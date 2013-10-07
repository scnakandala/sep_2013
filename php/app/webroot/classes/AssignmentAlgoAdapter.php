<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class for Assignment Algo Adoptation
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 22 july 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/HungarianAlgorithm.php';
require_once ROOT_DIR . '/classes/PanelBuilder.php';
require_once ROOT_DIR . '/classes/FileWriter.php';
require_once ROOT_DIR . '/libraries/Dictionary.php';

/**
 * AssignmentAlgoAdapter Class
 */
class AssignmentAlgoAdapter {

    /**
     * Over all value
     * 
     * @var int
     */
    var $overAllValue;

    /**
     * Panel Slots
     * 
     * @var PanelSlot[]
     */
    var $panelSlots;

    /**
     * project handler
     * 
     * @var ProjectHandler
     */
    var $projectHandler;

    /**
     * Assigned Data
     * 
     * @var type 
     */
    var $assignedData;

    /**
     * Constructor
     */
    public function __construct() {
        $pb = new PanelBuilder();
        $valueMatrix = array();
        $this->projectHandler = ProjectHandler::getInstance();
        $indexNumbers = $this->projectHandler->indexNumberVector;
        $this->panelSlots = $pb->panels;
        $this->overAllValue = 0;
        for ($i = 0; $i < count($indexNumbers); $i++) {
            $valueVector = array();
            $catLength = TimeSlotMatrixManager::getInstance()->categoryLength;
            $typeIncrimentor = $catLength[count($catLength) - 1];
            $oldType = -1;
            for ($j = 0; $j < count($this->panelSlots); $j++) {
                $value = 10 * $this->projectHandler->evaluateProjectAgainstPanel(
                                $i, $this->panelSlots[$j]->internalEvaluators, $this->panelSlots[$j]->externaEvaluators
                );
                if ($oldType != $this->panelSlots[$j]->templateNumber) {
                    $oldType = $this->panelSlots[$j]->templateNumber;
                    $typeIncrimentor = $catLength[count($catLength) - 1];
                } else {
                    $typeIncrimentor--;
                }

                if ($value > 0) {
                    $value = $value + (4 - $this->panelSlots[$j]->category) * $typeIncrimentor;
                }
                array_push($valueVector, $value);
            }
            array_push($valueMatrix, $valueVector);
        }

        $costs = array();
        for ($i = 0; $i < count($valueMatrix[0]); $i++) {
            $costs[$i] = array_fill(0, count($valueMatrix[0]), 0);
        }

        $maxValue = 0;
        for ($i = 0; $i < count($valueMatrix); $i++) {
            for ($j = 0; $j < count($valueMatrix[$i]); $j++) {
                $maxValue = max($maxValue, $valueMatrix[$i][$j]);
            }
        }

        for ($i = 0; $i < count($valueMatrix); $i++) { // tasks
            for ($j = 0; $j < count($valueMatrix[$i]); $j++) { // Agents
                $costs[$j][$i] = $maxValue - $valueMatrix[$i][$j];
            }
        }
        $hungAlgo = new HungarianAlgorithm($costs);
        $assignments = $hungAlgo->findAssignments();

        $this->valuePrinter($this->projectHandler, $indexNumbers, $this->panelSlots, $assignments, false);
        $this->printToFile($assignments, false);
        
        $this->assignedData = new Dictionary();
        for ($i = 0; $i < count($this->panelSlots); $i++) {
            if ($assignments[$i] < count($indexNumbers)) {
                $this->assignedData->offsetSet($this->panelSlots[$i], $assignments[$i]);
                //array_push($this->assignedData, array((string)$this->panelSlots[$i] => $assignments[$i]));
            } else {
                $this->assignedData->offsetSet($this->panelSlots[$i], -1);
                //array_push($this->assignedData, array((string)$this->panelSlots[$i] => -1));
            }
        }
        
        $sortingList = array();
        foreach ($this->panelSlots as $panelSlot) {
            array_push($sortingList, $panelSlot);
        }
        usort($sortingList, 'PanelSlot::compareSlotbySlotNumber');

        for ($i = 0; $i < count($sortingList); $i++) {
            $currentAssignment = $this->assignedData->offsetGet($sortingList[$i]);
            //$currentAssignment= array_search($sortingList[$i], $this->assignedData);
            $currentAssignment == false ? $currentAssignment = 0 : $currentAssignment = $currentAssignment;
            if ($currentAssignment < 0) {
                $j = count($sortingList) - 1;
                for (; $j > $i; $j--) {
                    $invalidationCandidate = -1;
                    $invalidationCandidate = $this->assignedData->offsetGet($sortingList[$j]);
                    $invalidationCandidate == false ? $invalidationCandidate = -1 : $invalidationCandidate = $invalidationCandidate;
                    if ($invalidationCandidate >= 0) {
                        $newValue = $this->projectHandler->evaluateProjectAgainstPanel(
                                $invalidationCandidate, $sortingList[$i]->internalEvaluators, $sortingList[$i]->externaEvaluators
                        );
                        if ($newValue > 0) {
                            $this->assignedData->offsetUnset($sortingList[$i]);
                            $this->assignedData->offsetSet($sortingList[$i], $invalidationCandidate);
                            $this->assignedData->offsetUnset($sortingList[$j]);
                            $this->assignedData->offsetSet($sortingList[$j], -1);
                            break;
                        }
                    }
                }
                if ($j == $i) {
                    break;
                }
            }
        }
        
        $this->valuePrinter($this->projectHandler, $indexNumbers, $this->panelSlots, $assignments, true);
        $this->printToFile(array(), true);
    }
    
    /**
     * Function to print to file with empty parameters
     * 
     * @return void
     */
    public function printToFileWithEmptyParameters()
    {
        $this->printToFile(array(), true);
    }

    /**
     * Function to print to file
     * 
     * @param array $assignments assignments
     * @param bool  $fromDict    from dictionary or not
     */
    private function printToFile($assignments, $fromDict) {
        $keyLines = array();
        $data = array();
        $indexNumbers = $this->projectHandler->indexNumberVector;
        $cuttentTemplateNumber = 0;
        $indexList = array();
        $addLine = false;
        for ($i = 0; $i < count($this->panelSlots); $i++) {
            if ($this->panelSlots[$i]->templateNumber == $cuttentTemplateNumber) {
                if ($fromDict) {
                    $index = $this->assignedData->offsetGet($this->panelSlots[$i]);
                    //array_search($this->panelSlots[$i], $this->assignedData);
                    $index == false ? $index = -1 : $index = $index;
                } else {
                    $index = $assignments[$i];
                }
                if (($index < 0) || ($index >= count($indexNumbers) )) {
                    //dataLine.Add("nill");
                } else {
                    array_push($indexList, $indexNumbers[$index]);
                }
            } else {
                $addLine = true;
            }

            if (($i == (count($this->panelSlots) - 1)) || ($addLine)) {
                array_push($keyLines, "" . $this->panelSlots[$i - 1]->category);
                $dataLine = array();
                array_push($dataLine, $this->panelSlots[$i - 1]->getInternalEvalautorString());
                array_push($dataLine, $this->panelSlots[$i - 1]->getExternalEvaluatorString());
                foreach ($indexList as $idx) {
                    array_push($dataLine, $idx);
                }
                $indexList = array();
                if ($fromDict) {
                    $index = $this->assignedData->offsetGet($this->panelSlots[$i]);
                    //array_search($this->panelSlots[$i], $this->assignedData);
                    $index == false ? $index = -1 : $index = $index;
                } else {
                    $index = $assignments[$i];
                }

                if (($index < 0) || ($index >= count($indexNumbers))) {
                    //dataLine.Add("nill");
                } else {
                    array_push($indexList, $indexNumbers[$index]);
                }

                $cuttentTemplateNumber = $this->panelSlots[$i]->templateNumber;
                array_push($data, $dataLine);
                $addLine = false;
            }
        }

        //Write the key
        $keyWriter = new FileWriter(ROOT_DIR . "/resources/key.txt");
        $keyWriter->writeLines($keyLines);

        //Write the matrix
        $valueWriter = new FileWriter(ROOT_DIR . "/resources/value.csv");
        $title = array('Assignment', 'Internal', 'External');
        $valueWriter->writeStringMatrix($title, $keyLines, $data);
    }

    /**
     * Function to print the values
     * 
     * @param Object $projectHandler project handler
     * @param array  $indexNumbers   index numbers
     * @param array  $panelSlots     panelslots
     * @param array  $assignments    assignments
     * @param bool   $useDict        whether use dictionary or not
     * 
     * @return type
     */
    private function valuePrinter($projectHandler, $indexNumbers, $panelSlots, $assignments, $useDict) {
        $nillRuns = array();
        $inNillRun = false;
        $currentNillRunValue = 0;
        for ($i = 0; $i < count($panelSlots); $i++) {
            if ($useDict) {
                $comparater = $this->assignedData->offsetGet($panelSlots[$i]);
                $comparater == false ? $comparater = 0 : $comparater = $comparater;
                if($comparater < 0){
                    $comparater = count($indexNumbers);
                }                
            } else {
                $comparater = $assignments[$i];                      
            }
            
            if ($comparater < count($indexNumbers)) {
                $assignmentvalue = $this->assignmentValue($projectHandler, $panelSlots, $assignments, $i, $useDict);
                if ($assignmentvalue == 0) {
                    $this->overAllValue = 0;
                    return;
                }

                $this->overAllValue += $assignmentvalue;
                if ($inNillRun) {
                    $inNillRun = false;
                    array_push($nillRuns, $currentNillRunValue);
                    $currentNillRunValue = 0;
                }
            } else {
                if ($inNillRun) {
                    $currentNillRunValue++;
                } else {
                    $inNillRun = true;
                    $currentNillRunValue = 1;
                }
            }
        }
    }

    /**
     * Function to get the assignment value
     * 
     * @param Object $projHandler project handler
     * @param array  $panelSlots  panel slots
     * @param array  $assignments assignments
     * @param int    $i           counter
     * @param bool   $useDict     whether use dictionary or not
     * 
     * @return int
     */
    public function assignmentValue($projHandler, $panelSlots, $assignments, $i, $useDict) {
        $index = 0;
        if ($useDict) {
            $index = $this->assignedData->offsetGet($panelSlots[$i]);
            if ($index < 0) {
                return (0);
            }
        } else {
            $index = $assignments[$i];
        }
        
        return $projHandler->evaluateProjectAgainstPanel(
                        $index, $panelSlots[$i]->internalEvaluators, $panelSlots[$i]->externaEvaluators
        );
    }

    /**
     * Function to compare allocation by over all value
     * 
     * @param Object $asignAlgoAdap1 AssignemntAlgoAdapter instance
     * @param Object $asignAlgoAdap2 AssignmentAlgoAdapter 
     * 
     * @return int
     */
    public static function compareAllocationByOverAllValue($asignAlgoAdap1, $asignAlgoAdap2) {
        if ($asignAlgoAdap1->overAllValue > $asignAlgoAdap2->overAllValue)
            return -1;
        else if ($asignAlgoAdap1->overAllValue == $asignAlgoAdap2->overAllValue)
            return 0;
        else
            return 1;
    }

    /**
     * Function to get the over all value
     * 
     * @return bool
     */
    public function getOverAllValue() {
        return $this->overAllValue;
    }
    
    /**
     * Function to set overAllValue
     * 
     * @param bool $val
     * 
     * @return void
     */
    public function setOverAllValue($val) {
        $this->overAllValue = $val;
    }

}

?>

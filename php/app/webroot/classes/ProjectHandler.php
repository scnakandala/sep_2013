<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to handle the project
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 20 july 2013
 */


require_once ROOT_DIR . '/classes/ExternalEvaluatorMatrixManager.php';

/**
 * ProjectHandler class
 */
class ProjectHandler {
    /**
     * Instance of the singleton class
     * 
     * @var ProjectHandler
     */
    static $instance;
    
    /**
     * Index number vector
     * 
     * @var string[]
     * 
     */
    var $indexNumberVector;
    
    /**
     * Name vector
     * 
     * @var string[]
     */
    var $nameVector;
    
    /**
     * Mid marks vector
     * 
     * @var int[]
     */
    var $midMarksVector;
    
    /**
     * Internal evalautor vector
     * 
     * @var string[]
     */
    var $internalEvaluatorVector;
    
    /**
     * Technology availability vector
     * 
     * @var bool[]
     */
    var $technologyAvailabilityVector;
    
    /**
     * Internal evaluator assignability matrix
     * 
     * @var int[][]
     */
    var $internalEvaluatorAssignabilityMatrix;
    
    /**
     * Technology vector
     * 
     * @var string[]
     */
    var $technologyVector;
    
    /**
     * Project technology matrix 
     * 
     * $var boolean[][]
     */
    var $projectTechnologyMatrix;
    
    /**
     * External evaluator matrix manager
     * 
     * @var ExternalEvalauatorMatrixManager
     */
    var $externalEvaluatorMatrixManager;
    
    /**
     * Call this function to get the instance
     * 
     * @retrun ProjectHandler
     */
    public static function getInstance() {
        if (empty(ProjectHandler::$instance)) {
            ProjectHandler::$instance
                =  new ProjectHandler(); 
        }
        return ProjectHandler::$instance;
    }
    
    /**
     * Private constructor of the class. The class is made singleton
     */
    private function __construct() {
        $this->indexNumberVector = array();
        $this->nameVector = array();
        $this->midMarksVector = array();
        $this->internalEvaluatorVector = array();
        $this->technologyAvailabilityVector = array();
        $this->internalEvaluatorAssignabilityMatrix = array();
        $this->technologyVector = array();
        $this->projectTechnologyMatrix = array();
        $this->externalEvaluatorMatrixManager
            = ExternalEvaluatorMatrixManager::getInstance();
    }
    
    /**
     * Function to get the technology vector
     * 
     * @return string[]
     */
    public function getTechnologyVector() {
        $this->technologyVector;
    }
    
    /**
     * Function to get the internal evaluator vector
     * 
     * @return string[]
     */
    public function getInternalEvalautorVector() {
        $this->internalEvaluatorVector;
    }
    
    /**
     * Function to get the index number vector
     * 
     * @return string[]
     */
    public function getIndexNumberVector() {
        $this->indexNumberVector;
    }
    
    /**
     * Function to set data
     * 
     * @param string[][] $data
     * 
     * @return void
     */
    public function setData($data) {
        for ($i = 0; $i < count($data); $i++) {
            $dataLine = $data[$i];
            if ($i == 0) {
                    $this->readTitles($dataLine);
            } else {
                $this->readProject($dataLine);
            }
        }
    }
    
    public function evaluateProjectAgainstPanel($projIndex, $internalEvaluators, $externalEvalautors) {
        $value = 1;
        for ($i = 0; $i < count($internalEvaluators); $i++) {
            $inernalEvalIndex = array_search($internalEvaluators[$i], $this->internalEvaluatorVector);
            $value = $this->internalEvaluatorAssignabilityMatrix[$projIndex][$inernalEvalIndex] * $value;
            //breaking condition
            if ($value == 0){
                return ($value);
            }
        }
        
        $externalValue = 1;
        $allProjectTechnologyList = $this->projectTechnologyMatrix[$projIndex];
        $projectTechnologyList = array();
        for ($i = 0; $i < count($allProjectTechnologyList); $i++) {
            if ($allProjectTechnologyList[$i]) {
                array_push($projectTechnologyList, $this->technologyVector[$i]);
            }
        }
        $externalValue += $this->externalEvaluatorMatrixManager->calculateValueOfChoice($externalEvalautors,$projectTechnologyList);
        $value *= $externalValue;
        
        
        return $value;
    }
    
    /**
     * Function to read titles
     * 
     * @param string[] $dataLine
     * 
     * @return void
     */
    private function readTitles($dataLine) {
        $i = 3;
        for (; !($dataLine[$i] == "|"); $i++) {
            array_push($this->internalEvaluatorVector, $dataLine[$i]);
        }
        $i++;
        for (; $i < count($dataLine); $i++) {
            $currentTechStatus
                = $this->externalEvaluatorMatrixManager->isTechnologyValid(
                    $dataLine[$i]
                );
            array_push($this->technologyAvailabilityVector, $currentTechStatus);
            if ($currentTechStatus) {
                array_push($this->technologyVector, $dataLine[$i]);                 
            }
        }            
    }
    
    /**
     * Function to read project
     * 
     * @param string[] $dataLine
     * 
     * @return void
     */
    private function readProject($dataLine) {
        array_push($this->indexNumberVector, $dataLine[0]);
        array_push($this->nameVector, $dataLine[1]);
        array_push($this->midMarksVector, $dataLine[2]);
        
        $index = 3;
        $internalEvaluatorAssignabilityVector = array();
        for (; !($dataLine[$index] == "|"); $index++) {
            array_push($internalEvaluatorAssignabilityVector, $dataLine[$index]);
        }
        array_push(
            $this->internalEvaluatorAssignabilityMatrix,
            $internalEvaluatorAssignabilityVector
        );
        $index++;
            
        $offset = $index;
        $projectTechnologyVector = array();
        for (; $index < count($dataLine); $index++) {
            if ($this->technologyAvailabilityVector[$index-$offset]) {
                if ($dataLine[$index] == 0) {
                    array_push($projectTechnologyVector, FALSE);
                } else {
                    array_push($projectTechnologyVector, TRUE);
                }                    
            }
        }
        array_push($this->projectTechnologyMatrix, $projectTechnologyVector);
    }
    
    /**
     * Functio to print data
     * 
     * @return void
     */
    public function printData() {
        print("\n");
        $this->printStudentData();
        print("\n");
        $this->printInternalMatrix();
        print("\n");
        $this->printTechMatrix();
        print("\n");
    }
    
    /**
     * Function to print student data
     * 
     * @return void
     */
    public function printStudentData() {
        $line = "";
        //Title
        $line .= "Index\tName\tMid marks";            
        print($line . "\n");
        //Data
        for ($i = 0; $i < count($this->indexNumberVector); $i++) {
            $line = $this->indexNumberVector[$i] . "\t" . $this->nameVector[$i] 
                    . "\t" . $this->midMarksVector[$i];               
            print($line . "\n");
        }
    }
    
    
    /**
     * Function to print internal matrix
     * 
     * @return void
     */
    public function printInternalMatrix() {
        $line = "";
        //Title
        $line .= "Index ";
        for ($i = 0; $i < count($this->internalEvaluatorVector); $i++) {
            $line .= $this->internalEvaluatorVector[$i] . " ";
        }
        print($line . "\n");
        //Data
        for ($i = 0; $i < count($this->indexNumberVector); $i++) {
            $line = $this->indexNumberVector[$i] . "\t";
            for ($j = 0; $j < count($this->internalEvaluatorAssignabilityMatrix[$i]); $j++) {
                $line .= $this->internalEvaluatorAssignabilityMatrix[$i][$j] == 1 ? 'true ' : 'false ';
            }
            print($line . "\n");
        }
    }
    
    /**
     * Function to print tech matrix
     * 
     * @return void
     */
    public function printTechMatrix() {
        $line = "";
        //Title
        $line .= "Index ";
        for ($i = 0; $i < count($this->technologyVector); $i++) {
            $line .= $this->technologyVector[$i] . " ";
        }
        print($line . "\n");
        //Data
        for ($i = 0; $i < count($this->indexNumberVector); $i++) {
            $line = $this->indexNumberVector[$i] . " ";
            for ($j = 0; $j < count($this->projectTechnologyMatrix[$i]); $j++) {
                $line .= $this->projectTechnologyMatrix[$i][$j] == 1 ? 'true ' : 'false ';
            }
            print($line . "\n");
        }
    }
}
?>

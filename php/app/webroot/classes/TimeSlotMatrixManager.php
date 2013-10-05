<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * TimeSlotMatrixManager class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 20 july 2013
 */

require_once ROOT_DIR . '/classes/ProjectHandler.php';

/**
 * TimeSlotMatrixManager class
 */
class TimeSlotMatrixManager {

    /**
     * Instance of the Singleton class
     * 
     * @var TimeSlotMatrixManager
     */
    static $instance;

    /**
     * Slot column
     * 
     * @var int
     */
    var $slotCount;

    /**
     * Evaluator vector
     * 
     * @var string[]
     */
    var $evaluatorVector;

    /**
     * Project Handler
     * 
     * @var ProjectHandler
     */
    var $projectHandler;

    /**
     * Evaluator time slot matrix
     * 
     * @var boolean[][]
     */
    var $evaluatorTimeSlotMatrix;

    /**
     * Category length
     * 
     * @var int[]
     */
    var $categoryLength;

    /**
     * Call this function to get the instance
     * 
     * @retrun TimeSlotMatrixManager
     */
    public static function getInstance() {
        if (empty(TimeSlotMatrixManager::$instance)) {
            TimeSlotMatrixManager::$instance
                    = new TimeSlotMatrixManager();
        }
        return TimeSlotMatrixManager::$instance;
    }

    /**
     * Private constructor of the class. The class is made singleton
     * 
     */
    private function __construct() {
        $this->evaluatorVector = array();
        $this->projectHandler = ProjectHandler::getInstance();
        $this->evaluatorTimeSlotMatrix = array();
        $this->categoryLength = array();
    }

    /**
     * Function to get the evaluator vector
     * 
     * @return string[]
     */
    public function getEvaluatorVector() {
        return $this->evaluatorVector;
    }

    /**
     * Function to get the evaluator time slot matrix
     * 
     * @return boolean[][]
     */
    public function getEvaluatorTimeSlotMatrix() {
        return $this->evaluatorTimeSlotMatrix;
    }

    /**
     * Function to get category length
     * 
     * @return int[]
     */
    public function getCategoryLength() {
        return $this->categoryLength;
    }

    /**
     * Function to get external evaluator possibility
     * 
     * @param int $category
     * @param string $evaluator
     * 
     * @return boolean
     */
    public function getExternalEvaluaterPossibility($category, $evaluator) {
        $evalIndex = array_search($evaluator, $this->evaluatorVector);
        return ($this->evaluatorTimeSlotMatrix[$category][$evalIndex]);
    }

    /**
     * Function to set data
     * 
     * @param string[][] $data
     * 
     * @return void
     */
    public function setData($data) {
        $this->slotCount = count($data[0]) - 1;
        $patternCount = 1;

        for ($j = 1; $j < count($data[0]); $j++) {
            $externalEvalTimeSlotVector = array();
            $addPattern = false;
            for ($i = 2; $i < count($data); $i++) {
                array_push($this->evaluatorVector, $data[$i][0]);
                if ($data[$i][$j] == 0) {
                    array_push($externalEvalTimeSlotVector, false);
                } else {
                    array_push($externalEvalTimeSlotVector, true);
                }
            }
            if ($j == (count($data[0]) - 1)) {
                $addPattern = true;
            }
            $addLine = false;
            if (count($this->evaluatorTimeSlotMatrix) > 0) {
                for ($i = 0; $i < count($externalEvalTimeSlotVector); $i++) {
                    if ($this->evaluatorTimeSlotMatrix[count($this->evaluatorTimeSlotMatrix) - 1][$i] != $externalEvalTimeSlotVector[$i]) {
                        $addPattern = true;
                        $addLine = true;
                        break;
                    }
                }
            } else {
                $addLine = true;
            }

            if ($addLine) {
                array_push($this->evaluatorTimeSlotMatrix, $externalEvalTimeSlotVector);
            } else {
                $patternCount++;
            }

            if ($addPattern) {
                array_push($this->categoryLength, $patternCount);
                $patternCount = 1;
            }
        }
    }
    
    /**
     * Function to print data
     * 
     * @return void
     */
    public function printData() {
        $line = "\nName\t";
        for ($i = 0; $i < count($this->evaluatorTimeSlotMatrix); $i++) {
            $line .= $i . " ";
        }
        print($line . "\n");
        for ($i = 0; $i < count($this->evaluatorTimeSlotMatrix[0]); $i++) {
            $line = $this->evaluatorVector[$i] . "\t";
            for ($j = 0; $j < count($this->evaluatorTimeSlotMatrix); $j++) {
                $line .= $this->evaluatorTimeSlotMatrix[$j][$i] == 1 ? 'true ' : 'false ';
            }
            print($line . "\n");
        }
    }

}

?>

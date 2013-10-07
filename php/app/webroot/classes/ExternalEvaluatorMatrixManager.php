<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to manage the external evaluator matrix
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 20 july 2013
 */

require_once 'config.php';

/**
 * ExternalEvaluatorMatrixManager class
 */
class ExternalEvaluatorMatrixManager {
    
    /**
     * Instance of the sigleton class
     * 
     * @var ExternalEvaluatorMatrixManage
     */
    static $instance;
    
    /**
     * Array of different technologies
     * 
     * @var string[]
     */
    var $technologyVector;
    
    /**
     * Frequency Vector
     * 
     * @var int[]
     */
    var $frequencyVector;
    
    /**
     * Array of evaluators
     * 
     * @var string[]
     */
    var $evaluatorVector;
    
    /**
     * Matrix of external evaluators
     * 
     * @var int[][]
     */
    var $matrix;
    
    /**
     * Call this function to get the instance
     * 
     * @retrun ExternalEvaluatorMatrixManager
     */
    public static function getInstance() {
        if (empty(ExternalEvaluatorMatrixManager::$instance)) {
            ExternalEvaluatorMatrixManager::$instance
                =  new ExternalEvaluatorMatrixManager(); 
        }
        return ExternalEvaluatorMatrixManager::$instance;
    }
    
    /**
     * Private constructor of the class. The class is made singleton
     * 
     */
    private function __construct() {
        $this->evaluatorVector = array();
        $this->frequencyVector = array();
        $this->technologyVector = array();
        $this->matrix = array();
        
    }
    
    /**
     * Function to set the external evaluator data
     * 
     * @param string[][] $data data
     * 
     * @return void
     */
    public function setData($data) {
        for ($i = 0; $i < count($data); $i++) {
            $dataLine = $data[$i];
            if ($i == 0) {
                $slicedArray = array_slice($dataLine, 2 , count($dataLine) - 3);
                foreach ($slicedArray as $element){
                    array_push($this->evaluatorVector,$element );                
                }
            } else {
                $evalCount = $dataLine[count($dataLine) - 1];
                if ($evalCount > 0) {
                    array_push($this->technologyVector, $dataLine[0]);
                    array_push($this->frequencyVector, $dataLine[1]);
                    $matrixRow = array();
                    for ($j = 2; $j < count($dataLine)-1; $j++) {
                        array_push($matrixRow,$dataLine[$j]);
                    }
                    array_push($this->matrix, $matrixRow);
                }
            }
        }
    }
    
    /**
     * Function to calculate the value of choice
     * 
     * @param string[] $evaluators   evaluators
     * @param string[] $technologies technologies
     * 
     * @return int
     */
    public function calculateValueOfChoice($evaluators, $technologies) {
        $value = 0;
        for ($i = 0; $i < count($technologies); $i++) {
            $techIndex = array_search($technologies[$i],$this->technologyVector);
            if ($techIndex >= 0) {
                for ($j = 0; $j < count($evaluators); $j++) {
                    $evalIndex
                        = array_search($evaluators[$j], $this->evaluatorVector);
                    if ($evalIndex >= 0){
                        $value += $this->matrix[$techIndex][$evalIndex];                         
                    }
                }
            }
        }
        return ($value);
    }
        
    /**
     * Function to check whether a given tech is valid
     * 
     * @param string $tech technology
     * 
     * @return boolean
     */
    public function isTechnologyValid($tech) {
        return in_array($tech, $this->technologyVector);
    }
    
    /**
     * Function to get the technology vecotor
     * 
     * @return string[] $technologyVector technology vector
     */
    public function getTechnologyVector() {
        return $this->technologyVector;
    }
        
    /**
     * Function to get the list of external evaluators
     * 
     * @return string[]
     */
    public function getExternalEvaluatorVector() {
        return $this->evaluatorVector;
    }
    
    /**
     * Function print data
     * 
     * @return void
     */
    public function printData() {
        print("\nEvaluators\n");
        for ($i = 0; $i<count($this->evaluatorVector); $i++)
        {
            print($this->evaluatorVector[$i] . "\n");
        }
        print("Passed tech\n");
        for ($i = 0; $i < count($this->technologyVector); $i++)
        {
            print($this->technologyVector[$i] . "\n");
        }
        print("Matrix\n");
        for ($i = 0; $i <count($this->matrix); $i++)
        {
            $martixRow = $this->matrix[$i];
            $line = "";
            for ($j = 0; $j < count($martixRow); $j++)
            {
                $line .= $martixRow[$j] . " ";
            }
            print($line . "\n");
        }
    }
}
?>

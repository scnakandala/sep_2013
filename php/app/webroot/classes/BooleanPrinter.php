<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class for Boolean Printing
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 6 August 2013
 */

require_once 'config.php';

/**
 * Boolean Printer Class
 */
class BooleanPrinter {
    
    /**
     * Instance of the Boolean Printer class
     * 
     * @var BooleanPrinter
     */
    static $instance;
    
    /**
     * Call this function to get the instance
     * 
     * @retrun BooleanPrinter
     */
    public static function getInstance() {
        if (empty(BooleanPrinter::$instance)) {
            BooleanPrinter::$instance
                    = new BooleanPrinter();
        }
        return BooleanPrinter::$instance;
    }
    
    /**
     * Private constructor of the class. The class is made singleton
     * 
     */
    private function __construct() {
    }
    
    /**
     * Given a bool value function to get the string
     * 
     * @param bool $candidate candidate
     * 
     * @return string
     */
    public function getBooleanString($candidate) {
        if ($candidate == 1) {
            return ("1");
        } else {
            return ("0");
        }
    }
    
    
    /**
     * Given a bool array function to print to the console
     * 
     * @param bool[] $candidateLine candidate line
     * 
     * @return void
     */
    public function printLine($candidateLine) {
        for ($i=0;$i<count($candidateLine);$i++){
            print($candidateLine[$i] + " ");
        }
        print("\n");
    }
    
    /**
     * Given a boolean matrix function to print it to the console
     * 
     * @param bool[][] $matrix matrix
     * 
     * @return void
     */
    public function printMatrix($matrix) {
        for($i=0;$i<count($matrix[i]);$i++){
            $this->printLine($matrix[$i]);
        }
    }
}

?>

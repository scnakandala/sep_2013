<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class for writing CSV files
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 6 August 2013
 */


/**
 * FileWriter Class
 */

class FileWriter {
    /**
     * File
     * 
     * @var File
     */    
    var $file;
    
    /**
     * The constructor
     * 
     * @param string $name file name
     */
    public function __construct($name) {
        $this->file = fopen($name, 'w');
    }
    
    /**
     * Function to write lines to a file
     * 
     * @param string[] $lines lines
     * 
     * @return void
     */
    public function writeLines($lines) {           
        for ($i = 0; $i < count($lines); $i++) {
            fwrite($this->file, $lines[$i] . "\n");
        }
        fclose($this->file);
    }
    
    /**
     * Function ot write in matrix
     * 
     * @param array $horizental horizental
     * @param array $vertical   verticle
     * @param array $matrix     matrix
     */
    public function writeIntMatrix($horizental, $vertical, $matrix) {
        $newMatrix = array();
        for($i=0;$i<count($matrix); $i++){
            $matrixLine = array();
            for($j=0;$j<count($matrix[i]); $j++) {
                array_push($matrixLine, $matrix[i][j] . "");
            }
            array_push($newMatrix, $matrixLine);
        }
        $this->writeStringMatrix($horizental, $vertical, $newMatrix);
    }
    
    
    /**
     * Function to write string matrix
     * 
     * @param array $horizental horizental
     * @param array $vertical   vertical
     * @param array $matrix     matrix
     */
    public function writeStringMatrix($horizental, $vertical, $matrix) {
        $lines = array();
        // first line
        $line = ""; //there is an empty space at the begining ?
        for($i=0;$i<count($horizental);$i++) {
            $line .= $horizental[$i] . ",";
        }
        array_push($lines, $line);
        
        //rest of the lines
        for($i=0;$i<count($vertical);$i++) {
            $line = $vertical[$i] . ",";
            for($j=0; $j < count($matrix[$i]);$j++) {
                $line .= $matrix[$i][$j] . ",";
            }
            array_push($lines, $line);
        }
        
        $this->writeLines($lines);
    }    
}
?>

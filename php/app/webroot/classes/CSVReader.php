<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to read data from a csv file and return a string array
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 17 july 2013
 */

require_once ROOT_DIR . '/libraries/ParseCSV.php';

/**
 * CSVReader class
 */
class CSVReader {
    
    /**
     * Instance of the ParseCSV class
     * 
     * @var ParseCSV class
     */
    var $csv;
    
    /**
     * Constructor
     * 
     * @param string $fileName file name 
     */
    public function __construct($fileName) {
        $this->csv = new parseCSV();
        $this->csv->delimiter = ",";
	$this->csv->parse($fileName);
    }
    
    /**
     * Function to get the array of string arrays the csv file
     * 
     * @return array
     */
    public function getData() {
        $data = array();
        $titles = array();
        foreach ($this->csv->titles as $value) {
            array_push($titles, $value);
        }
        $data[0] = $titles;
        
        foreach ($this->csv->data as $key => $row) {
            $elements = array();
            foreach ($row as $value) {
                array_push($elements, $value);
            }
            $data[count($data)] = $elements;
        }        
        return $data;
    }
}
?>

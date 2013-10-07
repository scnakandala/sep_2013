<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to test the CSVReader class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 17 july 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/CSVReader.php';

class CSVReaderTest extends PHPUnit_Framework_TestCase {
    var $csvReader;
    
    /**
     * Set up function for setting up essential variables.
     */
    public function setup() {
        $this->csvReader = new CSVReader(ROOT_DIR . '/tests/_books.csv');
    }
    
    /**
     * Function to test the csv reader.
     */
    public function testCSVReader() {
        $data = $this->csvReader->getData();
        $this->assertEquals(15, count($data));
        $this->assertEquals("The Traveller",$data[4][1]);
    }
}
?>

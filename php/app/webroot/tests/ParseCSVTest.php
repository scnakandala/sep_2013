<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to test the ParseCSV class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 17 july 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/libraries/ParseCSV.php';

class ParseCSVTest extends PHPUnit_Framework_TestCase {

    var $csv;
    
    /**
     * Setup the csv reader.
     */
    public function setup() {
        $this->csv = new parseCSV();
    }  
    
    /**
     * Function to test the parsecsv method.
     */
    public function testParseCSV() {
        # Parse '_books.csv' using automatic delimiter detection...
        $this->csv->auto(ROOT_DIR . '/tests/_books.csv');

        # ...or if you know the delimiter, set the delimiter character
        # if its not the default comma...
        // $this->csv->delimiter = "\t";   # tab delimited

        # ...and then use the parse() function.
        // $this->csv->parse('_books.csv');
        
        $this->assertEquals(7, count($this->csv->titles));
        $this->assertEquals("title", $this->csv->titles[1]);
        $this->assertEquals(14, count($this->csv->data));
        $this->assertEquals("Crisis Four", $this->csv->data[4]['title']);      
    }
}
?>

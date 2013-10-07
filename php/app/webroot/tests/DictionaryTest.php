<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to test the Dictionary class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 12 September 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/libraries/Dictionary.php';

class DictionaryTest extends PHPUnit_Framework_TestCase {
    var $dictionary;
    
    /**
     * Set up function for setting up essential variables.
     */
    public function setup() {
        $this->dictionary = new Dictionary();
    }
    
    /**
     * Function to test the Dictionary testoffsetSet
     */
    public function testOffsetSet() {
        $this->dictionary->offsetSet("supun", "nakandala");
        $this->assertEquals(true, $this->dictionary->offsetExists("supun"));
    }
    
    /**
     * Function to test the Dictionary testoffsetGet
     */
    public function testOffsetGet() {
        $this->dictionary->offsetSet("abc", "def");
        $this->assertEquals("def", $this->dictionary->offsetGet("abc"));
    }
    
    /**
     * Function to test the Dictionary offset unset method
     */
    public function testOffsetUnset() {
        $this->dictionary->offsetSet("supun", "nakandala");
        $this->dictionary->offsetUnset("supun");
        $this->assertEquals(false, $this->dictionary->offsetExists("supun"));
    }
}
?>

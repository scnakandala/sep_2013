<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to test the HungarianAlgorithm class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 17 july 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/HungarianAlgorithm.php';

class HungarianAlgorithmTest extends PHPUnit_Framework_TestCase {
    var $costs;
    var $hungAlgo;
    
    /**
     * Sets up necessary variables
     */
    public function setup() {
        $this->costs[0] = array(1,0,0,1);
        $this->costs[1] = array(0,0,0,1);
        $this->costs[2] = array(1,1,1,1);
        $this->costs[3] = array(1,1,1,1);
        
        $this->hungAlgo = new HungarianAlgorithm($this->costs);
    }    
    
    /**
     * This method tests the find assignments method
     */
    public function testFindAssignments() {
        $assignments = $this->hungAlgo->findAssignments();
        $this->assertNotNull($assignments);
        $this->assertEquals(4, count($assignments));
        $this->assertEquals(1, $assignments[0]);
        $this->assertEquals(0, $assignments[1]);
        $this->assertEquals(2, $assignments[2]);
        $this->assertEquals(3, $assignments[3]);       
    }
}
?>

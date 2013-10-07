<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to test the Manager class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 10 August 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/Manager.php';

class ManagerTest extends PHPUnit_Framework_TestCase {
    
    /**
     * This method tests the overall execution using the manager class
     */
    public function testManager() {
        $manager = new Manager();
    }

}

?>

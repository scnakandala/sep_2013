<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Location class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 17 july 2013
 */

/**
 * Location class
 */
class Location {

    /**
     * row number of the location
     * 
     * @var int
     */
    var $row;
    
    /**
     * column number of the location
     * 
     * @var int
     */
    var $column;
    
    /**
     * Constructor
     * 
     * @param int $r row    row
     * @param int $c column column
     */
    function __construct($r, $c) {
        $this->row = $r;
        $this->column = $c;
    }
}

?>

<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class to represent Student
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 22 july 2013
 */

/**
 * Student class
 */
class Student {

    /**
     * Number
     * 
     * @var int
     */
    var $number;

    /**
     * Index number
     * 
     * @var string
     */
    var $indexNumber;

    /**
     * Name
     * 
     * @var string
     */
    var $name;

    /**
     * Internal posible evaluators vector
     * 
     * @var int[]
     */
    var $internalPossibleVector;

    /**
     * Technology vector
     * 
     * @var int[]
     */
    var $technologyVector;

    /**
     * Mid grade
     * 
     * @var int
     */
    var $midGrade;

    /**
     * Internal Count
     * 
     * @var int
     */
    var $internalCount;

    /**
     * Constructor
     */
    public function __construct() {
        $this->internalPossibleVector = array();
        $this->technologyVector = array();
        $this->internalCount = 0;
    }

    /**
     * Function to get the student number
     * 
     * @return int
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Function to set the student number
     * 
     * @param int $number
     * 
     * @return void 
     * 
     */
    public function setNumber($number) {
        $this->number = $number;
    }

    /**
     * Function to get the index number
     * 
     * @return string
     */
    public function getIndexNumber() {
        return $this->indexNumber;
    }

    /**
     * Function to set the index number
     * 
     * @param string $indexNumber
     * 
     * @return void 
     */
    public function setIndexNumber($indexNumber) {
        $this->indexNumber = $indexNumber;
    }

    /**
     * Function to get student name
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Function to set the student name
     * 
     * @param string $name
     * 
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Function to get the internal evaluators possible vector
     * 
     * @return int[]
     */
    public function getInternalPossibleVector() {
        return $this->internalPossibleVector;
    }

    /**
     * Function to set the possible internal evaluators vector
     * 
     * @param int[] $internalPossibleVector
     */
    public function setInternalPossibleVector($internalPossibleVector) {
        $this->internalPossibleVector = $internalPossibleVector;
    }

    /**
     * Function to get the technology vector
     * 
     * @return int
     */
    public function getTechnologyVector() {
        return $this->technologyVector;
    }

    /**
     * Function to set the technology vector
     * 
     * @param int[] $technologyVector
     * 
     * @return void
     */
    public function setTechnologyVector($technologyVector) {
        $this->technologyVector = $technologyVector;
    }

    /**
     * Function to get the mid grade
     * 
     * @return int
     */
    public function getMidGrade() {
        return $this->midGrade;
    }

    /**
     * Function to set the mid grade
     * 
     * @param int $midGrade
     * 
     * @return void
     */
    public function setMidGrade($midGrade) {
        $this->midGrade = $midGrade;
    }

    /**
     * Function to get the internal count
     * 
     * @return int
     */
    public function getInternalCount() {
        return $this->internalCount;
    }

    /**
     * Function to set the internal count
     * 
     * @param int $internalCount
     * 
     * @return void
     */
    public function setInternalCount($internalCount) {
        $this->internalCount = $internalCount;
    }

    /**
     * Function to count up the internal count
     * 
     * @return void
     */
    public function internalCountUp() {
        $this->internalCount++;
    }

    /**
     * Static function to compare two students by eval assignability
     * 
     * @param student $s1
     * @param student $s2
     * 
     * @return int
     */
    public static function compareStudentsByIntEvalAssignability($s1, $s2) {
        if ($s1->internalCount < $s2->internalCount) {
            return -1;
        } elseif ($s1->internalCount == $s2->internalCount) {
            return 0;
        } else {
            return 1;
        }
    }
}

?>

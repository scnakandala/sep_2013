<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class for Panel Slot
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 22 july 2013
 */

/**
 * PanelSlot class
 */
class PanelSlot {

    /**
     * Internal Evaluators
     * 
     * @var string[]
     */
    var $internalEvaluators;

    /**
     * External Evaluators
     * 
     * @var string[]
     */
    var $externaEvaluators;

    /**
     * Catogory
     * 
     * @var int 
     */
    var $category;

    /**
     * Remaining Vacancies
     * 
     * @var int
     */
    var $remainigVacancies;

    /**
     * Slot Number
     * 
     * @var int
     */
    var $slotNumber;

    /**
     * Template Number
     * 
     * @var int
     */
    var $templateNumber;

    /**
     * Constructor
     * 
     * @param string[] $internalEvaluators internal evaluators
     * @param int      $categ              category
     * @param int      $remainingVac       remaining vacancies
     */
    public function __construct($categ, $remainigVac) {
        $this->category = $categ;
        $this->remainigVacancies = $remainigVac;
        $this->internalEvaluators = array();
        $this->externaEvaluators = array();
    }
    
    public static function withInternalEvaluators($internalEvaluators, $categ, $remainingVac) {
        $instance = new self($categ, $remainingVac);
        foreach($internalEvaluators as $internalEvaluator) {
            array_push($instance->internalEvaluators, $internalEvaluator);
        }
    	return $instance;
    }
    
    public static function withCloningParent($cloningParent) {
        return PanelSlot::withCloningParentAndCateg($cloningParent, $cloningParent->category);
    }
    
    public static function withCloningParentAndCateg($cloningParent, $categ) {
        $instance  = PanelSlot::withInternalEvaluators(
                $cloningParent->internalEvaluators, $categ, $cloningParent->remainigVacancies
        );
        
        for ($i = 0; $i < count($cloningParent->externaEvaluators); $i++) {
            $instance->addExternalEvaluator($cloningParent->externaEvaluators[$i]);
            $instance->remainigVacancies++; //to make it neutral again
        }
        
        return $instance;
    }

    /**
     * Function to print when $length given
     * 
     * @param boolean $length
     */
    public function panelSlotPrint($length = null) {
        if (empty($length)) {
            print true;
        } else {
            if ($length) {
                print "Category " . $this->category . "\n";
                print ".................Internal................." . "\n";
                for ($i = 0; $i < count($this->internalEvaluators); $i++) {
                    print $this->internalEvaluators[$i] . "\n";
                }
                print ".................External................." . "\n";
                for ($i = 0; $i < count($this->externaEvaluators); $i++) {
                    print $this->externaEvaluators[$i] . "\n";
                }
            } else {
                $line = $this->toString();
                print $line . "\n";
            }
        }
    }

    /**
     * Function to translate this object to a string
     * 
     * @return void
     */
    public function toString() {
        $line = $this->category . " | " . $this->slotNumber . " | ";
        $line .= $this->getInternalEvaluatorString();
        $line .= $this->getExternalEvaluatorString();
        return $line;
    }

    /**
     * Function to get list of external evaluators as string
     * 
     * @return string
     */
    public function getExternalEvaluatorString() {
        $line = "";
        for ($i = 0; $i < count($this->externaEvaluators); $i++) {
            $line .= $this->externaEvaluators[$i] . " . ";
        }
        return $line;
    }

    /**
     * Function to get the internal evaluators in a string
     * 
     * @return string
     */
    public function getInternalEvalautorString() {
        $line = "";
        for ($i = 0; $i < count($this->internalEvaluators); $i++) {
            $line .= $this->internalEvaluators[$i] . " . ";
        }
        return $line;
    }

    /**
     * Function to add an interanl evaluator
     * 
     * @param string $name
     * 
     * @return void
     */
    public function addInternalEvaluator($name) {
        array_push($this->internalEvaluators, $name);
    }

    /**
     * Function to remove internal evaluator
     * 
     * @return int
     */
    public function removeInternalEvaluator() {
        $intEval = $this->internalEvaluators[count($this->internalEvaluators) - 1];
        unset($this->internalEvaluators[count($this->internalEvaluators)-1]);
        return ($intEval);
    }

    /**
     * Function to add external evaluator
     * 
     * @param string $name
     */
    public function addExternalEvaluator($name) {
        array_push($this->externaEvaluators, $name);
        $this->remainigVacancies--;
    }

    /**
     * Function to remove external evaluator
     * 
     * @param bool $withReplacement
     * 
     * @return string
     */
    public function removeExternalEvaluator($withReplacement) {
        $index = rand(0, count($this->externaEvaluators)-1);
        $extEval = $this->externaEvaluators[$index];
        unset($this->externaEvaluators[$index]);
        $this->externaEvaluators = array_values($this->externaEvaluators);
        if ($withReplacement) {
            $this->remainigVacancies++;
        }
        return ($extEval);
    }

    /**
     * Function to get remaining vacancies
     * 
     * @return int
     */
    public function getRemainigVacancies() {
        return $this->remainigVacancies;
    }

    /**
     * Function to set remaing vacancies
     * 
     * @param int $remainigVacancies
     * 
     * @return void
     */
    public function setRemainigVacancies($remainigVacancies) {
        $this->remainigVacancies = $remainigVacancies;
    }

    /**
     * Function to get the internal evaluators list
     * 
     * @return int[]
     */
    public function getInternalEvaluators() {
        return $this->internalEvaluators;
    }

    /**
     * Function to get external evaluators list
     * 
     * @return int[]
     */
    public function getExternaEvaluators() {
        return $this->externaEvaluators;
    }

    /**
     * Function to get the slot number
     * 
     * @return int
     */
    public function getSlotNumber() {
        return $this->slotNumber;
    }

    /**
     * Function to set the slot number
     * 
     * @param int $slotNumber
     */
    public function setSlotNumber($slotNumber) {
        $this->slotNumber = $slotNumber;
    }

    /**
     * Function to get the time slot  number
     * 
     * @return int
     */
    public function getTemplateNumber() {
        return $this->templateNumber;
    }

    /**
     * Function to set the template number
     * 
     * @param int $templateNumber
     * 
     * @return void
     */
    public function setTemplateNumber($templateNumber) {
        $this->templateNumber = $templateNumber;
    }

    /**
     * Function to get the category
     * 
     * @return int
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Static function to compare slot by slot number
     * 
     * @param PanelSlot $s1
     * @param PanelSlot $s2
     * 
     * @return int
     */
    public static function compareSlotbySlotNumber($s1, $s2) {
        if ($s1->slotNumber < $s2->slotNumber) {
            return -1;
        } elseif ($s1->slotNumber == $s2->slotNumber) {
            return 0;
        } else {
            return 1;
        }
    }
    
    /**
     * To String function
     * 
     * @return void
     */
    public function __toString()
    {
        return spl_object_hash($this);
    }

}

?>

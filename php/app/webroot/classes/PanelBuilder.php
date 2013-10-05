<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * PanelBuilder Class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 10 August 2013
 */

require_once ROOT_DIR . '/classes/TimeSlotMatrixManager.php';
require_once ROOT_DIR . '/classes/PanelSlot.php';
require_once ROOT_DIR . '/classes/PanelMotiffManager.php';

class PanelBuilder {

    /**
     * panel motiffs
     * 
     * @var array
     */
    var $panelMotiffs;

    /**
     * panels
     * 
     * @var array
     */
    var $panels;

    /**
     * TimeslotMatrixManager
     * 
     * @var Object
     */
    var $tsmm;

    /**
     * External evaluator vector
     * 
     * @var Object
     */
    var $externalevaluatorVector;

    /**
     * Panel generation 0
     * 
     * @var array
     */
    var $panelGeneration0;

    /**
     * Panel generation 1
     * 
     * @var array
     */
    var $panelGeneration1;

    /**
     * Panel generation 2
     * 
     * @var array
     */
    var $panelGeneration2;

    /**
     * Constructor
     */
    public function __construct() {
        $this->panelMotiffs = array();
        $this->panels = array();
        $this->tsmm = TimeSlotMatrixManager::getInstance();
        $this->externalevaluatorVector = array();
        $this->panelGeneration0 = array();
        $this->panelGeneration1 = array();
        $this->panelGeneration2 = array();

        $panel_motiffs = PanelMotiffManger::getInstance()->getData();
        foreach ($panel_motiffs as $key=>$panel_motiff){
            $this->createPanelMotiff($panel_motiff[0], $panel_motiff[1], $panel_motiff[2]);
        }
        $categoryLength = array();

        $catLengths = $this->tsmm->categoryLength;
        foreach ($catLengths as $catLength) {
            array_push($categoryLength, $catLength);
        }

        $exEvalVec = ExternalEvaluatorMatrixManager::getInstance()->getExternalEvaluatorVector();
        foreach ($exEvalVec as $exEval) {
            array_push($this->externalevaluatorVector, $exEval);
        }

        $category = 0;
        $panelGeneration0 = array();
        $this->buildGeneration0($category, $panelGeneration0);
        $this->buildPanelSlots($panelGeneration0, $categoryLength[$category], true);

        $category++;
        $panelGeneration1 = array();
        $this->buildGeneration1($category, $panelGeneration0, $panelGeneration1);
        $this->buildPanelSlots($panelGeneration1, $categoryLength[$category], false);

        $category++;
        $panelGeneration2 = array();
        $this->buildGeneration2($category, $panelGeneration1, $panelGeneration2);
        $this->buildPanelSlots($panelGeneration2, $categoryLength[$category], false);
    }

    /**
     * function to build panel slots
     * 
     * @param array $panelList
     * @param int   $categoryLength
     * @param bool  $firstGen
     * 
     * @return void
     */
    private function buildPanelSlots($panelList, $categoryLength, $firstGen) {
        for ($i = 0; $i < count($panelList); $i++) {
            $limit = $categoryLength;
            if ($firstGen) {
                $limit -= 2;
                if ($i > 2) {
                    $limit++;
                }
            }
            for ($j = 0; $j < $limit; $j++) {
                $panelInstance = PanelSlot::withCloningParent($panelList[$i]);
                $panelInstance->slotNumber = $j;
                $panelInstance->templateNumber = $i;
                array_push($this->panels, $panelInstance);
            }
        }
    }

    private function buildGeneration2($category, &$panelGeneration1, &$panelGeneration2) {
        array_push($panelGeneration2, $this->transferExternalEvaluators($panelGeneration1[5], $panelGeneration1[1], $category));
        array_push($panelGeneration2, $this->transferExternalEvaluators($panelGeneration1[2], $panelGeneration1[4], $category));
        array_push($panelGeneration2, PanelSlot::withCloningParentAndCateg($panelGeneration1[3], $category));
        array_push($panelGeneration2, PanelSlot::withCloningParentAndCateg($panelGeneration1[0], $category));
        array_push($panelGeneration2, PanelSlot::withCloningParentAndCateg($panelGeneration1[6], $category));
    }

    private function buildGeneration1($category, &$panelGeneration0, &$panelGeneration1) {
        $splitPanels1 = $this->createSplitPanels($panelGeneration0[0], $panelGeneration0[3], $category);
        foreach ($splitPanels1 as $splitPanel) {
            array_push($panelGeneration1, $splitPanel);
        }

        $splitPanels2 = $this->createSplitPanels($panelGeneration0[1], $panelGeneration0[4], $category);
        foreach ($splitPanels2 as $splitPanel) {
            array_push($panelGeneration1, $splitPanel);
        }

        array_push($panelGeneration1, $panelGeneration0[2]);

        for ($i = 0; $i < count($panelGeneration1); $i++) {
            $this->addExternalEvaluatorToPanel($category, $panelGeneration1[$i]);
        }
    }

    private function buildGeneration0($category, &$panelGeneration0) {
        for ($i = 0; $i < count($this->panelMotiffs); $i++) {
            $panel = PanelSlot::withCloningParent($this->panelMotiffs[$i]);
            $this->addExternalEvaluatorToPanel($category, $panel);
            array_push($panelGeneration0, $panel);
        }
    }

    private function addExternalEvaluatorToPanel($category, &$panel) {
        while ($panel->remainigVacancies > 0) {
            do {
                $rand = rand(0, count($this->externalevaluatorVector) - 1);
                $eval = $this->externalevaluatorVector[$rand];
            } while (!$this->tsmm->getExternalEvaluaterPossibility($category, $eval));
            $key = array_search($eval, $this->externalevaluatorVector);
            if ($key !== false) {
                unset($this->externalevaluatorVector[$key]);
                $this->externalevaluatorVector = array_values($this->externalevaluatorVector);
            }
            $panel->addExternalEvaluator($eval);
        }
    }

    private function transferExternalEvaluators($externalEvalDorner, $externalEvalreceiver, $category) {
        $resultantPanel = PanelSlot::withCloningParentAndCateg($externalEvalreceiver, $category);
        $externallEvaluators = $externalEvalDorner->externaEvaluators;
        for ($i = 0; $i < count($externallEvaluators); $i++) {
            $resultantPanel->addExternalEvaluator($externallEvaluators[$i]);
        }
        return ($resultantPanel);
    }

    private function createSplitPanels($internalEvalDorner, $externalEvalDorner, $category) {
        $newPanels = array();
        $seniorPanel = PanelSlot::withCloningParentAndCateg($externalEvalDorner, $category);
        $juniorPanel = PanelSlot::withCloningParentAndCateg($internalEvalDorner, $category);
        $externalEvaluator = $seniorPanel->removeExternalEvaluator(true);
        array_push($newPanels, $seniorPanel);
        $internalEvaluator = $juniorPanel->removeInternalEvaluator();
        array_push($newPanels, $juniorPanel);
        $splitPanel = new PanelSlot($category, 0);
        $splitPanel->addInternalEvaluator($internalEvaluator);
        $splitPanel->addExternalEvaluator($externalEvaluator);
        array_push($newPanels, $splitPanel);
        return ($newPanels);
    }

    private function createPanelMotiff($names, $categ, $remainigVac) {
        $panelMotiff = new PanelSlot($categ, $remainigVac);
        for ($i = 0; $i < count($names); $i++) {
            $panelMotiff->addInternalEvaluator($names[$i]);
        }
        array_push($this->panelMotiffs, $panelMotiff);
    }

    /**
     * Public function to get the panels
     * 
     * @return array
     */
    public function getPanels() {
        return $this->panels;
    }

}

?>

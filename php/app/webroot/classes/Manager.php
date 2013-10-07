<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Manager Class
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 10 August 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/CSVReader.php';
require_once ROOT_DIR . '/classes/ExternalEvaluatorMatrixManager.php';
require_once ROOT_DIR . '/classes/ProjectHandler.php';
require_once ROOT_DIR . '/classes/TimeSlotMatrixManager.php';
require_once ROOT_DIR . '/classes/AssignmentAlgoAdapter.php';
require_once ROOT_DIR . '/classes/PanelMotiffManager.php';

class Manager {

    /**
     * Constructor
     */
    public function __construct() {
        $techReader = new CSVReader(ROOT_DIR . '/resources/ExternalEvaluatorChoices.csv');
        $externalEvalMatrixManager = ExternalEvaluatorMatrixManager::getInstance();
        $externalEvalMatrixManager->setData($techReader->getData());
        //$externalEvalMatrixManager->printData();
        
        $markSheetReader = new CSVReader(ROOT_DIR . '/resources/Mark_sheet_allocations.csv');
        $projectHandler = ProjectHandler::getInstance();
        $projectHandler->setData($markSheetReader->getData());
        //$projectHandler->printData();
        
        $timeslotReader = new CSVReader(ROOT_DIR . '/resources/EvaluatorTimeSlotMatrix.csv');
        $timeSlotMatrixManager = TimeSlotMatrixManager::getInstance();
        $timeSlotMatrixManager->setData($timeslotReader->getData());
        //$timeSlotMatrixManager->printData();
        
        
        $motiffReader = new CSVReader(ROOT_DIR . '/resources/PanelMotiffs.csv');
        $motiffManager = PanelMotiffManger::getInstance();
        $motiffManager->setData($motiffReader->getData());

        $population = 1;
        $alocationList = array();
        for ($i = 0; $i < $population; $i++) {
            echo $i . "/" . $population . "<br>";
            $aaa = new AssignmentAlgoAdapter();
            array_push($alocationList, $aaa);
        }

        /*************** Results analyser.*************************************/
        $data = array();
        $keyLines = array();
        for ($i = 0; $i < count($alocationList); $i++) {
            $line = array();
            array_push($keyLines, $i . "");
            array_push($line, $alocationList[$i]->getOverAllValue() . "");
            array_push($data, $line);
        }

        $valueWriter = new FileWriter(ROOT_DIR . "/resources/results1.csv");
        $title = array();
        array_push($title, "Index");
        array_push($title, "Value");
        $valueWriter->writeStringMatrix($title, $keyLines, $data);


        usort($alocationList, 'AssignmentAlgoAdapter::compareAllocationByOverAllValue');
        for ($i = 0; $i < count($alocationList); $i++) {
            echo $i . " " . $alocationList[$i]->overAllValue . "<br>";
        }
        $alocationList[0]->printToFileWithEmptyParameters();

        $data = array();
        $keyLines = array();
        $key = 550;
        $count = 0;

        for ($i = 0; $i < count($alocationList); $i++) {
            if ($alocationList[$i]->overAllValue > $key) {
                $count++;
            } else {
                $line = array();
                array_push($keyLines, $key . "");
                $key -= 1;
                array_push($line, $count . "");
                $count = 0;
                array_push($data, $line);
            }
        }
        
        $valueWriter = new FileWriter(ROOT_DIR . "/resources/results2.csv");
        $title = array();
        array_push($title, "Index");
        array_push($title, "Value");
        $valueWriter->writeStringMatrix($title, $keyLines, $data);

        /**********End of Results Analyser.************************************/
    }

}

?>

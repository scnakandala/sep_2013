<?php

/*
 * Author Supun Nakandala
 * 
 * Date : 5-10-2013
 */

require_once './config.php';
require_once './dbconfig.php';
require_once './dbfunctions.lib.php';
require_once './classes/Manager.php';


//$timeslots = getTimeSlots();
//$internalEvaluators = getInternalEvaluators();
//$externalEvaluators = getExternalEvaluators();
//$technologies = getTechnologyList();
//
///* * ***********************Creating Evaluator Timeslot File********************* */
//$start_row = "start";
//$end_row = "end";
//foreach ($timeslots as $key => $timeslot) {
//    list($start, $end) = explode("-", $timeslot);
//    $start_row = $start_row . "," . $start;
//    $end_row = $end_row . "," . $end;
//}
//$start_row = $start_row . "\n";
//$end_row = $end_row . "\n";
//
//$evaluator_time_slot_file_name = "EvaluatorTimeSlotMatrix.csv";
//$file = fopen("./resources/" . $evaluator_time_slot_file_name, 'wb');
//fwrite($file, $start_row);
//fwrite($file, $end_row);
//
//foreach ($internalEvaluators as $key => $internalEvaluator) {
//    fwrite($file, $internalEvaluator);
//    $internalEvaluatorTimeslots = getInternalEvaluatorTimeslots($internalEvaluator);
//    foreach ($timeslots as $key => $timeslot) {
//        if (in_array($timeslot, $internalEvaluatorTimeslots)) {
//            fwrite($file, ",1");
//        } else {
//            fwrite($file, ",0");
//        }
//    }
//    fwrite($file, "\n");
//}
//
//foreach ($externalEvaluators as $key => $externalEvaluator) {
//    fwrite($file, $externalEvaluator);
//    $externalEvaluatorTimeSlots = getExternalEvaluatorTimeslots($externalEvaluator);
//    foreach ($timeslots as $key => $timeslot) {
//        if (in_array($timeslot, $externalEvaluatorTimeSlots)) {
//            fwrite($file, ",1");
//        } else {
//            fwrite($file, ",0");
//        }
//    }
//    fwrite($file, "\n");
//}
//
//fclose($file);
//
///* * *******************End of Evaluator Timeslot File*************************** */
//
///* * ****************Creating External Evaluator Choices File******************** */
//$evaluator_choices_file_name = "ExternalEvaluatorChoices.csv";
//$file = fopen("./resources/" . $evaluator_choices_file_name, 'wb');
//fwrite($file, "Technology,Number of projects");
//foreach ($internalEvaluators as $key => $internalEvaluator) {
//    fwrite($file, "," . $internalEvaluator);
//}
//foreach ($externalEvaluators as $key => $externalEvaluator) {
//    fwrite($file, "," . $externalEvaluator);
//}
//fwrite($file, ",sum\n");
//
//foreach ($technologies as $key => $technology) {
//    fwrite($file, $technology);
//    fwrite($file, "," . getStudentTechnologyCount($technology));
//    foreach ($externalEvaluators as $key => $externalEvaluator) {
//        $externalEvaluatorTechnologies = getEvaluatorTechnologies($externalEvaluator);
//        if (in_array($technology, $externalEvaluatorTechnologies)) {
//            fwrite($file, ",1");
//        } else {
//            fwrite($file, ",0");
//        }
//    }
//    fwrite($file, "," . getEvaluatorTechnologyCount($technology) . "\n");
//}
//
//fclose($file);
//
///* * *******************End of External Evaluator Choices File******************* */
//
///* * ********************Creating Mark Sheet Allocations.csv********************* */
//$marksheet_allocations_file_name = "Mark_sheet_allocations.csv";
//$file = fopen("./resources/" . $marksheet_allocations_file_name, 'wb');
//fwrite($file, "Index Number,Name with Initials,Mid");
//foreach ($internalEvaluators as $key => $internalEvaluator) {
//    fwrite($file, "," . $internalEvaluator);
//}
//fwrite($file, ",|");
//foreach ($technologies as $key => $technology) {
//    fwrite($file, "," . $technology);
//}
//fwrite($file, "\n");
//$students_list = getCompleteStudentInformationList();
//foreach ($students_list as $key => $student) {
//    fwrite($file, $student[STUDENT_INDEX_NUMBER_COLUMN]);
//    fwrite($file, "," . $student[STUDENT_NAME_COLUMN]);
//    fwrite($file, "," . $student[STUDENT_MID_MARKS_COLUMN]);
//    $student_mid_evaluators = getMidEvaluators($student[STUDENT_INDEX_NUMBER_COLUMN]);
//    foreach ($internalEvaluators as $key => $internalEvaluator) {
//        if (in_array($internalEvaluator, $student_mid_evaluators)) {
//            fwrite($file, ",1");
//        } else {
//            fwrite($file, ",0");
//        }
//    }
//    fwrite($file, ",|");
//    $student_technologies = getStudentTechnologies($student[STUDENT_NAME_COLUMN]);
//    foreach ($technologies as $key => $technology) {
//        if (in_array($technology, $student_technologies)) {
//            fwrite($file, ",1");
//        } else {
//            fwrite($file, ",0");
//        }
//    }
//    fwrite($file, "\n");
//}
///* * ********************End of creating Mark Sheet Allocations.csv************** */
//
///* * **********************Creating panel mottifs file ************************** */
//$panel_mottifs_file_name = "PanelMotiffs.csv";
//$file = fopen("./" . $panel_mottifs_file_name, 'wb');
//$panel_motiffs = getPanelMotiffsList();
//foreach ($panel_motiffs as $key => $panel_motiff) {
//    fwrite($file, $panel_motiff[PANEL_MOTIFF_CATEGORY]);
//    fwrite($file, "," . $panel_motiff[PANEL_MOTIFF_REMAINING_VAC]);
//    $motiff_evaluators = getMotiffEvaluators($panel_motiff[PANEL_MOTIFF_ID]);
//    foreach ($motiff_evaluators as $key => $motiff_evaluator) {
//        fwrite($file, "," . $motiff_evaluator);
//    }
//    fwrite($file, "\n");
//}
///* * ***************** End of creating panel mottifs file *********************** */

new Manager();

$file_name = 'value.csv';
$file_url = 'http://localhost/sep_2013/web/resources/' . $file_name;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
readfile($file_url);
?> 
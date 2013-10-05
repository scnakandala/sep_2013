<?php
/**
 * Author : Supun Nakandala
 * 
 * Contains essential db configurations
 */


define('DB_SERVER', getenv("OPENSHIFT_MYSQL_DB_HOST").":".getenv("OPENSHIFT_MYSQL_DB_PORT"));
define('DB_USERNAME', getenv("OPENSHIFT_MYSQL_DB_USERNAME"));
define('DB_PASSWORD', getenv("OPENSHIFT_MYSQL_DB_PASSWORD"));
define('DB_DATABASE', getenv("OPENSHIFT_APP_NAME"));

define('STUDENTS_TABLE', 'students');
define('STUDENT_NAME_COLUMN', 'name');
define('STUDENT_INDEX_NUMBER_COLUMN', 'index_number');
define('STUDENT_EMAIL_COLUMN', 'gmail_address');
define('STUDENT_MID_MARKS_COLUMN', 'mid_marks');

define('TECHNOLOGY_TABLE', 'technologies');
define('TECH_NAME_COLUMN', 'name');

define('STUDENTS_TECHNOLOGIES', 'students_technologies');
define('STUD_TECH_NAME_COLUMN_COLUMN', 'student_name');
define('STUD_TECH_TECH_COLUMN', 'technology_name');

define('EXTERNAL_EVALUATORS_TECHNOLOGIES', 'external_evaluators_technologies');
define('EX_EVAL_TECH_NAME_COLUMN', 'external_evaluator_name');
define('EX_EVAL_TECH_TECH_COLUMN', 'technology_name');

define('INTERNAL_EVALUATORS_TIMESLOTS', 'internal_evaluators_timeslots');
define('IN_EVAL_TIME_NAME_COLUMN', 'internal_evaluator_name');
define('IN_EVAL_TIME_TIME_NAME_COLUMN', 'timeslot_name');

define('EXTERNAL_EVALUATORS_TIMESLOTS', 'external_evaluators_timeslots');
define('EX_EVAL_TIME_NAME_COLUMN', 'external_evaluator_name');
define('EX_EVAL_TIME_TIME_COLUMN', 'timeslot_name');


define('TIMESLOTS_TABLE', 'timeslots');
define('TIMESLOT_TIMESLOT_COLUMN', 'name');

define('PANEL_MOTIFFS_TABLE', 'panel_motiffs');
define('PANEL_MOTIFF_ID', 'id');
define('PANEL_MOTIFF_CATEGORY', 'category');
define('PANEL_MOTIFF_REMAINING_VAC', 'remaining_vacancies');

define('PANEL_MOTIFF_EVALUATOR', 'panel_motiffs_internal_evaluators');
define('PANEL_MOTIFF_EVALUATOR_ID', 'panel_motiff_id');
define('PANEL_MOTIFF_EVALUATOR_NAME', 'internal_evaluator_name');

define('INTERNAL_EVALUATORS', 'internal_evaluators');
define('INTERNAL_EVAL_ID', 'id');
define('INTERNAL_EVAL_NAME', 'name');
define('INTERNAL_EVAL_EMAIL', 'gmail_address');

define('EXTERNAL_EVALUATORS', 'external_evaluators');
define('EXTERNAL_EVAL_NAME', 'name');
define('EXTERNAL_EVAL_EMAIL', 'gmail_address');


define('STUDENTS_INTERNAL_EVALUATORS_TABLE', 'students_internal_evaluators');
define('STUDENT_INTERNAL_EVALUATOR_STUDENT_COLUMN', 'student_index_number');
define('STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN', 'internal_evaluator_name');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());

$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

?>
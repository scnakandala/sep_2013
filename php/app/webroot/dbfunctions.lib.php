<?php

function getTechnologyList() {
    $sql = "SELECT * FROM " . TECHNOLOGY_TABLE . " ORDER BY " . TECH_NAME_COLUMN;
    $result = mysql_query($sql);
    $technologies = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($technologies, $row[TECH_NAME_COLUMN]);
    }
    sort($technologies);

    return $technologies;
}

function getEvaluatorTechnologies($name = null) {
    $name == null ? $name = $_SESSION['name'] : $name = $name;
    $sql = "SELECT * FROM " . EXTERNAL_EVALUATORS_TECHNOLOGIES
            . " WHERE " . EX_EVAL_TECH_NAME_COLUMN . "='" . $name . "';";
    $result = mysql_query($sql);
    $evaluator_technologies = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($evaluator_technologies, $row[EX_EVAL_TECH_TECH_COLUMN]);
    }

    return $evaluator_technologies;
}

function getStudentTechnologies($name = null) {
    $name == null ? $name = $_SESSION['name'] : $name = $name;
    $sql = "SELECT * FROM " . STUDENTS_TECHNOLOGIES
            . " WHERE " . STUD_TECH_NAME_COLUMN_COLUMN . "='" . $name . "';";
    $result = mysql_query($sql);
    $student_technologies = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($student_technologies, $row[STUD_TECH_TECH_COLUMN]);
    }

    return $student_technologies;
}

function getTimeSlots() {
    $sql = "SELECT * FROM " . TIMESLOTS_TABLE;
    $result = mysql_query($sql);
    $timeslots = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($timeslots, $row[TIMESLOT_TIMESLOT_COLUMN]);
    }

    return $timeslots;
}

function getInternalEvaluatorTimeSlots($name = null) {
    $name == null ? $name = $_SESSION['name'] : $name = $name;
    $sql = "SELECT * FROM " . INTERNAL_EVALUATORS_TIMESLOTS
            . " WHERE " . IN_EVAL_TIME_NAME_COLUMN . "='" . $name . "';";

    $result = mysql_query($sql);
    $internal_evaluator_timeslots = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($internal_evaluator_timeslots, $row[IN_EVAL_TIME_TIME_NAME_COLUMN]);
    }
    return $internal_evaluator_timeslots;
}

function getExternalEvaluatorTimeSlots($name = null) {
    $name == null ? $name = $_SESSION['name'] : $name = $name;
    $sql = "SELECT * FROM " . EXTERNAL_EVALUATORS_TIMESLOTS
            . " WHERE " . EX_EVAL_TIME_NAME_COLUMN . "='" . $name . "';";
    $result = mysql_query($sql);
    $external_evaluator_timeslots = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($external_evaluator_timeslots, $row[EX_EVAL_TIME_TIME_COLUMN]);
    }
    return $external_evaluator_timeslots;
}

function getEvaluatorTimeSlots() {
    if ($_SESSION['role'] == "INTERNAL_EVALUATOR") {
        return getInternalEvaluatorTimeSlots();
    } else if ($_SESSION['role'] == "EXTERNAL_EVALUATOR") {
        return getExternalEvaluatorTimeSlots();
    }
}

function updateEvaluatorTimeSlots() {
    if ($_SESSION['role'] == "INTERNAL_EVALUATOR") {
        updateInternalEvaluatorTimeSlots();
    } else if ($_SESSION['role'] == "EXTERNAL_EVALUATOR") {
        updateExternalEvaluatorTimeSlots();
    }
}

function updateExternalEvaluatorTimeSlots() {
    $sql = "DELETE  FROM " . EXTERNAL_EVALUATORS_TIMESLOTS . " WHERE "
            . EX_EVAL_TIME_NAME_COLUMN . "='"
            . $_SESSION['name'] . "'";
    mysql_query($sql);
    foreach ($_POST as $key => $value) {
        $key = str_replace("_", " ", $key);
        $sql = "INSERT INTO " . EXTERNAL_EVALUATORS_TIMESLOTS . "(" . EX_EVAL_TIME_NAME_COLUMN
                . "," . EX_EVAL_TIME_TIME_COLUMN . ")"
                . " VALUES('" . $_SESSION['name']
                . "','" . $key . "')";
        mysql_query($sql);
    }
}

function updateInternalEvaluatorTimeSlots() {
    $sql = "DELETE  FROM " . INTERNAL_EVALUATORS_TIMESLOTS . " WHERE "
            . IN_EVAL_TIME_NAME_COLUMN . "='"
            . $_SESSION['name'] . "'";
    mysql_query($sql);
    foreach ($_POST as $key => $value) {
        $key = str_replace("_", " ", $key);
        $sql = "INSERT INTO " . INTERNAL_EVALUATORS_TIMESLOTS . "(" . IN_EVAL_TIME_NAME_COLUMN
                . "," . IN_EVAL_TIME_TIME_NAME_COLUMN . ")"
                . " VALUES('" . $_SESSION['name']
                . "','" . $key . "')";
        mysql_query($sql);
    }
}

function updateUserInformation() {
    $sql = "SELECT * FROM " . STUDENTS_TABLE . " WHERE "
            . STUDENT_EMAIL_COLUMN . "='"
            . $_SESSION['email'] . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if (!empty($row)) {
        $_SESSION['role'] = "STUDENT";
        $sql = "UPDATE " . STUDENTS_TABLE . " SET " . STUDENT_NAME_COLUMN
                . "='" . $_SESSION['name'] . "' WHERE " . STUDENT_EMAIL_COLUMN . " = '"
                . $_SESSION['email'] . "'";
        mysql_query($sql);
        return;
    }
    $sql = "SELECT * FROM " . INTERNAL_EVALUATORS . " WHERE "
            . INTERNAL_EVAL_EMAIL . "='"
            . $_SESSION['email'] . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if (!empty($row)) {
        $_SESSION['role'] = "INTERNAL_EVALUATOR";
        $sql = "UPDATE " . INTERNAL_EVALUATORS . " SET " . INTERNAL_EVAL_NAME
                . "='" . $_SESSION['name'] . "' WHERE " . INTERNAL_EVAL_EMAIL . " = '"
                . $_SESSION['email'] . "'";
        mysql_query($sql);
        return;
    }
    $sql = "SELECT * FROM " . EXTERNAL_EVALUATORS . " WHERE "
            . EXTERNAL_EVAL_EMAIL . "='"
            . $_SESSION['email'] . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if (!empty($row)) {
        $_SESSION['role'] = "EXTERNAL_EVALUATOR";
        $sql = "UPDATE " . EXTERNAL_EVALUATORS . " SET " . EXTERNAL_EVAL_NAME
                . "='" . $_SESSION['name'] . "' WHERE " . EXTERNAL_EVAL_EMAIL . " = '"
                . $_SESSION['email'] . "'";
        mysql_query($sql);
        return;
    }
}

function getStudentIndexNumbers() {
    $sql = "SELECT " . STUDENT_INDEX_NUMBER_COLUMN . " FROM " . STUDENTS_TABLE . " ORDER BY "
            . STUDENT_INDEX_NUMBER_COLUMN . " ASC";
    $result = mysql_query($sql);
    $students = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($students, $row[STUDENT_INDEX_NUMBER_COLUMN]);
    }
    return $students;
}

function getMidEvaluatedStudents() {
    $sql = "SELECT " . STUDENT_INTERNAL_EVALUATOR_STUDENT_COLUMN . " FROM " . STUDENTS_INTERNAL_EVALUATORS_TABLE
            . " WHERE " . STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN . " = '"
            . $_SESSION['name'] . "'";
    $result = mysql_query($sql);
    $evaluated_students = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($evaluated_students, $row[STUDENT_INTERNAL_EVALUATOR_STUDENT_COLUMN]);
    }
    return $evaluated_students;
}

function updateEvaluatorTechnologies() {
    if ($_SESSION['role'] == "EXTERNAL_EVALUATOR") {
        $sql = "DELETE  FROM " . EXTERNAL_EVALUATORS_TECHNOLOGIES . " WHERE "
                . EX_EVAL_TECH_NAME_COLUMN . "='"
                . $_SESSION['name'] . "'";
        mysql_query($sql);
        foreach ($_POST as $key => $value) {
            $sql = "INSERT INTO " . EXTERNAL_EVALUATORS_TECHNOLOGIES . "(" . EX_EVAL_TECH_NAME_COLUMN
                    . "," . EX_EVAL_TECH_TECH_COLUMN . ")"
                    . " VALUES('" . $_SESSION['name']
                    . "','" . $key . "')";
            mysql_query($sql);
        }
    }
}

function updateStudentTechnologies() {
    if ($_SESSION['role'] == "STUDENT") {
        $sql = "DELETE  FROM " . STUDENTS_TECHNOLOGIES . " WHERE "
                . STUD_TECH_NAME_COLUMN_COLUMN . "='"
                . $_SESSION['name'] . "'";
        mysql_query($sql);
        foreach ($_POST as $key => $value) {
            $sql = "INSERT INTO " . STUDENTS_TECHNOLOGIES . "(" . STUD_TECH_NAME_COLUMN_COLUMN
                    . "," . STUD_TECH_TECH_COLUMN . ")"
                    . " VALUES('" . $_SESSION['name']
                    . "','" . $key . "')";
            mysql_query($sql);
        }
    }
}

function updateMidEvaluatedStudents() {
    if ($_SESSION['role'] == "INTERNAL_EVALUATOR") {
        $sql = "DELETE  FROM " . STUDENTS_INTERNAL_EVALUATORS_TABLE . " WHERE "
                . STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN . "='"
                . $_SESSION['name'] . "'";
        mysql_query($sql);
        foreach ($_POST as $key => $value) {
            $sql = "INSERT INTO " . STUDENTS_INTERNAL_EVALUATORS_TABLE . "("
                    . STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN
                    . "," . STUDENT_INTERNAL_EVALUATOR_STUDENT_COLUMN . ")"
                    . " VALUES('" . $_SESSION['name']
                    . "','" . $key . "')";
            mysql_query($sql);
        }
    }
}

function getInternalEvaluators() {
    $sql = "SELECT " . INTERNAL_EVAL_NAME . " FROM " . INTERNAL_EVALUATORS . " order by " . INTERNAL_EVAL_NAME;
    $result = mysql_query($sql);
    $internal_evaluators = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($internal_evaluators, $row[INTERNAL_EVAL_NAME]);
    }
    return $internal_evaluators;
}

function getExternalEvaluators() {
    $sql = "SELECT " . EXTERNAL_EVAL_NAME . " FROM " . EXTERNAL_EVALUATORS . " order by " . EXTERNAL_EVAL_NAME;
    $result = mysql_query($sql);
    $external_evaluators = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($external_evaluators, $row[EXTERNAL_EVAL_NAME]);
    }
    return $external_evaluators;
}

function getStudentTechnologyCount($technology) {
    $sql = "SELECT count(*) as total FROM " . STUDENTS_TECHNOLOGIES . " where "
            . STUD_TECH_TECH_COLUMN . "='" . $technology . "'";
    $result = mysql_query($sql);
    $data = mysql_fetch_assoc($result);
    return $data['total'];
}

function getEvaluatorTechnologyCount($technology) {
    $sql = "SELECT count(*) as total FROM " . EXTERNAL_EVALUATORS_TECHNOLOGIES . " where "
            . EX_EVAL_TECH_TECH_COLUMN . "='" . $technology . "'";
    $result = mysql_query($sql);
    $data = mysql_fetch_assoc($result);
    return $data['total'];
}

function getCompleteStudentInformationList() {
    $sql = "SELECT * FROM " . STUDENTS_TABLE . " order by " . STUDENT_INDEX_NUMBER_COLUMN;
    $result = mysql_query($sql);
    $students = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($students,$row);
    }
    return $students;
}

function getMidEvaluators($student_index) {
    $sql = "SELECT " . STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN 
            . " FROM " . STUDENTS_INTERNAL_EVALUATORS_TABLE . " where " 
            . STUDENT_INTERNAL_EVALUATOR_STUDENT_COLUMN . "='" . $student_index . "'";
    $result = mysql_query($sql);
    $mid_evaluators = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($mid_evaluators,$row[STUDENT_INTERNAL_EVALUATOR_INTERNAL_EVALUATOR_COLUMN]);
    }
    return $mid_evaluators;
}

function getPanelMotiffsList(){
    $sql = "SELECT * FROM " . PANEL_MOTIFFS_TABLE ;
    $result = mysql_query($sql);
    $panel_motiffs = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($panel_motiffs,$row);
    }
    return $panel_motiffs;
}

function getMotiffEvaluators($motiff_id){
    $sql = "SELECT " . INTERNAL_EVAL_NAME 
            . " FROM " . PANEL_MOTIFF_EVALUATOR . "," 
            . INTERNAL_EVALUATORS . " where " 
            . PANEL_MOTIFF_EVALUATOR_ID . "=" . $motiff_id 
            . " and " . INTERNAL_EVAL_ID . "=" . PANEL_MOTIFF_EVALUATOR_ID
            . " order by "
            . PANEL_MOTIFF_EVALUATOR_NAME;
    $result = mysql_query($sql);
    $motiff_evaluators = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($motiff_evaluators,$row[INTERNAL_EVAL_NAME]);
    }
    return $motiff_evaluators;
}

?>

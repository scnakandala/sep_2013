<?php

if (isset($_POST['timeslot-submit'])) {
    unset($_POST['timeslot-submit']);
    updateEvaluatorTimeSlots();
}

if (isset($_POST['technology-submit'])) {
    unset($_POST['technology-submit']);
    updateEvaluatorTechnologies();
}

if (isset($_POST['midstudent-submit'])) {
    unset($_POST['midstudent-submit']);
    updateMidEvaluatedStudents();
}

if ($_SESSION['role'] == "EXTERNAL_EVALUATOR") {
    $technologies = getTechnologyList();
    $evaluator_technologies = getEvaluatorTechnologies();
    echo '<h2>Select Competent Technologies</h2>';
    echo '<form name="competent technologies" method="post">';
    foreach ($technologies as $technology) {
        $is_checked = in_array($technology, $evaluator_technologies) ? " checked" : "";
        echo '<input type="checkbox" name="' . $technology . '" value=1 '
        . $is_checked . ' >' . $technology . '<br>';
    }
    echo '<input type="submit" name="technology-submit" value="Save Changes">';
    echo '</form>';
}

$timeslots = getTimeSlots();
$evaluator_timeslots = getEvaluatorTimeSlots();

echo '<h2>Select Available Time Slots</h2>';
echo '<form name="time slots" method="post">';
foreach ($timeslots as $timeslot) {
    $is_checked = in_array($timeslot, $evaluator_timeslots) ? " checked" : "";
    echo '<input type="checkbox" name="' . $timeslot . '" value="1" '
    . $is_checked . ' ">' . $timeslot . '<br>';
}
echo '<input type="submit" name="timeslot-submit" value="Save Changes">';
echo '</form>';

if ($_SESSION['role'] == "INTERNAL_EVALUATOR") {
    $students = getStudentIndexNumbers();
    $mid_evaluated_students = getMidEvaluatedStudents();

    echo '<h2>Select Mid Evaluated Students</h2>';
    echo '<form name="mid slots" method="post">';
    foreach ($students as $student) {
        $is_checked = in_array($student, $mid_evaluated_students) ? " checked" : "";
        echo '<input type="checkbox" name="' . $student . '" value="1" '
        . $is_checked . ' >' . $student . '<br>';
    }
    echo '<input type="submit" name="midstudent-submit" value="Save Changes">';
    echo '</form>';
}
?>

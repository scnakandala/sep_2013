<?php

if (isset($_POST['student-technology-submit'])) {
    unset($_POST['student-technology-submit']);
    updateStudentTechnologies();
}

$technologies = getTechnologyList();
$student_technologies = getStudentTechnologies();

echo '<h2>Select Used Technologies</h2>';
echo '<form name="used technologies" method="post">';
foreach ($technologies as $technology) {
    $is_checked = in_array($technology, $student_technologies) ? " checked" : "";
    echo '<input type="checkbox" name="' . $technology . '" value=1 '
    . $is_checked . ' >' . $technology . '<br>';
}
echo '<input type="submit" name="student-technology-submit" value="Save Changes">';
echo '</form>';
?>
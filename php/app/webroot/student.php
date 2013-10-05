<?php
if (isset($_POST['student-technology-submit'])) {
    unset($_POST['student-technology-submit']);
    updateStudentTechnologies();
}

$technologies = getTechnologyList();
$student_technologies = getStudentTechnologies();
?>
<div class="container"><div class="page-header"></div>
    <h3>Technologies Used</h3>
    <form name="used technologies" method="post">
        <?php
        for ($i = 0; $i < count($technologies);) {
            print "<div class='row'>";
            if ($i < count($technologies)) {
                $technology = $technologies[$i];
                $i++;
                $is_checked = in_array($technology, $student_technologies) ? " checked" : "";
                echo '<div class="col-md-4"><label class="checkbox"><input type="checkbox" name="' . $technology . '" value=1 '
                . $is_checked . ' >' . $technology . "</label></div>";
            }
            if ($i < count($technologies)) {
                $technology = $technologies[$i];
                $i++;
                $is_checked = in_array($technology, $student_technologies) ? " checked" : "";
                echo '<div class="col-md-4"><label class="checkbox"><input type="checkbox" name="' . $technology . '" value=1 '
                . $is_checked . ' >' . $technology . "</label></div>";
            }
            if ($i < count($technologies)) {
                $technology = $technologies[$i];
                $i++;
                $is_checked = in_array($technology, $student_technologies) ? " checked" : "";
                echo '<div class="col-md-4"><label class="checkbox"><input type="checkbox" name="' . $technology . '" value=1 '
                . $is_checked . ' >' . $technology . "</label></div>";
            }
            print "</div>";
        }
        ?>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button type="submit" class="btn btn-success" name="student-technology-submit" value="Save Changes">
            </div>
        </div>
    </form>
</div>
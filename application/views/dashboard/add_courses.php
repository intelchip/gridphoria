<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Add Courses</h4>
</div>
<?php
if (@$_GET["success"] == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully added a course.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if (@$_GET["success"] == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem saving the course to the database.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>
<form method="post" action="<?php echo base_url(); ?>/index.php?/post/add_courses" data-abide>
    <div class="clearfix"></div>
    <div class="large-6 column">
        <div class="crn-field">
            <label>CRN <small>required</small>
                <input type="text" name="data[course][crn]" required />
                <small class="error">CRN is required.</small>
            </label>
        </div>

        <div class="name-field">
            <label>Course Name <small>required</small>
                <input type="text" name="data[course][name]" required />
                <small class="error">Course name is required.</small>
            </label>
        </div>

        <div class="description-field">
            <label>Description <small>required</small>
                <textarea name="data[course][description]" required></textarea>
                <small class="error">Description is required.</small>
            </label>
        </div>

        <div class="instructor-field">
            <label>Instructor <small>required</small>
                <select name="data[course][instructor]" required>
                    <option value="">-- Select an instructor</option>
                    <?php
                    foreach ($CI->datamodel->getInstructors() as $row) {
                        echo "<option value='{$row->id}' " . ($CI->session_uid == $row->id ? "selected" : "") . ">{$row->first_name} {$row->last_name}</option>";
                    }
                    ?>
                </select>
                <small class="error">Please select an instructor for this course.</small>
            </label>
        </div>

        <div class="times-offered">
            <label>Times offered <small>Required</small></label>
            <?php
            $days = array(
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
            );
            ?>
            <div class="course-schedule">
                <label>
                    <select class="columns large-4 left" name="data[course][schedule][0][day]" required>
                        <option value=""> -- Select Day --</option>
                        <?php
                        foreach ($days as $day) {
                            echo "<option value='$day'>$day</option>";
                        }
                        ?>
                    </select>
                    <input class="timepicker left" type="text" name="data[course][schedule][0][start_time]" placeholder="Start Time" required />
                    <input class="timepicker left" type="text" name="data[course][schedule][0][end_time]" placeholder="End Time" required />
                    <small class="error">Please add a time schedule.</small>
                </label>
            </div>
            <a id="addNewTimescheduleField" class="right" href="javascript:void(0)">Add time slot</a>
            <p></p>
            <div class="clearfix"></div>
        </div>

        <div class="semseter-field">
            <label>Semester <small>required</small>
                <select name="data[course][semester]" required>
                    <option value="">-- Select a Semester --</option>
                    <?php
                    foreach ($CI->datamodel->getSemesters() as $row) {
                        echo "<option value = '{$row->id}'>{$row->semester}</option>";
                    }
                    ?>
                </select>
                <small class="error"> Semester is required.</small>
            </label>
        </div>

        <div class="slot-field">
            <label>Slot <small>required</small>
                <select name="data[course][slot]" required>
                    <option value="">-- Select a slot --</option>
                    <?php
                    foreach ($CI->datamodel->getSlots() as $row) {
                        echo "<option value = '{$row->id}'>{$row->slot_number}</option>";
                    }
                    ?>
                </select>
                <small class="error">Please select a slot.</small>
            </label>
        </div>

        <input type="submit" class="button radius" value="Add Course" />
    </div>
</form>
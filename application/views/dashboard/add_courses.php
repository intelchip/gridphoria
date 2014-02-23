<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Add Courses</h4>
</div>
<?php
if(@$_GET["success"]=="true"){
?>
<div data-alert class="alert-box success radius">
  You have successfully added a course.
  <!--<a href="#" class="close">&times;</a>-->
</div>
<?php } ?>
<form method="post" action="/index.php?/post/add_courses" data-abide>
    <div class="clearfix"></div>
    <div class="large-6 column">
        <div class="crn-field">
            <label>CRN <small>required</small>
                <input type="text" name="data[course][crn]" required />
            </label>
            <small class="error">CRN is required.</small>
        </div>

        <div class="name-field">
            <label>Course Name <small>required</small>
                <input type="text" name="data[course][name]" required />
            </label>
            <small class="error">Course name is required.</small>
        </div>

        <div class="description-field">
            <label>Description <small>required</small>
                <textarea name="data[course][description]" required></textarea>
            </label>
            <small class="error">Description is required.</small>
        </div>

        <div class="instructor-field">
            <label>Instructor <small>required</small>
                <select name="data[course][instructor]" required>
                    <option>-- Select an instructor</option>
                    <?php
                    foreach ($CI->datamodel->getInstructors() as $row) {
                        echo "<option value='{$row->id}' " . ($CI->session_uid == $row->id ? "selected" : "") . ">{$row->first_name} {$row->last_name}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="start-time-field">
            <label>Start Time <small>required</small>
                <input type="text" name="data[course][start_time]" required />
            </label>
            <small class="error">Start time is required.</small>
        </div>

        <div class="end-time-field">
            <label>End Time <small>required</small>
                <input type="text" name="data[course][end_time]" required />
            </label>
            <small class="error">Start time is required.</small>
        </div>

        <div class="semseter-field">
            <label>Semester <small>required</small>
                <select name="data[course][semester]" required>
                    <option> -- Select a Semester --</option>

                    <?php
                    foreach ($CI->datamodel->getSemesters() as $row) {
                        echo "<option value = '{$row->id}'>{$row->semester}</option>";
                    }
                    ?>
                </select>
            </label>
            <small class="error"> Semester is required.</small>
        </div>

        <div class="slot-field">
            <label>Slot <small>required</small>
                <select name="data[course][slot]" required="">
                    <option>-- Select a slot --</option>
                    <?php
                    foreach ($CI->datamodel->getSlots() as $row) {
                        echo "<option value = '{$row->id}'>{$row->slot_number}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <input type="submit" class="button radius" value="Add Course" />
    </div>
</form>
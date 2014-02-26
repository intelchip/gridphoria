<?php
$CI = & get_instance();
$id = $CI->uri->segment(3);
$course = $CI->datamodel->getCourse($id);
?>
<div class="panel">
    <h4>Edit Course</h4>
</div>
<form method="post" action="/index.php?/post/edit_courses" data-abide>
    <div class="clearfix"></div>
    <div class="large-6 column">
        <div class="crn-field">
            <label>CRN <small>required</small>
                <input type="text" name="data[course][crn]" required value="<?php echo $course->crn; ?>" />
            </label>
            <small class="error">CRN is required.</small>
        </div>

        <div class="name-field">
            <label>Course Name <small>required</small>
                <input type="text" name="data[course][name]" required value="<?php echo $course->name; ?>"/>
            </label>
            <small class="error">Course name is required.</small>
        </div>

        <div class="description-field">
            <label>Description <small>required</small>
                <textarea name="data[course][description]" required><?php echo $course->description; ?></textarea>
            </label>
            <small class="error">Description is required.</small>
        </div>

        <div class="instructor-field">
            <label>Instructor <small>required</small>
                <select name="data[course][instructor]" required>
                    <option>-- Select an instructor</option>
                    <?php
                    foreach ($CI->datamodel->getInstructors() as $row) {
                        echo "<option value='{$row->id}' " . ($CI->session_uid == $course->instructor_id ? "selected" : "") . ">{$row->first_name} {$row->last_name}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="start-time-field">
            <label>Start Time <small>required</small>
                <input id="startTime" type="text" name="data[course][start_time]" required value="<?php echo $course->start_time; ?>" />
            </label>
            <small class="error">Start time is required.</small>
        </div>

        <div class="end-time-field">
            <label>End Time <small>required</small>
                <input id="endTime" type="text" name="data[course][end_time]" required value="<?php echo $course->end_time; ?>"/>
            </label>
            <small class="error">Start time is required.</small>
        </div>

        <div class="semseter-field">
            <label>Semester <small>required</small>
                <select name="data[course][semester]" required>
                    <option> -- Select a Semester --</option>

                    <?php
                    foreach ($CI->datamodel->getSemesters() as $row) {
                        echo "<option value = '{$row->id}' ".($row->id == $course->semester ? "selected='true'" : "").">{$row->semester}</option>";
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
                        echo "<option value = '{$row->id}'' ".($row->id == $course->slot ? "selected='true'" : "").">{$row->slot_number}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <input type="submit" class="button radius" value="Edit Course" />
    </div>
</form>
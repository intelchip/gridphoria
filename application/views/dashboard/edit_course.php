<?php
$CI = & get_instance();
$id = $CI->uri->segment(3);
$course = $CI->datamodel->getCourse($id);
?>
<div class="panel">
    <h4>Edit Course</h4>
</div>

<?php
if ($CI->input->get("success") == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully updated the course.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if ($CI->input->get("success") == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem saving the slot to the database.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>
<form method="post" action="<?php echo base_url(); ?>index.php?/post/edit_course" data-abide>
    <div class="clearfix"></div>
    <div class="large-6 column">
        <div class="crn-field">
            <label>CRN <small>required</small>
                <input type="text" name="data[course][crn]" required value="<?php echo $course->crn; ?>" />
                <input type="hidden" name="data[course][id]" value="<?php echo $course->id; ?>" />
                <small class="error">CRN is required.</small>
            </label>
        </div>

        <div class="name-field">
            <label>Course Name <small>required</small>
                <input type="text" name="data[course][name]" required value="<?php echo $course->name; ?>"/>
                <small class="error">Course name is required.</small>
            </label>
        </div>

        <div class="description-field">
            <label>Description <small>required</small>
                <textarea name="data[course][description]" required><?php echo $course->description; ?></textarea>
                <small class="error">Description is required.</small>
            </label>
        </div>

        <div class="instructor-field">
            <label>Instructor <small>required</small>
                <select name="data[course][instructor]" required>
                    <option value="">-- Select an instructor</option>
                    <?php
                    foreach ($CI->datamodel->getInstructors() as $row) {
                        echo "<option value='{$row->id}' " . ($CI->session_uid == $course->instructor_id ? "selected" : "") . ">{$row->first_name} {$row->last_name}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>
        <div class="semseter-field">
            <label>Semester <small>required</small>
                <select name="data[course][semester]" required>
                    <option value=""> -- Select a Semester --</option>

                    <?php
                    foreach ($CI->datamodel->getSemesters() as $row) {
                        echo "<option value = '{$row->id}' " . ($row->id == $course->semester ? "selected='true'" : "") . ">{$row->semester}</option>";
                    }
                    ?>
                </select>
                <small class="error"> Semester is required.</small>
            </label>
        </div>
        <?php
        $slot_results = $CI->datamodel->getCourseSlots($course->id);
        $slot_index = 0;
        foreach ($slot_results as $slot) {
            ?>
            <div class="slot-field">
                <label>Slot <?php echo $slot_index == 0 ? "<small>required</small>" : ""; ?>
                    <select name="data[course][slots][<?php echo $slot_index++; ?>]" <?php echo $slot_index == 0 ? "required" : ""; ?>>
                        <option value="">-- Select a slot --</option>
                        <?php
                        foreach ($CI->datamodel->getSlots() as $row) {
                            $is_not_closed = $CI->datamodel->getAvailableSlots($row->id) > 0;
                            echo "<option value = '" . ($is_not_closed ? $row->id : "") . "' " . ($row->id == $slot->slot_id ? "selected='true'" : "") . ">Slot {$row->slot}" . ($is_not_closed ? " - {$CI->datamodel->getAvailableSlots($row->id)} Remaining" : " <em>(Closed)</em>" ) . "</option>";
                        }
                        ?>
                    </select>
                    <small class="error">Please select a slot</small>
                </label>
            </div>
            <?php
        }

        // print out the remaining
        $slot_count = 4 - $slot_index;
        for ($i = 0; $i < $slot_count; $i++) {
            ?>
            <div class="slot-field">
                <label>Slot <?php echo $i + $slot_index == 0 ? "<small>required</small>" : ""; ?>
                    <select name="data[course][slots][<?php echo $i + $slot_index; ?>]" <?php echo $i + $slot_index == 0 ? "required" : "" ?>>
                        <option value="">-- Select a slot --</option>
                        <?php
                        foreach ($CI->datamodel->getSlots() as $row) {
                            $is_not_closed = $CI->datamodel->getAvailableSlots($row->id) > 0;
                            echo "<option value = '" . ($is_not_closed ? $row->id : "") . "'>Slot {$row->slot}" . ($is_not_closed ? " - {$CI->datamodel->getAvailableSlots($row->id)} Remaining" : " <em>(Closed)</em>" ) . "</option>";
                        }
                        ?>
                    </select>
                    <small class="error">Please select a slot.</small>
                </label>
            </div>
            <?php
        }
        ?>

        <input type="submit" class="button radius" value="Edit Course" />
    </div>
</form>
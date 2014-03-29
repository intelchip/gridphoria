<?php
$CI = & get_instance();
$id = $CI->uri->segment(3);
$course = $CI->datamodel->getCourse($id);
?>
<div class="panel">
    <h4>Edit Course</h4>
</div>
<form method="post" action="<?php echo base_url(); ?>/index.php?/post/edit_courses" data-abide>
    <div class="clearfix"></div>
    <div class="large-6 column">
        <div class="crn-field">
            <label>CRN <small>required</small>
                <input type="text" name="data[course][crn]" required value="<?php echo $course->crn; ?>" />
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
        <div class="times-offered">
            <label>Times offered <small>Required</small></label>
            <?php
            $count = 0;
            $schedule_results = $CI->datamodel->getCourseSchedule($course->id);
            $days = array(
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
            );

            foreach ($schedule_results as $sch) {
                ?>
                <div class="course-schedule">
                    <label>
                        <select class="columns large-4 left" name="data[course][schedule][<?php echo $count; ?>][day]" required>
                            <option value=""> -- Select Day --</option>
                            <?php
                            foreach ($days as $day) {
                                echo "<option value='$day'" . ($day == $sch->day ? "selected='selected'" : "") . ">$day</option>";
                            }
                            ?>
                        </select>
                        <input class="timepicker left" type="text" name="data[course][schedule][<?php echo $count; ?>][start_time]" placeholder="Start Time" required value="<?php echo $sch->start_time; ?>" />
                        <input class="timepicker left" type="text" name="data[course][schedule][<?php echo $count; ?>][end_time]" placeholder="End Time" required value="<?php echo $sch->end_time; ?>" />
                        <small class="error">Please add a time schedule.</small>
                        <a data-schedulefield="<?php echo $count; ?>" class="timeschedule-delete" href="javascript:void(0)">remove</a>
                    </label>
                </div>
                <?php
                $count++;
            }
            ?>
            <a id="addNewTimescheduleField" class="right" href="javascript:void(0)">Add time slot</a>
            <p></p>
            <div class="clearfix"></div>
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

        <div class="slot-field">
            <label>Slot <small>required</small>
                <select name="data[course][slot]" required="">
                    <option value="">-- Select a slot --</option>
                    <?php
                    foreach ($CI->datamodel->getSlots() as $row) {
                        echo "<option value = '{$row->id}'' " . ($row->id == $course->slot ? "selected='true'" : "") . ">{$row->slot_number}</option>";
                    }
                    ?>
                </select>
                <small class="error">Please select a slot</small>
            </label>
        </div>

        <input type="submit" class="button radius" value="Edit Course" />
    </div>
</form>
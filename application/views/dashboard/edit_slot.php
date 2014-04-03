<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Edit Slot</h4>
</div>

<?php
if ($CI->input->get("success") == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully updated the slot.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if ($CI->input->get("success") == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem saving the slot to the database.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>
<form method="post" action="<?php echo base_url(); ?>/index.php?/post/edit_slot" data-abide>
    <div class="large-6 column">
        <div class="slot-field">
            <label>Slot <small>required</small>
                <input type="text" name="data[slot][slot_name]" required value="<?php echo $slot->slot; ?>" />
                <input type="hidden" name="data[slot][slot_id]" value="<?php echo $slot->id; ?>" />
                <small class="error">A slot number or name is required!</small>
            </label>
        </div>
        <div>
            <label>Capacity <small>required</small>
                <input type="text" name="data[slot][capacity]" required value="<?php echo $slot->capacity; ?>" pattern="[0-9]" />
                <small class="error">Please add numeric number of spots available for this slot!</small>
            </label>
        </div>
        <div>
            <label>Available Spots
                <input type="text" value="<?php echo $available_spots; ?>" disabled />
            </label>
        </div>

        <div class="times-offered">
            <label>Times offered <small>Required</small></label>
            <?php
            $count = 0;
            $schedule_results = $CI->datamodel->getSlotSchedule($slot->id);
            $days = $CI->datamodel->getWeekDays();

            foreach ($schedule_results as $sch) {
                ?>
                <div class="course-schedule">
                    <label>
                        <select class="columns large-4 left" name="data[slot][schedule][<?php echo $count; ?>][day]" required>
                            <option value=""> -- Select Day --</option>
                            <?php
                            foreach ($days as $row) {
                                echo "<option value='$row->id'" . ($row->id == $sch->day_id ? "selected='selected'" : "") . ">$row->day</option>";
                            }
                            ?>
                        </select>
                        <input class="timepicker left" type="text" name="data[slot][schedule][<?php echo $count; ?>][start_time]" placeholder="Start Time" required value="<?php echo $sch->start_time; ?>" />
                        <input class="timepicker left" type="text" name="data[slot][schedule][<?php echo $count; ?>][end_time]" placeholder="End Time" required value="<?php echo $sch->end_time; ?>" />
                        <small class="error">Please add a time schedule.</small>
                        <a data-schedulefield="<?php echo $count; ?>" class="timeschedule-delete" href="javascript:void(0)">remove</a>
                    </label>
                </div>
                <?php
                $count++;
            }

            // 
            if (count($schedule_results) == 0) {
                ?>
                <div class="course-schedule">
                    <label>
                        <select class="columns large-4 left" name="data[slot][schedule][0][day]" required>
                            <option value=""> -- Select Day --</option>
                            <?php
                            foreach ($days as $row) {
                                echo "<option value='$row->id'>$row->day</option>";
                            }
                            ?>
                        </select>
                        <input class="timepicker left" type="text" name="data[slot][schedule][0][start_time]" placeholder="Start Time" required />
                        <input class="timepicker left" type="text" name="data[slot][schedule][0][end_time]" placeholder="End Time" required />
                        <small class="error">Please add a time schedule.</small>
                    </label>
                </div>
                <?php
            }
            ?>
            <a id="addNewTimescheduleField" data-section="slot" class="right" href="javascript:void(0)">Add time slot</a>
            <p></p>
            <div class="clearfix"></div>
        </div>

        <input type="submit" class="button radius" value="Save" />
    </div>
</form>
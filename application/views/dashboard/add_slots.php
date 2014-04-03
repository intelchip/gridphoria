<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Add Slots</h4>
</div>

<?php
if ($CI->input->get("success") == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully added a slot.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if ($CI->input->get("success") == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem saving the slot to the database.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>
<form method="post" action="<?php echo base_url(); ?>/index.php?/post/add_slots" data-abide>
    <div class="large-6 column">
        <div class="slot-field">
            <label>Slot <small>required</small>
                <input type="text" name="data[slot][slot_name]" required />
                <small class="error">A slot number or name is required!</small>
            </label>
        </div>
        <div>
            <label>Capacity <small>required</small>
                <input type="text" name="data[slot][capacity]" required pattern="[0-9]" />
                <small class="error">Please add numeric number of spots available for this slot!</small>
            </label>
        </div>
        
        <div class="times-offered">
            <label>Times offered <small>Required</small></label>
            <?php
            $days = $CI->datamodel->getWeekDays();
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
            <a id="addNewTimescheduleField" data-section="slot" class="right" href="javascript:void(0)">Add time slot</a>
            <p></p>
            <div class="clearfix"></div>
        </div>
        <input type="submit" class="button radius" value="Add Slot" />
    </div>
</form>
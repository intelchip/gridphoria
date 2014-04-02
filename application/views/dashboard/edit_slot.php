
<div class="panel">
    <h4>Edit Slot</h4>
</div>

<?php
if (@$_GET["success"] == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully updated the slot.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if (@$_GET["success"] == "error") {
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
        <input type="submit" class="button radius" value="Save" />
    </div>
</form>
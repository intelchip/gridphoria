<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>View Slots</h4>
</div>
<?php
if ($CI->input->get("success") == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully updated the slots table.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if ($CI->input->get("success") == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem saving the slot to the database.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>

<table class="slots-table full-table-width">
    <thead>
        <tr>
            <td>Slot</td>
            <td>Time</td>
            <td>Available Spots</td>
            <td>Capacity</td>
            <td></td>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($slots as $slot) {
            $schedule = function ($slot_id) {
                $CI = & get_instance();
                $schedule_results = $CI->datamodel->getSlotSchedule($slot_id);
                $results = "";
                foreach ($schedule_results as $sch) {
                    $results .= "<div>{$CI->datamodel->getDay($sch->day_id)->day}:<br /><small>{$sch->start_time} - {$sch->end_time}</small></div><div class='clearfix'></div>";
                }
                return $results;
            };
            echo "<tr>
                    <td>{$slot->slot}</td>
                    <td>" . $schedule($slot->id) . "</td>
                    <td>{$CI->datamodel->getAvailableSlots($slot->id)}</td>
                    <td>{$slot->capacity}</td>
                    <td>" . ( $is_current_user_faculty_chair ? "
                        <a href='" . base_url() . "/index.php?/dashboard/edit_slot/{$slot->id}'>edit</a><br />
                        <a href='" . base_url() . "/index.php?/dashboard/delete_slot/{$slot->id}'>delete</a>  
                            " : "" ) . " 
                    </td>
             </tr>";
        }
        ?>
    </tbody>
</table>
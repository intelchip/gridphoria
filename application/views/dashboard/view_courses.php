<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Courses</h4>
</div>

<table class="courses-table full-table-width">
    <thead>
        <tr>
            <th>CRN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Instructor</th>
            <th>Semester</th>
            <th>Times Offered</th>
            <th>Slot</th>
            <th>Modified on</th>
            <th>Modified by</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($courses as $row) {
            $instructor = $CI->usermodel;
            $instructor->id = $row->instructor_id;
            $instructor->get_user();
            $instructor_name = $instructor->id != 0 ? $instructor->first_name . " " . $instructor->last_name : "TBA";
            $schedule = function ($result) {
                $CI = & get_instance();
                $results = "";
                foreach ($result as $slot) {
                    $schedule_results = $CI->datamodel->getSlotSchedule($slot->slot_id);
                    foreach ($schedule_results as $sch) {
                        $results .= "<div>{$CI->datamodel->getDay($sch->day_id)->day}:<br /><small>{$sch->start_time} - {$sch->end_time}</small></div><div class='clearfix'></div>";
                    }
                }
                return $results;
            };

            $slots = function($result) {

                $CI = & get_instance();
                $results = "";
                foreach ($result as $slot) {
                    $results .= $slot->slot_id . ", ";
                }
                return $results;
            };

            echo "<tr>
                    <td>{$row->crn}</td>
                    <td>{$row->name}</td>
                    <td>{$row->description}</td>
                    <td>$instructor_name</td>
                    <td>{$CI->datamodel->getSemester($row->semester)}</td>
                    <td>" . $schedule($CI->datamodel->getCourseSlots($row->id)) . "</td>
                    <td>" . $slots($CI->datamodel->getCourseSlots($row->id)) . "</td>
                    <td><small>" . timespan($row->modified, time()) . " ago</small></td>
                    <td>{$row->modified_by}</td>
                    <td>" . ($row->instructor_id == 0 ? "<a href='" . base_url() . "index.php?/dashboard/take_course/{$row->id}'>take course</a><br />" : "") . ($is_current_user_faculty_chair ? "
                        <a href='" . base_url() . "index.php?/dashboard/edit_course/{$row->id}'>edit</a><br />
                        <a href='" . base_url() . "index.php?/dashboard/delete_course/{$row->id}'>delete</a>   
                            " : "" ) . "
                          
                    </td>
                 <tr>";
        }

        // If there are no courses display message
        if (!count($courses)) {
            echo "<tr><td colspan=10>No Courses in system!</td></tr>";
        }
        ?>
    </tbody>
</table>
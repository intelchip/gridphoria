<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>View Courses</h4>
</div>

<table class="courses-table">
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
        foreach ($CI->datamodel->getCourses() as $row) {
            $instructor = $CI->usermodel;
            $instructor->id = $row->instructor_id;
            $instructor->get_user();
            $schedule = function ($course_id) {
                $CI = & get_instance();
                $schedule_results = $CI->datamodel->getCourseSchedule($course_id);
                $results = "";
                foreach ($schedule_results as $sch) {
                    $results .= "<div>{$sch->day}:<br /><small>{$sch->start_time} - {$sch->end_time}</small></div><div class='clearfix'></div>";
                }
                return $results;
            };

            echo "<tr>
                    <td>{$row->crn}</td>
                    <td>{$row->name}</td>
                    <td>{$row->description}</td>
                    <td>{$instructor->first_name} {$instructor->last_name}</td>
                    <td>{$CI->datamodel->getSemester($row->semester)}</td>
                    <td>" . $schedule($row->id) . "</td>
                    <td>{$row->slot}</td>
                    <td><small>" . timespan($row->modified, time()) . " ago</small></td>
                    <td>{$row->modified_by}</td>
                    <td>
                        <a href='".base_url()."/index.php?/dashboard/edit_course/{$row->id}'>edit</a><br />
                        <a href='".base_url()."/index.php?/dashboard/delete_course/{$row->id}'>delete</a>   
                    </td>
                 <tr>";
        }
        ?>
    </tbody>
</table>
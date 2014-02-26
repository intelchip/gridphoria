<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>View Courses</h4>
</div>

<table>
    <thead>
        <tr>
            <th>CRN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Instructor</th>
            <th>Semester</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Slot</th>
            <th>Modified on</th>
            <th>Modified by</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($CI->datamodel->getCourses() as $row){
            $instructor = $CI->usermodel;
            $instructor->id = $row->instructor_id;
            $instructor->get_user();
            echo "<tr>
                    <td>{$row->crn}</td>
                    <td>{$row->name}</td>
                    <td>{$row->description}</td>
                    <td>{$instructor->first_name} {$instructor->last_name}</td>
                    <td>{$CI->datamodel->getSemester($row->semester)}</td>
                    <td>{$row->start_time}</td>
                    <td>{$row->end_time}</td>
                    <td>{$row->slot}</td>
                    <td>{$row->modified}</td>
                    <td>{$row->modified_by}</td>
                    <td>
                        <a href='/index.php?/dashboard/edit_course/{$row->id}'>edit</a><br />
                        <a href='/index.php?/dashboard/delete_course/{$row->id}'>delete</a>   
                    </td>
                 <tr>";
        }
        ?>
    </tbody>
</table>
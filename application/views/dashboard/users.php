<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Instructors</h4>
</div>

<table class="slots-table full-table-width">
    <thead>
        <tr>
            <td>id</td>
            <td>Instructor</td>
            <td>Role</td>
            <td>Disabled?</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $getRole = function($id) {
            $CI = & get_instance();
            $role = $CI->datamodel->getRole($id);
            return $role ? $role->role : null;
        };
        foreach ($users as $instructor) {
            echo "<tr>"
            . "<td>$instructor->id</td>"
            . "<td>$instructor->first_name $instructor->last_name</td>"
            . "<td>" . $getRole($instructor->role_id) . "</td>"
            . "<td>" . ($instructor->enabled ? "enabled" : "disabled") . "</td>"
            . "<td>" . ($getRole($instructor->role_id) != "Chair" ? ($instructor->enabled ? "<a href='" . base_url("index.php?/dashboard/disable_user/$instructor->id") . "'>disable</a>" : "<a href='" . base_url("index.php?/dashboard/enable_user/$instructor->id") . "'>enable</a>") : "" ) . "</td>"
            . "</tr>";
        }
        ?>
    </tbody>
</table>

<div class="panel">
    <h4>Dashboard</h4>
</div>

<div>
    <?php
    if ($is_current_user_faculty_chair) {
        ?>
        <a href="<?php echo base_url(); ?>index.php?/dashboard/add_courses" class="button"><i class="fi-plus large"></i> Add Course</a>
    <?php } ?>
    <a href="<?php echo base_url(); ?>index.php?/dashboard/view_courses" class="button"><i class="fi-list-bullet large"></i> View Courses</a>
    <hr />
</div>

<div id='calendar'></div>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $page; ?></title>
        <meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more." />
        <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com" />
        <meta name="copyright" content="ZURB, inc. Copyright (c) 2013" />
        <?php
        echo $css;
        ?>
    </head>
    <body>
        <header id="header">

            <div class="row">
                <div class="large-3 columns logo">
                    <img src="<?php echo base_url(); ?>/assets/img/logo.png" onclick="window.location = '<?php echo base_url(); ?>'" />
                </div>
                <div class="large-9 columns">
                    <ul class="right nav-bar button-group">
                        <?php
                        $CI = & get_instance();

                        $current_user = $CI->session->userdata("uid");
                        if (!$current_user) {
                            ?>
                            <li><a href="<?php echo base_url(); ?>index.php?/pages/register">Register</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php?/pages/login">Login</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo base_url(); ?>index.php?/dashboard/">Dashboard</a></li>
                            <li><a href="#" data-dropdown="coursesDropdown">Manage Courses &raquo;</a></li>
                            <li><a href="#" data-dropdown="slotsDropdown">Manage Slots &raquo;</a></li>
                            <li>
                                <a href="#" data-dropdown="accountDropdown"><i class="fi-torso small"></i> Account &raquo;</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul id="coursesDropdown" class="nav-dropdown tiny f-dropdown" data-options="is_hover:true" data-dropdown-content>
                        <?php
                        if ($is_current_user_faculty_chair) {
                            ?>
                            <li><a href="<?php echo base_url(); ?>index.php?/dashboard/add_courses">Add Courses</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="<?php echo base_url(); ?>index.php?/dashboard/view_courses/uid_<?php echo $CI->session_uid; ?>">My Courses</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?/dashboard/view_courses">View All Courses</a></li>
                    </ul>
                    <ul id="slotsDropdown" class="nav-dropdown tiny f-dropdown" data-options="is_hover:true" data-dropdown-content>
                        <?php
                        if ($is_current_user_faculty_chair) {
                            ?>
                            <li><a href="<?php echo base_url(); ?>index.php?/dashboard/add_slots">Add Slots</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="<?php echo base_url(); ?>index.php?/dashboard/view_slots">View Slots</a></li>
                    </ul>
                    <ul id="accountDropdown" class="nav-dropdown tiny f-dropdown" data-options="is_hover:true" data-dropdown-content>
                        <li><a href="<?php echo base_url(); ?>index.php?/dashboard/account_settings">Settings</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?/dashboard/logout">Logout</a></li>
                    </ul>
                </div>
            </div>

        </header>
        <div class="main-content">
            <div class="row">
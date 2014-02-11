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
                    <img src="/assets/img/logo.png" onclick="window.location='<?php echo base_url(); ?>'" />
                </div>
                <div class="large-9 columns">
                    <ul class="right nav-bar button-group">
                        <?php
                        $CI = & get_instance();

                        $current_user = $CI->session->userdata("uid");
                        if (!$current_user) {
                            ?>
                            <li><a href="/index.php?/pages/register">Register</a></li>
                            <li><a href="/index.php?/pages/login">Login</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="/index.php?/dashboard/">Dashboard</a></li>
                            <li><a href="/index.php?/dashboard/add_courses">Add Courses</a></li>
                            <li><a href="/index.php?/dashboard/view_courses">View Courses</a></li>
                            <li><a href="/index.php?/dashboard/logout">Logout</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </header>
        <div class="main-content">
            <div class="row">
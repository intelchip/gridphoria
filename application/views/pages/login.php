
<?php
$CI = & get_instance();
$message = $CI->uri->segment(3);

if ($message == "fail") {
    ?>
    <div data-alert class="alert-box warning">
        There is a problem logging in. Your account might also be disabled. Please try again!
        <a href="#" class="close">&times;</a>

    </div>
    <?php
}
?>
<form method="post" action="<?php echo base_url(); ?>index.php?/authenticate/user" data-abide>

    <div class="panel">
        <h4>Login</h4>
    </div>
    <div class="clearfix"></div>
    <div class="large-6 column">

        <div class="email-field">
            <label for="email">Email <small>required</small>
                <input id="email" type="text" name="data[user][email]" value="<?php echo $CI->input->get("email") ? $CI->input->get("email") : ""; ?>" required />
                <small class="error">Email is required.</small>
            </label>
        </div>

        <div class="password-field">
            <label for="password">Password <small>required</small>
                <input id="password" type="password" name="data[user][password]" required pattern="[0-9]{4}" />
                <small class="error">Password must be numeric and contain 4 digits.</small>
            </label>
        </div>

        <?php
        echo anchor(base_url("index.php?/pages/forgotpassword"), "Forgot Password?", "class='pull-right'");
        ?>
        <div class="clearfix"></div>

        <input type="submit" class="button radius" value="Login" />
    </div>
</form>
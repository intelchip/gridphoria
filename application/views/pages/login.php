
<?php
$CI = & get_instance();
$message = $CI->uri->segment(3);

if ($message == "fail") {
    ?>
    <div data-alert class="alert-box warning">
        There is a problem logging in. Please try again!
    </div>
    <?php
}
?>
<form method="post" action="/index.php?/authenticate/user" data-abide>

    <div class="panel">
        <h4>Login</h4>
    </div>
    <div class="clearfix"></div>
    <div class="large-6 column">

        <div class="email-field">
            <label>Email <small>required</small>
                <input type="text" name="data[user][email]" value="<?php echo $CI->input->get("email") ? $CI->input->get("email") : ""; ?>" required>
            </label>
            <small class="error">Email is required.</small>
        </div>

        <div class="password-field">
            <label>Password <small>required</small>
                <input type="password" name="data[user][password]" required />
            </label>
            <small class="error">Password must be numeric and contain 4 digits.</small>
        </div>

        <input type="submit" class="button radius" value="Login" />
    </div>
</form>
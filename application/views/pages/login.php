
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
<form method="post" action="/index.php?/authenticate/user">

    <div class="panel">
        <h4>Login</h4>
    </div>
    <div class="clearfix"></div>
    <div class="large-6 column">

        <label>Email
            <input type="text" name="data[user][email]" value="<?php echo $CI->input->get("email") ? $CI->input->get("email") : ""; ?>">
        </label>

        <label>Password
            <input type="password" name="data[user][password]">
        </label>

        <input type="submit" class="button radius" value="Login" />
    </div>
</form>
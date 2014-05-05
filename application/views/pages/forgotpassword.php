<?php if (@$errormessage): ?>
    <div data-alert class="alert-box warning ">
        <!--<a href="#" class="close">&times;</a>-->
        <strong>Warning!</strong> <?php echo @$errormessage; ?>
    </div>
<?php elseif (@$successmessage): ?>
    <div data-alert class="alert-box success">
        <!--<a href="#" class="close">&times;</a>-->
        <strong>Awesome!</strong> <?php echo @$successmessage; ?>
    </div>
<?php endif; ?>
<div class="alert-box warning">
    <!--<a href="#" class="close">&times;</a>-->
    If you do not get an email from us within 10mins and cannot find the email in your spam folder, email our <a target="_blank" href="mailto:support@gridphoria.com">customer support</a>.
</div>
<div class="panel">
    <h4 class="pull-left">Please enter Email Address that you want your info to be sent to...</h4>
    <div class="clearfix"></div>
</div>
<div class="large-6 column">	
    <form class="forgot-password-form" method="post" action="<?php echo base_url("index.php?/pages/forgotpassword") ?>" data-abide>
        <div>
            <label for="email">Email <small>required</small>
                <input type="text" id="email" name="data[user][email]" required />                
                <small class="error">Email is required.</small>
            </label>
        </div>
        <div class='form-input-div'>
            <input class="button small" type="submit" value="Forgot Password" />
        </div>
    </form>
</div>
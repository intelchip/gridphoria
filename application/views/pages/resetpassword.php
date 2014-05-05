
<div class="panel">
    <h4 class="pull-left">Reset Password</h4>
    <div class="clearfix"></div>
</div>
<div id="reset-password-page">

    <div class="large-6 column">	
        <form id="resetform" method="post" action="<?php echo base_url("index.php?/pages/resetpassword/$uid/$tokken/send"); ?>" data-abide>

            <div>
                <label for="email">Email <small>required</small>
                    <input type="text" id="email" name="email" value="<?php echo $email ?>" required />                
                    <small class="error">Email is required.</small>
                </label>
            </div>
            <div>
                <label for="password">Password <small>required</small>
                    <input type="password" id="password" name="password" required pattern="[0-9]{4}" />
                    <small class="error">Password must be 4 digits long</small>
                </label>
            </div>	
            <div>
                <label for="cpassword">Confirm Password <small>Required</small>
                    <input type="password" id="cpassword" name="cpassword"  required pattern="[0-9]{4}" data-equalto="password" />
                    <small class="error">The password did not match</small>
                </label>
            </div>	
            <div class='form-input-div'>
                <input class="button" type="submit" value="Reset Password" />
            </div>
        </form>
        <div class="clearfix">&nbsp;</div>
    </div>
</div>
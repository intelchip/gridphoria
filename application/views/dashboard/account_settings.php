<?php
$CI = & get_instance();
?>
<div class="row">
    <form method="post" action="<?php echo base_url(); ?>/index.php?/authenticate/update_user" data-abide>

        <div class="panel">
            <h4>Account Settings</h4>
        </div>

        <?php
        if ($CI->input->get("success") == "true") {
            ?>
            <div data-alert class="alert-box success radius">
                You have successfully updated user info.
                <a href="#" class="close">&times;</a>

            </div>
        <?php } else if ($CI->input->get("success") == "error") {
            ?>
            <div data-alert class="alert-box warning radius">
                There was a problem updating user info in the database.
                <a href="#" class="close">&times;</a>

            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <div class="large-6 column">
            <div class="email-field">
                <label>Email <small>required</small>
                    <input type="text" name="data[user][email]" required value="<?php echo $current_user->email; ?>" />
                    <small class="error">email is required.</small>
                </label>
            </div>

            <div class="name-field">
                <label>First Name <small>required</small>
                    <input type="text" name="data[user][first_name]" required value="<?php echo $current_user->first_name; ?>" />
                    <small class="error">First name is required.</small>
                </label>
            </div>

            <div class="name-field">
                <label>Last Name <small>required</small>
                    <input type="text" name="data[user][last_name]" required value="<?php echo $current_user->last_name; ?>" />
                    <small class="error">Name is required.</small>
                </label>
            </div>

            <div class="role-field">
                <label>Role <small>required</small>
                    <select name="data[user][role]" required>
                        <option value=""> -- Select a role --</option>

                        <?php
                        $CI = & get_instance();

                        foreach ($CI->datamodel->getRoles() as $row) {
                            echo "<option" . ($row->id == $current_user->role_id ? " selected='selected'" : "") . " value = '{$row->id}'>{$row->role}</option>";
                        }
                        ?>
                    </select>
                    <small class="error"> Role is required.</small>
                </label>
            </div>

            <input type="submit" class="button radius" value="Save" />
        </div>
    </form>
    <hr />
    <div class="panel">
        <h4>Change Password</h4>
    </div>
    <div class="large-6 column">
        <form method="post" action="<?php echo base_url(); ?>/index.php?/authenticate/update_password" data-abide>            

            <div class="password-field">
                <label>Password <small>required. *must be 4 digits long</small>
                    <input id="password" type="password" name="data[user][password]" required pattern="[0-9]{4}"/>
                    <small class="error">Password must be 4 digits long</small>
                </label>
            </div>
            <div class="password-confirmation-field">
                <label>Confirm Password <small>required</small>
                    <input type="password" name="data[user][cpassword]"  required pattern="[0-9]{4}" data-equalto="password" />
                    <small class="error">The password did not match</small>
                </label>
            </div>
            <input type="submit" class="button radius" value="Change Password" />
        </form>
    </div>
</div>
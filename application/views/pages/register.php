<div class="row">
    <form method="post" action="/index.php?/authenticate/register_user" data-abide>

        <div class="panel">
            <h4>Login</h4>
        </div>
        <div class="clearfix"></div>
        <div class="large-6 column">
            <div class="email-field">
                <label>Email <small>required</small>
                    <input type="text" name="data[user][email]" required />
                </label>
                <small class="error">email is required.</small>
            </div>

            <div class="name-field">
                <label>First Name <small>required</small>
                    <input type="text" name="data[user][first_name]" required />
                </label>
                <small class="error">First name is required.</small>
            </div>

            <div class="name-field">
                <label>Last Name <small>required</small>
                    <input type="text" name="data[user][last_name]" required />
                </label>
                <small class="error">Name is required.</small>
            </div>

            <div class="role-field">
                <label>Role <small>required</small>
                    <select name="data[user][role]" required>
                        <option> -- Select a role --</option>

                        <?php
                        $CI = & get_instance();

                        foreach ($CI->datamodel->getRoles() as $row) {
                            echo "<option value = '{$row->id}'>{$row->role}</option>";
                        }
                        ?>
                    </select>
                </label>
                <small class="error"> Role is required.</small>
            </div>

            <div class="password-field">
                <label>Password <small>required. *must be 4 digits long</small>
                    <input id="password" type="password" name="data[user][password]" required pattern="[0-9]{4}"/>
                </label>
                <small class="error">Your password must match the requirements</small>
            </div>
            <div class="password-confirmation-field">
                <label>Confirm Password <small>required</small>
                    <input type="password" name="data[user][cpassword]"  required pattern="[0-9]{4}" data-equalto="password" />
                </label>
                <small class="error">The password did not match</small>
            </div>

            <input type="submit" class="button radius" value="Register" />
        </div>
    </form>
</div>
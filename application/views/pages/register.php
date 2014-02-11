<div class="row">
    <form method="post" action="/index.php?/authenticate/register_user">

        <div class="panel">
            <h4>Login</h4>
        </div>
        <div class="clearfix"></div>
        <div class="large-6 column">
            <label>Email
                <input type="text" name="data[user][email]">
            </label>

            <label>First Name
                <input type="text" name="data[user][first_name]">
            </label>

            <label>Last Name
                <input type="text" name="data[user][last_name]">
            </label>

            <label>Role
                <select name="data[user][role]">
                    <option> -- Select a role --</option>

                    <?php
                    $CI = & get_instance();

                    foreach ($CI->datamodel->getRoles() as $row) {
                        echo "<option value = '{$row->id}'>{$row->role}</option>";
                    }
                    ?>
                </select>
            </label>

            <label>Password
                <input type="password" name="data[user][password]">
            </label>
            <label>Confirm Password
                <input type="password" name="data[user][cpassword]">
            </label>

            <input type="submit" class="button radius" value="Register" />
        </div>
    </form>
</div>
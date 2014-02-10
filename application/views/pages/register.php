<div class="row">
    <form method="post" action="/index.php?/authenticate/register_user">

        <div class="panel">
            <h4>Login</h4>
        </div>

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
                <option value="0">Chair</option>
            </select>
        </label>

        <label>Password
            <input type="text" name="data[user][password]">
        </label>

        <input type="submit" class="button radius round" value="Register" />
    </form>
</div>
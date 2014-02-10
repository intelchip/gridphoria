<div class="row">
    <form method="post" action="/authentication/user">

        <div class="panel">
            <h4>Login</h4>
        </div>

        <label>Email
            <input type="text" name="data[user][email]">
        </label>

        <label>Password
            <input type="text" name="data[user][password]">
        </label>

        <input type="submit" class="button radius round" value="Login" />
    </form>
</div>
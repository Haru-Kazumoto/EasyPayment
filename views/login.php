<h2>Login</h2>
<form method="post">
    <input name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button>Login</button>
</form>
<?php if (!empty($error)) echo "<p>$error</p>"; ?>
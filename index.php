<!DOCTYPE html>
<html>
<head>
    <title>ChatApp</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
    <div id="main">
        <div id="info">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label><b>Username</b></label>
                <input type="text" name="username" placeholder="Username"><br><br>
                <label><b>Password</b></label>
                <input type="text" name="password" placeholder="Password"><br><br>
                <button style="background-color: #6495ed; color: white;" type="submit">
                    <b>Login</b>
                </button>
            </form>

            <form action="register.php" method="post">
                <h2>Don't have an account? Register here</h2>
                <label><b>Username</b></label>
                <input type="text" name="username" placeholder="Username"><br><br>
                <label><b>Password</b></label>
                <input type="text" name="password" placeholder="Password"><br><br>
                <button style="background-color: #6495ed; color: white;" type="submit">
                    <b>Register</b>
                </button>
            </form>
        </div>
    </div>

</body>
</html>
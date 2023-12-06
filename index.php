<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<!-- index.php -->
<body>
    <form action="login.php" method="post">
        <h2><strong>Login</strong></h2>
        <?php if (isset($_GET['error'])) {?>
            <p class=error><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <div>
        <button type="submit">Login</button>
        <button><a href="signup.php" style="color: antiquewhite;">Sign Up</a></button>
        </div>
    </form>
</body>
</html>
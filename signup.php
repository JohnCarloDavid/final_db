<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="register.php" method="post">
        <h2><strong>Sign Up</strong></h2>
        <?php if (isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } elseif (isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name" required><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign Up</button>
        <button><a href="index.php" style="color: antiquewhite;">back</a></button>
    </form>
</body>

</html>

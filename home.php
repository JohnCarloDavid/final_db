<?php
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['uname'])) {
    header("Location: index.php");
    exit();
}

// Initialize balance for demonstration (replace this with actual balance retrieval logic)
$_SESSION['balance'] = isset($_SESSION['balance']) ? $_SESSION['balance'] : 1000;

// Handle money transfer logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 0;

    // Check if the balance is sufficient
    if ($_SESSION['balance'] >= $amount && $amount > 0) {
        $_SESSION['balance'] -= $amount;
        $message = "Money transferred successfully!";
    } else {
        $message = "Insufficient funds or invalid amount.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: #1690a7;">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img src="img/images-removebg-preview (1).png" class="logo" style="width: 6%;" alt="img1">
            <h5 class="mx-auto">Welcome, <?php echo $_SESSION['uname']; ?>!</h5>
            <a class="navbar-brand mx-auto" href="#" style="font-weight: bold; font-size: 40px;">Payme</a>
        </div>
    </nav>

    <section class="bg-primary text-white text-center py-5">
        <h2>Your Balance: $<?php echo $_SESSION['balance']; ?></h2>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="home.php" method="post" class="d-flex justify-content-center">
            <label for="amount" class="mr-2">Enter Amount to Transfer:</label>
            <input type="number" name="amount" id="amount" min="1" required class="mr-2">
            <button type="submit" class="btn btn-light">Transfer Money</button>
        </form>

        <form action="login.php" method="get" class="mt-3">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
    </section>
</body>

</html>

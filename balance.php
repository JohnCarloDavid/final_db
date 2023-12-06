<?php
session_start();

// Initialize balance for demonstration (replace this with actual balance retrieval logic)
$_SESSION['balance'] = isset($_SESSION['balance']) ? $_SESSION['balance'] : 1000;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle money transfer logic
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
    <title>Money Transfer</title>
</head>

<body>
    <h2>Your Balance: $<?php echo $_SESSION['balance']; ?></h2>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="index.php" method="post">
        <label for="amount">Enter Amount to Transfer:</label>
        <input type="number" name="amount" id="amount" min="1" required>
        <button type="submit">Transfer Money</button>
    </form>
</body>

</html>

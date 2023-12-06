<?php
session_start();

// Establish a connection to the database
$conn = mysqli_connect("localhost", "root", "", "final_db");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=User Name and Password are required");
        exit();
    } else {
        // Check if user exists in the database
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // User found, start session and redirect to home page
            $_SESSION['uname'] = $uname;
            header("Location: home.php");
            exit();
        } else {
            // Invalid credentials, redirect to login page with error message
            header("Location: index.php?error=Incorrect User name or Password");
            exit();
        }
    }
} else {
    // Redirect to login page if form is not submitted
    header("Location: index.php");
    exit();
}

// Function to validate user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

mysqli_close($conn); // Close database connection
?>

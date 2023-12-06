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
        header("Location: signup.php?error=User Name and Password are required");
        exit();
    } else {
        // Check if the username is already taken
        $check_user_sql = "SELECT * FROM users WHERE user_name=?";
        $check_user_stmt = mysqli_prepare($conn, $check_user_sql);
        mysqli_stmt_bind_param($check_user_stmt, "s", $uname);
        mysqli_stmt_execute($check_user_stmt);
        $check_user_result = mysqli_stmt_get_result($check_user_stmt);

        if (mysqli_num_rows($check_user_result) > 0) {
            header("Location: signup.php?error=User Name is already taken");
            exit();
        }

        // Insert new user into the database
        $insert_user_sql = "INSERT INTO users (user_name, password) VALUES (?, ?)";
        $insert_user_stmt = mysqli_prepare($conn, $insert_user_sql);
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($insert_user_stmt, "ss", $uname, $hashed_password);

        if (mysqli_stmt_execute($insert_user_stmt)) {
            header("Location: signup.php?success=Registration successful. You can now log in.");
            exit();
        } else {
            header("Location: signup.php?error=Registration failed. Please try again later.");
            exit();
        }
    }
} else {
    // Redirect to login page if form is not submitted
    header("Location: signup.php");
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

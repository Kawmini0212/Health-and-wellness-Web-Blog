<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitness');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture username and password from the form
$username = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare the SQL statement to avoid SQL injection
$sql = $conn->prepare("SELECT * FROM register WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;

            // Check if the user is an admin (assuming you have an is_admin column)
            if ($row['is_admin'] == 1) {
                // Store is_admin status in the session
                $_SESSION['is_admin'] = true;

                // Redirect admin to the admin review page
                header("Location: admin.php"); 
            } else {
                // Store is_admin status in the session
                $_SESSION['is_admin'] = false;

                // Redirect normal user to their dashboard or homepage
                header("Location: chth.html"); 
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found!";
    }
} else {
    echo "Error in SQL query: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

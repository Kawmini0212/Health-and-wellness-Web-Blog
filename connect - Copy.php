
<?php
$username = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$conn  = new mysqli('localhost' ,'root', '', 'fitness');

// Check if the connection is successful
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare the SQL statement to insert user data
    $stmt = $conn->prepare("INSERT INTO register (username, password, email, age, gender) VALUES (?, ?, ?, ?, ?)");
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssis", $username, $hashedPassword, $email, $age, $gender);
    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration Successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

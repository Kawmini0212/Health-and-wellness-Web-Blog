<?php
// Database connection settings
$servername = "localhost"; // Your server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "fitness"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query to fetch tips
$sql = "SELECT tip_name, category FROM health"; // Adjust the table name if needed
$result = $conn->query($sql);

// Initialize an array to hold the tips
$tips = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tips[] = $row; // Add each row to the tips array
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json'); // Set the response content type
echo json_encode($tips); // Encode tips as JSON and return
?>

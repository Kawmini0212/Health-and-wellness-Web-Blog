<?php
$title = isset($_POST['title']) ? $_POST['title'] : '';
$author = isset($_POST['author']) ? $_POST['author'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';


var_dump($_POST);


$conn = new mysqli('localhost', 'root', '', 'fitness');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare the SQL statement to insert user data along with the image URL
    $stmt = $conn->prepare("INSERT INTO blog(title, author, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $content);

    if ($stmt->execute()) {
        echo "Submission successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

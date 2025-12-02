<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: connect2.php"); // Redirect to login if not an admin
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitness');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if action and id are set
if (isset($_POST['action']) && isset($_POST['id'])) {
    $blog_id = $_POST['id'];

    if ($_POST['action'] == 'approve') {
        // Update blog post to approved
        $sql = $conn->prepare("UPDATE blog SET approved = 1 WHERE id = ?");
        $sql->bind_param("i", $blog_id);
        $sql->execute();
        echo "Blog post approved successfully.";
    } elseif ($_POST['action'] == 'reject') {
        // Delete blog post from database
        $sql = $conn->prepare("DELETE FROM blog WHERE id = ?");
        $sql->bind_param("i", $blog_id);
        $sql->execute();
        echo "Blog post rejected and deleted successfully.";
    }

    // Redirect back to admin review page
    header("Location: admin.php");
    exit();
} else {
    echo "Invalid request.";
}

$conn->close();
?>

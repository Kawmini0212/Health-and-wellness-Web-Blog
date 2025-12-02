<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitness');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all approved blog posts from the database
$sql = "SELECT * FROM blog WHERE approved = 1"; // Assuming 'approved' is a column in your blog table
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="template.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Approved Blogs</title>
</head>
<body>
 
<main>
 
  <div class="content-box">
    <h2 class="content-heading">Approved Blog Posts</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="blog-post">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
               
            </div>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No approved blog posts available.</p>
    <?php endif; ?>
  </div>
</main>



<script src="search.js"></script>
  
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

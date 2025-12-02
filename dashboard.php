<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: connect2.php");
  exit();
}
?>
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>Now you can submit a blog post or discover health tips.</p>
<a href="chth.html">Submit a Blog Post</a> | 

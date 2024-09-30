<?php
include 'db.php'; // Include database connection file

$id = $_GET['id']; // Get the post ID from the URL

// Prepare an SQL statement to delete the post
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id); // Bind the post ID
$stmt->execute(); // Execute the statement

header('Location: index.php'); // Redirect to the index page after successful deletion
exit();
?>

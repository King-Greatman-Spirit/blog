<?php
include 'db.php'; // Include database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the form is submitted
    $title = $_POST['title']; // Get the title from POST request
    $content = $_POST['content']; // Get the content from POST request

    // Prepare an SQL statement to insert the new post
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content); // Bind parameters
    $stmt->execute(); // Execute the statement

    header('Location: index.php'); // Redirect to the index page after successful insertion
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Post</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Include custom CSS -->
</head>
<body>
<div class="container">
    <h1 class="my-4">Add New Post</h1>
    <form action="add_post.php" method="post"> <!-- Form to add a new post -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required> <!-- Title input field -->
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea> <!-- Content input field -->
        </div>
        <button type="submit" class="btn btn-primary">Add Post</button> <!-- Submit button -->
        <a href="index.php" class="btn btn-secondary">Cancel</a> <!-- Cancel button to go back to index -->
    </form>
</div>
<!-- Include jQuery and Bootstrap JS for functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script> <!-- Include custom JS -->
</body>
</html>

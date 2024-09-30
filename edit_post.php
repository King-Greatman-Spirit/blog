<?php
// Include the database connection file
include 'db.php';

// Get the post ID from the query string
$id = $_GET['id'];

// Prepare SQL statement to select the post with the given ID
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id); // Bind the post ID parameter
$stmt->execute(); // Execute the query
$result = $stmt->get_result(); // Get the result set from the executed query
$post = $result->fetch_assoc(); // Fetch the post details into an associative array

// Check if the form has been submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the updated title and content from the form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Update the post in the database and set `created_at` to the current timestamp
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, created_at = CURRENT_TIMESTAMP WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id); // Bind parameters: title, content, and post ID
    $stmt->execute(); // Execute the update query

    // Redirect to the index.php page after successful update
    header('Location: index.php');
    exit(); // Terminate script execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Edit Post</h1>
    <!-- Edit post form with action attribute pointing to edit_post.php with post ID -->
    <form action="edit_post.php?id=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <!-- Input field for post title, prefilled with current post title -->
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <!-- Textarea for post content, prefilled with current post content -->
            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <!-- Button to submit the form to update the post -->
        <button type="submit" class="btn btn-primary">Update</button>
        <!-- Button to cancel editing and go back to index.php -->
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<!-- Scripts for Bootstrap and custom scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>

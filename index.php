<?php
include 'db.php'; // Include database connection file

// Query to fetch all posts ordered by creation date in descending order
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $result->fetch_all(MYSQLI_ASSOC); // Fetch all posts as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Blog</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Include custom CSS -->
</head>
<body>
<div class="container">
    <h1 class="my-4">Simple Blog</h1>
    <a href="add_post.php" class="btn btn-primary mb-4">Add New Post</a> <!-- Button to add a new post -->
    <?php foreach ($posts as $post): ?> <!-- Loop through each post -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h2> <!-- Display post title -->
                <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p> <!-- Display post content -->
                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Edit</a> <!-- Button to edit the post -->
                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a> <!-- Button to delete the post -->
            </div>
            <div class="card-footer text-muted">
                Posted on <?php echo $post['created_at']; ?> <!-- Display post creation date -->
            </div>
        </div>
    <?php endforeach; ?>
    
</div>
<!-- Include jQuery and Bootstrap JS for functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script> <!-- Include custom JS -->
</body>
</html>

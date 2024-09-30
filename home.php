<?php 
include "db.php"; //include db connection file

// Query to fetch all posts ordered by creation date in desending order
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $result->fetch_all(MYSQLI_ASSOC); // Fetch all posts as an associative array
?>


<!DOCTYPE html5>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Blog</title>

	<!-- Include bootstrap CSS for styling  -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- external styling to css -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container">
		<h1 class="my-4">Simple Blog</h1>
		<a href="add_post.php" class="btn btn-primary mb-4">Add New Post</a>

		<!-- loop through each post -->
		<?php foreach ($posts as $post): ?>  
			<div class="card mb-4">
				<div class="card-body">
					<!-- display post title  -->
					<h2 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h2>
					<!-- display post content -->
					<p class="card-text"><?php echo nl2br(htmlspecialchars($post['content']));
					 ?></p>
					 <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Edit </a> 
					 <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you eant to delete this post?');">Delete </a> 
				</div>
				<div class="card-footer text-muted">
					Posted on <?php echo $post['creted_at']; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>



<!-- Include bootstrap JS for styling  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- external linking to js file -->
<script src="js/scripts.js" type="text/javascript"></script>
</body>
</html>
<?php
session_start(); // Start the session to check if the admin is logged in

// Check if admin is logged in and if 'post_id' is passed in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['post_id'])) {
	$post_id = $_GET['post_id']; // Get the post ID from the URL

	// Include necessary files for fetching post data and database connection
	include_once("data/Post.php");        // Contains function to get post by ID
	include_once("../db_conn.php");       // Database connection file

	// Get the post details by post ID
	$post = getByIdDeep($conn, $post_id);

	// Get category details associated with the post
	$category = getCategoryById($conn, $post['category']);

	// If category exists, get its name, otherwise display "Unknown Category"
	$categoryName = $category ? $category['category'] : "Unknown Category";
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - <?= $post['post_title'] ?> </title>

		<!-- Include CSS & necessary libraries -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/side-bar.css">
		<link rel="stylesheet" href="../css/style.css">
	</head>

	<body>

		<?php
		// Display the sidebar menu
		$key = "hhdsfs1263z";
		include "inc/side-nav.php"; // Include sidebar navigation
		?>


		<div class="main-table">
			<!-- Display the post in a card layout -->
			<div class="card main-blog-card mb-5">
				<!-- Display the post's cover image -->
				<img src="../upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="Post cover image">

				<div class="card-body">
					<h5 class="card-title"><?= $post['post_title'] ?></h5> <!-- Display post title -->

					<!-- Display the content of the post -->
					<?= $post['post_text'] ?>

					<hr>

					<!-- Display category name and creation date -->
					<p class="card-text d-flex justify-content-between">
						<b>Category: <?= $categoryName ?></b>
						<small class="text-body-secondary">Date: <?= $post['crated_at'] ?></small>
					</p>
				</div>
			</div>
		</div>

		<!-- Activate the sidebar menu item corresponding to the second section -->
		<script>
			var navList = document.getElementById('navList').children;
			navList.item(1).classList.add("active"); // Add "active" class to second menu item
		</script>

		<!-- Include Bootstrap JS script -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>

<?php
} else {
	// If not logged in or 'post_id' is not provided, redirect to login page
	header("Location: ../admin-login.php");
	exit;
}
?>
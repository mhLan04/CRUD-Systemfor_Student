<?php
// Start the session or resume the existing session
session_start();

// Check if the user is logged in as an admin (both admin_id and username should be set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Comments</title>
		<!-- Include Font Awesome for icons -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Include Bootstrap CSS for styling -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<!-- Include custom sidebar and main styles -->
		<link rel="stylesheet" href="../css/side-bar.css">
		<link rel="stylesheet" href="../css/style.css">
	</head>

	<body>
		<?php
		// A secret key for encryption or security purposes (if needed)
		$key = "hhdsfs1263z";
		// Include the sidebar and the required files for handling comments and posts
		include "inc/side-nav.php";
		include_once("data/Comment.php");
		include_once("data/Post.php");
		include_once("../db_conn.php");

		// Retrieve all comments from the database
		$comments = getAllComment($conn);
		?>

		<div class="main-table">
			<h3 class="mb-3">All Comments</h3>

			<!-- Display error message if any -->
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-warning">
					<?= htmlspecialchars($_GET['error']) ?>
				</div>
			<?php } ?>

			<!-- Display success message if any -->
			<?php if (isset($_GET['success'])) { ?>
				<div class="alert alert-success">
					<?= htmlspecialchars($_GET['success']) ?>
				</div>
			<?php } ?>

			<!-- Check if there are comments to display -->
			<?php if ($comments != 0) { ?>
				<table class="table t1 table-bordered">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Post Title</th>
							<th scope="col">Comment</th>
							<th scope="col">User</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// Loop through each comment and display in the table
						foreach ($comments as $comment) {
						?>
							<tr>
								<th scope="row"><?= $comment['comment_id'] ?></th>
								<td>
									<?php
									$p = getByIdDeep($conn, $comment['post_id']);
									if (is_array($p) && isset($p['post_title'])) {
										echo $p['post_title'];
									} else {
										echo 'Post not found'; 
									}
									?>
								</td>
								<td>
									<?= $comment['comment'] ?>
								</td>
								<td>
									<?php
									// Retrieve and display the username of the user who posted the comment
									$u = getUserByID($conn, $comment['user_id']);
									echo '@' . $u['username']; ?>
								</td>
								<td>
									<!-- Link to delete the comment -->
									<a href="comment-delete.php?comment_id=<?= $comment['comment_id'] ?>" class="btn btn-danger">Delete</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } else { ?>
				<!-- Display a message if there are no comments -->
				<div class="alert alert-warning">
					Empty!
				</div>
			<?php } ?>
		</div>

		<script>
			// Add "active" class to the fourth item in the navigation list (for highlighting purposes)
			var navList = document.getElementById('navList').children;
			navList.item(3).classList.add("active");
		</script>

		<!-- Include Bootstrap JS for functionality -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	// If the user is not logged in as admin, redirect to the login page
	header("Location: ../admin-login.php");
	exit;
} ?>
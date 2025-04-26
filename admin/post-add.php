<?php 
// Start the session or resume the existing session
session_start();

// Check if the user is logged in as an admin (both admin_id and username should be set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Create Post</title>
	<!-- Include Font Awesome for icons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Include Bootstrap CSS for styling -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!-- Include custom sidebar and main styles -->
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
    <!-- Include rich text editor CSS for textarea styling -->
    <link rel="stylesheet" href="../css/richtext.min.css">
    <!-- Include jQuery for rich text editor functionality -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.richtext.min.js"></script>
</head>
<body>
	<?php 
      // A secret key for encryption or security purposes (if needed)
      $key = "hhdsfs1263z"; 
      // Include the sidebar and the required files for handling categories and database connection
      include "inc/side-nav.php"; 
      include_once("data/Category.php");
      include_once("../db_conn.php");
    
      // Retrieve all categories from the database
      $categories = getAll($conn);
	?>
               
	<div class="main-table">
	 	<h3 class="mb-3">Create New Post
	 		<!-- Link to go back to the posts page -->
	 		<a href="post.php" class="btn btn-secondary">Posts</a></h3>
	 	
        <!-- Display error message if any -->
        <?php if (isset($_GET['error'])) { ?>	
        <div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
        <?php } ?>

        <!-- Display success message if any -->
        <?php if (isset($_GET['success'])) { ?>	
        <div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
        <?php } ?>

        <!-- Form to create a new post -->
        <form class="shadow p-3" 
    	      action="req/post-create.php" 
    	      method="post"
    	      enctype="multipart/form-data">
		  
		  <!-- Input field for post title -->
		  <div class="mb-3">
		    <label class="form-label">Title</label>
		    <input type="text" 
		           class="form-control"
		           name="title">
		  </div>

		  <!-- Input field for post cover image -->
		  <div class="mb-3">
		    <label class="form-label">Cover Image</label>
		    <input type="file" 
		           class="form-control"
		           name="cover">
		  </div>

		  <!-- Textarea for the post content -->
		  <div class="mb-3">
		    <label class="form-label">Text</label>
		    <textarea
		           class="form-control text"
		           name="text"></textarea>
		  </div>

		  <!-- Dropdown for selecting post category -->
		  <div class="mb-3">
		    <label class="form-label">Category</label>
		    <select name="category" class="form-control">
		    	<!-- Loop through all categories and display them as options -->
		    	<?php foreach ($categories as $category) { ?>
		    	<option value="<?=$category['id']?>"><?=$category['category']?></option>
		        <?php } ?>
		    </select>
		  </div>

		  <!-- Submit button to create the post -->
		  <button type="submit" class="btn btn-primary">Create</button>
		</form>
	</div>

	<!-- Script to highlight the "Create Post" navigation link as active -->
	<script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(1).classList.add("active");

        // Initialize rich text editor for the text area
        $(document).ready(function() {
            $('.text').richText();
        });
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

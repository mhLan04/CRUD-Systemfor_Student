<?php 
// Start the session to check if the user is logged in as an admin
session_start();

// Check if the admin is logged in and if the 'id' parameter is passed in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['id']) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Category Edit</title>
	<!-- Include external CSS and Bootstrap for styling -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      // Initialize variables and include necessary files
      $key = "hhdsfs1263z"; // This key seems unused in the current code
      $id = $_GET['id']; // Get the category ID from the URL query parameter
      include "inc/side-nav.php"; // Include the sidebar navigation
      include_once("data/Category.php"); // Include the file for category functions
      include_once("../db_conn.php"); // Include the database connection

      // Fetch category details by ID from the database
      $categoryx = getById($conn, $id);

      // Check if the 'category' parameter is passed in the URL
      // If passed, use it; otherwise, use the existing category name from the database
      if (isset($_GET['category'])) {
      	$category = $_GET['category']; // Use the category value from the URL
      } else {
      	$category = $categoryx['category']; // Use the category from the database
      	$category_id = $categoryx['id']; // Store the category ID
      }
	?>
               
	<!-- Main content section for category editing -->
	 <div class="main-table">
	 	<h3 class="mb-3">Edit Category
	 		<a href="Category.php" class="btn btn-success">Category</a></h3>
	 	
        <!-- Display any error or success messages -->
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?> <!-- Display the error message -->
		</div>
	    <?php } ?>

        <?php if (isset($_GET['success'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?> <!-- Display the success message -->
		</div>
	    <?php } ?>
        
        <!-- Form for editing category -->
        <form class="shadow p-3" 
    	      action="req/Category-edit.php"  <!-- Form action to handle category update -->
    	      method="post">

		  <!-- Category input field -->
		  <div class="mb-3">
		    <label class="form-label">Category</label>
		    <input type="text" 
		           class="form-control"
		           name="category"  <!-- Input for category name -->
		           value="<?=$category?>">  <!-- Pre-fill with current category name -->
		    <input type="text" 
		           class="form-control"
		           name="id"
		           value="<?=$category_id?>"  <!-- Hidden input for category ID -->
		           hidden>
		  </div>
		  
		  <!-- Submit button to save changes -->
		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
	 	
	 </div>

	<!-- Sidebar navigation active highlight -->
	<script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(2).classList.add("active");  // Highlight the active link in the sidebar
	 </script>

    <!-- Include Bootstrap JS for functionality -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php 
// If the user is not logged in as an admin, redirect to the login page
} else {
	header("Location: ../admin-login.php");
	exit;
} 
?>

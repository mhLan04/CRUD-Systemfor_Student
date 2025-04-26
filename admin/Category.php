<?php 
// Start the session to check if the user is logged in as an admin
session_start();

// Check if the admin is logged in
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Category</title>
	<!-- Include external CSS and Bootstrap for styling -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";  // This key seems unused in the current code
      include "inc/side-nav.php";  // Include the sidebar navigation
      include_once("data/Category.php");  // Include the file for category functions
      include_once("../db_conn.php");  // Include the database connection

      // Fetch all categories from the database
      $categories = getAll($conn);
	?>
                <!-- Main content section for displaying categories -->
	 <div class="main-table">
	 	<h3 class="mb-3">All Categories 
	 		<a href="Category-add.php" class="btn btn-success">Add New</a></h3>
	 	
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

	 	<!-- If categories exist, display them in a table -->
	 	<?php if ($categories != 0) { ?>
	 	<table class="table t1 table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Category</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($categories as $category) { ?>
		    <tr>
		      <th scope="row"><?=$category['id'] ?></th>
		      <td><?=$category['category'] ?></td>
		      <td>
		      	<a href="category-delete.php?id=<?=$category['id'] ?>" class="btn btn-danger">Delete</a> <!-- Link to delete category -->
		      	<a href="category-edit.php?id=<?=$category['id'] ?>" class="btn btn-warning">Edit</a> <!-- Link to edit category -->
		      </td>
		    </tr>
		    <?php } ?>
		 </tbody>
		</table>
	<?php } else { ?>
		<!-- If no categories exist, show an "Empty" message -->
		<div class="alert alert-warning">
			Empty!
		</div>
	<?php } ?>
	 </div>
	</section>
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

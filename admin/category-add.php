<?php 
// Start the session to track user login status
session_start();

// Check if the user is an authenticated admin
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Category</title>
	<!-- Including FontAwesome for icons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Including Bootstrap CSS for styling -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!-- Including custom sidebar and main style CSS -->
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      // Key for some internal processing or security measure
	  $key = "hhdsfs1263z";
	  // Include the sidebar navigation
	  include "inc/side-nav.php"; 
	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Create New Category
	 		<!-- Link to the existing Category page -->
	 		<a href="Category.php" class="btn btn-success">Category</a></h3>

	 	<!-- Display error message if there is any -->
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
	    <?php } ?>

        <!-- Display success message if there is any -->
        <?php if (isset($_GET['success'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
	    <?php } ?>

        <!-- Category creation form -->
        <form class="shadow p-3" 
    	      action="req/Category-create.php"
    	      method="post">

		  <!-- Category name input field -->
		  <div class="mb-3">
		    <label class="form-label">Category</label>
		    <input type="text" 
		           class="form-control"
		           name="category">
		  </div>
		  
		  <!-- Submit button to create the category -->
		  <button type="submit" class="btn btn-primary">Create</button>
		</form>
	 	
	 </div>
	</section>
	</div>

	 <!-- JavaScript to set the active link in the sidebar -->
	 <script>
	 	var navList = document.getElementById('navList').children;
	 	// Mark the 3rd item (Category) as active in the sidebar navigation
	 	navList.item(2).classList.add("active");
	 </script>

     <!-- Including Bootstrap JS for functionality -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php 
} else {
    // If user is not logged in as admin, redirect to the login page
    header("Location: ../admin-login.php");
    exit;
} 
?>

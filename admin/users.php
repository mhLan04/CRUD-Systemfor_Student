<?php 
session_start();  // Start the session to check if the user is logged in as admin

// Check if the admin session exists
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Users</title>
	<!-- Load Font Awesome for icons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Load Bootstrap CSS for styling -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!-- Custom CSS for sidebar and general styling -->
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";  // Encryption key for potential security purposes
	  include "inc/side-nav.php";  // Include the sidebar navigation
      include_once("data/User.php");  // Include User data handler
      include_once("../db_conn.php");  // Include database connection
      $users = getAll($conn);  // Fetch all users from the database

	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">All Users 
	 		<!-- Button to add a new user -->
	 		<a href="../signup.php" class="btn btn-success">Add New</a></h3>
	 	
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<!-- Display error message if exists -->
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
	    <?php } ?>

        <?php if (isset($_GET['success'])) { ?>	
	 	<!-- Display success message if exists -->
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
	    <?php } ?>

	 	<?php if ($users != 0) { ?>
	 	<!-- If there are users, display them in a table -->
	 	<table class="table t1 table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Full Name</th>
		      <th scope="col">username</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($users as $user) { ?>
		    <tr>
		      <th scope="row"><?=$user['user_id'] ?></th>
		      <td><?=$user['fname'] ?></td>
		      <td><?=$user['username'] ?></td>
		      <td>
		      	<!-- Link to delete user -->
		      	<a href="user-delete.php?user_id=<?=$user['user_id'] ?>" class="btn btn-danger">Delete</a>
		      </td>
		    </tr>
		    <?php } ?>
		 </tbody>
		</table>
	<?php } else { ?>
		<!-- If no users, display empty message -->
		<div class="alert alert-warning">
			Empty!
		</div>
	<?php } ?>
	 </div>
	</section>
	</div>

	<!-- Set the first navigation item to active -->
	<script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(0).classList.add("active");
	 </script>
     <!-- Load Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php } else {
	// If no admin session, redirect to admin login page
	header("Location: ../admin-login.php");
	exit;
} ?>

<?php 
session_start();  // Start the session to check if the admin is logged in

// Check if the admin is logged in and the session variables are set
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Users</title>
	<!-- Include necessary CSS files for the page -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";  // Random key (for security purposes, possibly not used here directly)
	  include "inc/side-nav.php";  // Include the side navigation
      include_once("data/Admin.php");  // Include the admin class file
      include_once("../db_conn.php");  // Include the database connection file
      $admin = getByID($conn, $_SESSION['admin_id']);  // Fetch admin data from the database using session admin_id
	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Admin Profile </h3>
	 	<!-- Display any error message if present -->
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
	    <?php } ?>

        <!-- Display any success message if present -->
        <?php if (isset($_GET['success'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
	    <?php } ?>

        <!-- Form to change admin profile information -->
        <form class="shadow p-3" 
    	      action="req/admin-edit.php"
    	      method="post">
          <h3>Change Profile Info</h3>
		  <!-- Form field for First name -->
		  <div class="mb-3">
		    <label class="form-label">First name</label>
		    <input type="text" 
		           class="form-control"
		           name="fname"
		           value="<?=$admin['first_name']?>">  <!-- Pre-fill with admin's first name -->
		  </div>

		  <!-- Form field for Last name -->
		  <div class="mb-3">
		    <label class="form-label">Last name</label>
		    <input type="text" 
		           class="form-control"
		           name="lname"
		           value="<?=$admin['last_name']?>">  <!-- Pre-fill with admin's last name -->
		  </div>

		  <!-- Form field for Username -->
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" 
		           class="form-control"
		           name="username"
		           value="<?=$admin['username']?>">  <!-- Pre-fill with admin's username -->
		  </div>

		  <!-- Submit button for profile update -->
		  <button type="submit" class="btn btn-primary">Change</button>
		</form>

		<!-- Form to change admin password -->
		<form class="shadow p-3 mt-5" 
    	      action="req/admin-edit-pass.php"
    	      method="post">
          <h3 id="cpassword">Change password</h3>

          <!-- Display any password-related error or success messages -->
          <?php if (isset($_GET['perror'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['perror'])?>
		</div>
	    <?php } ?>

        <?php if (isset($_GET['psuccess'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['psuccess'])?>
		</div>
	    <?php } ?>

		  <!-- Form field for current password -->
		  <div class="mb-3">
		    <label class="form-label">Current Password</label>
		    <input type="password" 
		           class="form-control"
		           name="cpass">
		  </div>

		  <!-- Form field for new password -->
		  <div class="mb-3">
		    <label class="form-label">New password</label>
		    <input type="password" 
		           class="form-control"
		           name="new_pass">
		  </div>

		  <!-- Form field for confirm new password -->
		  <div class="mb-3">
		    <label class="form-label">Confirm password</label>
		    <input type="password" 
		           class="form-control"
		           name="cnew_pass">
		  </div>

		  <!-- Submit button for password update -->
		  <button type="submit" class="btn btn-primary">Change password</button>
		</form>
	 	
	 </div>
	</section>
	</div>

    <!-- Include Bootstrap JS file for any frontend functionalities -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php } else {
	// If admin is not logged in, redirect to login page
	header("Location: ../admin-login.php"); 
	exit; 
} ?>

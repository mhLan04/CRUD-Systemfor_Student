<?php 
// Start the session to access session variables
session_start();

// Check if the admin session is active (i.e., 'admin_id' and 'username' are set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    // Check if the necessary POST data is set for updating profile information
    if(isset($_POST['fname']) && 
       isset($_POST['lname']) &&
       isset($_POST['username'])){

      // Include the database connection file
      include "../../db_conn.php";

      // Retrieve the form data
      $fname = $_POST['fname'];  // First name entered by the admin
      $lname = $_POST['lname'];  // Last name entered by the admin
      $username = $_POST['username'];  // Username entered by the admin
      $id = $_SESSION['admin_id'];  // Admin ID from the session

      // Validate the input fields to ensure none of them are empty
      if(empty($fname)){
         $em = "First name is required"; 
         header("Location: ../profile.php?error=$em");  // Redirect with error message
         exit;
      }else if(empty($lname)){
         $em = "Last name is required"; 
         header("Location: ../profile.php?error=$em");  // Redirect with error message
         exit;
      }else if(empty($username)){
         $em = "Username is required"; 
         header("Location: ../profile.php?error=$em");  // Redirect with error message
         exit;
      }
    
      // Prepare and execute the SQL query to update the admin's profile information
      $sql = "UPDATE admin SET first_name=?, last_name=?, username=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$fname, $lname, $username, $id]);
    
      // Check if the update was successful
      if ($res) {
        // If successful, update the session with the new username
        $_SESSION['username'] = $username;
        $sm = "Successfully edited!";  // Success message
        header("Location: ../profile.php?success=$sm");  // Redirect with success message
        exit;
      }else {
        // If an error occurs, show an unknown error message
        $em = "Unknown error occurred"; 
        header("Location: ../profile.php?error=$em");  // Redirect with error message
        exit;
      }

    // If form data is not set, redirect back to the profile page
    }else {
        header("Location: ../profile.php");
        exit;
    }

// If the admin session is not active, redirect to the login page
}else {
    header("Location: ../admin-login.php");
    exit;
}  

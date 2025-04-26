<?php 
// Start the session
session_start();

// Check if the admin session is active
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    // Check if the form data for changing the password is set
    if(isset($_POST['cpass']) && 
       isset($_POST['new_pass']) &&
       isset($_POST['cnew_pass'])){

      // Include the database connection file
      include "../../db_conn.php";

      // Retrieve form data
      $cpass = $_POST['cpass'];  // Current password entered by the user
      $new_pass = $_POST['new_pass'];  // New password entered by the user
      $cnew_pass = $_POST['cnew_pass'];  // Confirm new password entered by the user
      $id = $_SESSION['admin_id'];  // Admin ID from the session

      // Validate the input fields
      if(empty($cpass)){
         $em = "Current Password is required"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if(empty($new_pass)){
         $em = "New Password is required"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if(empty($cnew_pass)){
         $em = "Confirm Password is required"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if($cnew_pass != $new_pass){
         // If new password and confirm password don't match
         $em = "New password and confirm password doesn't match"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }

      // Query to fetch the current password from the database
      $sql = "SELECT password FROM admin WHERE id=?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$id]);

       $data = $stmt->fetch();

      // Verify the current password
      if(!password_verify($cpass, $data['password'])){
         $em = "Incorrect password"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else {
        // Hash the new password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        // Update the password in the database
         $sql = "UPDATE admin SET password=?";
          $stmt = $conn->prepare($sql);
          $res = $stmt->execute([$new_pass]);

         // Check if the password update was successful
         if ($res) {
              $sm = "The Password Successfully changed!"; 
              header("Location: ../profile.php?psuccess=$sm#cpassword");
              exit;
          }else {
            $em = "Unknown error occurred"; 
            header("Location: ../profile.php?perror=$em#cpassword");
            exit;
          }

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

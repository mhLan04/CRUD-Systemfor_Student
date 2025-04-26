<?php 
session_start();  // Start the session to check if the user is logged in as admin

// Check if the admin session exists and the user_id is passed in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['user_id']) {

  // Get the user_id from the URL parameter
  $user_id = $_GET['user_id'];

  // Include necessary files for database connection and User class
  include_once("data/User.php");
  include_once("../db_conn.php");

  // Call the deleteById function to delete the user by their ID
  $res = deleteById($conn, $user_id);

  // If the deletion is successful, redirect with a success message
  if ($res) {
      $sm = "Successfully deleted!"; 
      header("Location: users.php?success=$sm");
      exit;
  } else {
    // If an error occurs, redirect with an error message
    $em = "Unknown error occurred"; 
    header("Location: users.php?error=$em");
    exit;
  }

} else {
    // If the session doesn't exist or user_id is not passed, redirect to the admin login page
    header("Location: ../admin-login.php");
    exit;
}

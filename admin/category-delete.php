<?php 
// Start the session to track the user's login state
session_start();

// Check if the user is logged in as an admin and if the 'id' parameter is passed in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['id']) {

  // Get the category ID from the URL query parameter
  $id = $_GET['id'];

  // Include necessary files for database connection and category data handling
  include_once("data/Category.php");
  include_once("../db_conn.php");

  // Call the deleteById function to delete the category with the given ID
  $res = deleteById($conn, $id);

  // Check if the deletion was successful
  if ($res) {
      // If successful, show success message and redirect to the Category page
      $sm = "Successfully deleted!"; 
      header("Location: Category.php?success=$sm");
      exit;
  } else {
    // If there was an error during the deletion, show error message
    $em = "Unknown error occurred"; 
    header("Location: Category.php?error=$em");
    exit;
  }

} else {
    // If the user is not logged in as an admin, redirect to the login page
    header("Location: ../admin-login.php");
    exit;
} 
?>

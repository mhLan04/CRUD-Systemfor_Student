<?php 
// Start a new session or resume the existing session
session_start();

// Check if the user is logged in as an admin and if the 'comment_id' is provided in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['comment_id']) {

  // Retrieve the 'comment_id' from the URL
  $id = $_GET['comment_id'];

  // Include the necessary files for handling the comment and database connection
  include_once("data/Comment.php");
  include_once("../db_conn.php");

  // Call the function to delete the comment by its ID from the database
  $res = deleteCommentById($conn, $id);

  // Check if the deletion was successful
  if ($res) {
      // Set a success message and redirect to the comment page with success message
      $sm = "Successfully deleted!"; 
      header("Location: Comment.php?success=$sm");
      exit;
  } else {
    // Set an error message and redirect to the comment page with error message
    $em = "Unknown error occurred"; 
    header("Location: Comment.php?error=$em");
    exit;
  }

} else {
    // If the user is not logged in as admin, redirect to the login page
    header("Location: ../admin-login.php");
    exit;
}
?>

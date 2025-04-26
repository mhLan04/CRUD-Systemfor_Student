<?php 
// Start the session or resume the existing session
session_start();

// Check if the user is logged in as an admin (both admin_id and username should be set), and a valid post_id is provided in the URL
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['post_id']) {

  // Retrieve the post_id from the URL query string
  $post_id = $_GET['post_id'];

  // Include necessary files for handling post, comments, and database connection
  include_once("data/Post.php");
  include_once("data/Comment.php");
  include_once("../db_conn.php");

  // Call the function to delete the post by its ID
  $res = deleteById($conn, $post_id);
  
  // Call the function to delete comments associated with the post
  $res2 = deleteCommentByPostId($conn, $post_id);
  
  // Call the function to delete likes associated with the post
  $res3 = deleteLikeByPostId($conn, $post_id);

  // If the post is successfully deleted, redirect to the post page with a success message
  if ($res) {
      $sm = "Successfully deleted!"; 
      header("Location: post.php?success=$sm");
      exit;
  } else {
    // If an error occurred, redirect to the post page with an error message
    $em = "Unknown error occurred"; 
    header("Location: post.php?error=$em");
    exit;
  }

} else {
    // If the user is not logged in as admin or post_id is not provided, redirect to the admin login page
    header("Location: ../admin-login.php");
    exit;
}

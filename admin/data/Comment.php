<?php 

// Function: Get all comments from the 'comment' table
// Parameters:
//   $conn - the database connection object (PDO)
function getAllComment($conn){
   // SQL query to fetch all comments
   $sql = "SELECT * FROM comment";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   // If there are results, return the comments as an array
   if($stmt->rowCount() >= 1){
       $data = $stmt->fetchAll();
       return $data;
   } else {
       return 0; // If no comments, return 0
   }
}

// Function: Get a comment by its ID
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the comment to fetch
function getCommentById($conn, $id){
   // SQL query to fetch comment by its ID
   $sql = "SELECT * FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   // If a comment is found, return its data
   if($stmt->rowCount() >= 1){
         $data = $stmt->fetch();
         return $data;
   } else {
       return 0; // If comment is not found, return 0
   }
}

// Function: Count the number of comments for a specific post by post_id
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the post_id to count comments for
function CountByPostID($conn, $id){
   // SQL query to count comments for a specific post_id
   $sql = "SELECT * FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   // Return the count of comments
   return $stmt->rowCount();
}

// Function: Count the number of likes for a specific post by post_id
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the post_id to count likes for
function likeCountByPostID($conn, $id){
   // SQL query to count likes for a specific post_id
   $sql = "SELECT * FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   // Return the count of likes
   return $stmt->rowCount();
}

// Function: Check if a user has liked a specific post
// Parameters:
//   $conn    - the database connection object (PDO)
//   $post_id - the ID of the post
//   $user_id - the ID of the user
function isLikedByUserID($conn, $post_id, $user_id){
   // SQL query to check if the user has liked the post
   $sql = "SELECT * FROM post_like WHERE post_id=? AND liked_by=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$post_id, $user_id]);

   // If the user has liked the post, return 1, else return 0
   if ($stmt->rowCount() > 0) {
      return 1; // Liked
   } else {
      return 0; // Not liked
   }
}

// Function: Get all comments for a specific post ordered by comment_id in descending order
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the post_id to fetch comments for
function getCommentsByPostID($conn, $id){
   // SQL query to fetch comments for a specific post ordered by comment_id descending
   $sql = "SELECT * FROM comment WHERE post_id=? ORDER BY comment_id desc";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   // If there are comments, return them as an array
   if($stmt->rowCount() >= 1){
      $data = $stmt->fetchAll();
      return $data;
   } else {
       return 0; // If no comments, return 0
   }
}

// Function: Delete a comment by its ID
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the comment to delete
function deleteCommentById($conn, $id){
   // SQL query to delete a comment by its comment_id
   $sql = "DELETE FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   // Return 1 if deletion is successful, 0 if it fails
   if($res){
       return 1; // Success
   } else {
       return 0; // Failure
   }
}

// Function: Delete all comments for a specific post by post_id
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the post_id to delete all comments for
function deleteCommentByPostId($conn, $id){
   // SQL query to delete all comments for a specific post_id
   $sql = "DELETE FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   // Return 1 if deletion is successful, 0 if it fails
   if($res){
         return 1; // Success
   } else {
       return 0; // Failure
   }
}

// Function: Delete all likes for a specific post by post_id
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the post_id to delete all likes for
function deleteLikeByPostId($conn, $id){
   // SQL query to delete all likes for a specific post_id
   $sql = "DELETE FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   // Return 1 if deletion is successful, 0 if it fails
   if($res){
         return 1; // Success
   } else {
       return 0; // Failure
   }
}
?>

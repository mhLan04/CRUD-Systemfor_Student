<?php 

// Function: Get admin information by ID
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the admin to fetch
function getByID($conn, $id){
   // SQL query to fetch admin information by ID, selecting only essential columns
   $sql = "SELECT id, first_name, last_name, username FROM admin WHERE id=?";

   // Prepare the query
   $stmt = $conn->prepare($sql);

   // Execute the query with the provided $id as the parameter
   $stmt->execute([$id]);

   // If at least one result is returned (i.e., admin found)
   if($stmt->rowCount() >= 1){
         // Fetch the first result (since ID is unique)
         $data = $stmt->fetch();

         // Return the admin data
         return $data;
   }else {
       // If no admin found with the given ID, return 0
       return 0;
   }
}
?>

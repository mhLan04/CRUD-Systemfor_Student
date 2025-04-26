<?php 

// Function: Get all categories from the 'category' table
// Parameters:
//   $conn - the database connection object (PDO)
function getAll($conn){
   // SQL query to fetch all categories
   $sql = "SELECT * FROM category";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   // If there are any results, return all the data as an array
   if($stmt->rowCount() >= 1){
       $data = $stmt->fetchAll();
       return $data;
   } else {
       // If no categories found, return 0
       return 0;
   }
}

// Function: Get category information by ID
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the category to fetch
function getById($conn, $id){
   // SQL query to fetch category by its ID
   $sql = "SELECT * FROM category WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   // If category found, return the data
   if($stmt->rowCount() >= 1){
         $data = $stmt->fetch();
         return $data;
   } else {
       // If no category found, return 0
       return 0;
   }
}

// Function: Delete category by ID
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the category to delete
function deleteById($conn, $id){
   // SQL query to delete a category by its ID
   $sql = "DELETE FROM category WHERE id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   // Return 1 if deletion is successful, 0 if failed
   if($res){
       return 1;
   } else {
       return 0;
   }
}
?>

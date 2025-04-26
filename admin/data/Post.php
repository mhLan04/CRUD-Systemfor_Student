<?php

// Get all published posts
function getAll($conn)
{
    $sql = "SELECT * FROM post 
            WHERE publish=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // If posts are found, return data as an array, else return 0
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0; // No posts found
    }
}

// Get all posts with category information (For Admin)
function getAllDeep($conn)
{
    $sql = "SELECT post.*, category.category 
            FROM post 
            LEFT JOIN category 
            ON post.category = category.id 
            ORDER BY post.post_id DESC";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Return all posts with category information if found, else return 0
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return 0; // No posts found
    }
}

// Get all posts by a specific category and that are published
function getAllPostsByCategory($conn, $category_id)
{
    $sql = "SELECT * FROM post WHERE category=? AND publish=1";
    $stmt = $conn->prepare($sql);
    
    // Pass category_id as a parameter
    $stmt->execute([$category_id]);

    // If posts are found, return data as an array, else return 0
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0; // No posts found
    }
}

// Get a specific post by its ID, only if it's published
function getById($conn, $id)
{
    $sql = "SELECT * FROM post 
            WHERE post_id=? AND publish=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // If the post is found, return the data, else return 0
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetch();
        return $data;
    } else {
        return 0; // Post not found
    }
}

// Get a specific post by its ID (For Admin)
function getByIdDeep($conn, $id)
{
    $sql = "SELECT * FROM post WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);  // Đảm bảo ràng buộc đúng kiểu dữ liệu
    $stmt->execute();

    // Kiểm tra số dòng trả về
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);  // Trả về mảng kết quả
        return $data;
    } else {
        return 0; // Nếu không tìm thấy bài viết
    }
}



// Search for posts by keywords in title or content
function search($conn, $key) {
    if (!$conn) {
        die("Database connection failed: \$conn is null");
    }
    $key = "%{$key}%"; // Format the keyword for LIKE query
    $sql = "SELECT * FROM post 
            WHERE publish=1 AND (post_title LIKE ? 
            OR post_text LIKE ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key]);

    // If posts are found based on search, return the data
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0; // No posts found
    }
}

// Get category information by category ID
function getCategoryById($conn, $id)
{
    $sql = "SELECT * FROM category WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // If category is found, return the data, else return null
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetch();
    } else {
        return null; // Category not found
    }
}

// Get the first 5 categories
function get5Categories($conn)
{
    $sql = "SELECT * FROM category LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // If categories are found, return the data, else return 0
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return []; // No categories found
    }
}

// Get user information by user ID
function getUserByID($conn, $user_id)
{
    $sql = "SELECT user_id, fname, username FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);

    // If user is found, return the data, else return 0
    if ($stmt->rowCount() == 1) { 
        $data = $stmt->fetch();  
        return $data;
    } else {
        return 0; // User not found
    }
}

// Get all categories ordered by name
function getAllCategories($conn)
{
    $sql = "SELECT * FROM category ORDER BY category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // If categories are found, return the data, else return 0
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0; // No categories found
    }
}

// Delete a post by post_id
function deleteById($conn, $id)
{
    $sql = "DELETE FROM post WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    // Return 1 if the post was successfully deleted, else return 0
    if ($res) {
        return 1; // Successfully deleted
    } else {
        return 0; // Deletion failed
    }
}
?>

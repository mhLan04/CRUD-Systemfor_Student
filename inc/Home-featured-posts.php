<?php
// Featured Posts Section - Load from Database
include "db_conn.php";
include_once("admin/data/Post.php");

// Lấy danh sách bài viết mới nhất (giới hạn 9 bài)
$featuredPosts = getLatestPosts($conn, 9);
?>

<section class="py-5 bg-light">
  <div class="container" style="background-color: #f5f6f8;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold mb-0">Featured Blog Posts</h2>
      <a href="blog.php" class="btn btn-outline-primary btn-sm">View all posts</a>
    </div>

    <div class="row g-4">
      <?php foreach ($featuredPosts as $post): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm transition-hover">
            <?php if (!empty($post['cover_url'])): ?>
              <img src="upload/blog/<?= htmlspecialchars($post['cover_url']) ?>" class="card-img-top" style="height:220px; object-fit:cover;" alt="Post Cover">
            <?php else: ?>
              <img src="upload/blog/default.jpg" class="card-img-top" style="height:220px; object-fit:cover;" alt="Default Image">
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold mb-2" style="min-height:60px;">
                <a href="blog-view.php?id=<?= $post['post_id'] ?>" class="text-dark text-decoration-none"><?= htmlspecialchars($post['post_title']) ?></a>
              </h5>
              <p class="card-text small text-muted mb-4" style="height:80px; overflow:hidden;">
                <?= htmlspecialchars(mb_substr(strip_tags($post['post_text']), 0, 120)) ?>...
              </p>
              <div class="mt-auto d-flex align-items-center">
                <img src="upload/img-users/2.jpg" alt="User" width="30" height="30" class="rounded-circle me-2">
                <div>
                  <small class="fw-semibold"><?= htmlspecialchars($post['author_name'] ?? 'Unknown') ?></small><br>
                  <small class="text-muted"><?= date('d M Y', strtotime($post['created_at'])) ?></small>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
      <button class="btn btn-outline-primary btn-sm">Loading more...</button>
    </div>
  </div>
</section>

<style>
  /* Hover nhẹ nhàng cho từng card */
  .transition-hover {
    transition: all 0.3s ease;
  }

  .transition-hover:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }
</style>

<?php
// Hàm lấy bài mới nhất
function getLatestPosts($conn, $limit = 9) {
    $limit = (int)$limit;

    $sql = "
        SELECT 
            p.*, 
            COALESCE(u.username, a.username) AS author_name
        FROM post p
        LEFT JOIN users u ON p.user_id = u.user_id
        LEFT JOIN admin a ON p.user_id = a.id
        ORDER BY p.created_at DESC
        LIMIT $limit
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

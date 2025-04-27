<?php
session_start();
include "db_conn.php";
include "auto-login.php";

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}

$notFound = 0;

include_once("admin/data/Post.php");
include_once("admin/data/Comment.php");

if (isset($_GET['search'])) {
	$key = $_GET['search'];
	$posts = search($conn, $key);
	if ($posts == 0) {
		$notFound = 1;
	}
} else {
	$posts = getAll($conn);
}
$categories = get5Categories($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php
		if (isset($_GET['search'])) {
			echo "Search '" . htmlspecialchars($_GET['search']) . "'";
		} else {
			echo "Blog Page";
		} ?>
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

	<?php include 'inc/NavBar.php'; ?>
	<!-- Hero Section -->
    <section class="hero-section">
        <div class="text-center">
            <h1>BLOG</h1>
            <p class="lead">DISCOVER COURSES THAT INSPIRE YOU</p>
        </div>
    </section>

	<div class="container mt-5">
		<div class="row g-4 align-items-stretch"> <!-- Dùng row để chia layout 2 phần -->
			<?php if ($posts != 0) { ?>
				<main class="col-md-8">
					<h1 class="mb-4 fs-3">
						<?php if (isset($_GET['search'])) {
							echo "Search <b>'" . htmlspecialchars($_GET['search']) . "'</b>";
						} ?>
					</h1>

					<?php foreach ($posts as $post) { ?>
						<div class="card main-blog-card mb-4">
							<img src="upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="<?= htmlspecialchars($post['post_title']) ?>">
							<div class="card-body">
								<h5 class="card-title"><?= $post['post_title'] ?></h5>
								<?php
								$p = strip_tags($post['post_text']);
								$p = substr($p, 0, 200);
								?>
								<p class="card-text"><?= $p ?>...</p>
								<a href="blog-view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary btn-readmore">Read more</a>
								<hr>
								<div class="d-flex justify-content-between">
									<div class="react-btns">
										<?php
										$post_id = $post['post_id'];
										if ($logged) {
											$liked = isLikedByUserID($conn, $post_id, $user_id);

											if ($liked) { ?>
												<i class="fa fa-thumbs-up liked like-btn"
													post-id="<?= $post_id ?>"
													liked="1"
													aria-hidden="true"></i>
											<?php } else { ?>
												<i class="fa fa-thumbs-up like like-btn"
													post-id="<?= $post_id ?>"
													liked="0"
													aria-hidden="true"></i>
											<?php }
										} else { ?>
											<i class="fa fa-thumbs-up" aria-hidden="true"></i>
										<?php } ?>
										Likes (<span><?php echo likeCountByPostID($conn, $post['post_id']); ?></span>)
										<a href="blog-view.php?post_id=<?= $post['post_id'] ?>#comments">
											<i class="fa fa-comment" aria-hidden="true"></i> Comments (
											<?php echo CountByPostID($conn, $post['post_id']); ?> )
										</a>
									</div>
									<small class="text-body-secondary"><?= $post['created_at'] ?></small>
								</div>
							</div>
						</div>
					<?php } ?>
				</main>
			<?php } else { ?>
				<main class="col-md-8">
					<?php if ($notFound) { ?>
						<div class="alert alert-warning">
							No search results found - <b><?= htmlspecialchars($_GET['search']) ?></b>
						</div>
					<?php } else { ?>
						<div class="alert alert-warning">
							No posts yet.
						</div>
					<?php } ?>
				</main>
			<?php } ?>

			<aside class="col-md-4">
				<div class="list-group category-aside">
					<a href="#" class="list-group-item list-group-item-action active">
						Category
					</a>

					<?php if (is_array($categories) && count($categories) > 0): ?>
						<?php foreach ($categories as $category) { ?>
							<a href="category.php?category_id=<?= htmlspecialchars($category['id']) ?>"
								class="list-group-item list-group-item-action">
								<?= htmlspecialchars($category['category']) ?>
							</a>
						<?php } ?>
					<?php else: ?>
						<div class="p-3 text-muted">No categories found.</div>
					<?php endif; ?>

				</div>
			</aside>
		</div>

		<?php include 'footer.php'; ?>
	</div>


	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
		$(document).ready(function() {
			$(".like-btn").click(function() {
				var post_id = $(this).attr('post-id');
				var liked = $(this).attr('liked');

				if (liked == 1) {
					$(this).attr('liked', '0');
					$(this).removeClass('liked');
				} else {
					$(this).attr('liked', '1');
					$(this).addClass('liked');
				}
				$(this).next().load("ajax/like-unlike.php", {
					post_id: post_id
				});
			});
		});

		toastr.options = {
			"closeButton": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"timeOut": "3000",
			"extendedTimeOut": "1000"
		};

		<?php if (isset($_GET['success'])): ?>
			toastr.success("<?= htmlspecialchars($_GET['success']) ?>");
		<?php endif; ?>
	</script>

</body>

</html>
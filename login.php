<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
	<form class="shadow w-450 p-3" action="php/login.php" method="post">
		<h4 class="display-4 fs-1">LOGIN</h4><br>

		<div class="mb-3">
			<label class="form-label">Username</label>
			<input type="text" class="form-control" name="uname"
			       value="<?= isset($_COOKIE['remember_username']) ? htmlspecialchars($_COOKIE['remember_username']) : (isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '') ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Password</label>
			<input type="password" class="form-control" name="pass">
		</div>

		<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" name="remember" id="remember"
			<?= isset($_COOKIE['remember_username']) ? 'checked' : '' ?>>
			<label class="form-check-label" for="remember">Remember me</label>
		</div>

		<button type="submit" class="btn btn-primary w-100">Login</button>

		<br><br>

		<div class="text-center">
			<a href="admin-login.php" class="link-secondary">Admin Login</a> &nbsp;
			<a href="blog.php" class="link-secondary">Blog</a> &nbsp;
			<a href="signup.php" class="link-secondary">Sign Up</a>
		</div>
	</form>
</div>

<!-- Toastr popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Cấu hình toastr
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

// Hiển thị toastr theo GET parameters
<?php if (isset($_GET['error'])): ?>
    toastr.error("<?= htmlspecialchars($_GET['error']) ?>");
<?php elseif (isset($_GET['success'])): ?>
    toastr.success("<?= htmlspecialchars($_GET['success']) ?>");
<?php endif; ?>
</script>

</body>
</html>

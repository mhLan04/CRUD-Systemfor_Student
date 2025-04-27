<!-- Navbar with dynamic Login/Profile -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container-fluid">
    <!-- Logo bên trái -->
    <a class="navbar-brand fw-bold text-uppercase" href="index.php">
      MY <span class="text-primary">BLOG</span>
    </a>

    <!-- Nút toggle cho mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu căn giữa -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
      <ul class="navbar-nav gap-4">
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="classes.php">Classes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="teachers.php">Teachers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-uppercase" href="contact.php">Contact Us</a>
        </li>
      </ul>
    </div>

    <!-- Search + Login/Profile bên phải -->
    <div class="d-flex align-items-center gap-2 ms-auto me-3">
      <form class="d-flex" method="GET" action="blog.php">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success fw-bold text-uppercase" type="submit">Search</button>
      </form>

      <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
      <!-- Nếu đã đăng nhập -->
      <div class="dropdown">
        <a class="btn btn-outline-success fw-bold text-uppercase dropdown-toggle" href="#" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-user"></i> <?= htmlspecialchars($_SESSION['username']) ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownProfile">
          <li><a class="dropdown-item" href="users-profile.php">View Profile</a></li>
          <li><a class="dropdown-item" href="users-manage-posts.php">Manage Posts</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </div>
      <?php else: ?>
      <!-- Nếu chưa đăng nhập -->
      <a href="login.php" class="btn btn-outline-success fw-bold text-uppercase">Login/Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <!-- Link to homepage or blog with styled brand name -->
    <a class="navbar-brand" href="blog.php">
      <b>My<span style="color: #0088FF;">Blog</span></b>
    </a>

    <!-- Button to toggle the navbar on smaller screens -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content with links to various sections -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Home link -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        
        <!-- Blog link -->
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        
        <!-- Category link -->
        <li class="nav-item">
          <a class="nav-link" href="category.php">Category</a>
        </li>

        <!-- Check if the user is logged in -->
        <?php if ($logged) { ?>
          <!-- Dropdown menu for logged-in user with username -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user" aria-hidden="true"></i> @<?=htmlspecialchars($_SESSION['username'])?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
              <!-- Profile option -->
              <li><a class="dropdown-item" href="users-profile.php">View Profile</a></li>
              <!-- Manage posts option -->
              <li><a class="dropdown-item" href="users-manage-posts.php">Manage Posts</a></li>
              <!-- Add new post option -->
              <li><a class="dropdown-item" href="users-add-posts.php">Add New Post</a></li>
              <!-- Logout option -->
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php } else { ?>
          <!-- Login/signup link for users who are not logged in -->
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login | Signup</a>
          </li>
        <?php } ?>
      </ul>

      <!-- Search form -->
      <form class="d-flex" role="search" method="GET" action="blog.php">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<?php 
   // Check if the 'key' variable is set and matches a specific value
   if (isset($key) && $key == "hhdsfs1263z") {
 ?>
<!-- Checkbox input for toggling sidebar visibility -->
<input type="checkbox" id="checkbox">

<!-- Header section -->
<header class="header">
    <h2 class="u-name">My <b>Blog</b>
        <!-- Label for the checkbox which acts as a button to toggle the navigation menu -->
        <label for="checkbox">
            <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
        </label>
    </h2>

    <!-- User profile link -->
    <div class="d-flex align-items-center main-profile-link">
        <a href="profile.php">
            <!-- User profile icon and username -->
            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
            <span>@<?php echo $_SESSION['username']; ?></span>
        </a>
    </div>
</header>

<!-- Main body section -->
<div class="body">
    <!-- Sidebar navigation -->
    <nav class="side-bar">
        <div class="user-p">
            <!-- User profile section (empty in this example) -->
        </div>

        <!-- Navigation list -->
        <ul id="navList">
            <!-- Users page link -->
            <li>
                <a href="Users.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Users</span>
                </a>
            </li>
            <!-- Post page link -->
            <li>
                <a href="Post.php">
                    <i class="fa fa-wpforms" aria-hidden="true"></i>
                    <span>Post</span>
                </a>
            </li>
            <!-- Category page link -->
            <li>
                <a href="Category.php">
                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                    <span>Category</span>
                </a>
            </li>
            <!-- Comment page link -->
            <li>
                <a href="Comment.php">
                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                    <span>Comment</span>
                </a>
            </li>
            <!-- Settings page link -->
            <li>
                <a href="setting.php">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span>Setting</span>
                </a>
            </li>
            <!-- Logout page link -->
            <li>
                <a href="../logout.php">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main content section (empty in this example) -->
    <section class="section-1">
<?php 
   } 
 ?>

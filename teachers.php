<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Teachers - MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Include Navbar -->
    <?php include 'inc/NavBar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="text-center">
            <h1>Our Teachers</h1>
            <p class="lead">Meet Our Dedicated Educators</p>
        </div>
    </section>

    <!-- Teachers Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="teacher-card w-100">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Teacher" class="teacher-avatar">
                        <h5 class="teacher-name">Emily Johnson</h5>
                        <p class="teacher-subject">English Teacher</p>
                        <p class="teacher-bio">Passionate about literature and language arts, Emily brings 10+ years of experience into her dynamic classes.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="teacher-card w-100">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Teacher" class="teacher-avatar">
                        <h5 class="teacher-name">Michael Smith</h5>
                        <p class="teacher-subject">Mathematics Teacher</p>
                        <p class="teacher-bio">Expert in calculus and applied mathematics, Michael inspires students through interactive problem solving.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="teacher-card w-100">
                        <img src="https://randomuser.me/api/portraits/women/52.jpg" alt="Teacher" class="teacher-avatar">
                        <h5 class="teacher-name">Sophia Williams</h5>
                        <p class="teacher-subject">Science Teacher</p>
                        <p class="teacher-bio">Driven by curiosity, Sophia makes physics and biology accessible and exciting for all learners.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="teacher-card w-100">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Teacher" class="teacher-avatar">
                        <h5 class="teacher-name">Daniel Brown</h5>
                        <p class="teacher-subject">Computer Science Teacher</p>
                        <p class="teacher-bio">Software engineer turned educator, Daniel builds strong coding fundamentals with practical projects.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="teacher-card w-100">
                        <img src="https://randomuser.me/api/portraits/women/79.jpg" alt="Teacher" class="teacher-avatar">
                        <h5 class="teacher-name">Olivia Davis</h5>
                        <p class="teacher-subject">Art Teacher</p>
                        <p class="teacher-bio">Encouraging creativity and self-expression, Olivia leads inspiring art workshops for students of all ages.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
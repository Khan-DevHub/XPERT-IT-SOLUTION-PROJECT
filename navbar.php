<?php
$currentPage = basename($_SERVER['PHP_SELF']);
function navActive($page, $current) {
    return $page === $current ? ' class="active"' : '';
}
?>
<nav class="navbar" id="mainNav">
    <a class="logo-brand" href="index.php" aria-label="XPERT IT SOLUTIONS home">
        <img class="logo-img" src="assets/image.png" alt="XPERT IT SOLUTIONS logo">
        <div class="logo-text-stack">
            <span class="logo-text">XPERT IT <em>SOLUTIONS</em></span>
            <p class="navbar-tagline">Reliable Technology Partner</p>
        </div>
    </a>
    <ul class="nav-links">
        <li><a href="index.php"<?php echo navActive('index.php',$currentPage); ?>>Home</a></li>
        <li><a href="about.php"<?php echo navActive('about.php',$currentPage); ?>>About Us</a></li>
        <li><a href="courses.php"<?php echo navActive('courses.php',$currentPage); ?>>Courses</a></li>
        <li><a href="gallery.php"<?php echo navActive('gallery.php',$currentPage); ?>>Gallery</a></li>
        <li><a href="contact.php"<?php echo navActive('contact.php',$currentPage); ?>>Contact Us</a></li>
        <li class="btn-cta"><a href="registration.php">Enroll Now</a></li>
    </ul>
</nav>
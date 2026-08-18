<?php $currentPage = 'about.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | XPERT IT SOLUTIONS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- About Hero -->
    <section class="about-hero hero-subpage">
        <div class="section-inner">
            <h1 class="glow-text">Empowering the <span class="accent-word">Next Generation</span></h1>
            <p class="hero-sub">XPERT IT SOLUTIONS is a leading hub for technology excellence, dedicated to bridging the gap between academic learning and industry demands.</p>
        </div>
    </section>

    <!-- 4 Pillar Section (Mission, Vision, Philosophy, Strategy) -->
    <section class="about-pillars">
        <div class="section-inner pillar-grid">
            
            <!-- Our Mission -->
            <div class="pillar-card glass-panel">
                <div class="pillar-img-wrapper">
                    <img src="assets/our mission.jpg" alt="Our Mission">
                </div>
                <div class="pillar-info">
                    <h3>Our <span class="accent-word">Mission</span></h3>
                    <p>To empower individuals through cutting-edge technology education and real-world skills that translate into successful global careers.</p>
                </div>
            </div>

            <!-- Our Vision -->
            <div class="pillar-card glass-panel">
                <div class="pillar-img-wrapper">
                    <img src="assets/vision.jpg" alt="Our Vision">
                </div>
                <div class="pillar-info">
                    <h3>Our <span class="accent-word">Vision</span></h3>
                    <p>To be the leading innovator in digital learning and professional IT solutions, recognized for producing the region's top tech talent.</p>
                </div>
            </div>

            <!-- Our Philosophy -->
            <div class="pillar-card glass-panel">
                <div class="pillar-img-wrapper">
                    <img src="assets/philosophy.jpg" alt="Our Philosophy">
                </div>
                <div class="pillar-info">
                    <h3>Our <span class="accent-word">Philosophy</span></h3>
                    <p>We believe in hands-on experience, ethical practices, and fostering a culture of continuous growth and curiosity for every student.</p>
                </div>
            </div>

            <!-- Our Strategy -->
            <div class="pillar-card glass-panel">
                <div class="pillar-img-wrapper">
                    <img src="assets/strategy.jpg" alt="Our Strategy">
                </div>
                <div class="pillar-info">
                    <h3>Our <span class="accent-word">Strategy</span></h3>
                    <p>Leveraging industry-standard tools, expert mentorship, and high-impact projects to deliver learning results that truly matter.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Our Team (5 Members in a Row, No scrolling) -->
    <section class="team-section">
        <div class="section-inner">
            <h2 class="section-title text-center">Our <span class="accent-word">Expert Team</span></h2>
            <div class="team-grid-row">
                
                <!-- 1. CEO -->
                <div class="team-card glass-panel">
                    <div class="team-img-wrapper">
                        <img src="assets/boy.png" alt="Mr. Wahab Khan">
                    </div>
                    <h3>Mr. Wahab Khan</h3>
                    <p class="team-role">CEO / Director</p>
                    <p class="team-desc">PhD Computer Science. Specialty: PMP, ISTQB, Oracle Certified</p>
                </div>

                <!-- 2. Adnan Khan -->
                <div class="team-card glass-panel">
                    <div class="team-img-wrapper">
                        <img src="assets/boy.png" alt="Mr. Adnan Khan">
                    </div>
                    <h3>Mr. Adnan Khan</h3>
                    <p class="team-role">Teaching Staff</p>
                    <p class="team-desc">BS(CS). Developer (ASP, PHP, C#)</p>
                </div>
                <div class="team-card glass-panel">
                    <div class="team-img-wrapper">
                        <img src="assets/girl.png" alt="Miss Shamsa">
                    </div>
                    <h3>Miss Shamsa</h3>
                    <p class="team-role">Non-Teaching Staff</p>
                    <p class="team-desc">BS(CS). Specialty: WordPress Web Designing</p>
                </div>
            
                <div class="team-card glass-panel">
                    <div class="team-img-wrapper">
                        <img src="assets/boy.png" alt="Mr. Fazal Rahman Afridi">
                    </div>
                    <h3>Mr.Fazal Rahman</h3>
                    <p class="team-role">Trainer</p>
                    <p class="team-desc">MSc (CS). Specialty: WordPress, Graphics and Web.</p>
                </div>

                <div class="team-card glass-panel">
                    <div class="team-img-wrapper">
                        <img src="assets/boy.png" alt="Mr. Kazim Ullah">
                    </div>
                    <h3>Mr. Kazim Ullah</h3>
                    <p class="team-role">Teaching Staff</p>
                    <p class="team-desc">MSc. Computer Science. Specialty: CCNA, CCNP, CCIE</p>
                </div>
                

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="section-inner">
            <p>© <?php echo date("Y"); ?> XPERT IT SOLUTIONS. All rights reserved.</p>
        </div>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>

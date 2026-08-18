<?php $currentPage = 'courses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Courses | XPERT IT SOLUTIONS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Creative Courses Hero (Inspired by provided layout) -->
    <section class="creative-hero">
        <div class="section-inner hero-split">
            
            <!-- Left Side: Content -->
            <div class="hero-content">
                <span class="offer-label">MASTER YOUR FUTURE WITH OUR</span>
                <h1 class="mega-title" style="margin-bottom: 40px;">OUR <span class="accent-word">COURSES</span></h1>
                
                <div class="what-we-offer-stack">
                    <ul class="check-list">
                        <li><i class="fas fa-check-square"></i> Graphic Design</li>
                        <li><i class="fas fa-check-square"></i> Website Design</li>
                        <li><i class="fas fa-check-square"></i> UI/UX Design</li>
                        <li><i class="fas fa-check-square"></i> App Development</li>
                        <li><i class="fas fa-check-square"></i> Networking (CCNA)</li>
                        <li><i class="fas fa-check-square"></i> Digital Marketing</li>
                    </ul>
                </div>

                <a href="registration.php" class="btn-register">REGISTER NOW</a>
            </div>

            <!-- Right Side: Offer Circle -->
            <div class="hero-visual">
                <div class="discount-circle">
                    <span class="save-up">SAVE UP TO</span>
                    <span class="percent">45%</span>
                    <span class="off">OFF</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Courses Grid -->
    <section class="services-section" style="background: var(--navy-mid); padding: 120px 0; border-top: 1px solid var(--border);">
        <div class="section-inner">
            <h2 class="section-title text-center">Our Professional <span class="accent-word">Programs</span></h2>
            <div class="grid-3">
                
                <!-- Web Development -->
                <div class="f-card glass-panel">
                    <div class="f-card-icon"><i class="fas fa-code"></i></div>
                    <h3>Web Development</h3>
                    <p>MERN Stack, PHP Laravel, and modern JavaScript frameworks to build scalable applications.</p>
                    <div class="course-meta">
                        <span><i class="far fa-clock"></i> 3 Months</span>
                        <span><i class="fas fa-certificate"></i> Certified</span>
                    </div>
                </div>

                <!-- Graphic Design -->
                <div class="f-card glass-panel">
                    <div class="f-card-icon"><i class="fas fa-bezier-curve"></i></div>
                    <h3>Graphic Designing</h3>
                    <p>Master Adobe Photoshop, Illustrator, and Canva to create stunning visual identities.</p>
                    <div class="course-meta">
                        <span><i class="far fa-clock"></i> 2 Months</span>
                        <span><i class="fas fa-certificate"></i> Certified</span>
                    </div>
                </div>

                <!-- Networking -->
                <div class="f-card glass-panel">
                    <div class="f-card-icon"><i class="fas fa-network-wired"></i></div>
                    <h3>Networking (CCNA/CCNP)</h3>
                    <p>Comprehensive training on Cisco networking, routing, switching, and security.</p>
                    <div class="course-meta">
                        <span><i class="far fa-clock"></i> 4 Months</span>
                        <span><i class="fas fa-certificate"></i> Certified</span>
                    </div>
                </div>

                <!-- Cyber Security -->
                <div class="f-card glass-panel">
                    <div class="f-card-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Cyber Security</h3>
                    <p>Learn ethical hacking, network security, and data protection strategies.</p>
                    <div class="course-meta">
                        <span><i class="far fa-clock"></i> 3 Months</span>
                        <span><i class="fas fa-certificate"></i> Certified</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="contact-info-section">
        <div class="section-inner">
            <div class="info-grid">
                
                <a href="https://www.google.com/maps/search/Kaka+Khail+Town+near+Pakha+Ghulam+Dalaza+road+Peshawar" target="_blank" class="info-card">
                    <div class="info-icon"><i class="fas fa-globe"></i></div>
                    <h3>Our Address:</h3>
                    <p>Kaka Khail Town near Pakha Ghulam Dalaza road Peshawar</p>
                </a>

                <a href="mailto:Info@xpertsolutions.edu.pk" class="info-card">
                    <div class="info-icon"><i class="fas fa-envelope-open-text"></i></div>
                    <h3>Our Mailbox:</h3>
                    <p>Info@xpertsolutions.edu.pk</p>
                </a>

                <a href="tel:+923139383506" class="info-card">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <h3>Our Phone:</h3>
                    <p>+92-313-9383506</p>
                </a>

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

<?php
$site = [
    "name"      => "XPERT IT SOLUTION",
    "tagline"   => "Reliable technology partner",
    "heroTitle" => "Digital Solutions Built for Real Business Growth",
    "heroText"  => "We design, build, and train teams with practical digital services that improve operations and customer experience.",
    "bannerText"=> "Smart execution. Transparent process. Measurable results."
];

$stats = [
    ["value" => "120+", "label" => "Projects Delivered"],
    ["value" => "95%",  "label" => "Client Retention"],
    ["value" => "24/7", "label" => "Technical Support"]
];

$services = [
    ["title" => "Web Development",  "description" => "Custom websites and web applications built with modern technologies."],
    ["title" => "Graphic Design",   "description" => "Professional branding, logos, and marketing materials."],
    ["title" => "IT Training",      "description" => "Comprehensive training programs for students and professionals."],
    ["title" => "Digital Marketing", "description" => "Boost your online presence with targeted marketing strategies."],
    ["title" => "SEO Solutions",    "description" => "Improve your search engine rankings and drive organic traffic."],
    ["title" => "App Development",  "description" => "Scalable mobile applications for iOS and Android platforms."],
    ["title" => "UI/UX Design",     "description" => "User-centric design solutions for a seamless digital experience."],
    ["title" => "Cloud Computing",  "description" => "Secure and reliable cloud infrastructure for your business."],
    ["title" => "Cyber Security",   "description" => "Protect your digital assets with advanced security measures."],
    ["title" => "E-commerce",       "description" => "Custom online stores to help you sell your products globally."]
];

$testimonials = [
    ["text" => "XPERT IT transformed our business operations with their web solutions. Highly recommended!", "author" => "Wahab Khan, CEO of TechCorp"],
    ["text" => "The training program was exceptional. I gained practical skills that helped me land my dream job.", "author" => "Kazim Ullah, Junior Developer"],
    ["text" => "Their graphic design team is top-notch. They captured our brand identity perfectly.", "author" => "Arif Shah, Marketing Director"],
    ["text" => "The technical proficiency and attention to detail they brought to our full-stack project was exceptional. A reliable partner for any complex software needs.", "author" => "Hamza Ahmed, CTO at TechSolutions"],
    ["text" => "Working with this team was a seamless experience. They delivered a high-quality, responsive mobile interface well ahead of our project deadline.", 
    "author" => "Zainab Malik, Product Manager"],
    ["text" => "Innovative thinkers who truly understand UI/UX. They transformed our vision into a polished, professional platform that our users find incredibly intuitive.", "author" => "Bilal Khan, Creative Director"]];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site["name"]); ?> | Digital Services</title>
    <meta name="description" content="XPERT IT SOLUTION — Your reliable technology partner for web development, graphic design, and IT training in Peshawar.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero section with bg.jpg -->
    <section class="hero-full" id="heroSection">
        <div class="hero-bg-img" style="background-image: url('assets/bg.jpg');"></div>
        <div class="hero-overlay"></div>

        <div class="hero-center">
            <h1 class="glow-text" id="heroTitle">
                <?php echo htmlspecialchars($site["heroTitle"]); ?>
            </h1>
            <p class="hero-sub" id="heroSub"><?php echo htmlspecialchars($site["heroText"]); ?></p>
            <div class="cta-group" id="heroCta">
                <a href="#servicesSection" class="btn-hero-orange">Explore Services</a>
                <a href="registration.php" class="btn-hero-orange">Book Consultation</a>
            </div>

            <div class="hero-stats" id="heroStats">
                <?php foreach ($stats as $stat): ?>
                    <div class="stat-card">
                        <strong><?php echo htmlspecialchars($stat["value"]); ?></strong>
                        <span><?php echo htmlspecialchars($stat["label"]); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="servicesSection">
        <div class="section-inner">
            <div class="section-header">
                <h2 class="section-title">What We <span class="accent-word">Offer</span></h2>
                <div class="scroll-controls">
                    <button class="scroll-btn" id="prevServices" aria-label="Previous Services"><i class="fas fa-chevron-left"></i></button>
                    <button class="scroll-btn" id="nextServices" aria-label="Next Services"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="floating-cards" id="servicesContainer">
                <?php foreach ($services as $service): ?>
                    <article class="f-card">
                        <h3><?php echo htmlspecialchars($service["title"]); ?></h3>
                        <p><?php echo htmlspecialchars($service["description"]); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="section-label">Testimonials</div>
        <div class="section-header">
            <h2 class="section-title">Client <span class="accent-word">Feedback</span></h2>
            <div class="scroll-controls">
                <button class="scroll-btn" id="prevTestimonials" aria-label="Previous Testimonials"><i class="fas fa-chevron-left"></i></button>
                <button class="scroll-btn" id="nextTestimonials" aria-label="Next Testimonials"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="testimonial-grid" id="testimonialsContainer">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p>"<?php echo htmlspecialchars($testimonial["text"]); ?>"</p>
                    <div class="testimonial-author">- <?php echo htmlspecialchars($testimonial["author"]); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="bottom-banner" id="ctaBanner">
        <div class="banner-text">
            <h2>Ready to transform your digital presence?</h2>
        </div>
        <a href="project.php" class="btn-primary">Start Project</a>
    </section>

    <footer class="footer">
        <p>© <?php echo date("Y"); ?> XPERT IT SOLUTION. All rights reserved.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>

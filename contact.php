<?php $currentPage = 'contact.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details | XPERT IT SOLUTIONS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
    <style>
        .contact-details-hero {
            padding: 130px 0 80px;
            background: var(--navy);
            text-align: center;
        }
        .contact-details-hero h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 4rem;
            margin-bottom: 25px;
            color: #fff;
        }
        
        /* Search Bar Style */
        .contact-search-box {
            max-width: 600px;
            margin: 30px auto 15px;
            position: relative;
        }
        .contact-search-box input {
            width: 100%;
            padding: 18px 30px;
            padding-right: 60px;
            border-radius: 99px;
            border: 2px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .contact-search-box input:focus {
            border-color: var(--orange);
            background: rgba(255,255,255,0.1);
            outline: none;
            box-shadow: 0 0 30px rgba(255,143,0,0.1);
        }
        .contact-search-box i {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--orange);
            font-size: 1.2rem;
        }
        .faq-prompt {
            color: var(--muted);
            font-size: 0.95rem;
        }
        .faq-prompt a {
            color: var(--orange);
            font-weight: 700;
            margin-left: 5px;
        }

        .details-grid-section {
            padding: 80px 0;
            background: var(--navy-mid);
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .detail-card {
            background: rgba(255, 255, 255, 0.03);
            padding: 50px 30px;
            border-radius: 25px;
            text-align: center;
            border: 1px solid var(--border);
            transition: all 0.4s ease;
        }
        .detail-card:hover {
            transform: translateY(-8px);
            border-color: var(--orange);
            background: rgba(255, 255, 255, 0.06);
        }
        .detail-card i {
            font-size: 2.8rem;
            color: var(--orange);
            margin-bottom: 25px;
            display: block;
        }
        .detail-card h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 12px;
        }
        .detail-card p {
            color: rgba(255,255,255,0.7);
            font-size: 1rem;
            line-height: 1.6;
        }
        .detail-card a {
            display: inline-block;
            margin-top: 15px;
            color: var(--orange);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* FAQ Section */
        .faq-section {
            padding: 100px 0;
            background: var(--navy);
        }
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .faq-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 15px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s;
        }
        .faq-header {
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
        }
        .faq-header:hover {
            background: rgba(255,255,255,0.05);
        }
        .faq-header h4 {
            font-size: 1.1rem;
            color: #fff;
            font-weight: 600;
        }
        .faq-header i {
            color: var(--orange);
            transition: transform 0.3s;
        }
        .faq-body {
            padding: 0 30px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease-out;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
        }
        .faq-item.active .faq-body {
            padding: 0 30px 25px;
            max-height: 200px;
        }
        .faq-item.active .faq-header i {
            transform: rotate(180deg);
        }
        .faq-item.active {
            border-color: var(--orange);
            background: rgba(255,255,255,0.05);
        }

        /* Map Section Side-by-Side */
        .map-section {
            padding: 80px 0 120px;
            background: var(--navy-mid);
        }
        .map-split-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
        }
        .map-text-content h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            color: #fff;
            margin-bottom: 20px;
        }
        .map-text-content p {
            color: rgba(255,255,255,0.7);
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .location-perks {
            list-style: none;
            padding: 0;
        }
        .location-perks li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: #fff;
            font-weight: 500;
        }
        .location-perks i { color: var(--orange); }

        .map-wrapper-small {
            border-radius: 25px;
            overflow: hidden;
            border: 1px solid var(--border);
            height: 350px;
            box-shadow: var(--shadow);
        }

        @media(max-width: 992px) {
            .details-grid { grid-template-columns: 1fr; }
            .map-split-grid { grid-template-columns: 1fr; gap: 40px; }
            .contact-details-hero h1 { font-size: 2.8rem; }
        }
    </style>
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero with Search -->
    <section class="contact-details-hero">
        <div class="section-inner">
            <h1>Get in <span class="accent-word">Touch</span></h1>
            
            <div class="contact-search-box">
                <input type="text" id="faqSearch" placeholder="Search for help..." onkeyup="searchFaqs()">
                <i class="fas fa-search"></i>
            </div>
            <p class="faq-prompt">Have a quick question? Check our <a href="#faqSection">FAQS?</a></p>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="details-grid-section">
        <div class="section-inner">
            <div class="details-grid">
                <div class="detail-card">
                    <i class="fas fa-envelope-open-text"></i>
                    <h3>Email Support</h3>
                    <p>Our support team is available 24/7.</p>
                    <p><strong>Info@xpertsolutions.edu.pk</strong></p>
                    <a href="mailto:Info@xpertsolutions.edu.pk">Send Mail</a>
                </div>
                <div class="detail-card">
                    <i class="fas fa-phone-alt"></i>
                    <h3>Call Us</h3>
                    <p>Mon - Sat, 9:00 AM to 6:00 PM</p>
                    <p><strong>+92-313-9383506</strong></p>
                    <a href="tel:+923139383506">Call Now</a>
                </div>
                <div class="detail-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Visit Office</h3>
                    <p>Kaka Khail Town near Pakha Ghulam Dalaza road Peshawar</p>
                    <a href="https://www.google.com/maps/search/Kaka+Khail+Town+near+Pakha+Ghulam+Dalaza+road+Peshawar" target="_blank">View Directions</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faqSection">
        <div class="section-inner">
            <h2 class="section-title text-center">Frequently Asked <span class="accent-word">Questions</span></h2>
            
            <div class="faq-container">
                <!-- FAQ 1 -->
                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <h4>What is the duration of the IT courses?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-body">
                        Most of our professional courses range from 2 to 4 months, depending on the complexity and track you choose (Web, Design, or Networking).
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <h4>Do you provide certificates after completion?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-body">
                        Yes, all students receive a professional certification from XPERT IT SOLUTIONS upon successful completion of their course and final project.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <h4>Can I register for multiple courses at once?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-body">
                        Yes, you can enroll in multiple courses. However, we recommend a maximum of two at a time to ensure you can dedicate enough time to practical projects.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <h4>How can I start a project with Xpert?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-body">
                        You can simply click the "Start Project" button on our home page or visit our dedicated Project Inquiry page to tell us about your vision.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map with Side Text -->
    <section class="map-section">
        <div class="section-inner">
            <div class="map-split-grid">
                <div class="map-text-content">
                    <h2>Find Us in <span class="accent-word">Peshawar</span></h2>
                    <p>We are located in the heart of Peshawar's tech hub. Our modern facility is open for visits and student counseling sessions.</p>
                    <ul class="location-perks">
                        <li><i class="fas fa-parking"></i> Free Parking Available</li>
                        <li><i class="fas fa-bus"></i> Near Public Transport</li>
                        <li><i class="fas fa-wifi"></i> Free Guest Wi-Fi</li>
                    </ul>
                </div>
                <div class="map-wrapper-small">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13233.123456789!2d71.5!3d34.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDAwJzAwLjAiTiA3McKwMzAnMDAuMCJF!5e0!3m2!1sen!2s!4v1234567890" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
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

    <script>
        function toggleFaq(header) {
            const item = header.parentElement;
            item.classList.toggle('active');
        }

        function searchFaqs() {
            const input = document.getElementById('faqSearch').value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const text = item.innerText.toLowerCase();
                if (text.includes(input)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>

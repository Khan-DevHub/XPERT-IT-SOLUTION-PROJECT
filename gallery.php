<?php $currentPage = 'gallery.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life at Xpert | Gallery</title>
    
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

    <!-- Simple Hero Section -->
    <section class="about-hero gallery-hero-small" style="background: var(--navy); padding: 130px 0 80px; border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div class="section-inner text-center">
            <h1 class="gallery-title">Life at <span class="accent-word">Xpert</span></h1>
            <div class="hero-quotes">
                <p class="quote-line">"The only way to do great work is to love what you do."</p>
                <p class="quote-line secondary">Empowering the next generation of innovators with hands-on skills and creative freedom.</p>
            </div>
        </div>
    </section>

    <!-- Small Single Photo Gallery Section -->
    <section class="single-gallery-section" style="background: var(--navy-mid); padding: 90px 0;">
        <div class="section-inner">
            <h2 class="section-title text-center" style="margin-bottom: 40px; font-size: 3rem; opacity: 1; letter-spacing: 1px;">Our <span class="accent-word">Gallery</span> Collection</h2>
            
            <div class="photo-viewer-container">
                
                <!-- Individual Photo Cards -->
                <div class="photo-card active" onclick="openLightbox('assets/faculty meeting room.jpg', 'Faculty Meeting Room')">
                    <img src="assets/faculty meeting room.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Faculty Meeting Room</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/admin.jpg', 'Administration Office')">
                    <img src="assets/admin.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Administration Office</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/campus hallway.jpg', 'Campus Hallway View')">
                    <img src="assets/campus hallway.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Campus Hallway View</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/interior design gallery.jpg', 'Interior Design Gallery')">
                    <img src="assets/interior design gallery.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Interior Design Gallery</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/waiting lounge.jpg', 'Students Waiting Lounge')">
                    <img src="assets/waiting lounge.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Students Waiting Lounge</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/Campus lobby interior.jpg', 'Campus Lobby Interior')">
                    <img src="assets/Campus lobby interior.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Campus Lobby Interior</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/Reception desk area.jpg', 'Reception Desk Area')">
                    <img src="assets/Reception desk area.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Reception Desk Area</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/Modern It labs.jpg', 'Modern IT Labs')">
                    <img src="assets/Modern It labs.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Modern IT Labs</h3>
                    </div>
                </div>

                <div class="photo-card" onclick="openLightbox('assets/building.jpg', 'Main Campus Building')">
                    <img src="assets/building.jpg" alt="Photo">
                    <div class="photo-overlay">
                        <h3>Main Campus Building</h3>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="viewer-controls">
                    <button class="v-btn prev" onclick="changePhoto(-1)"><i class="fas fa-chevron-left"></i></button>
                    <div class="photo-counter"><span id="current-num">1</span> / 9</div>
                    <button class="v-btn next" onclick="changePhoto(1)"><i class="fas fa-chevron-right"></i></button>
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

    <!-- Lightbox Modal -->
    <div id="gallery-lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
        <div class="lb-content" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="Full Image">
            <h3 id="lightbox-title"></h3>
        </div>
    </div>

    <script>
        let photoIdx = 0;
        const photos = document.querySelectorAll('.photo-card');
        const counter = document.getElementById('current-num');

        function changePhoto(dir) {
            photoIdx = (photoIdx + dir + photos.length) % photos.length;
            photos.forEach((p, i) => {
                p.classList.toggle('active', i === photoIdx);
            });
            counter.innerText = photoIdx + 1;
        }

        function openLightbox(src, title) {
            const lightbox = document.getElementById('gallery-lightbox');
            const img = document.getElementById('lightbox-img');
            const caption = document.getElementById('lightbox-title');
            if (lightbox && img && caption) {
                img.src = src;
                caption.innerText = title;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden'; 
            }
        }
        function closeLightbox() {
            const lightbox = document.getElementById('gallery-lightbox');
            if (lightbox) {
                lightbox.classList.remove('active');
                document.body.style.overflow = 'auto'; 
            }
        }
        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') changePhoto(1);
            if (e.key === 'ArrowLeft') changePhoto(-1);
        });
    </script>
    <script src="scripts.js"></script>
</body>
</html>

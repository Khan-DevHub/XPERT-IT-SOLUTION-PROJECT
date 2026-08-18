<?php 
$currentPage = 'registration.php'; 
include 'db_connect.php';

$message = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['full_name'])) {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number'] ?? '');
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name'] ?? '');

        // 1. Phone length validation (Max 13 characters)
        if (strlen($phone_number) > 13) {
            $message = "Error: Phone number cannot exceed 13 characters.";
            $status = "error";
        } else {
            // 2. Check for duplicate Email or Phone
            $checkSql = "SELECT * FROM registrations WHERE email = '$email' OR phone_number = '$phone_number'";
            $result = mysqli_query($conn, $checkSql);

            if (mysqli_num_rows($result) > 0) {
                $message = "Error: This Email or Phone Number is already registered.";
                $status = "error";
            } else {
                // 3. Proceed with Insertion
                $sql = "INSERT INTO registrations (full_name, email, phone_number, course_name) 
                        VALUES ('$full_name', '$email', '$phone_number', '$course_name')";

                if (mysqli_query($conn, $sql)) {
                    $message = "Registration successful! We will contact you soon.";
                    $status = "success";
                }
 else {
                    $message = "Database Error: " . mysqli_error($conn);
                    $status = "error";
                }
            }
        }
    } else {
        $message = "Error: Please fill in your name and refresh the page.";
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | XPERT IT SOLUTIONS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
    <style>
        .reg-section {
            padding: 130px 0 60px;
            background: var(--navy);
            min-height: calc(100vh - 80px); /* Adjusting for navbar height */
            display: flex;
            align-items: flex-start; /* Start from top with padding */
            justify-content: center;
        }
        .reg-container {
            max-width: 850px;
            margin: 0 auto;
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            display: grid;
            grid-template-columns: 1fr 1.2fr;
        }
        .reg-sidebar {
            background: var(--navy-mid);
            padding: 30px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .reg-form-area {
            padding: 30px;
            background: #fff;
        }
        .reg-sidebar h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        .reg-sidebar p {
            opacity: 0.8;
            line-height: 1.5;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .reg-perks {
            list-style: none;
            padding: 0;
        }
        .reg-perks li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }
        .reg-perks i {
            color: var(--orange);
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 6px;
            font-size: 0.85rem;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #edf2f7;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: var(--orange);
            outline: none;
        }
        .btn-submit-reg {
            width: 100%;
            padding: 15px;
            background: var(--orange);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }
        .btn-submit-reg:hover {
            background: var(--navy);
            transform: translateY(-2px);
        }

        /* Alert Styles */
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            font-size: 0.9rem;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media(max-width: 850px) {
            .reg-container { grid-template-columns: 1fr; }
            .reg-sidebar { display: none; }
            .reg-section { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <section class="reg-section">
        <div class="reg-container">
            <!-- Sidebar -->
            <div class="reg-sidebar">
                <div class="reg-logo" style="margin-bottom: 20px;">
                    <img src="assets/image.png" alt="XPERT IT SOLUTIONS" style="height: 80px; display: block; margin: 0 auto;">
                </div>
                <h2>Join Peshawar's <span class="accent-word">Elite</span> IT Hub</h2>
                <p>Kickstart your career with professional training and industry-recognized certifications.</p>
                <ul class="reg-perks">
                    <li><i class="fas fa-check-circle"></i> Expert Industry Mentors</li>
                    <li><i class="fas fa-check-circle"></i> Practical Hands-on Projects</li>
                    <li><i class="fas fa-check-circle"></i> Career Placement Support</li>
                    <li><i class="fas fa-check-circle"></i> Modern IT Lab Access</li>
                </ul>
            </div>

                <!-- Form -->
            <div class="reg-form-area">
                <div style="margin-bottom: 25px;">
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.8rem; color: var(--navy);">Online Registration</h3>
                    <p style="color: #64748b; font-size: 0.9rem;">Fill out the form below and we'll get back to you shortly.</p>
                </div>

                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $status; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                
                <form action="registration.php" method="POST" onsubmit="handleFormSubmit(this.querySelector('button'))">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="example@mail.com" required>
                    </div>
 
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone_number" placeholder="+92 3XX XXXXXXX" maxlength="13" required>
                    </div>
 
                    <div class="form-group">
                        <label>Select Course</label>
                        <select name="course_name" required>
                            <option value="">Choose your course...</option>
                            <option value="Full Stack Web Development">Full Stack Web Development (MERN/PHP)</option>
                            <option value="Professional Graphic Designing">Professional Graphic Designing (Adobe Suite)</option>
                            <option value="Networking & CCNA">Networking & CCNA</option>
                            <option value="Cyber Security & Ethical Hacking">Cyber Security & Ethical Hacking</option>
                            <option value="Digital Marketing Masterclass">Digital Marketing Masterclass</option>
                            <option value="AI & Machine Learning">AI & Machine Learning</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit-reg">Submit Registration</button>
                </form>
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
    <style>
        /* Spinner Style */
        .btn-loading { pointer-events: none; opacity: 0.7; }
        .spinner { display: none; width: 18px; height: 18px; border: 2px solid #fff; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite; margin-left: 10px; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .active .spinner { display: inline-block; }
    </style>

    <script>
        function handleFormSubmit(btn) {
            btn.classList.add('active');
            btn.innerHTML = 'Sending <span class="spinner"></span>';
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';
        }

        // Redirect logic if success
        <?php if (isset($status) && $status == "success"): ?>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000);
        <?php endif; ?>
    </script>
    <style>
        .btn-loading { pointer-events: none; opacity: 0.7; }
        .spinner { display: none; width: 18px; height: 18px; border: 2px solid #fff; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite; margin-left: 10px; vertical-align: middle; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .active .spinner { display: inline-block; }
    </style>

    <script>
        function handleFormSubmit(btn) {
            btn.classList.add('active');
            btn.innerHTML = 'Sending <span class="spinner"></span>';
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';
        }

        <?php if (isset($status) && $status == "success"): ?>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>

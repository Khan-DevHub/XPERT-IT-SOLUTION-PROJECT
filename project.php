<?php 
$currentPage = 'project.php'; 
include 'db_connect.php';

$message = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required field exists and is not empty
    if (!empty($_POST['full_name'])) {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $business_email = mysqli_real_escape_string($conn, $_POST['business_email'] ?? '');
        $interest_in = mysqli_real_escape_string($conn, $_POST['interest_in'] ?? '');
        $estimated_budget = mysqli_real_escape_string($conn, $_POST['estimated_budget'] ?? '');
        $projectMessage = mysqli_real_escape_string($conn, $_POST['message'] ?? '');

        // Check for duplicate Email
        $checkSql = "SELECT * FROM projectdetails WHERE business_email = '$business_email'";
        $result = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            $message = "Error: This Email has already been used for an inquiry.";
            $status = "error";
        } else {
            $sql = "INSERT INTO projectdetails (full_name, business_email, interest_in, estimated_budget, message) 
                    VALUES ('$full_name', '$business_email', '$interest_in', '$estimated_budget', '$projectMessage')";

            if (mysqli_query($conn, $sql)) {
                $message = "Your Project enquiry has been sent successfully!";
                $status = "success";
            }
 else {
                $message = "Database Error: " . mysqli_error($conn);
                $status = "error";
            }
        }
    } else {
        // This might happen if the form name attributes don't match the PHP keys
        $message = "Error: Full Name is required. Please refresh the page and try again.";
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start a Project | XPERT IT SOLUTIONS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
    <style>
        .project-hero {
            padding: 130px 0 60px;
            background: var(--navy);
            text-align: center;
        }
        .project-hero h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            margin-bottom: 20px;
            color: #fff;
        }
        .project-hero p {
            font-size: 1.2rem;
            color: var(--muted);
            max-width: 700px;
            margin: 0 auto;
        }

        .project-form-section {
            padding: 60px 0 120px;
            background: var(--navy);
        }
        .project-form-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 50px 150px rgba(0,0,0,0.6);
            display: grid;
            grid-template-columns: 1fr 1.5fr;
        }
        .project-sidebar {
            background: var(--navy-mid);
            padding: 60px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .project-sidebar::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: var(--orange);
            filter: blur(100px);
            opacity: 0.2;
        }
        .project-sidebar h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 20px;
            line-height: 1.1;
        }
        .project-steps {
            list-style: none;
            padding: 0;
            margin-top: 40px;
        }
        .project-steps li {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .step-num {
            width: 35px;
            height: 35px;
            background: var(--orange);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
        }
        .step-text h4 { font-size: 1.1rem; margin-bottom: 5px; }
        .step-text p { font-size: 0.9rem; opacity: 0.7; }

        .project-form-area {
            padding: 60px;
            background: #fff;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }
        .field-group {
            margin-bottom: 25px;
        }
        .field-group label {
            display: block;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .field-group input, .field-group select, .field-group textarea {
            width: 100%;
            padding: 16px;
            border: 2px solid #f1f5f9;
            border-radius: 15px;
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        .field-group input:focus, .field-group textarea:focus {
            border-color: var(--orange);
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 143, 0, 0.1);
        }
        .btn-launch {
            width: 100%;
            padding: 20px;
            background: var(--orange);
            color: #fff;
            border: none;
            border-radius: 15px;
            font-weight: 900;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .btn-launch:hover {
            background: var(--navy);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .alert {
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 15px;
            font-weight: 600;
            text-align: center;
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

        @media(max-width: 992px) {
            .project-form-container { grid-template-columns: 1fr; }
            .project-sidebar { display: none; }
            .project-form-area { padding: 40px 20px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Global Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero -->
    <section class="project-hero">
        <div class="section-inner">
            <h1 class="glow-text">Launch Your <span class="accent-word">Vision</span></h1>
            <p>Tell us about your project and we'll help you bring it to life with professional digital excellence.</p>
        </div>
    </section>

    <!-- Inquiry Form -->
    <section class="project-form-section">
        <div class="section-inner">
            <div class="project-form-container">
                
                <!-- Sidebar -->
                <div class="project-sidebar">
                    <h2>The Xpert <span class="accent-word">Process</span></h2>
                    <ul class="project-steps">
                        <li>
                            <div class="step-num">1</div>
                            <div class="step-text">
                                <h4>Discovery</h4>
                                <p>We analyze your needs and goals.</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-num">2</div>
                            <div class="step-text">
                                <h4>Strategy</h4>
                                <p>Custom planning for your project.</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-num">3</div>
                            <div class="step-text">
                                <h4>Execution</h4>
                                <p>High-end development and design.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Form Area -->
                <div class="project-form-area">
                    <?php if ($message): ?>
                        <div class="alert alert-<?php echo $status; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="project.php" method="POST" onsubmit="handleFormSubmit(this.querySelector('button'))">
                        <div class="form-grid">
                            <div class="field-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" placeholder="Your name" required>
                            </div>
                            <div class="field-group">
                                <label>Business Email</label>
                                <input type="email" name="business_email" placeholder="email@company.com" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="field-group">
                                <label>Interested In</label>
                                <select name="interest_in" required>
                                    <option value="">Select Service...</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Mobile App Development">Mobile App Development</option>
                                    <option value="UI/UX Design">UI/UX Design</option>
                                    <option value="Graphic Design & Branding">Graphic Design & Branding</option>
                                    <option value="Digital Marketing & SEO">Digital Marketing & SEO</option>
                                    <option value="Custom Software Solutions">Custom Software Solutions</option>
                                </select>
                            </div>
                            <div class="field-group">
                                <label>Estimated Budget</label>
                                <select name="estimated_budget" required>
                                    <option value="">Select Range...</option>
                                    <option value="Below $500">Below $500</option>
                                    <option value="$500 - $2000">$500 - $2000</option>
                                    <option value="$2000+">$2000+</option>
                                </select>
                            </div>
                        </div>

                        <div class="field-group">
                            <label>How can we help?</label>
                            <textarea name="message" rows="4" placeholder="Briefly describe your project goals..." required></textarea>
                        </div>

                        <button type="submit" class="btn-launch">Send Project Inquiry</button>
                    </form>
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
    <style>
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

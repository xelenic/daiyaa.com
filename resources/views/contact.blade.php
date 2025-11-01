<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - Daiyaa Restaurant</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #D4AF37;
            --dark-bg: #0a0a0a;
            --darker-bg: #050505;
            --card-bg: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;
            --accent-red: #8B0000;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
            padding-top: 80px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Hero Section */
        .hero {
            height: 50vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&q=80') center/cover;
            background-attachment: fixed;
        }

        .hero-content {
            text-align: center;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            color: var(--primary-gold);
            margin-bottom: 1rem;
            letter-spacing: 3px;
        }

        .hero p {
            font-size: 1.3rem;
            color: var(--text-secondary);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-gold);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        /* Contact Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-bottom: 4rem;
        }

        .contact-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            border-color: var(--primary-gold);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 3rem;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
        }

        .contact-card h3 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: var(--text-primary);
        }

        .contact-card p {
            color: var(--text-secondary);
            line-height: 1.8;
        }

        .contact-card a {
            color: var(--primary-gold);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-card a:hover {
            color: var(--text-primary);
        }

        /* Map Section */
        .map-section {
            background: var(--darker-bg);
            padding: 4rem 0;
            margin-top: 2rem;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .map-placeholder {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 4rem 2rem;
            text-align: center;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .map-placeholder i {
            font-size: 4rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        /* Footer */
        .footer {
            background: var(--darker-bg);
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-gold);
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
        }

        .social-links a {
            color: var(--primary-gold);
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--text-primary);
            transform: translateY(-5px);
        }

        .footer-text {
            color: var(--text-secondary);
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .container {
                padding: 3rem 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you</p>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="container">
        <h2 class="section-title">Get In Touch</h2>
        <p class="section-subtitle">Visit us, call us, or send us a message</p>

        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h3>Our Location</h3>
                <p>
                    Main Street<br>
                    Wellawaya City<br>
                    Sri Lanka
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h3>Phone & Email</h3>
                <p>
                    Phone: <a href="tel:+94552234567">+94 55 223 4567</a><br>
                    Email: <a href="mailto:info@daiyaa.lk">info@daiyaa.lk</a><br>
                    WhatsApp: <a href="https://wa.me/94552234567">+94 55 223 4567</a>
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h3>Opening Hours</h3>
                <p>
                    Monday - Sunday<br>
                    10:00 AM - 11:00 PM<br>
                    <strong style="color: var(--primary-gold);">Open Every Day</strong>
                </p>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="map-container">
            <h2 class="section-title">Find Us</h2>
            <p class="section-subtitle">Located in the heart of Wellawaya</p>
            
            <div class="map-placeholder">
                <i class="bi bi-pin-map-fill"></i>
                <h3 style="color: var(--primary-gold); margin-bottom: 1rem;">We're Located at Main Street, Wellawaya</h3>
                <p style="color: var(--text-secondary);">
                    Easily accessible from anywhere in the city<br>
                    Free parking available
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="logo">DAIYAA</div>
        <div class="social-links">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://wa.me/94552234567" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
        </div>
        <p class="footer-text">
            &copy; 2025 Daiyaa Restaurant. All rights reserved.<br>
            Crafted with <i class="bi bi-heart-fill" style="color: var(--accent-red);"></i> in Wellawaya, Sri Lanka
        </p>
    </footer>
</body>
</html>


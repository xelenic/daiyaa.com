<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daiyaa Restaurant - Authentic Sri Lankan Cuisine in Wellawaya</title>

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
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.2rem 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary-gold);
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--primary-gold);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
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
            max-width: 900px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            color: var(--primary-gold);
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            letter-spacing: 3px;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .hero-location {
            font-size: 1.2rem;
            color: var(--primary-gold);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--primary-gold);
            color: var(--dark-bg);
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin: 0.5rem;
            border: 2px solid var(--primary-gold);
        }

        .btn:hover {
            background: transparent;
            color: var(--primary-gold);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-gold);
            border: 2px solid var(--primary-gold);
        }

        .btn-outline:hover {
            background: var(--primary-gold);
            color: var(--dark-bg);
        }

        /* Section Styles */
        .section {
            padding: 6rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-gold);
            position: relative;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary-gold);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 4rem;
            font-size: 1.1rem;
        }

        /* CSS Fade Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }

        .fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
            opacity: 0;
        }

        .zoom-in {
            animation: zoomIn 1s ease-out forwards;
            opacity: 0;
        }

        /* Stagger animation delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; }
        .delay-800 { animation-delay: 0.8s; }

        /* Specific fix for h2 section titles */
        .section h2.section-title,
        #menu h2.section-title {
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            display: block !important;
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .about-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .about-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-gold);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
        }

        .about-icon {
            font-size: 3rem;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
        }

        .about-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .about-card p {
            color: var(--text-secondary);
        }

        /* Menu Section */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .menu-item {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
            border-color: var(--primary-gold);
        }

        .menu-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .menu-item:hover img {
            transform: scale(1.1);
        }

        .menu-info {
            padding: 1.5rem;
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .menu-item h3 {
            font-size: 1.3rem;
            color: var(--text-primary);
        }

        .menu-price {
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .menu-item p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Gallery Section */
        .gallery {
            background: var(--darker-bg);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .gallery-item {
            position: relative;
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.2);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h4 {
            color: var(--primary-gold);
            font-size: 1.3rem;
        }

        /* Contact Section */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .contact-card {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .contact-icon {
            font-size: 2.5rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        .contact-card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .contact-card p {
            color: var(--text-secondary);
        }

        .contact-card a {
            color: var(--primary-gold);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-card a:hover {
            color: var(--text-primary);
        }

        /* Footer */
        .footer {
            background: var(--darker-bg);
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
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
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .section {
                padding: 4rem 1rem;
            }
        }

        /* Scroll Animation */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;

            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            font-size: 2rem;
            color: var(--primary-gold);
        }



        /* Floating Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <p class="hero-subtitle fade-in-down">Welcome To</p>
            <h1 class="zoom-in delay-200">DAIYAA</h1>
            <div class="hero-location fade-in delay-400">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Wellawaya City, Sri Lanka</span>
            </div>
            <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 2rem;" class="fade-in delay-600">
                Experience Authentic Sri Lankan Flavors in the Heart of Wellawaya
            </p>
            <div class="fade-in delay-800">
                <a href="{{ route('menu.index') }}" class="btn">
                    <i class="bi bi-basket"></i> Order Online
                </a>
                <a href="#menu" class="btn btn-outline">View Menu</a>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="about">
        <h2 class="section-title fade-in">About Us</h2>
        <p class="section-subtitle fade-in delay-100">
            Discover the authentic taste of Sri Lankan cuisine
        </p>
        <div class="about-grid">
            <div class="about-card fade-in delay-200">
                <div class="about-icon float">
                    <i class="bi bi-award-fill"></i>
                </div>
                <h3>Premium Quality</h3>
                <p>We use only the finest, freshest ingredients sourced from local farmers and suppliers to ensure every dish is exceptional.</p>
            </div>
            <div class="about-card fade-in delay-400">
                <div class="about-icon float">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h3>Expert Chefs</h3>
                <p>Our experienced chefs bring generations of culinary expertise, crafting traditional Sri Lankan dishes with passion and precision.</p>
            </div>
            <div class="about-card fade-in delay-600">
                <div class="about-icon float">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <h3>Made with Love</h3>
                <p>Every dish is prepared with care and dedication, delivering an authentic dining experience that celebrates Sri Lankan culture.</p>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="section" id="menu">
        <h2 class="section-title fade-in">Our Signature Dishes</h2>
        <p class="section-subtitle fade-in delay-100">
            Taste the finest selection of Sri Lankan delicacies
        </p>
        <div class="menu-grid">
            <div class="menu-item fade-in delay-200">
                <img src="https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80" alt="Rice and Curry">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Rice & Curry</h3>
                        <span class="menu-price">Rs. 850</span>
                    </div>
                    <p>Traditional Sri Lankan rice with multiple curry varieties, dhal, and sambols</p>
                </div>
            </div>
            <div class="menu-item fade-in delay-300">
                <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600&q=80" alt="Kottu Roti">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Kottu Roti</h3>
                        <span class="menu-price">Rs. 650</span>
                    </div>
                    <p>Chopped roti stir-fried with vegetables, eggs, and your choice of meat</p>
                </div>
            </div>
            <div class="menu-item fade-in delay-400">
                <img src="https://images.unsplash.com/photo-1585032226651-759b368d7246?w=600&q=80" alt="Hoppers">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Hoppers</h3>
                        <span class="menu-price">Rs. 450</span>
                    </div>
                    <p>Crispy bowl-shaped pancakes served with coconut sambol and spicy curry</p>
                </div>
            </div>
            <div class="menu-item fade-in delay-500">
                <img src="https://images.unsplash.com/photo-1567337710282-00d59b1d8a77?w=600&q=80" alt="Seafood Platter">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Seafood Platter</h3>
                        <span class="menu-price">Rs. 1,450</span>
                    </div>
                    <p>Fresh catch of the day with prawns, calamari, and fish in aromatic spices</p>
                </div>
            </div>
            <div class="menu-item fade-in delay-600">
                <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?w=600&q=80" alt="Lamprais">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Lamprais</h3>
                        <span class="menu-price">Rs. 950</span>
                    </div>
                    <p>Dutch-Burgher specialty: rice, meat, sambols wrapped in banana leaf</p>
                </div>
            </div>
            <div class="menu-item fade-in delay-700">
                <img src="https://images.unsplash.com/photo-1626804475297-41608ea09aeb?w=600&q=80" alt="Curd and Treacle">
                <div class="menu-info">
                    <div class="menu-header">
                        <h3>Curd & Treacle</h3>
                        <span class="menu-price">Rs. 350</span>
                    </div>
                    <p>Creamy buffalo curd drizzled with sweet kithul treacle - a perfect dessert</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section gallery" id="gallery">
        <h2 class="section-title fade-in">Gallery</h2>
        <p class="section-subtitle fade-in delay-100">
            A glimpse into our culinary journey
        </p>
        <div class="gallery-grid">
            <div class="gallery-item zoom-in delay-200">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600&q=80" alt="Restaurant Interior">
                <div class="gallery-overlay">
                    <h4>Elegant Ambiance</h4>
                </div>
            </div>
            <div class="gallery-item zoom-in delay-300">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80" alt="Fine Dining">
                <div class="gallery-overlay">
                    <h4>Fine Dining Experience</h4>
                </div>
            </div>
            <div class="gallery-item zoom-in delay-400">
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&q=80" alt="Gourmet Food">
                <div class="gallery-overlay">
                    <h4>Gourmet Delights</h4>
                </div>
            </div>
            <div class="gallery-item zoom-in delay-500">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?w=600&q=80" alt="Chef Cooking">
                <div class="gallery-overlay">
                    <h4>Chef's Special</h4>
                </div>
            </div>
            <div class="gallery-item zoom-in delay-600">
                <img src="https://images.unsplash.com/photo-1578474846511-04ba529f0b88?w=600&q=80" alt="Desserts">
                <div class="gallery-overlay">
                    <h4>Sweet Endings</h4>
                </div>
            </div>
            <div class="gallery-item zoom-in delay-700">
                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=600&q=80" alt="Outdoor Dining">
                <div class="gallery-overlay">
                    <h4>Al Fresco Dining</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" id="contact">
        <h2 class="section-title fade-in">Visit Us</h2>
        <p class="section-subtitle fade-in delay-100">
            We'd love to serve you
        </p>
        <div class="contact-grid">
            <div class="contact-card fade-in delay-200">
                <div class="contact-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h3>Location</h3>
                <p>Main Street<br>Wellawaya City<br>Sri Lanka</p>
            </div>
            <div class="contact-card fade-in delay-300">
                <div class="contact-icon">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h3>Opening Hours</h3>
                <p>Monday - Sunday<br>10:00 AM - 11:00 PM<br>No Holidays</p>
            </div>
            <div class="contact-card fade-in delay-400">
                <div class="contact-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h3>Contact</h3>
                <p>
                    <a href="tel:+94552234567">+94 55 223 4567</a><br>
                    <a href="mailto:info@daiyaa.lk">info@daiyaa.lk</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="logo" style="font-size: 2.5rem;">DAIYAA</div>
        <div class="social-links">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
        </div>
        <p class="footer-text">
            &copy; 2025 Daiyaa Restaurant. All rights reserved.<br>
            Crafted with <i class="bi bi-heart-fill" style="color: var(--accent-red);"></i> in Wellawaya, Sri Lanka
        </p>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>

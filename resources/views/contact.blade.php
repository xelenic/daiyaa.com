@extends('layouts.app')

@section('title', 'Contact Us - ' . setting('site_name'))
@section('description', 'Get in touch with ' . setting('site_name') . '. Visit us at ' . setting('contact_address') . ' or call ' . setting('contact_phone'))

@section('styles')
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
@endsection

@section('content')
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
            <!-- Location Card -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h3>Our Location</h3>
                <p>
                    {{ setting('contact_address') }}<br>
                    @if(setting('contact_city'))
                        {{ setting('contact_city') }}
                        @if(setting('contact_postal_code'))
                            , {{ setting('contact_postal_code') }}
                        @endif
                        <br>
                    @endif
                    {{ setting('contact_country', 'Sri Lanka') }}
                </p>
                
                @if(setting('contact_map_latitude') && setting('contact_map_longitude'))
                    <a href="https://www.google.com/maps?q={{ setting('contact_map_latitude') }},{{ setting('contact_map_longitude') }}" 
                       target="_blank" 
                       style="display: inline-block; margin-top: 1rem; color: var(--primary-gold);">
                        <i class="bi bi-pin-map"></i> View on Google Maps
                    </a>
                @endif
            </div>

            <!-- Phone & Email Card -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h3>Phone & Email</h3>
                <p>
                    @if(setting('contact_phone'))
                        <strong>Primary:</strong> <a href="tel:{{ setting('contact_phone') }}">{{ setting('contact_phone') }}</a><br>
                    @endif
                    
                    @if(setting('contact_phone_secondary'))
                        <strong>Secondary:</strong> <a href="tel:{{ setting('contact_phone_secondary') }}">{{ setting('contact_phone_secondary') }}</a><br>
                    @endif
                    
                    @if(setting('contact_email'))
                        <strong>Email:</strong> <a href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a><br>
                    @endif
                    
                    @if(setting('contact_whatsapp'))
                        <strong>WhatsApp:</strong> <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" target="_blank">
                            {{ setting('contact_whatsapp') }}
                        </a>
                    @endif
                </p>
            </div>

            <!-- Opening Hours Card -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h3>Opening Hours</h3>
                <p>
                    {{ setting('hours_days', 'Monday - Sunday') }}<br>
                    {{ setting('hours_open', '10:00 AM') }} - {{ setting('hours_close', '11:00 PM') }}<br>
                    @if(setting('hours_special_note'))
                        <strong style="color: var(--primary-gold);">{{ setting('hours_special_note') }}</strong>
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Social Media Section -->
        <div style="text-align: center; margin-top: 3rem;">
            <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">Follow Us On Social Media</h3>
            <x-social-links iconSize="2rem" />
        </div>
    </section>

    <!-- Map Section -->
    @if(setting('contact_map_embed_url'))
        <section class="map-section">
            <div class="map-container">
                <h2 class="section-title">Find Us</h2>
                <p class="section-subtitle">Located in {{ setting('contact_city', 'Wellawaya') }}</p>
                
                <div style="border-radius: 15px; overflow: hidden; border: 1px solid rgba(212, 175, 55, 0.2);">
                    <iframe 
                        src="{{ setting('contact_map_embed_url') }}" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
    @else
        <section class="map-section">
            <div class="map-container">
                <h2 class="section-title">Find Us</h2>
                <p class="section-subtitle">Located in {{ setting('contact_city', 'Wellawaya') }}</p>
                
                <div class="map-placeholder">
                    <i class="bi bi-pin-map-fill"></i>
                    <h3 style="color: var(--primary-gold); margin-bottom: 1rem;">
                        We're Located at {{ setting('contact_address') }}
                    </h3>
                    <p style="color: var(--text-secondary);">
                        Easily accessible from anywhere in the city<br>
                        @if(setting('contact_map_latitude') && setting('contact_map_longitude'))
                            <a href="https://www.google.com/maps?q={{ setting('contact_map_latitude') }},{{ setting('contact_map_longitude') }}" 
                               target="_blank" 
                               style="color: var(--primary-gold); margin-top: 1rem; display: inline-block;">
                                <i class="bi bi-pin-map"></i> Get Directions
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </section>
    @endif
@endsection


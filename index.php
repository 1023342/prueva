<?php
require 'rifa_logic.php';
$rifaData = getRifaData();
extract($rifaData);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RifaVirtual - Plataforma Profesional de Rifas Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables y estilos base */
        :root {
            --primary: #8B0000; /* Rojo oscuro para el encabezado */
            --secondary: #B22222; /* Rojo más claro para detalles */
            --accent: #FFD700; /* Dorado para acentos */
            --light: #f8f9fa;
            --dark: #212529;
            --success: #28a745;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header - Color cambiado */
        header {
            background: linear-gradient(to right, var(--primary), #6a0d0d);
            color: var(--white);
            padding: 15px 0;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .logo i {
            color: var(--accent);
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 25px;
        }

        nav a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: var(--transition);
            padding: 8px 12px;
            border-radius: 4px;
        }

        nav a:hover, nav a.active {
            background: rgba(255,255,255,0.2);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--white);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--white);
            color: var(--white);
        }

        .btn-primary:hover {
            background: #9e1c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        .btn-large {
            padding: 12px 30px;
            font-size: 1.1rem;
        }

        /* Hero Section - Ajustado al nuevo color */
        .hero {
            padding: 100px 0;
            background: linear-gradient(rgba(139, 0, 0, 0.8), rgba(178, 34, 34, 0.8)), 
                        url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            color: var(--white);
            text-align: center;
            border-radius: 0 0 20px 20px;
            margin-bottom: 40px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.4rem;
            max-width: 800px;
            margin: 0 auto 40px;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Features */
        .section-title {
            text-align: center;
            margin: 50px 0 30px;
            font-size: 2.5rem;
            color: var(--primary);
            position: relative;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--secondary);
            margin: 15px auto;
            border-radius: 2px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }

        .feature-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--dark);
        }

        /* Current Raffles - Ajustado al nuevo color */
        .raffles {
            margin: 60px 0;
        }

        .raffle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .raffle-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .raffle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .raffle-image {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .raffle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .raffle-card:hover .raffle-image img {
            transform: scale(1.05);
        }

        .raffle-content {
            padding: 25px;
        }

        .raffle-title {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .raffle-prize {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: var(--secondary);
        }

        .raffle-meta {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .progress-bar {
            height: 10px;
            background: var(--light-gray);
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 5px;
            width: 65%;
        }

        .btn-block {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            margin-top: 15px;
        }

        /* How It Works */
        .how-it-works {
            background: var(--white);
            padding: 60px 0;
            margin: 60px 0;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .steps {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .step {
            flex: 0 0 calc(25% - 30px);
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
            position: relative;
            z-index: 2;
        }

        .step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 25px;
            left: 75%;
            width: 100%;
            height: 2px;
            background: var(--primary);
            opacity: 0.3;
        }

        .step h3 {
            margin: 15px 0;
            color: var(--dark);
        }

        /* Testimonials */
        .testimonials {
            margin: 60px 0;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial-card {
            background: var(--white);
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            position: relative;
        }

        .testimonial-card:before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 5rem;
            color: rgba(139, 0, 0, 0.1); /* Ajustado al nuevo color */
            font-family: Georgia, serif;
            line-height: 1;
        }

        .testimonial-text {
            margin-bottom: 20px;
            font-style: italic;
            color: var(--dark);
            position: relative;
            z-index: 2;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            margin-right: 15px;
        }

        .author-info h4 {
            color: var(--primary);
            margin-bottom: 5px;
        }

        /* CTA Section - Ajustado al nuevo color */
        .cta-section {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: var(--white);
            padding: 80px 0;
            text-align: center;
            border-radius: 20px;
            margin: 60px 0;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            opacity: 0.9;
        }

        .btn-light {
            background: var(--white);
            color: var(--primary);
            font-weight: bold;
            padding: 15px 40px;
            font-size: 1.2rem;
        }

        .btn-light:hover {
            background: rgba(255,255,255,0.9);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 1.4rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--secondary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: var(--white);
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #adb5bd;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .step {
                flex: 0 0 calc(50% - 20px);
                margin-bottom: 30px;
            }
            
            .step:not(:last-child):after {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.8rem;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 20px;
            }
            
            nav ul {
                gap: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .step {
                flex: 0 0 100%;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .auth-buttons {
                justify-content: center;
                margin-top: 15px;
            }
        }

        /* Nuevos estilos para la sección de números */
        .number-selection {
            background-color: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin: 40px 0;
            display: none; /* Inicialmente oculto */
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .number-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1/1;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .number-btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
        }

        .number-btn.selected {
            background-color: var(--secondary);
            color: white;
        }

        .number-btn.sold {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .close-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 20px;
            transition: var(--transition);
        }

        .close-btn:hover {
            background-color: #6a0d0d;
            transform: translateY(-2px);
        }

        .selection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .selection-title {
            color: var(--primary);
            font-size: 2rem;
        }

        .instructions {
            background-color: #fff8e1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--accent);
            font-size: 0.95rem;
        }
        
        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background: #f0f8ff;
            border-radius: 10px;
            font-weight: bold;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .ribbon {
            background: var(--accent);
            color: var(--dark);
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        /* Nueva sección de fotos de la tablet */
        .tablet-gallery {
            margin: 60px 0;
        }
        
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .gallery-main {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .gallery-main-img {
            width: 100%;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        
        .gallery-main-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }
        
        .gallery-thumbnails {
            display: flex;
            gap: 15px;
            padding: 20px;
            overflow-x: auto;
            background: var(--light-gray);
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            cursor: pointer;
            overflow: hidden;
            border: 2px solid transparent;
            transition: var(--transition);
            background: var(--white);
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .thumbnail:hover, .thumbnail.active {
            border-color: var(--primary);
            transform: scale(1.05);
        }
        
        .gallery-info {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
        }
        
        .specs-title {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .spec-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }
        
        .spec-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary);
            margin-bottom: 5px;
        }
        
        .spec-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .feature-list {
            list-style: none;
            margin-top: 20px;
        }
        
        .feature-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .feature-list li:before {
            content: "✓";
            color: var(--success);
            margin-right: 10px;
            font-weight: bold;
        }
        
        .gallery-description {
            margin-top: 25px;
            line-height: 1.8;
            color: #555;
        }
        
        @media (max-width: 768px) {
            .gallery-main-img {
                height: 300px;
            }
            
            .thumbnail {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-ticket-alt"></i>
                <span>RifaVirtual</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Rifas</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Rifas Online Seguras y Transparentes</h1>
            <p>Participa en emocionantes sorteos con grandes premios desde la comodidad de tu hogar</p>
            <div class="hero-buttons">
                <a href="#" class="btn btn-primary btn-large">Ver Rifas</a>
                <a href="#" class="btn btn-outline btn-large">Cómo Funciona</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="container">
        <h2 class="section-title">Características principales</h2>
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Seguridad Garantizada</h3>
                <p>Procesos seguros con encriptación SSL, protección de datos y transacciones seguras.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-random"></i>
                </div>
                <h3>Sorteo Transparente</h3>
                <p>Sistema de sorteo aleatorio certificado y grabado para máxima transparencia.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <h3>Múltiples Métodos de Pago</h3>
                <p>Nequi, Daviplata, Bancolombia y más.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Totalmente Responsive</h3>
                <p>Accede desde cualquier dispositivo: móvil, tablet o computadora.</p>
            </div>
        </div>
    </section>

       <!-- Current Raffles -->
    <section class="container raffles">
        <h2 class="section-title">Rifas Destacadas</h2>
        <div class="raffle-grid">
            <div class="raffle-card">
                <div class="raffle-image">
                    <img src="inicio.jpg" alt="Tablet Redmi Pad SE">
                </div>
                <div class="raffle-content">
                    <h3 class="raffle-title">Gran Sorteo de Tecnología</h3>
                    <div class="raffle-prize">Premio: Tablet Redmi Pad SE</div>
                    <p>Participa en nuestro sorteo tecnológico y gana uno de los mejores modelos de tablet de Xiaomi.</p>
                    
                    <div class="raffle-meta">
                        <div><i class="fas fa-ticket-alt"></i> Boletas: $10.000</div>
                        <div><i class="fas fa-calendar"></i> Finaliza: hasta agotar existencias</div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Boletos vendidos</span>
                            <span><?= $soldCount ?>/100</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $progressWidth ?>%"></div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary btn-block" id="participar-btn">Participar ahora</a>
                </div>
            </div>
        </div>
    </section>
    
    </section>
     <!-- Nueva sección de fotos de la tablet -->
    <section class="container tablet-gallery">
        <h2 class="section-title">Fotos del Premio: Tablet Redmi Pad SE</h2>
        <div class="gallery-container">
            <div class="gallery-main">
                <div class="gallery-main-img" id="main-img">
                    <img src="vista_tamaño.jpg" alt="Tablet Redmi Pad SE" id="main-image">
                </div>
                <div class="gallery-thumbnails">
                    <div class="thumbnail active" data-img="vista_frontal.jpg">
                        <img src="vista_frontal.jpg" alt="Tablet vista frontal">
                    </div>
                    <div class="thumbnail" data-img="vista_lateral.jpg">
                        <img src="vista_lateral.jpg" alt="Tablet vista lateral">
                    </div>
                    <div class="thumbnail" data-img="vista_pantalla.jpg">
                        <img src="vista_pantalla.jpg" alt="Pantalla de la tablet">
                    </div>
                    <div class="thumbnail" data-img="vista_tamaño.jpg">
                        <img src="vista_tamaño.jpg" alt="Tablet comparación de tamaño">
                    </div>
                </div>
            </div>
    <div class="gallery-info">
                <h3 class="specs-title">Especificaciones Técnicas</h3>
                
                <div class="specs-grid">
                    <div class="spec-item">
                        <div class="spec-value">11" FHD+</div>
                        <div class="spec-label">Pantalla</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">128GB</div>
                        <div class="spec-label">Almacenamiento</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">8GB RAM</div>
                        <div class="spec-label">Memoria</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">Android 13</div>
                        <div class="spec-label">Sistema</div>
                    </div>
                </div>
                
                <h4>Características destacadas:</h4>
                <ul class="feature-list">
                    <li>Pantalla de 11 pulgadas con resolución Full HD+</li>
                    <li>Procesador Snapdragon 680 de ocho núcleos</li>
                    <li>Batería de 8000 mAh con carga rápida de 18W</li>
                    <li>Diseño ultra delgado de solo 7.36 mm</li>
                    <li>Audio cuádruple con certificación Dolby Atmos</li>
                    <li>Cámara frontal de 5MP y trasera de 8MP</li>
                </ul>
                
                <p class="gallery-description">
                    La tablet Redmi Pad SE combina rendimiento y estilo en un dispositivo elegante. 
                    Perfecta para entretenimiento, trabajo y estudios con su potente hardware y 
                    sistema operativo optimizado. ¡Participa ahora por esta increíble tablet!
                </p>
            </div>
        </div>
    <!-- Sección de selección de números -->
    <section class="container number-selection" id="number-selection">
        <div class="selection-header">
            <h2 class="selection-title">Selecciona tu número</h2>
            <button class="close-btn" id="close-btn">
                <i class="fas fa-times"></i> Cerrar
            </button>
        </div>
        
        <div class="ribbon">
            <i class="fas fa-star"></i> Gran Sorteo de Tecnología - Tablet Redmi Pad SE
        </div>
        
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-value" id="available-count"><?= $availableCount ?></div>
                <div class="stat-label">Disponibles</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="sold-count"><?= $soldCount ?></div>
                <div class="stat-label">Vendidos</div>
            </div>
        </div>
        
        <div class="instructions">
            <p><i class="fas fa-info-circle"></i> Haz clic en un número disponible para reservarlo. Los números en gris ya están vendidos.</p>
        </div>
        
        <div class="number-grid" id="number-grid">
            <?php for ($i = 1; $i <= 100; $i++): ?>
                <button class="number-btn <?= isset($soldTickets[$i]) ? 'sold' : '' ?>" 
                    data-number="<?= $i ?>"
                    <?= isset($soldTickets[$i]) ? 'disabled' : '' ?>>
                    <?= $i ?>
                </button>
            <?php endfor; ?>
        </div>
        
        <div class="reservation-form" id="reservation-form">
            <h3>Completa tu información</h3>
            <form id="ticket-form" method="POST">
                <input type="hidden" name="action" value="reserve">
                <input type="hidden" name="ticket_number" id="selected-ticket">
                
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" required placeholder="Tu nombre completo">
                </div>
                
                <div class="form-group">
                    <label for="phone">Número de teléfono</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Tu número de WhatsApp">
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Confirmar reserva</button>
            </form>
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="reservation-message <?= strpos($message, 'éxito') !== false ? 'reservation-success' : 'reservation-error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">Cómo funciona</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Ingresa al apartado de la rifa</h3>
                    <p>Elije la rifa y dale al botón "Participa ahora".</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Elige tu número</h3>
                    <p>Selecciona el número que deseas comprar de la tabla.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Completa tus datos</h3>
                    <p>Ingresa tu nombre y número de teléfono para la reserva.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Sorteo automático</h3>
                    <p>El sistema selecciona al ganador con los últimos 2 números de la lotería de Bogotá.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>RifaVirtual</h3>
                    <p>La plataforma líder para organización de rifas virtuales con seguridad, transparencia y facilidad de uso.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Términos y condiciones</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Aviso legal</a></li>
                        <li><a href="#">Política de cookies</a></li>
                        <li><a href="#">Garantías</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contacto</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> juanjoseromero1234567@gmail.com</li>
                        <li><i class="fas fa-phone"></i> +57 311 5242233 </li>
                        <li><i class="fas fa-map-marker-alt"></i> Bogotá, Colombia</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 RifaVirtual. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script>
        // Función para mostrar la sección de números
        function showNumberSelection() {
            document.getElementById('number-selection').style.display = 'block';
            document.getElementById('number-selection').scrollIntoView({ behavior: 'smooth' });
        }
        
        // Función para cerrar la sección de números
        function closeNumberSelection() {
            document.getElementById('number-selection').style.display = 'none';
        }
        
        // Función para manejar la selección de un número
        function selectNumber(number) {
            document.getElementById('selected-ticket').value = number;
            document.getElementById('reservation-form').style.display = 'block';
            document.getElementById('reservation-form').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Event listeners al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar sección de números
            document.getElementById('participar-btn').addEventListener('click', function(e) {
                e.preventDefault();
                showNumberSelection();
            });
            
            // Cerrar sección de números
            document.getElementById('close-btn').addEventListener('click', closeNumberSelection);
            
            // Asignar evento a los botones de número
            const numberButtons = document.querySelectorAll('.number-btn:not(.sold)');
            numberButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    selectNumber(parseInt(this.dataset.number));
                });
            });
            
            // Limpiar mensajes después de 5 segundos
            const message = document.querySelector('.reservation-message');
            if (message) {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000);
            }
            
            // Agregar evento al formulario para redirigir a WhatsApp
            const form = document.getElementById('ticket-form');
            let formSubmitted = false;

            if (form) {
                form.addEventListener('submit', function(e) {
                    // Si ya se está enviando, salimos
                    if (formSubmitted) {
                        return;
                    }

                    // Prevenir envío normal
                    e.preventDefault();
                    formSubmitted = true;

                    // Obtener datos del formulario
                    const name = document.getElementById('name').value;
                    const phone = document.getElementById('phone').value;
                    const ticket = document.getElementById('selected-ticket').value;

                    // Construir mensaje para WhatsApp
                    const message = `Hola, he reservado el número ${ticket} para la rifa. Mi nombre es ${name} y mi teléfono es ${phone}. Por favor confirmar mi reserva.`;
                    const whatsappUrl = `https://wa.me/573115242233?text=${encodeURIComponent(message)}`;

                    // Abrir WhatsApp en una nueva pestaña
                    window.open(whatsappUrl, '_blank');

                    // Enviar el formulario después de un breve retraso
                    setTimeout(() => {
                        // Enviamos el formulario
                        form.submit();
                    }, 500);
                });
            }
        });
          // Galería de imágenes de la tablet
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainImage = document.getElementById('main-image');
            
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    // Remover clase activa de todas las miniaturas
                    thumbnails.forEach(t => t.classList.remove('active'));
                    
                    // Agregar clase activa a la miniatura clickeada
                    this.classList.add('active');
                    
                    // Cambiar imagen principal según la miniatura seleccionada
                    const imgPath = this.dataset.img;
                    mainImage.src = imgPath;
                    mainImage.alt = this.querySelector('img').alt;
                });
            });
    </script>
</body>
</html>
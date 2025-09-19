<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Elang | IoT Developer & 3D Designer</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo CaeCode.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('Logo CaeCode.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('Logo CaeCode.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2196F3;
            --secondary-color: #00BCD4;
            --accent-color: #FF6B35;
            --dark-bg: #0a0a0a;
            --card-bg: rgba(255, 255, 255, 0.05);
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Fullscreen Terminal Intro */
        .terminal-intro {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0a0a0a;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        .terminal-intro.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        .terminal-intro-container {
            max-width: 800px;
            width: 90%;
            padding: 2rem;
        }

        .terminal-intro-window {
            background: #1e1e1e;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.8);
            border: 1px solid #333;
            font-family: 'Fira Code', 'Courier New', monospace;
            margin-bottom: 2rem;
            transform: scale(0.9);
            animation: scaleUp 0.8s ease 0.5s both;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .terminal-intro-header {
            background: #2d2d2d;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .terminal-intro-buttons {
            display: flex;
            gap: 8px;
        }

        .terminal-intro-buttons span {
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }

        .terminal-intro-title {
            color: #8e8e93;
            font-size: 14px;
            font-weight: 500;
        }

        .terminal-intro-body {
            padding: 24px;
            background: #1e1e1e;
            min-height: 300px;
        }

        .terminal-intro-line {
            color: #fff;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .loading-indicator {
            text-align: center;
            opacity: 0;
            animation: fadeIn 0.5s ease 8s both;
        }

        .loading-text {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .loading-bar {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }

        .loading-progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
            width: 0%;
            animation: loadProgress 3s ease 8.5s both;
        }

        @keyframes loadProgress {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        /* Hide main content initially */
        .main-content {
            opacity: 0;
            animation: showMainContent 1s ease 12s both;
        }

        @keyframes showMainContent {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Animated Background */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: var(--gradient-1);
            border-radius: 50%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: var(--gradient-2);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            bottom: 20%;
            left: 30%;
            width: 100px;
            height: 100px;
            background: var(--gradient-3);
            border-radius: 20px;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(15px) rotate(240deg); }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(10, 10, 10, 0.9);
            backdrop-filter: blur(20px);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            z-index: 2;
        }

        /* Hero Logo Styling */
        .hero-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 0rem;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .hero-logo img {
            width: 250px;
            height: 250px;
            object-fit: contain;
            filter: brightness(1.3) contrast(1.2) drop-shadow(0 0 20px rgba(102, 126, 234, 0.4));
            transition: all 0.4s ease;
            margin-bottom: 0.5rem;
        }

        .hero-logo img:hover {
            transform: scale(1.05) translateY(-5px);
            filter: brightness(1.5) contrast(1.3) drop-shadow(0 0 30px rgba(102, 126, 234, 0.6));
        }

        .hero-brand {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
            margin-top: 0.5rem;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeInUp 1s ease 0.5s both;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease 0.8s both;
        }

        .typing-animation {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 3rem;
            animation: fadeInUp 1s ease 1.1s both;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--gradient-1);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 1.4s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sections */
        section {
            padding: 6rem 0;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            background: var(--gradient-2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 4rem;
            align-items: center;
        }

        .about-image {
            position: relative;
        }

        .profile-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-10px);
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: transparent;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
            border: 3px solid rgba(102, 126, 234, 0.3);
            backdrop-filter: blur(10px);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            border-radius: 50%;
            filter: brightness(1.1) contrast(1.05);
        }

        .cv-download-btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: var(--gradient-2);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
            box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);
        }

        .cv-download-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
        }

        .education-info {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        .education-item {
            margin-bottom: 1rem;
        }

        .education-item:last-child {
            margin-bottom: 0;
        }

        .education-level {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .education-school {
            color: var(--text-primary);
            font-weight: 500;
            margin-top: 0.2rem;
        }

        .about-text {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.8;
        }

        /* Skills Section */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .skill-category {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .skill-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .skill-category h3 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: rgba(33, 150, 243, 0.1);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            border: 1px solid rgba(33, 150, 243, 0.2);
        }

        /* Projects Section */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .project-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient-1);
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .project-title {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .project-description {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .project-tech {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tech-tag {
            background: rgba(255, 107, 53, 0.1);
            color: var(--accent-color);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            border: 1px solid rgba(255, 107, 53, 0.2);
        }

        .project-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .project-link:hover {
            color: var(--secondary-color);
        }

        /* Contact Section */
        .contact-content {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-info {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 3rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: var(--card-bg);
            border-radius: 50%;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .social-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .social-link.linkedin:hover { color: #0077B5; }
        .social-link.instagram:hover { color: #E4405F; }
        .social-link.email:hover { color: #D14836; }
        .social-link.github:hover { color: #333; }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-logo img {
                width: 160px;
                height: 160px;
            }

            .hero-brand {
                font-size: 2.2rem;
                letter-spacing: 2px;
            }

            .about-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .skills-grid,
            .projects-grid {
                grid-template-columns: 1fr;
            }

            section {
                padding: 4rem 1rem;
            }
        }

        /* Scroll Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .fade-in:nth-child(1) { animation-delay: 0.1s; }
        .fade-in:nth-child(2) { animation-delay: 0.2s; }
        .fade-in:nth-child(3) { animation-delay: 0.3s; }
        .fade-in:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <!-- Fullscreen Terminal Intro -->
    <div class="terminal-intro" id="terminalIntro">
        <div class="terminal-intro-container">
            <div class="terminal-intro-window">
                <div class="terminal-intro-header">
                    <div class="terminal-intro-buttons">
                        <span class="btn-close"></span>
                        <span class="btn-minimize"></span>
                        <span class="btn-maximize"></span>
                    </div>
                    <div class="terminal-intro-title">caesar@caecode:~$</div>
                </div>
                <div class="terminal-intro-body">
                    <div class="terminal-intro-line">
                        <span class="prompt">caesar@caecode:~$</span>
                        <span class="command" id="introTypingCommand"></span>
                        <span class="cursor">|</span>
                    </div>
                    <div class="output" id="introTerminalOutput"></div>
                </div>
            </div>
            
            <!-- Loading indicator -->
            <div class="loading-indicator" id="loadingIndicator">
                <div class="loading-text">Initializing portfolio...</div>
                <div class="loading-bar">
                    <div class="loading-progress"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Animated Background -->
    <div class="background-animation">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                CaeCode
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <!-- CaeCode Logo -->
            <div class="hero-logo">
                <img src="{{ asset('Logo CaeCode.png') }}" alt="CaeCode Logo">
            </div>
            
            <h1 class="hero-title">Caesar Elang Paksi</h1>
            <p class="hero-subtitle">Transforming Ideas into Digital Reality</p>
            <div class="typing-animation">
                <span id="typing-text">IoT Developer • Mobile App Developer • 3D Designer • UI/UX Designer</span>
            </div>
            <a href="#about" class="cta-button">
                <i class="fas fa-rocket"></i> Explore My Work
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <h2 class="section-title">About Me</h2>
        <div class="about-content">
            <div class="about-image">
                <div class="profile-card fade-in">
                    <div class="profile-avatar">
                        <img src="{{ asset('profile.png') }}" alt="Caesar Elang Paksi" id="profileImage" style="display: block;">
                        <i class="fas fa-user-tie" id="profileIcon" style="display: none;"></i>
                    </div>
                    <h3>Caesar Elang Paksi</h3>
                    <p style="color: var(--primary-color); margin-bottom: 1rem;">Full-Stack Developer & IoT Specialist</p>
                    
                    <!-- Education Info -->
                    <div class="education-info">
                        <h4 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1rem;">🎓 Pendidikan</h4>
                        <div class="education-item">
                            <div class="education-level">DIII - Manajemen Informatika</div>
                            <div class="education-school">Politeknik Negeri Malang</div>
                        </div>
                    </div>

                    <!-- Download CV Button -->
                    <a href="{{ asset('cv-caesar-elang.pdf') }}" class="cv-download-btn" download="CV-Caesar-Elang-Paksi.pdf">
                        <i class="fas fa-download"></i> Download CV
                    </a>
                    
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/caesar-elang-paksi-317656243/" class="social-link linkedin" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://instagram.com/caesarelang__" class="social-link instagram" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://github.com/caesarelang" class="social-link github" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="about-text fade-in">
                <p>Saya adalah seorang <strong>IoT Developer</strong> dan <strong>Mobile App Developer</strong> yang berpengalaman dalam mengembangkan solusi teknologi inovatif. Lulusan <strong>DIII Manajemen Informatika Politeknik Negeri Malang</strong> dengan keahlian dalam berbagai teknologi modern.</p>
                
                <p>Dengan latar belakang pendidikan dari <strong>Politeknik Negeri Malang</strong> dan pengalaman sebagai <strong>3D Designer</strong> serta <strong>Hardware Repair Specialist</strong>, saya memiliki kombinasi unik antara kreativitas desain dan pemahaman teknis yang mendalam.</p>

                <p>Fokus pengembangan aplikasi mobile dengan <strong>Kotlin</strong>, sistem IoT dengan <strong>Arduino & ESP32</strong>, dan platform web menggunakan <strong>Laravel</strong>. Saya percaya bahwa teknologi terbaik adalah yang dapat menjembatani kebutuhan pengguna dengan solusi yang elegan dan fungsional.</p>

                <div style="margin-top: 2rem;">
                    <strong style="color: var(--primary-color);">📧 Email:</strong> caesarelangpaksi@gmail.com<br>
                    <strong style="color: var(--primary-color);">📍 Lokasi:</strong> Kediri, Jawa Timur<br>
                    <strong style="color: var(--primary-color);">🎯 Spesialisasi:</strong> IoT Development, Mobile Apps, Web Development, 3D Design<br>
                    <strong style="color: var(--primary-color);">⚡ Fun Fact:</strong> I can design it in 3D, code it, and fix it if it breaks! 🛠️
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <h2 class="section-title">Tech Stack & Skills</h2>
        <div class="skills-grid">
            <div class="skill-category fade-in">
                <h3><i class="fas fa-mobile-alt"></i> Mobile Development</h3>
                <div class="skill-tags">
                    <span class="skill-tag">Android</span>
                    <span class="skill-tag">Kotlin</span>
                    <span class="skill-tag">Java</span>
                    <span class="skill-tag">Android Studio</span>
                </div>
            </div>

            <div class="skill-category fade-in">
                <h3><i class="fas fa-microchip"></i> IoT & Hardware</h3>
                <div class="skill-tags">
                    <span class="skill-tag">Arduino</span>
                    <span class="skill-tag">ESP32</span>
                    <span class="skill-tag">Raspberry Pi</span>
                    <span class="skill-tag">MicroPython</span>
                    <span class="skill-tag">Python</span>
                </div>
            </div>

            <div class="skill-category fade-in">
                <h3><i class="fas fa-code"></i> Backend & Web</h3>
                <div class="skill-tags">
                    <span class="skill-tag">Laravel</span>
                    <span class="skill-tag">CodeIgniter</span>
                    <span class="skill-tag">PHP</span>
                    <span class="skill-tag">Node.js</span>
                    <span class="skill-tag">MySQL</span>
                    <span class="skill-tag">Firebase</span>
                    <span class="skill-tag">Supabase</span>
                </div>
            </div>

            <div class="skill-category fade-in">
                <h3><i class="fas fa-palette"></i> Design & 3D</h3>
                <div class="skill-tags">
                    <span class="skill-tag">Figma</span>
                    <span class="skill-tag">SketchUp</span>
                    <span class="skill-tag">UI/UX Design</span>
                    <span class="skill-tag">3D Modeling</span>
                </div>
            </div>

            <div class="skill-category fade-in">
                <h3><i class="fas fa-globe"></i> Web Technologies</h3>
                <div class="skill-tags">
                    <span class="skill-tag">HTML5</span>
                    <span class="skill-tag">CSS3</span>
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">Bootstrap</span>
                </div>
            </div>

            <div class="skill-category fade-in">
                <h3><i class="fas fa-tools"></i> Tools & Others</h3>
                <div class="skill-tags">
                    <span class="skill-tag">VS Code</span>
                    <span class="skill-tag">Git</span>
                    <span class="skill-tag">Postman</span>
                    <span class="skill-tag">Hardware Repair</span>
                    <span class="skill-tag">Thonny</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects">
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
            <!-- IoT & Mobile Projects -->
            <div class="project-card fade-in">
                <h3 class="project-title">🚌 SatriaTracking-IoT</h3>
                <p class="project-description">Bus Satria Kediri Tracking Mobile App dengan integrasi Arduino untuk real-time tracking dan monitoring.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">Arduino</span>
                    <span class="tech-tag">IoT</span>
                    <span class="tech-tag">GPS</span>
                </div>
                <a href="https://github.com/caesarelang/SatriaTracking-IoT" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">👆 Aplikasi Presensi IoT Fingerprint</h3>
                <p class="project-description">Aplikasi Presensi dengan integrasi Fingerprint Sensor AS608 untuk sistem absensi otomatis berbasis biometrik.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">Fingerprint AS608</span>
                    <span class="tech-tag">IoT</span>
                    <span class="tech-tag">Biometric</span>
                </div>
                <a href="https://github.com/caesarelang/Aplikasi-Presensi---IoT-Fingerprint" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🌊 Sevetion - Seismic Wave Detection</h3>
                <p class="project-description">Aplikasi kalibrasi sensor Android 3 sumbu untuk deteksi gelombang seismik dan monitoring gempa real-time.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">Android Sensors</span>
                    <span class="tech-tag">Seismic Detection</span>
                    <span class="tech-tag">Calibration</span>
                </div>
                <a href="https://github.com/caesarelang/Sevetion" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">⚡ Monitoring Daya Lapangan Badminton</h3>
                <p class="project-description">IoT system untuk monitoring penggunaan daya lapangan badminton SMAS dengan kontrol lampu manual dan penjadwalan otomatis.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">IoT</span>
                    <span class="tech-tag">Power Monitoring</span>
                    <span class="tech-tag">Smart Lighting</span>
                </div>
                <a href="https://github.com/caesarelang/Monitoring-Penggunaan-Daya-Lapangan-Badminton-SMAS---IoT" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🐔 Feeder Ayam Otomatis IoT</h3>
                <p class="project-description">Sistem pakan ayam otomatis dengan time scheduling dan manual control untuk otomatisasi peternakan modern.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">IoT</span>
                    <span class="tech-tag">Automation</span>
                    <span class="tech-tag">Smart Farming</span>
                </div>
                <a href="https://github.com/caesarelang/Feeder-Ayam-Otomatis---IoT" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🚰 Mobile App Depo Air Gas</h3>
                <p class="project-description">Android app multi-level user (Admin, Driver & Customer) untuk distribusi air dan gas dengan OSRM navigation.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">Multi-user System</span>
                    <span class="tech-tag">OSRM Navigation</span>
                    <span class="tech-tag">Xendit Payment</span>
                </div>
                <a href="https://github.com/caesarelang/Mobile-App-Depo-Air-Gas" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🔧 Mobile App Bengkel Cak Dhi</h3>
                <p class="project-description">Aplikasi mobile bengkel dengan Native API Backend untuk manajemen servis dan reservasi kendaraan.</p>
                <div class="project-tech">
                    <span class="tech-tag">Kotlin</span>
                    <span class="tech-tag">Native API</span>
                    <span class="tech-tag">Workshop Management</span>
                    <span class="tech-tag">Booking System</span>
                </div>
                <a href="https://github.com/caesarelang/Mobile-App-Bengkel-Cak-Dhi" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <!-- Backend & Web Projects -->
            <div class="project-card fade-in">
                <h3 class="project-title">🔧 API Bengkel Mobil Cak Dhi</h3>
                <p class="project-description">Backend API PHP Native untuk Mobile App Bengkel dengan sistem manajemen workshop terintegrasi.</p>
                <div class="project-tech">
                    <span class="tech-tag">PHP Native</span>
                    <span class="tech-tag">REST API</span>
                    <span class="tech-tag">MySQL</span>
                    <span class="tech-tag">Workshop Backend</span>
                </div>
                <a href="https://github.com/caesarelang/API-Bengkel-Mobil-Cak-Dhi" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🎓 ISC Course - Platform Pelatihan</h3>
                <p class="project-description">Web platform pelatihan berpiagam menggunakan Laravel Filament untuk manajemen kursus dan sertifikasi.</p>
                <div class="project-tech">
                    <span class="tech-tag">PHP</span>
                    <span class="tech-tag">Laravel Filament</span>
                    <span class="tech-tag">Course Management</span>
                    <span class="tech-tag">Certification</span>
                </div>
                <a href="https://github.com/caesarelang/ISC-Course" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🚰 Backend Depo Air Mobile App</h3>
                <p class="project-description">Backend powerful untuk mobile app dengan OSRM Navigation integration dan Xendit Payment Gateway.</p>
                <div class="project-tech">
                    <span class="tech-tag">PHP</span>
                    <span class="tech-tag">OSRM API</span>
                    <span class="tech-tag">Xendit Gateway</span>
                    <span class="tech-tag">Geolocation</span>
                </div>
                <a href="https://github.com/caesarelang/Backend-Depo-Air-Mobile-App" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">💰 Rekap Keuangan Filament</h3>
                <p class="project-description">Web aplikasi rekap keuangan, absensi & penggajian karyawan menggunakan Laravel Filament.</p>
                <div class="project-tech">
                    <span class="tech-tag">PHP</span>
                    <span class="tech-tag">Laravel Filament</span>
                    <span class="tech-tag">Financial Management</span>
                    <span class="tech-tag">HR System</span>
                </div>
                <a href="https://github.com/caesarelang/Rekap-Keuangan---Filament" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">👥 Web Manajemen Karyawan</h3>
                <p class="project-description">Sistem manajemen penggajian, absensi & shift karyawan dengan dashboard monitoring real-time.</p>
                <div class="project-tech">
                    <span class="tech-tag">Laravel Blade</span>
                    <span class="tech-tag">Employee Management</span>
                    <span class="tech-tag">Payroll System</span>
                    <span class="tech-tag">Attendance</span>
                </div>
                <a href="https://github.com/caesarelang/Web-Karyawan" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">📝 Reservasi Bengkel Mobil</h3>
                <p class="project-description">Sistem reservasi bengkel mobil Cak Dhi Pare dengan manajemen booking dan jadwal servis online.</p>
                <div class="project-tech">
                    <span class="tech-tag">Laravel Blade</span>
                    <span class="tech-tag">Booking System</span>
                    <span class="tech-tag">Schedule Management</span>
                    <span class="tech-tag">Workshop</span>
                </div>
                <a href="https://github.com/caesarelang/Reservasi-Bengkel-Mobil-" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">💝 LAZIZNU - Platform Donasi</h3>
                <p class="project-description">Web platform donasi LAZIZNU dengan integrasi Xendit Payment Gateway untuk donasi online yang aman.</p>
                <div class="project-tech">
                    <span class="tech-tag">Laravel Blade</span>
                    <span class="tech-tag">Xendit Payment</span>
                    <span class="tech-tag">Donation Platform</span>
                    <span class="tech-tag">Islamic Finance</span>
                </div>
                <a href="https://github.com/caesarelang/LAZIZNU" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🏢 BLK Kabupaten Kediri</h3>
                <p class="project-description">Website resmi Balai Latihan Kerja Kabupaten Kediri untuk informasi pelatihan dan program ketenagakerjaan.</p>
                <div class="project-tech">
                    <span class="tech-tag">Laravel Blade</span>
                    <span class="tech-tag">Government Website</span>
                    <span class="tech-tag">Training Management</span>
                    <span class="tech-tag">Public Service</span>
                </div>
                <a href="https://github.com/caesarelang/BLK" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>

            <div class="project-card fade-in">
                <h3 class="project-title">🌐 APGI - Web Profile SEO</h3>
                <p class="project-description">Website profile APGI yang dioptimasi untuk SEO dengan performa dan visibilitas search engine terbaik.</p>
                <div class="project-tech">
                    <span class="tech-tag">Laravel Blade</span>
                    <span class="tech-tag">SEO Optimized</span>
                    <span class="tech-tag">Company Profile</span>
                    <span class="tech-tag">Performance</span>
                </div>
                <a href="https://github.com/caesarelang/APGI" class="project-link" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2 class="section-title">Let's Connect</h2>
        <div class="contact-content">
            <div class="contact-info fade-in">
                <h3 style="margin-bottom: 1rem; color: var(--primary-color);">Ready to collaborate?</h3>
                <p style="margin-bottom: 2rem; color: var(--text-secondary);">
                    Saya selalu terbuka untuk proyek-proyek menarik, kolaborasi, atau sekadar diskusi tentang teknologi. 
                    Mari berkarya bersama!
                </p>
                <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                    <div>
                        <i class="fas fa-envelope" style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                        <strong>caesarelangpaksi@gmail.com</strong>
                    </div>
                    <div>
                        <i class="fas fa-map-marker-alt" style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                        <strong>Kediri, East Java, Indonesia</strong>
                    </div>
                </div>
            </div>
            
            <div class="social-links fade-in">
                <a href="https://www.linkedin.com/in/caesar-elang-paksi-317656243/" class="social-link linkedin" target="_blank">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://instagram.com/caesarelang__" class="social-link instagram" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="mailto:caesarelangpaksi@gmail.com" class="social-link email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://github.com/caesarelang" class="social-link github" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
    </section>

    </div> <!-- End Main Content -->

    <script>
        // Typing animation
        const typingText = document.getElementById('typing-text');
        const texts = [
            'IoT Developer',
            'Mobile App Developer', 
            '3D Designer',
            'UI/UX Designer',
            'Hardware Repair Specialist',
            'Full-Stack Developer'
        ];
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeText() {
            const currentText = texts[textIndex];
            
            if (isDeleting) {
                typingText.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
                
                if (charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length;
                    setTimeout(typeText, 500);
                } else {
                    setTimeout(typeText, 50);
                }
            } else {
                typingText.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
                
                if (charIndex === currentText.length) {
                    isDeleting = true;
                    setTimeout(typeText, 2000);
                } else {
                    setTimeout(typeText, 100);
                }
            }
        }

        // Start typing animation
        setTimeout(typeText, 1000);

        // Fullscreen Terminal Intro Animation
        function startTerminalIntroAnimation() {
            const commands = [
                'whoami',
                'pwd', 
                'ls -la skills/',
                'cat welcome.txt',
                'git status'
            ];
            
            const outputs = [
                'caesar_elang_paksi',
                '/home/caesar/portfolio',
                'iot_development/\nmobile_apps/\n3d_design/\nweb_development/',
                '🚀 Welcome to Caesar\'s Portfolio!\n💻 Full-Stack Developer\n🔧 IoT Specialist\n🎨 3D Designer',
                'On branch: main\nStatus: Ready to collaborate!\n✨ All systems operational'
            ];

            let commandIndex = 0;
            let charIndex = 0;
            const typingCommand = document.getElementById('introTypingCommand');
            const terminalOutput = document.getElementById('introTerminalOutput');
            
            // Add terminal button styles
            const style = document.createElement('style');
            style.textContent = `
                .btn-close { background: #ff5f56; }
                .btn-minimize { background: #ffbd2e; }
                .btn-maximize { background: #27ca3f; }
                .prompt { color: #27ca3f; margin-right: 8px; }
                .command { color: #fff; margin-right: 4px; }
                .cursor { color: #fff; animation: blink 1s infinite; }
                @keyframes blink {
                    0%, 50% { opacity: 1; }
                    51%, 100% { opacity: 0; }
                }
                .output { color: #00d4ff; font-size: 15px; line-height: 1.5; margin-top: 8px; }
                .output-line { margin-bottom: 4px; opacity: 0; animation: fadeIn 0.5s ease forwards; }
                .success-msg { color: #27ca3f; font-weight: bold; }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateX(-10px); }
                    to { opacity: 1; transform: translateX(0); }
                }
            `;
            document.head.appendChild(style);
            
            function typeCommand() {
                if (commandIndex < commands.length) {
                    const currentCommand = commands[commandIndex];
                    
                    if (charIndex < currentCommand.length) {
                        typingCommand.textContent = currentCommand.substring(0, charIndex + 1);
                        charIndex++;
                        setTimeout(typeCommand, 100);
                    } else {
                        // Command typed, show output
                        setTimeout(() => {
                            const outputLines = outputs[commandIndex].split('\n');
                            outputLines.forEach((line, index) => {
                                setTimeout(() => {
                                    const outputLine = document.createElement('div');
                                    outputLine.className = 'output-line';
                                    outputLine.textContent = line;
                                    terminalOutput.appendChild(outputLine);
                                }, index * 300);
                            });
                            
                            setTimeout(() => {
                                commandIndex++;
                                charIndex = 0;
                                typingCommand.textContent = '';
                                
                                if (commandIndex < commands.length) {
                                    typeCommand();
                                } else {
                                    // Animation complete
                                    setTimeout(() => {
                                        document.querySelector('.cursor').style.display = 'none';
                                        const finalMsg = document.createElement('div');
                                        finalMsg.className = 'output-line success-msg';
                                        finalMsg.innerHTML = '🎉 Portfolio loaded successfully!<br/>👨‍💻 Ready for collaboration!';
                                        terminalOutput.appendChild(finalMsg);
                                        
                                        // Start loading animation
                                        setTimeout(() => {
                                            document.getElementById('loadingIndicator').style.display = 'block';
                                        }, 500);
                                        
                                        // Hide terminal intro after loading completes
                                        setTimeout(() => {
                                            document.getElementById('terminalIntro').classList.add('fade-out');
                                            setTimeout(() => {
                                                document.getElementById('terminalIntro').style.display = 'none';
                                            }, 1000);
                                        }, 4000);
                                        
                                    }, 1000);
                                }
                            }, outputLines.length * 300 + 500);
                        }, 500);
                    }
                }
            }
            
            setTimeout(typeCommand, 1000); // Start after 1 second
        }

        // Start terminal intro animation when page loads
        window.addEventListener('DOMContentLoaded', startTerminalIntroAnimation);

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.style.background = 'rgba(10, 10, 10, 0.95)';
                nav.style.backdropFilter = 'blur(20px)';
            } else {
                nav.style.background = 'rgba(10, 10, 10, 0.9)';
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Add some interactive hover effects
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-5px) scale(1)';
            });
        });

        // Handle profile image fallback
        const profileImage = document.getElementById('profileImage');
        const profileIcon = document.getElementById('profileIcon');
        
        profileImage.addEventListener('error', function() {
            this.style.display = 'none';
            profileIcon.style.display = 'flex';
        });

        profileImage.addEventListener('load', function() {
            this.style.display = 'block';
            profileIcon.style.display = 'none';
        });

        // Add click effect to CV download button
        document.querySelector('.cv-download-btn').addEventListener('click', function(e) {
            const button = this;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'translateY(-3px)';
            }, 150);
            
            // Show download notification
            const notification = document.createElement('div');
            notification.textContent = '📄 CV sedang diunduh...';
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--gradient-2);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                z-index: 10000;
                font-weight: 500;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                animation: slideIn 0.3s ease;
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        });

        // Add slide in animation for notification
        const notificationStyle = document.createElement('style');
        notificationStyle.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(notificationStyle);

        // Add ripple effect CSS
        const style = document.createElement('style');
        style.textContent = `
            .cta-button {
                position: relative;
                overflow: hidden;
            }
            
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add particle effect on scroll
        let particleId = 0;
        window.addEventListener('scroll', function() {
            if (Math.random() > 0.95) {
                createParticle();
            }
        });

        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.id = 'particle-' + particleId++;
            
            particle.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                left: ${Math.random() * window.innerWidth}px;
                top: ${Math.random() * window.innerHeight}px;
                opacity: 0.7;
                animation: particle-float 3s ease-out forwards;
            `;
            
            document.body.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 3000);
        }

        // Add particle animation CSS
        const particleStyle = document.createElement('style');
        particleStyle.textContent = `
            @keyframes particle-float {
                0% {
                    transform: translateY(0px) scale(1);
                    opacity: 0.7;
                }
                100% {
                    transform: translateY(-100px) scale(0);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(particleStyle);
    </script>
</body>
</html>
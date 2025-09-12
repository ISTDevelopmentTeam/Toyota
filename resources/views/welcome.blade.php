<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>Toyota × AAP - Premium Automotive Partnership</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        
        .hero-gradient {
            background: 
                linear-gradient(135deg, rgba(10, 10, 10, 0.75) 0%, rgba(26, 26, 46, 0.75) 25%, rgba(22, 33, 62, 0.75) 50%, rgba(15, 52, 96, 0.75) 75%, rgba(0, 0, 0, 0.75) 100%),
                url('images/test.gif') center/cover fixed;
            position: relative;
            overflow-x: hidden;
            background-attachment: fixed;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(220, 38, 127, 0.4) 0%, transparent 60%),
                radial-gradient(circle at 80% 20%, rgba(192, 192, 192, 0.3) 0%, transparent 60%),
                radial-gradient(circle at 40% 70%, rgba(255, 215, 0, 0.2) 0%, transparent 60%),
                radial-gradient(circle at 60% 40%, rgba(0, 191, 255, 0.15) 0%, transparent 50%);
            animation: ambientGlow 18s ease-in-out infinite alternate;
        }
        
        
        .floating-particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: particleFloat 15s ease-in-out infinite;
        }

.partnership-showcase:hover {
    transform: 
        perspective(1000px) 
        rotateX(5deg) 
        rotateY(-5deg) 
        translateY(-20px) 
        scale(1.02);
    box-shadow: 
        0 40px 100px rgba(255, 215, 0, 0.3),
        0 20px 50px rgba(220, 38, 127, 0.4);
}
        
    .partnership-showcase::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: url('images/palm.gif') center/120% no-repeat;
    border-radius: inherit;
    z-index: -1;
        }
        
        .partnership-content {
            position: relative;
            z-index: 3;
        }
        
        /* Partnership Benefits Grid */
        .partnership-benefit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }
        
        .benefit-highlight {
            background: 
                linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)),
                radial-gradient(circle at 30% 30%, rgba(220, 38, 127, 0.15), transparent),
                radial-gradient(circle at 70% 70%, rgba(0, 191, 255, 0.15), transparent);
            backdrop-filter: blur(30px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 40px 25px;
            text-align: center;
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.4);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .benefit-highlight::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, #dc267f, #ffd700, #00bfff, #8a2be2, #dc267f);
            background-size: 500% 500%;
            border-radius: 30px;
            opacity: 0;
            transition: opacity 0.6s ease;
            z-index: -1;
            animation: borderGlow 4s ease infinite;
        }
        
        .benefit-highlight:hover::before {
            opacity: 1;
        }
        
        .benefit-highlight:hover {
            transform: translateY(-25px) scale(1.15) rotateY(8deg) rotateX(5deg);
            box-shadow: 
                0 40px 80px rgba(255, 215, 0, 0.5),
                0 20px 40px rgba(220, 38, 127, 0.3);
        }
        
        .benefit-icon-container {
            position: relative;
            margin: 0 auto 25px;
            width: 80px;
            height: 80px;
        }
        
        .benefit-icon-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: conic-gradient(from 0deg, rgba(255, 215, 0, 0.4), rgba(220, 38, 127, 0.4), rgba(0, 191, 255, 0.4), rgba(255, 215, 0, 0.4));
            border-radius: 50%;
            animation: iconAura 6s linear infinite;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .benefit-highlight:hover .benefit-icon-container::before {
            opacity: 1;
        }
        
#forms .premium-card {
    background: 
        linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), /* Dark overlay for transparency */
        url('images/slow.gif') center/cover;
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
}
        /* Call to Action */
        .cta-button {
            background: 
                linear-gradient(135deg, #dc267f, #ff4500, #ffd700, #00bfff, #8a2be2),
                radial-gradient(circle, rgba(255, 255, 255, 0.2), transparent);
            background-size: 500% 500%, 100% 100%;
            animation: ultimateGradientShift 6s ease infinite;
            transition: all 0.6s ease;
            position: relative;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.3);
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.8s ease;
        }
        
        .cta-button:hover::before {
            left: 100%;
        }
        
        .cta-button:hover {
            transform: translateY(-8px) scale(1.08);
            box-shadow: 
                0 30px 60px rgba(220, 38, 127, 0.6),
                0 15px 30px rgba(255, 215, 0, 0.4);
            border-color: rgba(255, 215, 0, 0.8);
        }
        
        .floating-benefits-panel {
    position: fixed;
    right: -400px; /* Hide completely off-screen */
    top: 50%;
    transform: translateY(-50%);
    width: 400px;
    height: 80vh;
    z-index: 1000;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    opacity: 0; 
}
        .floating-benefits-panel.open {
    right: 20px;
    opacity: 1;
}

        .benefits-toggle {
    position: fixed;
    right: -10px; 
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 120px;
    background: linear-gradient(135deg, #dc267f, #ffd700);
    border-radius: 30px 0 0 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    writing-mode: vertical-lr;
    text-orientation: mixed;
    font-weight: 900;
    color: white;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    box-shadow: -10px 0 30px rgba(220, 38, 127, 0.3);
    transition: all 0.3s ease;
    z-index: 1001; /* Ensure it's above the panel */
}

        .benefits-toggle:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: -15px 0 40px rgba(220, 38, 127, 0.5);
         }

        
        .social-icon {
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            transform: translateY(-5px) scale(1.2);
            filter: drop-shadow(0 5px 15px rgba(255, 255, 255, 0.3));
        }
        
        .dpo-badge {
            opacity: 0.6;
            transition: all 0.3s ease;
        }
        
        .dpo-badge:hover {
            opacity: 1;
            transform: scale(1.1);
        }
        
        .logo-hover {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .logo-hover:hover {
            transform: scale(1.1) translateY(-5px);
            filter: drop-shadow(0 10px 30px rgba(255, 255, 255, 0.3));
        }
        
        .text-glow {
            text-shadow: 
                0 0 30px rgba(255, 255, 255, 0.8), 
                0 0 60px rgba(255, 215, 0, 0.6),
                0 0 90px rgba(220, 38, 127, 0.4);
        }
        
        .premium-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s ease;
        }
        
        .premium-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 191, 255, 0.2);
            border-color: rgba(0, 191, 255, 0.4);
        }

        /* Benefits Carousel Styles */
        .benefits-carousel-container {
    position: relative;
    max-width: 700px;
    height: 450px;
    overflow: hidden;
    border-radius: 25px;
    background: 
        linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)),
        url('images/cars.gif') center/cover;
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 215, 0, 0.3);
    box-shadow: 0 20px 50px rgba(220, 38, 127, 0.2);
}

       .benefits-carousel {
    display: flex;
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.4);
    height: calc(100% - 70px);
}

       .benefit-slide {
    min-width: 100%;
    padding: 20px 20px 40px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    justify-content: center;
    position: relative;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
}

        .benefit-slide.active {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(220, 38, 127, 0.05));
        }

        .benefit-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: conic-gradient(from 0deg, transparent, rgba(255, 215, 0, 0.05), transparent);
            transform: rotate(0deg);
            transition: transform 0.8s ease;
            opacity: 0;
        }

        .benefit-slide.active::before {
            transform: rotate(360deg);
            opacity: 1;
        }

        .carousel-benefit-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #dc267f, #ffd700);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            transform: scale(0.9);
            transition: all 0.6s ease;
        }

        .benefit-slide.active .carousel-benefit-icon {
            transform: scale(1);
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        }

        .carousel-benefit-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: iconRotate 4s linear infinite;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .benefit-slide.active .carousel-benefit-icon::before {
            opacity: 1;
        }

        .carousel-benefit-icon i {
            font-size: 42px;
            color: white;
            z-index: 1;
            position: relative;
        }

        .carousel-nav {
             position: absolute;
             bottom: 12px;
             left: 50%;
             transform: translateX(-50%);
             display: flex;
             gap: 6px;
             z-index: 10;
}

        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .carousel-dot.active {
            background: linear-gradient(135deg, #ffd700, #dc267f);
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
        }

        .carousel-arrows {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
            pointer-events: none;
            z-index: 10;
        }

        .carousel-arrow {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            pointer-events: all;
            color: white;
        }

        .carousel-arrow:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: rgba(255, 215, 0, 0.4);
            transform: scale(1.1);
        }

        /* 3D Coin Logo Styles */
        .central-logo-section {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 600px;
    padding: 80px 0;
    background: 
        radial-gradient(circle at center, rgba(255, 215, 0, 0.1) 0%, transparent 70%),
        radial-gradient(circle at 30% 30%, rgba(220, 38, 127, 0.05) 0%, transparent 60%),
        radial-gradient(circle at 70% 70%, rgba(0, 191, 255, 0.05) 0%, transparent 60%);
}

        .diamond-container {
    width: 320px;
    height: 320px;
    position: relative;
    cursor: pointer;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 1;
}
        
        .diamond-container:hover {
            transform: scale(1.1);
        }
        
        .diamond-frame {
            width: 100%;
            height: 100%;
            border: 6px solid #ffd700;
            border-radius: 25px;
            transform: rotate(45deg);
            position: absolute;
            box-shadow: 
                0 0 40px rgba(255, 215, 0, 0.8),
                inset 0 0 30px rgba(255, 215, 0, 0.2),
                0 0 80px rgba(220, 38, 127, 0.3);
            background: 
                linear-gradient(45deg, rgba(255, 215, 0, 0.05), rgba(220, 38, 127, 0.05)),
                radial-gradient(circle at center, rgba(255, 255, 255, 0.05), transparent);
            animation: diamondGlow 8s ease-in-out infinite alternate;
        }
        
        .diamond-frame::before {
    content: '';
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    background: url('images/move.gif') center/cover no-repeat;
    border-radius: 20px;
    z-index: -1;
    opacity: 0.7; /* Para hindi masyadong bright */
}
        
        .diamond-container:hover .diamond-frame::before {
            opacity: 1;
        }
        
        #coin-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            height: 320px;
            z-index: 5;
        }

        @keyframes diamondGlow {
            0%, 100% { 
                box-shadow: 
                    0 0 40px rgba(255, 215, 0, 0.8),
                    inset 0 0 30px rgba(255, 215, 0, 0.2),
                    0 0 80px rgba(220, 38, 127, 0.3);
            }
            50% { 
                box-shadow: 
                    0 0 60px rgba(255, 215, 0, 1),
                    inset 0 0 50px rgba(255, 215, 0, 0.3),
                    0 0 120px rgba(220, 38, 127, 0.5);
            }
        }

        @keyframes rotateBorder {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


        @keyframes ambientGlow {
            0% { transform: translateX(-15px) translateY(-15px) scale(1); }
            100% { transform: translateX(15px) translateY(15px) scale(1.03); }
        }
        
        
        @keyframes particleFloat {
            0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.4; }
            25% { transform: translateY(-40px) translateX(25px); opacity: 0.7; }
            50% { transform: translateY(-15px) translateX(-20px); opacity: 0.5; }
            75% { transform: translateY(-50px) translateX(15px); opacity: 0.6; }
        }
        
        @keyframes iconRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes ultimateBorderGlow {
            0%, 100% { 
                background-position: 0% 50%;
                transform: scale(1);
            }
            25% { 
                background-position: 25% 75%;
                transform: scale(1.02);
            }
            50% { 
                background-position: 100% 50%;
                transform: scale(1.04);
            }
            75% { 
                background-position: 75% 25%;
                transform: scale(1.02);
            }
        }

        @keyframes ultimateGradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes rainbowShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes subtitleShimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        @keyframes textGlow {
            0% { filter: brightness(1) drop-shadow(0 0 10px rgba(255, 255, 255, 0.5)); }
            100% { filter: brightness(1.3) drop-shadow(0 0 30px rgba(255, 255, 255, 0.9)); }
        }
        
        @keyframes epicTitleShine {
            0% { left: -150%; }
            30% { left: -50%; }
            70% { left: 100%; }
            100% { left: 150%; }
        }
        
        @keyframes brandAura {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes logoAura {
            0%, 100% { 
                transform: scale(1) rotate(0deg); 
                opacity: 0.6; 
            }
            50% { 
                transform: scale(1.1) rotate(180deg); 
                opacity: 0.9; 
            }
        }
        
        @keyframes logoSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes ultimateConnectorPulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 
                    0 0 60px rgba(255, 215, 0, 0.8),
                    inset 0 0 40px rgba(255, 255, 255, 0.3),
                    0 0 100px rgba(220, 38, 127, 0.6);
            }
            50% { 
                transform: scale(1.2);
                box-shadow: 
                    0 0 80px rgba(255, 215, 0, 1),
                    inset 0 0 60px rgba(255, 255, 255, 0.5),
                    0 0 120px rgba(220, 38, 127, 0.8);
            }
        }
        
        @keyframes ultimateRipple {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(3);
                opacity: 0;
            }
        }
        
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        @keyframes iconAura {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        
        @keyframes partnershipRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes borderGlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .floating-benefits-panel {
                width: calc(100vw - 40px);
                right: -100vw;
                height: 70vh;
            }

            .floating-benefits-panel.open {
                right: 20px;
            }

            .benefits-toggle {
                left: -50px;
                width: 50px;
                height: 100px;
                font-size: 12px;
            }
            
            .partnership-showcase {
                padding: 20px;
            }

            .partnership-showcase {
    background: 
        linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.5)),
        url('images/palm.gif') center/cover;
    transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
}

.partnership-showcase:hover {
    transform: translateY(-15px) scale(1.05);
    box-shadow: 
        0 30px 80px rgba(220, 38, 127, 0.4),
        0 15px 40px rgba(255, 215, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.6);
}

            .benefits-carousel-container {
                max-width: 100%;
                height: 350px;
            }
        }
        
.nav-container {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.9), rgba(26, 26, 46, 0.85));
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
}

.logo-container:hover {
    transform: scale(1.05);
}

.logo-brand {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    padding: 8px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s ease;
    cursor: pointer;
}

.logo-brand:hover {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(220, 38, 127, 0.2));
    border-color: rgba(255, 215, 0, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
}

.logo-brand img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: brightness(1.1);
}

.partnership-divider {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, #ffd700, #ff6b35, #dc267f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientShift 3s ease-in-out infinite alternate;
    text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
}

.brand-partnership {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
}

.brand-partnership::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.1), transparent);
    border-radius: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.brand-partnership:hover::before {
    opacity: 1;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-link {
    position: relative;
    color: #e5e7eb;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    transition: all 0.4s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid transparent;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(220, 38, 127, 0.1));
    border-radius: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.nav-link:hover::before {
    opacity: 1;
}

.nav-link:hover {
    color: #ffd700;
    transform: translateY(-2px);
    border-color: rgba(255, 215, 0, 0.3);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.2);
}

.nav-link.active {
    color: #ffd700;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(220, 38, 127, 0.15));
    border-color: rgba(255, 215, 0, 0.4);
}

.cta-nav-button {
    background: linear-gradient(135deg, #dc267f, #ff4500, #ffd700);
    background-size: 300% 300%;
    animation: gradientShift 4s ease infinite;
    color: white !important;
    font-weight: 800;
    padding: 0.75rem 2rem;
    border-radius: 15px;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
    transition: all 0.4s ease;
    border: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.cta-nav-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s ease;
}

.cta-nav-button:hover::before {
    left: 100%;
}

.cta-nav-button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 40px rgba(220, 38, 127, 0.4);
    border-color: rgba(255, 215, 0, 0.6);
}

.nav-diamond-container {
    width: 60px;
    height: 60px;
    position: relative;
    cursor: pointer;
    transition: all 0.4s ease;
}

.nav-diamond-container:hover {
    transform: scale(1.1);
}

.nav-diamond-frame {
    width: 100%;
    height: 100%;
    border: 3px solid #ffd700;
    border-radius: 12px;
    transform: rotate(45deg);
    position: relative;
    background: 
        linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1)),
        url('images/your-gif.gif') center/cover; /* Add your GIF here */
    box-shadow: 
        0 0 20px rgba(255, 215, 0, 0.6),
        inset 0 0 15px rgba(255, 215, 0, 0.1);
    animation: navDiamondGlow 4s ease-in-out infinite alternate;
}

#nav-coin-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    z-index: 5;
}

@keyframes navDiamondGlow {
    0% { 
        box-shadow: 
            0 0 20px rgba(255, 215, 0, 0.6),
            inset 0 0 15px rgba(255, 215, 0, 0.1);
    }
    100% { 
        box-shadow: 
            0 0 30px rgba(255, 215, 0, 0.8),
            inset 0 0 25px rgba(255, 215, 0, 0.2);
    }
}

.mobile-menu-toggle {
    display: none;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    align-items: center;
    justify-content: center;
}

.mobile-menu-toggle:hover {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(220, 38, 127, 0.2));
    border-color: rgba(255, 215, 0, 0.5);
}

.mobile-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.95), rgba(26, 26, 46, 0.95));
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.mobile-menu.active {
    display: block;
    animation: slideDown 0.3s ease;
}

.mobile-nav-link {
    display: block;
    color: #e5e7eb;
    font-weight: 600;
    text-decoration: none;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mobile-nav-link:hover {
    color: #ffd700;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(220, 38, 127, 0.05));
    padding-left: 2rem;
}

.mobile-cta {
    margin: 1rem 1.5rem;
    text-align: center;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 1024px) {
    .mobile-menu-toggle {
        display: flex;
    }
}

.back-to-top-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #dc267f, #ffd700);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: white;
    font-size: 20px;
    cursor: pointer;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 8px 25px rgba(220, 38, 127, 0.3);
}

.back-to-top-btn.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top-btn:hover {
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 15px 40px rgba(220, 38, 127, 0.5);
    background: linear-gradient(135deg, #ffd700, #dc267f);
}

.back-to-top-btn::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background: linear-gradient(45deg, #dc267f, #ffd700, #00bfff, #8a2be2);
    background-size: 400% 400%;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    animation: borderGlow 4s ease infinite;
}

.back-to-top-btn:hover::before {
    opacity: 1;
}
    </style>
</head>
<body class="hero-gradient min-h-screen">

    <div class="fixed inset-0 pointer-events-none z-0">  
       
        <div class="floating-elements">
            <div class="floating-particle w-3 h-3 top-[15%] left-[8%]" style="animation-delay: 0s;"></div>
            <div class="floating-particle w-2 h-2 top-[55%] left-[85%]" style="animation-delay: 3s;"></div>
            <div class="floating-particle w-4 h-4 top-[75%] left-[15%]" style="animation-delay: 6s;"></div>
            <div class="floating-particle w-2 h-2 top-[25%] left-[92%]" style="animation-delay: 9s;"></div>
            <div class="floating-particle w-1 h-1 top-[65%] left-[65%]" style="animation-delay: 12s;"></div>
            <div class="floating-particle w-3 h-3 top-[40%] left-[5%]" style="animation-delay: 2s;"></div>
            <div class="floating-particle w-2 h-2 top-[85%] left-[75%]" style="animation-delay: 7s;"></div>
        </div>
    </div>

    
    <nav class="nav-container relative z-20 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
       
        <div class="brand-partnership">
           <div class="nav-diamond-container">
        <div class="nav-diamond-frame">
            <div id="nav-coin-container"></div>
        </div>
    </div>
    <div class="hidden lg:block">
        <div class="text-white text-sm font-light">
            <span class="text-yellow-400 font-bold">PREMIUM</span> AUTOMOTIVE PARTNERSHIP
        </div>
    </div>
</div>

        <div class="hidden lg:flex nav-menu">
            <a href="#contact" class="nav-link active" onclick="setActiveLink(this)">
            <i class="fas fa-phone mr-2"></i>Contact
            </a>
            <a href="#about" class="nav-link" onclick="setActiveLink(this)">
             <i class="fas fa-info-circle mr-2"></i>About Us
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle lg:hidden" onclick="toggleMobileMenu()">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden">
            <a href="#about" class="mobile-nav-link" onclick="setActiveLink(this); closeMobileMenu()">
              <i class="fas fa-info-circle mr-3"></i>About Us
            </a>
            <a href="#contact" class="mobile-nav-link" onclick="setActiveLink(this); closeMobileMenu()">
                <i class="fas fa-phone mr-3"></i>Contact Us
            </a>
            <div class="mobile-cta">
                <a href="#forms" class="mobile-nav-link" onclick="setActiveLink(this); closeMobileMenu()">
                    <i class="fas fa-crown mr-2"></i>BECOME A MEMBER
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Registration/Forms Section -->

    <section id="forms" class="relative z-10 px-6 py-20">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16 section-fade-in">
                <h2 class="text-5xl md:text-7xl font-black text-white text-glow mb-6">
                    MEMBERSHIP
                    <span class="block bg-gradient-to-r from-yellow-400 via-orange-500 to-pink-500 bg-clip-text text-transparent">
                       ACTIVATION
                    </span>
                </h2>
                <p class="text-2xl text-gray-300 font-light mb-4">Start Your Premium Automotive Journey Today</p>
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-400/20 to-orange-500/20 border border-yellow-400/30 rounded-full">
                    <i class="fas fa-crown text-yellow-400 mr-3"></i>
                    <span class="text-yellow-400 font-bold">EXCLUSIVE MEMBER REGISTRATION</span>
                </div>
            </div>

            <div class="premium-card rounded-3xl p-8 section-fade-in" style="animation-delay: 0.2s;">
                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Registration Form -->
                    <div>
                        <h3 class="text-3xl font-bold text-white text-glow mb-6">
                            <i class="fas fa-user-plus mr-3 text-yellow-400"></i>
                            Member Registration
                        </h3>                    
                        
<form id="registration-form" action="{{ route('member.register') }}" method="POST" data-action="{{ route('member.register') }}" class="space-y-6">
    @csrf
    <div class="grid md:grid-cols-2 gap-4">
        <div class="form-group">
            <label class="block text-white font-semibold mb-2">
                <i class="fas fa-user mr-2 text-yellow-400"></i>
                First Name *
            </label>
            <input type="text" id="firstname" name="firstname" required 
                   class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
                   placeholder="Enter your first name">
        </div>
        
        <div class="form-group">
            <label class="block text-white font-semibold mb-2">
                <i class="fas fa-user mr-2 text-yellow-400"></i>
                Last Name *
            </label>
            <input type="text" id="lastname" name="lastname" required 
                   class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
                   placeholder="Enter your last name">
        </div>
    </div>
    
    <div class="form-group">
        <label class="block text-white font-semibold mb-2">
            <i class="fas fa-user mr-2 text-yellow-400"></i>
            Middle Name (Optional)
        </label>
        <input type="text" id="middlename" name="middlename" 
               class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
               placeholder="Enter your middle name">
    </div>
    
    <div class="form-group">
        <label class="block text-white font-semibold mb-2">
            <i class="fas fa-phone mr-2 text-yellow-400"></i>
            Contact Number *
        </label>
        <input type="tel" id="contact" name="contact" required 
               class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
               placeholder="+63 XXX XXX XXXX">
    </div>
    
    <div class="form-group">
        <label class="block text-white font-semibold mb-2">
            <i class="fas fa-envelope mr-2 text-yellow-400"></i>
            Email Address *
        </label>
        <input type="email" id="email" name="email" required 
               class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
               placeholder="your.email@example.com">
    </div>
    
    <div class="form-group">
        <div class="flex items-start space-x-3">
            <input type="checkbox" id="terms" name="terms" required 
                   class="mt-1 w-5 h-5 rounded border-2 border-white/20 bg-white/10 text-yellow-400 focus:ring-yellow-400">
            <label for="terms" class="text-gray-300 text-sm leading-relaxed">
                I agree to the <a href="https://aap.org.ph/privacy-policy" target="_blank" class="text-yellow-400 hover:text-yellow-300 underline">Privacy Policy</a>. 
                I understand that membership benefits are subject to AAP terms and conditions.
            </label>
        </div>
    </div>
    
    <button type="submit" class="cta-button w-full py-4 rounded-2xl text-white font-black text-lg">
        <i class="fas fa-rocket mr-3"></i>
        ACTIVATE
    </button>
</form>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-black/80 backdrop-blur-lg flex items-center justify-center z-50" style="display: none;">
    <div class="bg-gradient-to-br from-green-900 via-green-800 to-black rounded-3xl p-8 max-w-lg w-full mx-4 border border-green-400/30">
        <div class="text-center">
            <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl animate-pulse">
                <i class="fas fa-check-circle text-3xl text-white"></i>
            </div>
            <h2 class="text-3xl font-black text-white text-glow mb-4">Welcome to AAP!</h2>
            <p class="text-green-300 text-lg mb-4">🎉 Registration Successful! 🎉</p>
            <p class="text-gray-300 mb-6">
                Thank you for joining our premium automotive community! 
                We'll contact you within 24-48 hours to complete your membership activation.
            </p>
            
            <div class="bg-green-400/20 border border-green-400/30 rounded-xl p-4 mb-6">
                <p class="text-green-400 font-semibold text-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    Check your email for confirmation details
                </p>
            </div>
            
            <button id="close-success-btn" class="cta-button w-full py-3 rounded-xl text-white font-bold">
                <i class="fas fa-home mr-2"></i>Continue Exploring
            </button>
        </div>
    </div>
</div>
                     
                        <!-- Form Status Messages -->
                        <div id="form-success" class="hidden mt-6 p-4 bg-green-500/20 border border-green-400/50 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-400 text-xl mr-3"></i>
                                <div>
                                    <h4 class="text-green-400 font-bold">Registration Submitted Successfully!</h4>
                                    <p class="text-green-300 text-sm">We'll contact you within 24-48 hours to complete your membership activation.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div id="form-error" class="hidden mt-6 p-4 bg-red-500/20 border border-red-400/50 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-400 text-xl mr-3"></i>
                                <div>
                                    <h4 class="text-red-400 font-bold">Registration Failed</h4>
                                    <p class="text-red-300 text-sm">Please check your information and try again, or contact us directly.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Registration Benefits Summary -->
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl">
                                <i class="fas fa-crown text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white text-glow mb-4">Instant Benefits</h3>
                            <p class="text-gray-300 mb-6">Upon registration approval, you'll immediately access:</p>
                        </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-percentage text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">Exclusive Partner Discounts</h4>
                                    <p class="text-gray-400 text-sm">Up to 20% OFF on fuel, hotels, restaurants & more</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-tools text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">AAP Autocare Services</h4>
                                    <p class="text-gray-400 text-sm">10% discount on labor at certified service centers</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-globe text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">24/7 Global Support</h4>
                                    <p class="text-gray-400 text-sm">Emergency assistance and international reciprocity</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 bg-gradient-to-r from-yellow-400/20 to-orange-500/20 border border-yellow-400/30 rounded-xl mt-6">
                            <div class="text-center">
                                <h4 class="text-yellow-400 font-bold text-lg mb-2">Processing Time</h4>
                                <p class="text-white text-sm">Your membership will be activated within <strong>24-48 hours</strong> after form submission and verification.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Central 3D Logo Section -->
    <section id="about" class="central-logo-section relative z-10 px-6 py-16">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl md:text-7xl font-black text-white text-glow mb-20 mt-16">
    PARTNERSHIP
    <span class="block bg-gradient-to-r from-yellow-400 via-orange-500 to-pink-500 bg-clip-text text-transparent">
       EXCELLENCE
    </span>
</h2>
            
            <div class="diamond-container mx-auto">
                <div class="diamond-frame"></div>
                <div id="coin-container"></div>
            </div>
            
            <p class="text-xl text-gray-300 font-light mt-20 max-w-2xl mx-auto">
                Experience the synergy of Toyota's automotive excellence and AAP's comprehensive member services
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="relative z-10 px-6 py-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="section-fade-in">
                    <h2 class="text-4xl md:text-5xl font-black text-white text-glow mb-8">
                        GET IN TOUCH
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold">24/7 Hotline</p>
                                <p class="text-gray-300">+632 8-723-0808</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold">Email Support</p>
                                <p class="text-gray-300">info@aap.org.ph</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold">Emergency Services</p>
                                <p class="text-gray-300">Available 24/7 Nationwide</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-white mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <div class="social-icon w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center cursor-pointer" onclick="window.open('https://www.facebook.com/aaphilippines/', '_blank')">
                                <i class="fab fa-facebook-f text-white"></i>
                            </div>
                            <div class="social-icon w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-xl flex items-center justify-center cursor-pointer" onclick="window.open('https://www.instagram.com/aaphilippines/?hl=en', '_blank')">
                                <i class="fab fa-instagram text-white"></i>
                            </div>
                            <div class="social-icon w-12 h-12 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center cursor-pointer" onclick="window.open('https://www.youtube.com/@automobileassociationPH', '_blank')">
                                <i class="fab fa-youtube text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AAP Benefits Carousel -->
                <div class="section-fade-in" style="animation-delay: 0.3s;">
                    <div class="benefits-carousel-container mx-auto">
                        <div class="text-center p-4 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white text-glow mb-2">AAP Member Benefits</h3>
                        <p class="text-gray-300 text-sm">Discover Your Exclusive Advantages</p>
                    </div>
                        
                        <div class="benefits-carousel" id="benefits-carousel">

                            <!-- Lifestyle Partner Discounts -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">Lifestyle Partner Discounts</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Exclusive discounts on fuel, hotels, restaurants, and shopping with our extensive partner network.
                                </p>
                                <div class="text-yellow-400 font-bold">Up to 20% OFF</div>
                            </div>

                            <!-- AAP Autocare Services -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">AAP Autocare Services</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Professional automotive services with 10% discount on labor charges at certified service centers.
                                </p>
                                <div class="text-yellow-400 font-bold">10% Labor Discount</div>
                            </div>

                            <!-- Registration Assistance -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">Registration Assistance</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Skip long LTO lines with our hassle-free vehicle registration and license renewal services.
                                </p>
                                <div class="text-yellow-400 font-bold">Door-to-Door Service</div>
                            </div>

                            <!-- Free Glass Etching -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">Free Glass Etching</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Anti-theft protection with complimentary glass etching service for permanent vehicle identification.
                                </p>
                                <div class="text-yellow-400 font-bold">FREE Service</div>
                            </div>

                            <!-- Travel Assistance -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">Travel Assistance</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Complete travel support including insurance deals, emergency assistance, and partner hotel discounts.
                                </p>
                                <div class="text-yellow-400 font-bold">24/7 Support</div>
                            </div>

                            <!-- International Reciprocity -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">International Reciprocity</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Global FIA-affiliated benefits with worldwide automotive club recognition and emergency support.
                                </p>
                                <div class="text-yellow-400 font-bold">Global Coverage</div>
                            </div>

                            <!-- 24/7 Ambulance Service -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">24/7 Ambulance Service</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Discounted emergency medical transport services in Metro Manila with trained medical personnel.
                                </p>
                                <div class="text-yellow-400 font-bold">Emergency Ready</div>
                            </div>

                            <!-- AQ Magazine -->
                            <div class="benefit-slide">
                                <div class="carousel-benefit-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-white mb-4 text-glow">AQ Magazine</h4>
                                <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                    Quarterly automotive lifestyle magazine with industry insights, tips, and exclusive member features.
                                </p>
                                <div class="text-yellow-400 font-bold">Quarterly Issue</div>
                            </div>
                        </div>

                        <!-- Carousel Navigation -->
                        <div class="carousel-arrows">
                            <button class="carousel-arrow" onclick="previousBenefit()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-arrow" onclick="nextBenefit()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Carousel Dots -->
                        <div class="carousel-nav" id="carousel-nav">
                            <!-- Dots will be generated by JavaScript -->
                        </div>
                        
                        <!-- Join Now Button -->
                        <div class="text-center p-6">
                            <button class="cta-button px-8 py-3 rounded-xl text-white font-bold text-sm" onclick="scrollToForms()">
                                <i class="fas fa-crown mr-2"></i>
                                BECOME A MEMBER
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 px-6 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between text-center md:text-left mb-8">
                <div class="mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">
                        © 2025 <span class="text-white font-semibold">Toyota AAP Partnership</span>. All Rights Reserved.
                    </p>
                </div>
                
                <div class="flex items-center space-x-6 text-sm">
                    <a href="https://aap.org.ph/privacy-policy" target="_blank" class="text-gray-400 hover:text-yellow-400 transition-colors">Privacy Policy</a>
                    <span class="text-gray-600">|</span>
                    <a href="https://aap.org.ph/contactus" target="_blank" class="text-gray-400 hover:text-yellow-400 transition-colors">Contact Us</a>
                </div>
            </div>
            
            <!-- DPO/DPS Badge -->
            <div class="flex justify-center">
                <div class="dpo-badge bg-white/10 rounded-2xl p-3 cursor-pointer" onclick="window.open('images/logo-dpo-dps.pdf', '_blank')">
              <div class="w-16 h-16 rounded-xl overflow-hidden mx-auto opacity-80 hover:opacity-100 transition-opacity">
           <img src="images/logo-dpo-dps.png" alt="Data Privacy Officer Certificate" class="w-full h-full object-contain">
               </div>
        <p class="text-xs text-gray-400 mt-2 text-center">Data Privacy Certified</p>
    </div>
</div>
        </div>
    </footer>

    <!-- Benefit Detail Modal -->
    <div id="benefit-detail-modal" class="fixed inset-0 bg-black/80 backdrop-blur-lg flex items-center justify-center z-50" style="display: none;" onclick="this.style.display='none'">
        <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black rounded-3xl p-8 max-w-lg w-full mx-4 border border-yellow-400/30" onclick="event.stopPropagation()">
            <div class="text-center mb-6">
                <div id="detail-icon" class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl">
                    <i class="fas fa-star text-2xl text-white"></i>
                </div>
                <h2 id="detail-title" class="text-2xl font-black text-white text-glow mb-2">Benefit Details</h2>
            </div>
            
            <div id="detail-content" class="text-gray-300 leading-relaxed mb-8">
                <!-- Content will be populated by JavaScript -->
            </div>
            
            <div class="flex space-x-4">
                <button class="flex-1 px-6 py-3 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-800 transition-all" onclick="document.getElementById('benefit-detail-modal').style.display='none'">
                    Close
                </button>
                <button class="flex-1 cta-button px-6 py-3 rounded-xl text-white font-bold" onclick="document.getElementById('benefit-detail-modal').style.display='none'; scrollToForms()">
                    <i class="fas fa-rocket mr-2"></i>
                    Join Now
                </button>
            </div>
        </div>
    </div>
 <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top-btn">
        <i class="fas fa-chevron-up"></i>
    </button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        let scene, camera, renderer, coin;
        let navScene, navCamera, navRenderer, navCoin;
        let benefitsPanelOpen = false;
        let currentBenefitIndex = 0;
        const benefitSlides = document.querySelectorAll('.benefit-slide');
        const totalBenefits = benefitSlides.length;

        // 3D Coin Initialization
        function init3DCoin() {
            // Create scene
            scene = new THREE.Scene();
            
            // Create camera
            camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
            camera.position.z = 3;
            
            // Create renderer
            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(320, 320);
            renderer.setClearColor(0x000000, 0);
            document.getElementById('coin-container').appendChild(renderer.domElement);
            
            // Create lighting
            const ambientLight = new THREE.AmbientLight(0x404040, 0.4);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
            directionalLight.position.set(2, 2, 5);
            scene.add(directionalLight);
            
            // Create the coin
            createCoin();
            
            // Start animation
            animate3DCoin();

            initNavCoin();
        }
        
        function createCoin() {
            // Create coin geometry - thicker for better 3D effect
            const coinGeometry = new THREE.CylinderGeometry(1.5, 1.5, 0.2, 32);
            
            // Create Toyota material (front face)
            const toyotaMaterial = createToyotaMaterial();
            
            // Create AAP material (back face)
            const aapMaterial = createAAPMaterial();
            
            // Create edge material
            const edgeMaterial = new THREE.MeshPhongMaterial({
                color: 0xc0c0c0,
                shininess: 100
            });
            
            // Apply materials to coin faces
            const materials = [
                edgeMaterial,   // side
                toyotaMaterial, // top (Toyota)
                aapMaterial     // bottom (AAP)
            ];
            
            coin = new THREE.Mesh(coinGeometry, materials);
            // Set coin to stand upright (vertical position)
            coin.rotation.z = Math.PI / 2;
            scene.add(coin);
        }

        function initNavCoin() {
    // Create nav scene
    navScene = new THREE.Scene();
    
    // Create nav camera
    navCamera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
    navCamera.position.z = 2;
    
    // Create nav renderer
    navRenderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    navRenderer.setSize(50, 50);
    navRenderer.setClearColor(0x000000, 0);
    document.getElementById('nav-coin-container').appendChild(navRenderer.domElement);
    
    // Create lighting for nav coin
    const navAmbientLight = new THREE.AmbientLight(0x404040, 0.4);
    navScene.add(navAmbientLight);
    
    const navDirectionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
    navDirectionalLight.position.set(2, 2, 5);
    navScene.add(navDirectionalLight);
    
    // Create the nav coin
    createNavCoin();
}

function createNavCoin() {
    // Create smaller coin geometry for navigation
    const navCoinGeometry = new THREE.CylinderGeometry(0.8, 0.8, 0.15, 32);
    
    // Create materials
    const navToyotaMaterial = createToyotaMaterial();
    const navAAPMaterial = createAAPMaterial();
    const navEdgeMaterial = new THREE.MeshPhongMaterial({
        color: 0xc0c0c0,
        shininess: 100
    });
    
    const navMaterials = [
        navEdgeMaterial,   // side
        navToyotaMaterial, // top (Toyota)
        navAAPMaterial     // bottom (AAP)
    ];
    
    navCoin = new THREE.Mesh(navCoinGeometry, navMaterials);
    navCoin.rotation.z = Math.PI / 2;
    navScene.add(navCoin);
}

        
        function createToyotaMaterial() {
    // Load your image
    const loader = new THREE.TextureLoader();
    const texture = loader.load('images/toyota-red.png');
    
    return new THREE.MeshPhongMaterial({ 
        map: texture, 
        shininess: 50 
    });
}
        
        function createAAPMaterial() {
    const loader = new THREE.TextureLoader();
    const texture = loader.load('images/aap-logo.png');
    
    return new THREE.MeshPhongMaterial({ 
        map: texture, 
        shininess: 50 
    });
}
        
        function animate3DCoin() {
            if (navCoin) {
    navCoin.rotation.y += 0.03;
    navRenderer.render(navScene, navCamera);
}
            requestAnimationFrame(animate3DCoin);
            
            // Rotate the coin
            coin.rotation.y += 0.03;
            
            renderer.render(scene, camera);
        }

        // Initialize carousel
        function initBenefitsCarousel() {
            const carousel = document.getElementById('benefits-carousel');
            const nav = document.getElementById('carousel-nav');
            
            // Generate navigation dots
            for (let i = 0; i < totalBenefits; i++) {
                const dot = document.createElement('div');
                dot.className = `carousel-dot ${i === 0 ? 'active' : ''}`;
                dot.onclick = () => goToBenefit(i);
                nav.appendChild(dot);
            }
            
            // Auto-rotate carousel
            setInterval(() => {
                nextBenefit();
            }, 5000);
        }

        function updateCarousel() {
            const carousel = document.getElementById('benefits-carousel');
            const dots = document.querySelectorAll('.carousel-dot');
            
            // Update carousel position
            carousel.style.transform = `translateX(-${currentBenefitIndex * 100}%)`;
            
            // Update active slide
            benefitSlides.forEach((slide, index) => {
                slide.classList.toggle('active', index === currentBenefitIndex);
            });
            
            // Update active dot
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentBenefitIndex);
            });
        }

        function nextBenefit() {
            currentBenefitIndex = (currentBenefitIndex + 1) % totalBenefits;
            updateCarousel();
        }

        function previousBenefit() {
            currentBenefitIndex = (currentBenefitIndex - 1 + totalBenefits) % totalBenefits;
            updateCarousel();
        }

        function goToBenefit(index) {
            currentBenefitIndex = index;
            updateCarousel();
        }

        function scrollToForms() {
            const formsSection = document.getElementById('forms');
            if (formsSection) {
                formsSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        function showBenefitDetail(benefitId) {
            const benefits = {
                'discounts': {
                    title: 'Lifestyle Partner Discounts',
                    icon: 'fas fa-percentage',
                    content: `
                        <p class="mb-4"><strong>Exclusive Savings on:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li><strong>Fuel:</strong> Discounts at major gas stations</li>
                            <li><strong>Hotels:</strong> Special rates at partner accommodations</li>
                            <li><strong>Restaurants:</strong> Dining discounts at selected establishments</li>
                            <li><strong>Car Maintenance:</strong> Parts and service discounts</li>
                            <li><strong>Shopping:</strong> Retail partner discounts</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Save up to 20% on everyday expenses!</p>
                    `
                },
                'autocare': {
                    title: 'AAP Autocare Services',
                    icon: 'fas fa-tools',
                    content: `
                        <p class="mb-4"><strong>Professional Automotive Services:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li><strong>10% discount</strong> on labor charges</li>
                            <li>Certified technicians and mechanics</li>
                            <li>Quality parts and genuine accessories</li>
                            <li>Multiple service centers nationwide</li>
                            <li>Express service options available</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Keep your Toyota running at peak performance!</p>
                    `
                },
                'registration': {
                    title: 'Registration Assistance',
                    icon: 'fas fa-file-alt',
                    content: `
                        <p class="mb-4"><strong>Hassle-Free LTO Services:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li>Vehicle registration renewal assistance</li>
                            <li>License renewal support</li>
                            <li>Documentation processing</li>
                            <li>Skip the long LTO lines</li>
                            <li>Door-to-door pickup and delivery available</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Save time and avoid the bureaucratic hassle!</p>
                    `
                },
                'glass-etching': {
                    title: 'Free Glass Etching',
                    icon: 'fas fa-car',
                    content: `
                        <p class="mb-4"><strong>Anti-Theft Protection Service:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li><strong>FREE</strong> glass etching service</li>
                            <li>Permanent identification marking</li>
                            <li>Deters vehicle theft and carjacking</li>
                            <li>Professional installation</li>
                            <li>Increases vehicle security</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Protect your investment with this complimentary service!</p>
                    `
                },
                'travel': {
                    title: 'Travel Assistance',
                    icon: 'fas fa-plane',
                    content: `
                        <p class="mb-4"><strong>Complete Travel Support:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li>Comprehensive travel guides and tips</li>
                            <li>Best deals on travel insurance</li>
                            <li>Partner hotel and resort discounts</li>
                            <li>Emergency assistance while traveling</li>
                            <li>Travel documentation support</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Travel with confidence and peace of mind!</p>
                    `
                },
                'international': {
                    title: 'International Reciprocity',
                    icon: 'fas fa-globe',
                    content: `
                        <p class="mb-4"><strong>Global FIA Network Benefits:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li>Worldwide automotive club recognition</li>
                            <li>International driving assistance</li>
                            <li>Emergency roadside support abroad</li>
                            <li>Travel routing and information</li>
                            <li>Access to partner club facilities</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Drive worry-free anywhere in the world!</p>
                    `
                },
                'ambulance': {
                    title: '24/7 Ambulance Service',
                    icon: 'fas fa-ambulance',
                    content: `
                        <p class="mb-4"><strong>Emergency Medical Transport:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li>Discounted ambulance rates in Metro Manila</li>
                            <li>Partnership with Aeromed services</li>
                            <li>24/7 emergency response</li>
                            <li>Trained medical personnel</li>
                            <li>Modern emergency equipment</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Emergency medical care when you need it most!</p>
                    `
                },
                'magazine': {
                    title: 'AQ Magazine',
                    icon: 'fas fa-book',
                    content: `
                        <p class="mb-4"><strong>Quarterly Automotive Publication:</strong></p>
                        <ul class="list-disc list-inside space-y-2 mb-4">
                            <li>Latest club news and updates</li>
                            <li>Automotive industry insights</li>
                            <li>Member spotlight features</li>
                            <li>Motoring tips and advice</li>
                            <li>Partner promotions and deals</li>
                        </ul>
                        <p class="text-yellow-400 font-semibold">Stay informed about automotive trends and club activities!</p>
                    `
                }
            };

            const benefit = benefits[benefitId];
            if (benefit) {
                document.getElementById('detail-title').textContent = benefit.title;
                document.getElementById('detail-icon').innerHTML = `<i class="${benefit.icon} text-2xl text-white"></i>`;
                document.getElementById('detail-content').innerHTML = benefit.content;
                document.getElementById('benefit-detail-modal').style.display = 'flex';
            }
        }

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

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-fade-in').forEach(el => {
            observer.observe(el);
        });

        let mobileMenuOpen = false;

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const toggle = document.querySelector('.mobile-menu-toggle i');
            
            mobileMenuOpen = !mobileMenuOpen;
            
            if (mobileMenuOpen) {
                mobileMenu.classList.add('active');
                toggle.classList.remove('fa-bars');
                toggle.classList.add('fa-times');
            } else {
                mobileMenu.classList.remove('active');
                toggle.classList.remove('fa-times');
                toggle.classList.add('fa-bars');
            }
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const toggle = document.querySelector('.mobile-menu-toggle i');
            
            mobileMenuOpen = false;
            mobileMenu.classList.remove('active');
            toggle.classList.remove('fa-times');
            toggle.classList.add('fa-bars');
        }

        function setActiveLink(clickedLink) {
            // Remove active class from all nav links
            document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to clicked link
            clickedLink.classList.add('active');
            
            // Also set active for corresponding desktop/mobile link
            const href = clickedLink.getAttribute('href');
            document.querySelectorAll(`[href="${href}"]`).forEach(link => {
                if (link.classList.contains('nav-link') || link.classList.contains('mobile-nav-link')) {
                    link.classList.add('active');
                }
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const mobileMenu = document.getElementById('mobile-menu');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (mobileMenuOpen && !mobileMenu.contains(e.target) && !toggle.contains(e.target)) {
                closeMobileMenu();
            }
        });

        // Auto-set active link based on scroll position
        window.addEventListener('scroll', function() {
            const sections = ['home', 'contact', '3d'];
            const scrollPos = window.scrollY + 100;
            
            sections.forEach(section => {
                const element = document.getElementById(section);
                if (element) {
                    const offsetTop = element.offsetTop;
                    const offsetBottom = offsetTop + element.offsetHeight;
                    
                    if (scrollPos >= offsetTop && scrollPos < offsetBottom) {
                        document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
                            link.classList.remove('active');
                        });
                        
                        document.querySelectorAll(`[href="#${section}"]`).forEach(link => {
                            if (link.classList.contains('nav-link') || link.classList.contains('mobile-nav-link')) {
                                link.classList.add('active');
                            }
                        });
                    }
                }
            });
        });

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            init3DCoin();
            initBenefitsCarousel();
            initBackToTop();
        });
    // Back to Top Functionality
function initBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    // Smooth scroll to top when clicked
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Form Submission Handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registration-form');
    const successModal = document.getElementById('success-modal');
    const closeSuccessBtn = document.getElementById('close-success-btn');
    const formError = document.getElementById('form-error');

    // Close success modal
    closeSuccessBtn.addEventListener('click', function() {
        successModal.style.display = 'none';
    });

    // Close modal when clicking outside
    successModal.addEventListener('click', function(e) {
        if (e.target === successModal) {
            successModal.style.display = 'none';
        }
    });

    // Form submission handler
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>PROCESSING...';
        
        // Clear previous error states
        clearFormErrors();
        hideErrorMessage();
        
        try {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!csrfToken) {
                throw new Error('CSRF token not found. Please refresh the page.');
            }
            
            // Prepare form data
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('firstname', document.getElementById('firstname').value.trim());
            formData.append('lastname', document.getElementById('lastname').value.trim());
            formData.append('middlename', document.getElementById('middlename').value.trim());
            formData.append('contact', document.getElementById('contact').value.trim());
            formData.append('email', document.getElementById('email').value.trim());
            
            // Add terms agreement
            if (document.getElementById('terms').checked) {
                formData.append('terms', '1');
            }
            
            // Submit to Laravel backend
            const actionUrl = form.dataset.action;
            const response = await fetch("{{ route('member.register') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });
            
            const result = await response.json();
            
            if (response.ok && result.success) {
                // Success - show celebration effect and modal
                showSuccessCelebration();
                setTimeout(() => {
                    showSuccessModal(result);
                }, 1000);
                
                form.reset();
                
            } else {
                // Handle validation errors
                if (result.errors) {
                    displayFormErrors(result.errors);
                } else {
                    showErrorMessage(result.message || 'Registration failed. Please try again.');
                }
                
                // Shake form on error
                shakeForm();
            }
            
        } catch (error) {
            console.error('Registration error:', error);
            
            let errorMessage = 'An unexpected error occurred. Please try again.';
            
            if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                errorMessage = 'Connection error. Please check your internet connection and try again.';
            } else if (error.message.includes('CSRF')) {
                errorMessage = 'Security token expired. Please refresh the page and try again.';
            }
            
            showErrorMessage(errorMessage);
            shakeForm();
            
        } finally {
            // Restore button
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }, 1000);
        }
    });
});

// Enhanced success modal display
function showSuccessModal(result) {
    const modal = document.getElementById('success-modal');
    const memberName = result.data ? result.data.full_name : 'New Member';
    
    // Update modal content with personalized message
    const modalContent = modal.querySelector('.text-center');
    const nameElement = modalContent.querySelector('h2');
    const messageElement = modalContent.querySelector('p:nth-of-type(1)');
    
    if (nameElement && result.data) {
        nameElement.textContent = `Welcome ${result.data.full_name.split(' ')[0]}!`;
    }
    
    modal.style.display = 'flex';
    modal.style.opacity = '0';
    
    // Animate modal appearance
    setTimeout(() => {
        modal.style.transition = 'opacity 0.4s ease';
        modal.style.opacity = '1';
    }, 100);
}

// Success celebration animation
function showSuccessCelebration() {
    // Create celebration elements
    for (let i = 0; i < 15; i++) {
        createCelebrationElement(i * 100);
    }
    
    // Play success sound (optional)
    if (typeof Audio !== 'undefined') {
        try {
        } catch (e) {
            // Sound failed, continue silently
        }
    }
}

function createCelebrationElement(delay) {
    setTimeout(() => {
        const celebration = document.createElement('div');
        celebration.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background: linear-gradient(45deg, #ffd700, #ff6b35, #dc267f);
            border-radius: 50%;
            pointer-events: none;
            z-index: 10000;
            animation: celebrationBounce 2s ease-out forwards;
        `;
        
        document.body.appendChild(celebration);
        
        // Remove element after animation
        setTimeout(() => {
            if (celebration.parentNode) {
                celebration.parentNode.removeChild(celebration);
            }
        }, 2000);
    }, delay);
}

// Form validation error display
function displayFormErrors(errors) {
    // Clear previous errors
    clearFormErrors();
    
    Object.keys(errors).forEach(fieldName => {
        const field = document.getElementById(fieldName);
        const errorMessages = errors[fieldName];
        
        if (field && errorMessages.length > 0) {
            // Add error styling to field
            field.classList.add('border-red-500', 'bg-red-500/10');
            field.classList.remove('border-white/20');
            
            // Create error message element
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error-message text-red-400 text-sm mt-2';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${errorMessages[0]}`;
            
            // Insert error message after field
            field.parentNode.appendChild(errorDiv);
        }
    });
    
    // Scroll to first error
    const firstError = document.querySelector('.field-error-message');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function clearFormErrors() {
    // Remove error styling from all fields
    const fields = ['firstname', 'lastname', 'middlename', 'contact', 'email'];
    fields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) {
            field.classList.remove('border-red-500', 'bg-red-500/10');
            field.classList.add('border-white/20');
        }
    });
    
    // Remove all error messages
    document.querySelectorAll('.field-error-message').forEach(el => el.remove());
}

function showErrorMessage(message) {
    const errorDiv = document.getElementById('form-error');
    if (errorDiv) {
        errorDiv.querySelector('p').textContent = message;
        errorDiv.classList.remove('hidden');
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Auto-hide after 8 seconds
        setTimeout(() => {
            hideErrorMessage();
        }, 8000);
    }
}

function hideErrorMessage() {
    const errorDiv = document.getElementById('form-error');
    if (errorDiv) {
        errorDiv.classList.add('hidden');
    }
}

function shakeForm() {
    const form = document.getElementById('registration-form');
    if (form) {
        form.style.animation = 'shake 0.6s ease-in-out';
        setTimeout(() => {
            form.style.animation = '';
        }, 600);
    }
}
    </script>
</body>
</html>     
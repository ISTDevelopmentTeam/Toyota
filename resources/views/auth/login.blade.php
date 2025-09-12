<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Toyota x AAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'toyota-red': '#eb0a1e',
                        'toyota-dark': '#1a1a1a',
                        'premium-gold': '#ffd700',
                        'premium-orange': '#ff8c00',
                        'deep-blue': '#0a0e27',
                        'accent-purple': '#6366f1'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 8s ease-in-out infinite',
                        'glow-pulse': 'glow-pulse 2s ease-in-out infinite alternate',
                        'shimmer': 'shimmer 3s infinite',
                        'slide-up': 'slide-up 0.8s ease-out',
                        'fade-in': 'fade-in 1s ease-out',
                        'bounce-subtle': 'bounce-subtle 2s infinite',
                        'rotate-slow': 'rotate-slow 20s linear infinite',
                        'scale-pulse': 'scale-pulse 2s ease-in-out infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-20px) rotate(5deg)' }
                        },
                        'glow-pulse': {
                            'from': { 
                                'box-shadow': '0 0 30px rgba(255, 215, 0, 0.3), 0 0 60px rgba(255, 140, 0, 0.2)',
                                'filter': 'brightness(1)'
                            },
                            'to': { 
                                'box-shadow': '0 0 50px rgba(255, 215, 0, 0.6), 0 0 100px rgba(255, 140, 0, 0.4)',
                                'filter': 'brightness(1.2)'
                            }
                        },
                        shimmer: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' }
                        },
                        'slide-up': {
                            'from': { transform: 'translateY(50px)', opacity: '0' },
                            'to': { transform: 'translateY(0)', opacity: '1' }
                        },
                        'fade-in': {
                            'from': { opacity: '0' },
                            'to': { opacity: '1' }
                        },
                        'bounce-subtle': {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-5px)' }
                        },
                        'rotate-slow': {
                            'from': { transform: 'rotate(0deg)' },
                            'to': { transform: 'rotate(360deg)' }
                        },
                        'scale-pulse': {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-morphism {
            background: rgba(15, 23, 42, 0.2);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-morphism-strong {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(32px);
            -webkit-backdrop-filter: blur(32px);
            border: 2px solid rgba(255, 215, 0, 0.1);
        }
        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.6), transparent);
            background-size: 200px 100%;
            animation: shimmer 3s infinite;
            position: absolute;
            inset: 0;
            border-radius: inherit;
        }
        .floating-particles {
            position: absolute;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            pointer-events: none;
            top: 0;
            left: 0;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, #ffd700, #ff8c00);
            opacity: 0.6;
        }
        .particle:nth-child(1) { 
            width: 6px; height: 6px; left: 10%; top: 20%;
            animation: float 8s infinite linear;
            animation-delay: 0s; 
        }
        .particle:nth-child(2) { 
            width: 4px; height: 4px; left: 80%; top: 80%;
            animation: float 12s infinite linear;
            animation-delay: 2s; 
        }
        .particle:nth-child(3) { 
            width: 8px; height: 8px; left: 60%; top: 10%;
            animation: float 10s infinite linear;
            animation-delay: 4s; 
        }
        .particle:nth-child(4) { 
            width: 5px; height: 5px; left: 20%; top: 70%;
            animation: float 15s infinite linear;
            animation-delay: 1s; 
        }
        .particle:nth-child(5) { 
            width: 7px; height: 7px; left: 90%; top: 30%;
            animation: float 9s infinite linear;
            animation-delay: 3s; 
        }
        
        .input-glow:focus {
            box-shadow: 0 0 0 4px rgba(235, 10, 30, 0.1), 0 0 20px rgba(255, 215, 0, 0.3);
        }
        
        .button-hover-effect {
            position: relative;
            overflow: hidden;
        }
        
        .button-hover-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .button-hover-effect:hover::before {
            left: 100%;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        .typing-animation {
            overflow: hidden;
            white-space: nowrap;
            animation: typing 2s steps(40, end);
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.3);
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #ffd700, #ff8c00);
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-deep-blue to-slate-800 min-h-screen relative">
    <!-- Enhanced Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-deep-blue via-slate-900 to-black opacity-90 overflow-hidden"></div>
    
    <!-- Floating Particles Background -->
    <div class="floating-particles fixed inset-0 z-0 overflow-hidden">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Enhanced Gradient Orbs - Fixed positioning to prevent overflow -->
    <div class="fixed top-0 left-0 w-80 h-80 bg-gradient-to-r from-toyota-red/20 via-premium-gold/15 to-premium-orange/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float z-0 transform -translate-x-1/2 -translate-y-1/2"></div>
    <div class="fixed bottom-0 right-0 w-80 h-80 bg-gradient-to-r from-premium-gold/15 via-toyota-red/20 to-premium-orange/15 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-delayed z-0 transform translate-x-1/2 translate-y-1/2"></div>
    <div class="fixed top-1/2 left-1/2 w-60 h-60 bg-gradient-to-r from-toyota-red/10 to-premium-gold/15 rounded-full mix-blend-multiply filter blur-2xl opacity-40 animate-rotate-slow z-0 transform -translate-x-1/2 -translate-y-1/2"></div>

    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-lg w-full space-y-6 animate-slide-up">
            <!-- Enhanced Header -->
            <div class="text-center animate-fade-in">
                <!-- Logo Section -->
                <div class="flex justify-center mb-8">
                    <div class="relative group cursor-pointer">
                        <!-- Outer rotating ring -->
                        <div class="absolute -inset-4 bg-gradient-to-r from-premium-gold via-premium-orange to-premium-gold rounded-full animate-rotate-slow opacity-60 blur-sm"></div>
                        <!-- Middle glow ring -->
                        <div class="absolute -inset-2 bg-gradient-to-r from-premium-gold/50 to-premium-orange/50 rounded-full animate-glow-pulse"></div>
                        <!-- Logo container -->
                        <div class="relative bg-gradient-to-br from-toyota-red via-premium-gold to-premium-orange p-5 rounded-3xl transform rotate-12 group-hover:rotate-0 transition-transform duration-700 animate-scale-pulse shadow-2xl">
                            <div class="w-16 h-16 bg-gradient-to-br from-toyota-dark via-slate-800 to-deep-blue rounded-2xl transform -rotate-12 group-hover:rotate-0 transition-transform duration-700 flex items-center justify-center shadow-inner border border-toyota-red/20">
                                <span class="text-premium-gold font-black text-3xl transform group-hover:scale-110 transition-transform duration-300">T</span>
                            </div>
                        </div>
                        <!-- Inner sparkle effect -->
                        <div class="absolute inset-3 bg-gradient-to-r from-premium-gold/20 to-premium-orange/20 rounded-3xl blur-lg animate-bounce-subtle"></div>
                    </div>
                </div>
                
                <!-- Title with enhanced effects -->
                <div class="relative mb-6">
                    <h2 class="text-5xl font-black bg-gradient-to-r from-toyota-red via-premium-gold to-premium-orange bg-clip-text text-transparent mb-3 tracking-wider relative">
                        <span class="typing-animation">Admin Portal</span>
                        <div class="absolute -inset-2 bg-gradient-to-r from-toyota-red/20 to-premium-gold/20 rounded-lg blur-xl opacity-50"></div>
                    </h2>
                    <div class="text-xl bg-gradient-to-r from-gray-200 via-white to-gray-300 bg-clip-text text-transparent font-semibold tracking-wide">
                        Toyota × AAP Management System
                    </div>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-toyota-red via-premium-gold to-premium-orange mx-auto mt-4 rounded-full shadow-lg">
                        <div class="h-full bg-gradient-to-r from-white/50 to-transparent rounded-full shimmer-effect"></div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Login Form -->
            <div class="glass-morphism-strong rounded-3xl p-10 shadow-2xl relative overflow-hidden group hover:shadow-premium-gold/20 transition-all duration-500">
                <!-- Enhanced shimmer effect -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity duration-500">
                    <div class="shimmer-effect"></div>
                </div>
                
                <!-- Decorative corner elements -->
                <div class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-toyota-red/15 to-transparent rounded-br-full"></div>
                <div class="absolute bottom-0 right-0 w-20 h-20 bg-gradient-to-tl from-premium-gold/15 to-transparent rounded-tl-full"></div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-8 relative z-10">
                    @csrf

                    <!-- Enhanced Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-500/10 backdrop-blur-sm border-l-4 border-red-500 rounded-2xl p-5 animate-slide-up shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-red-400 rounded-full animate-ping"></div>
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <p class="text-red-300 font-medium">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-500/10 backdrop-blur-sm border-l-4 border-red-500 rounded-2xl p-5 animate-slide-up shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-red-400 rounded-full animate-ping"></div>
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <p class="text-red-300 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div class="space-y-3">
                        <label for="email" class="block text-sm font-bold text-premium-gold mb-3 tracking-wide uppercase">
                            <span class="flex items-center space-x-2">
                                <span>Email Address</span>
                                <div class="w-1 h-1 bg-premium-orange rounded-full animate-bounce-subtle"></div>
                            </span>
                        </label>
                        <div class="relative group">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   class="input-glow w-full px-6 py-5 bg-slate-800/60 backdrop-blur-sm border-2 border-slate-600/40 rounded-2xl text-white placeholder-gray-400 focus:ring-0 focus:border-toyota-red/80 transition-all duration-300 hover:border-toyota-red/50 hover:bg-slate-800/80 text-lg font-medium"
                                   placeholder="Enter your email address">
                            <!-- Input decoration -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-toyota-red/5 via-transparent to-premium-gold/5 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <!-- Focus indicator -->
                            <div class="absolute -bottom-1 left-0 h-0.5 bg-gradient-to-r from-toyota-red to-premium-gold transform scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-3">
                        <label for="password" class="block text-sm font-bold text-premium-gold mb-3 tracking-wide uppercase">
                            <span class="flex items-center space-x-2">
                                <span>Password</span>
                                <div class="w-1 h-1 bg-premium-orange rounded-full animate-bounce-subtle" style="animation-delay: 0.5s;"></div>
                            </span>
                        </label>
                        <div class="relative group">
                            <input id="password" name="password" type="password" required
                                   class="input-glow w-full px-6 py-5 bg-slate-800/60 backdrop-blur-sm border-2 border-slate-600/40 rounded-2xl text-white placeholder-gray-400 focus:ring-0 focus:border-toyota-red/80 transition-all duration-300 hover:border-toyota-red/50 hover:bg-slate-800/80 text-lg font-medium"
                                   placeholder="Enter your password">
                            <!-- Input decoration -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-toyota-red/5 via-transparent to-premium-gold/5 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <!-- Focus indicator -->
                            <div class="absolute -bottom-1 left-0 h-0.5 bg-gradient-to-r from-toyota-red to-premium-gold transform scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Enhanced Options -->
                    <div class="flex items-center justify-between pt-4">
                        <div class="flex items-center group">
                            <div class="relative">
                                <input id="remember" name="remember" type="checkbox"
                                       class="h-5 w-5 text-premium-gold focus:ring-premium-gold/50 border-slate-500 rounded-lg bg-slate-700/60 backdrop-blur-sm transition-all duration-200">
                                <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-premium-gold/10 to-premium-orange/10 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            </div>
                            <label for="remember" class="ml-3 block text-sm text-gray-200 font-semibold hover:text-premium-gold transition-colors duration-200">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-sm text-premium-gold hover:text-premium-orange transition-all duration-200 font-semibold hover:underline decoration-2 underline-offset-4">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Enhanced Submit Button -->
                    <button type="submit"
                            class="button-hover-effect group relative w-full bg-gradient-to-r from-toyota-red via-premium-gold to-premium-orange hover:from-premium-gold hover:via-toyota-red hover:to-premium-orange text-white font-black py-6 px-8 rounded-2xl transition-all duration-500 transform hover:scale-105 hover:shadow-2xl hover:shadow-toyota-red/30 shadow-xl text-lg tracking-wide uppercase overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center space-x-3">
                            <span>Sign In to Dashboard</span>
                            <div class="w-2 h-2 bg-white rounded-full group-hover:animate-bounce"></div>
                        </span>
                        <!-- Button glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <!-- Button shadow -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-toyota-red to-premium-gold rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                    </button>
                </form>

                <!-- Enhanced Footer -->
                <div class="mt-10 pt-8 border-t border-premium-gold/10 relative">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-0.5 bg-gradient-to-r from-transparent via-premium-gold to-transparent"></div>
                    <p class="text-center text-sm text-gray-300 font-medium">
                        🔐 Secured by 
                        <span class="text-premium-gold font-bold bg-gradient-to-r from-premium-gold to-premium-orange bg-clip-text text-transparent">
                            Toyota Security Standards
                        </span>
                    </p>
                    <div class="mt-3 flex justify-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce-subtle"></div>
                        <div class="w-2 h-2 bg-premium-gold rounded-full animate-bounce-subtle" style="animation-delay: 0.2s;"></div>
                        <div class="w-2 h-2 bg-premium-orange rounded-full animate-bounce-subtle" style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
            </div>

            <!-- Additional Status Indicator -->
            <div class="text-center animate-fade-in" style="animation-delay: 0.5s;">
                <div class="inline-flex items-center space-x-2 px-4 py-2 bg-green-500/10 rounded-full border border-green-500/20 backdrop-blur-sm">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-ping"></div>
                    <span class="text-green-300 text-sm font-medium">System Online</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript for interactions -->
    <script>
        // Add smooth focus transitions
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });

        // Add button click effect
        document.querySelector('button[type="submit"]').addEventListener('click', function() {
            this.classList.add('animate-pulse');
            setTimeout(() => {
                this.classList.remove('animate-pulse');
            }, 300);
        });

        // Add typing effect to title (rerun on page load)
        window.addEventListener('load', function() {
            const title = document.querySelector('.typing-animation');
            title.style.animation = 'none';
            setTimeout(() => {
                title.style.animation = 'typing 2s steps(40, end)';
            }, 500);
        });
    </script>
</body>
</html>
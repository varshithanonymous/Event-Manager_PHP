<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHorizons - Discover & Host</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6', // Teal
                            600: '#0d9488',
                            900: '#134e4a',
                        },
                        dark: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>



    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a; /* dark-900 */
            color: #f8fafc;
        }
        .glass-nav {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">

<nav class="glass-nav fixed w-full z-50 top-0 left-0 transition-all duration-300" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-brand-500 to-purple-500 flex items-center justify-center">
                   <i data-lucide="sparkles" class="text-white w-5 h-5"></i>
                </div>
                <span class="font-bold text-xl tracking-tight text-white">Event<span class="text-brand-500">Horizons</span></span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="<?php echo BASE_URL; ?>" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                    <a href="<?php echo BASE_URL; ?>explore" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Explore</a>
                    <a href="<?php echo BASE_URL; ?>events/create" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Create Event</a>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center gap-3">
                 <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>profile" class="flex items-center gap-2 text-gray-300 hover:text-white transition">
                        <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-8 h-8 rounded-full border border-gray-600">
                    </a>
                    <a href="<?php echo BASE_URL; ?>logout" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-full text-sm font-medium transition border border-gray-700">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>login" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Log In</a>
                    <a href="<?php echo BASE_URL; ?>login" class="bg-brand-600 hover:bg-brand-500 text-white px-5 py-2 rounded-full text-sm font-medium shadow-lg shadow-brand-500/20 transition transform hover:scale-105">Sign Up</a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button @click="mobileOpen = !mobileOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                    <span class="sr-only">Open main menu</span>
                     <i x-show="!mobileOpen" data-lucide="menu" class="block h-6 w-6"></i>
                     <i x-show="mobileOpen" data-lucide="x" class="block h-6 w-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-transition class="md:hidden bg-dark-900 border-b border-gray-800">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="<?php echo BASE_URL; ?>" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="<?php echo BASE_URL; ?>explore" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Explore</a>
             <a href="<?php echo BASE_URL; ?>events/create" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Create Event</a>
             <?php if(isset($_SESSION['user_id'])): ?>
                <a href="<?php echo BASE_URL; ?>logout" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Logout</a>
             <?php else: ?>
                <a href="<?php echo BASE_URL; ?>login" class="text-brand-500 block px-3 py-2 rounded-md text-base font-medium">Sign In</a>
             <?php endif; ?>
        </div>
    </div>
</nav>

<main class="flex-grow pt-16">

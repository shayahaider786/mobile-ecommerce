<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SDVAD - Mobile & Electronics')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Swiper CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-800 bg-gray-50 flex flex-col min-h-screen">

    <!-- ================= NAVBAR ================= -->
    @include('layouts.partials.navbar')


    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-slate-900 text-slate-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Brand -->
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">ShopEase.</h2>
                    <p class="text-sm text-slate-400 mb-4">Your one-stop destination for premium quality products. We
                        deliver happiness to your doorstep.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-white">Fb</a>
                        <a href="#" class="text-slate-400 hover:text-white">Tw</a>
                        <a href="#" class="text-slate-400 hover:text-white">Ig</a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Shop</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-white transition">Sale</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition">Shipping Policy</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Newsletter</h3>
                    <p class="text-sm text-slate-400 mb-3">Subscribe for latest updates.</p>
                    <form class="flex">
                        <input type="email" placeholder="Email address"
                            class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-l-md text-sm focus:outline-none focus:border-indigo-500">
                        <button type="submit"
                            class="bg-indigo-600 px-4 py-2 rounded-r-md text-white text-sm hover:bg-indigo-700 transition">Go</button>
                    </form>
                </div>

            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} ShopEase. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Mobile Menu JS Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>

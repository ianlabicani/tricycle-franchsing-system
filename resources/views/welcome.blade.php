@extends('shell')

@section('title', 'Tricycle Franchising Management System')


@section('content')

    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Tricycle Franchise Logo" class="h-12 w-12 rounded-full object-cover">
                    <span class="text-xl font-bold text-gray-800">Tricycle Franchise System</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium transition">About</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 font-medium transition">Features</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
                </div>
                <div class="flex space-x-3">
                    @auth
                    @if (Auth::user()->hasRole('driver'))
                        <a href="{{ route('driver.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">Dashboard</a>
                    @endif

                    @if (Auth::user()->hasRole('sb_staff'))
                        <a href="{{ route('sb.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">Dashboard</a>
                    @endif
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center text-white">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/tricycle-bg.jpg') }}');">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-700 opacity-90"></div>
        </div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">Tricycle Franchising Management System</h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">Streamline your tricycle franchise operations with our comprehensive management platform.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#about" class="bg-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105">Learn More</a>
                <a href="#contact" class="bg-white text-gray-800 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105">Get Started</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">About the System</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('images/tricycle-fleet.jpg') }}" alt="Tricycle Fleet" class="rounded-lg shadow-xl w-full h-96 object-cover">
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Our Mission & Vision</h3>
                    <p class="text-gray-600 text-lg mb-4 leading-relaxed">
                        Our Tricycle Franchising Management System is designed to streamline and modernize the operations of tricycle franchises. We provide a comprehensive platform that connects drivers, inspectors, treasury staff, and administrators in one unified system.
                    </p>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        Through digital transformation, we aim to improve efficiency, transparency, and accountability in tricycle franchise management.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-2xl font-bold text-blue-600 mb-2">100+</h4>
                            <p class="text-gray-600">Active Drivers</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-2xl font-bold text-blue-600 mb-2">6</h4>
                            <p class="text-gray-600">User Roles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">System Features & User Roles</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Comprehensive tools for every stakeholder in the franchise ecosystem.</p>
            </div>

            <!-- User Roles Showcase -->
            <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-2xl shadow-2xl p-8 mb-12 text-white">
                <div class="text-center mb-8">
                    <i class="fas fa-users-cog text-5xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">Multi-Role Access System</h3>
                    <p class="text-blue-100">Different access levels for different responsibilities</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">�</div>
                        <h4 class="text-xl font-bold mb-3">Driver</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>View routes & schedules</p>
                            <p>Submit daily reports</p>
                            <p>Track earnings</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">🔍</div>
                        <h4 class="text-xl font-bold mb-3">Inspector</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>Vehicle inspections</p>
                            <p>Compliance monitoring</p>
                            <p>Safety audits</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">�</div>
                        <h4 class="text-xl font-bold mb-3">Treasury Staff</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>Payment processing</p>
                            <p>Financial reports</p>
                            <p>Revenue tracking</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">📋</div>
                        <h4 class="text-xl font-bold mb-3">SB Staff</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>Administrative tasks</p>
                            <p>Documentation</p>
                            <p>Record management</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">⛪</div>
                        <h4 class="text-xl font-bold mb-3">Priest</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>Oversight & guidance</p>
                            <p>Approvals</p>
                            <p>Policy review</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-20 transition">
                        <div class="text-4xl mb-3">👑</div>
                        <h4 class="text-xl font-bold mb-3">Super Admin</h4>
                        <div class="space-y-2 text-blue-100 text-sm">
                            <p>Full system access</p>
                            <p>User management</p>
                            <p>System configuration</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Fleet Management -->
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-car text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Fleet Management</h3>
                    <p class="text-gray-600 mb-4">Track and manage your entire tricycle fleet in real-time with detailed vehicle information and status updates.</p>
                    <p class="text-blue-600 font-semibold">Real-time Monitoring</p>
                </div>

                <!-- Financial Tracking -->
                <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Financial Tracking</h3>
                    <p class="text-gray-600 mb-4">Comprehensive financial management with automated reporting, payment tracking, and revenue analytics.</p>
                    <p class="text-green-600 font-semibold">Automated Reports</p>
                </div>

                <!-- Compliance & Safety -->
                <div class="bg-gradient-to-br from-purple-50 to-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Compliance & Safety</h3>
                    <p class="text-gray-600 mb-4">Ensure regulatory compliance and safety standards through systematic inspections and documentation.</p>
                    <p class="text-purple-600 font-semibold">Safety First</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Get in Touch</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Have questions about our system? Contact us for demos, support, or partnership inquiries.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div class="space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Address</h4>
                            <p class="text-gray-600">123 Franchise Center<br>Your City, State 12345</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Phone</h4>
                            <p class="text-gray-600">+1 (234) 567-8900</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Email</h4>
                            <p class="text-gray-600">support@tricyclefranchise.com</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Support Hours</h4>
                            <p class="text-gray-600">Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition" placeholder="john@example.com" required>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition" placeholder="How can we help you?" required>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition" placeholder="Your message here..." required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- About Column -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Tricycle Franchise Logo" class="h-10 w-10 rounded-full object-cover">
                        <h3 class="text-xl font-bold">Tricycle Franchise</h3>
                    </div>
                    <p class="text-gray-400">Modernizing tricycle franchise management through digital innovation.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Features</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Features -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Key Features</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Fleet Management</li>
                        <li>Financial Tracking</li>
                        <li>Compliance Monitoring</li>
                        <li>Multi-Role Access</li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Tricycle Franchising Management System. All rights reserved. Built with innovation and efficiency.</p>
            </div>
        </div>
    </footer>

    <!-- Smooth Scroll Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navHeight = 64; // Height of fixed navbar
                    const targetPosition = target.offsetTop - navHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

@endsection

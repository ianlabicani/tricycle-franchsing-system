@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Help & Support</h1>
        <p class="text-gray-600 mt-2">Find answers to your questions or contact our support team</p>
    </div>

    <!-- Quick Contact Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-phone text-3xl"></i>
                </div>
                <div>
                    <p class="text-blue-100 text-sm">Call Us</p>
                    <p class="text-xl font-bold">+63 123 456 7890</p>
                    <p class="text-blue-100 text-xs mt-1">Mon-Fri, 8AM-5PM</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-envelope text-3xl"></i>
                </div>
                <div>
                    <p class="text-green-100 text-sm">Email Us</p>
                    <p class="text-lg font-bold">support@franchise.com</p>
                    <p class="text-green-100 text-xs mt-1">24/7 Response</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-map-marker-alt text-3xl"></i>
                </div>
                <div>
                    <p class="text-purple-100 text-sm">Visit Us</p>
                    <p class="text-lg font-bold">Main Office</p>
                    <p class="text-purple-100 text-xs mt-1">123 Franchise Center</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FAQ Section -->
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Frequently Asked Questions</h2>

                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="border-b border-gray-200 pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">How long does the application process take?</h3>
                                <p class="text-sm text-gray-600 mt-2">The entire franchise application process typically takes 2-3 weeks from submission to approval, depending on document verification and inspection scheduling.</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">What documents do I need to submit?</h3>
                                <p class="text-sm text-gray-600 mt-2">You need: Valid Driver's License, Vehicle OR/CR, Police Clearance, Barangay Clearance, and Medical Certificate. All documents must be valid and not expired.</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">How much is the total franchise fee?</h3>
                                <p class="text-sm text-gray-600 mt-2">The total franchise fee is ₱8,500.00 which includes inspection fee (₱1,500), processing fee (₱2,000), and annual franchise fee (₱5,000).</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">Can I reschedule my inspection?</h3>
                                <p class="text-sm text-gray-600 mt-2">Yes, you can reschedule your inspection up to 48 hours before the scheduled time. Go to the Inspection page and click "Reschedule".</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">What payment methods are accepted?</h3>
                                <p class="text-sm text-gray-600 mt-2">We accept over-the-counter payments at the Treasury Office, GCash, PayMaya, and bank transfers. Online payment is available after inspection approval.</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>

                    <div class="pb-4">
                        <button class="w-full text-left flex items-start justify-between group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">How often do I need to renew my franchise?</h3>
                                <p class="text-sm text-gray-600 mt-2">Franchises must be renewed annually. You'll receive reminders 90 days and 30 days before expiration. Renewal process is similar to initial application.</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 mt-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Send Us a Message</h2>

                <form class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Juan Dela Cruz">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="juan@email.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option>Select a topic</option>
                            <option>Application Issues</option>
                            <option>Payment Questions</option>
                            <option>Inspection Concerns</option>
                            <option>Document Verification</option>
                            <option>Technical Support</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Please describe your concern or question..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i>Send Message
                    </button>
                </form>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Quick Links -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Links</h2>

                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-book text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">User Guide</p>
                            <p class="text-xs text-gray-500">Step-by-step instructions</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Download Forms</p>
                            <p class="text-xs text-gray-500">Application forms & templates</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-video text-purple-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Video Tutorials</p>
                            <p class="text-xs text-gray-500">How-to videos</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-gavel text-orange-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Terms & Policies</p>
                            <p class="text-xs text-gray-500">Rules and regulations</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Office Hours -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Office Hours</h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">Monday - Friday</span>
                        <span class="font-semibold text-gray-800">8:00 AM - 5:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">Saturday</span>
                        <span class="font-semibold text-gray-800">9:00 AM - 2:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Sunday & Holidays</span>
                        <span class="font-semibold text-red-600">Closed</span>
                    </div>
                </div>
            </div>

            <!-- Support Status -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex items-center space-x-2 mb-2">
                    <i class="fas fa-check-circle text-green-600"></i>
                    <p class="font-semibold text-green-800 text-sm">Support Available</p>
                </div>
                <p class="text-green-700 text-xs">Our support team is currently online and ready to help you.</p>
            </div>

        </div>
    </div>

@endsection

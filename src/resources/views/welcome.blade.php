<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased">
    <!-- Hero Section -->
    <section id="hero" class="bg-blue-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Our Company</h1>
            <p class="text-lg mb-6">Your trusted partner in success.</p>
            <a href="#about" class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold">Learn More</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">About Us</h2>
            <p class="text-lg text-gray-700">We are a leading company in our industry, committed to delivering high-quality services and solutions to our clients.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="service-item bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Service 1</h3>
                    <p class="text-gray-700">Description of Service 1.</p>
                </div>
                <div class="service-item bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Service 2</h3>
                    <p class="text-gray-700">Description of Service 2.</p>
                </div>
                <div class="service-item bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Service 3</h3>
                    <p class="text-gray-700">Description of Service 3.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Contact Us</h2>
            <p class="text-lg text-gray-700 mb-6">Have questions? Reach out to us!</p>
            <form action="/contact" method="POST" class="max-w-lg mx-auto">
                @csrf
                <input type="text" name="name" placeholder="Your Name" required class="w-full mb-4 px-4 py-2 border rounded-lg">
                <input type="email" name="email" placeholder="Your Email" required class="w-full mb-4 px-4 py-2 border rounded-lg">
                <textarea name="message" placeholder="Your Message" required class="w-full mb-4 px-4 py-2 border rounded-lg"></textarea>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold">Send Message</button>
            </form>
        </div>
    </section>
</body>
</html>

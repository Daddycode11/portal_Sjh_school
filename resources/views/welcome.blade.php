<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>San Jose National High School Student Portal</title>

  <!-- Tailwind + DaisyUI -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap');

    body {
      font-family: 'Outfit', sans-serif;
      scroll-behavior: smooth;
      overflow-x: hidden;
      background-color: #f8fafc;
    }

    .font-playfair { font-family: 'Playfair Display', serif; }

    /* Scroll Progress Bar */
    #progress-bar {
      position: fixed;
      top: 0;
      left: 0;
      height: 4px;
      background: linear-gradient(90deg, #16a34a, #a7f3d0);
      width: 0%;
      z-index: 60;
      transition: width 0.1s linear;
    }

    /* Glass Navbar */
    .nav-glass {
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 50;
      backdrop-filter: blur(14px) saturate(180%);
      background: rgba(25, 35, 25, 0.45);
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
      transition: all 0.4s ease;
      animation: slideDown 1.2s ease forwards;
      opacity: 0;
    }
    .nav-glass.scrolled {
      background: rgba(20, 40, 25, 0.85);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.35);
    }
    @keyframes slideDown {
      from { transform: translateY(-30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0%;
      height: 2px;
      background-color: #6ee7b7;
      transition: width 0.3s ease;
    }
    .nav-link:hover::after { width: 100%; }
    .nav-link:hover { color: #6ee7b7; }

    /* Hero Section */
    .hero-bg {
      position: relative;
      height: 100vh;
      overflow: hidden;
      background: #000;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero-bg::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image: url('https://tse4.mm.bing.net/th/id/OIP.vvk6LCWqWBhEguDnh-R3kQHaEK?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3');
      background-size: cover;
      background-position: center;
      transform: scale(1);
      animation: zoomIn 30s ease-in-out infinite alternate;
      z-index: 1;
    }
    @keyframes zoomIn {
      from { transform: scale(1); }
      to { transform: scale(1.18); }
    }
    .hero-bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0, 50, 30, 0.35), rgba(0, 0, 0, 0.9)),
                  rgba(110, 231, 183, 0.08);
      z-index: 2;
    }

    .hero-content {
      position: relative;
      z-index: 3;
      text-align: center;
      color: #fff;
      max-width: 750px;
      padding: 2rem;
      backdrop-filter: blur(4px);
      background: rgba(6, 95, 70, 0.15);
      border-radius: 1.25rem;
      animation: fadeUp 1.6s ease forwards 0.5s;
      opacity: 0;
      transform: translateY(40px);
    }
    @keyframes fadeUp {
      to { opacity: 1; transform: translateY(0); }
    }

    /* Button Glow */
    .btn-glow {
      transition: all 0.3s ease;
    }
    .btn-glow:hover {
      transform: translateY(-3px);
      box-shadow: 0 0 20px rgba(110, 231, 183, 0.5);
    }

    /* Scroll Animation for Sections */
    .slide-in {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.9s cubic-bezier(0.25, 1, 0.3, 1);
    }
    .slide-visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Footer Gradient */
    .footer-gradient {
      background: linear-gradient(135deg, #064e3b, #065f46);
    }

    /* Parallax Effect */
    .parallax {
      transform: translateY(0px);
      transition: transform 0.3s ease-out;
    }
  </style>
</head>

<body>
  <!-- Scroll Progress Bar -->
  <div id="progress-bar"></div>

  <!-- Navbar -->
  <nav class="nav-glass">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
      <a href="#" class="flex items-center gap-2 font-playfair text-lg md:text-xl font-bold text-white tracking-wide">
        <i class="fa-solid fa-graduation-cap text-green-300"></i>
        SJ National High School
      </a>
      <div class="hidden md:flex gap-8 text-gray-200 font-medium">
        <a href="#" class="nav-link">Home</a>
        <a href="#features" class="nav-link">Academics</a>
        <a href="#" class="nav-link">Research</a>
        <a href="#" class="nav-link">Campus Life</a>
      </div>
      <div>
        <a href="{{ route('login.form') }}"
          class="btn bg-green-400 hover:bg-green-500 text-white font-semibold rounded-full btn-glow">
          Access Portal
        </a>
      </div>
    </div>
  </nav>
!-- HERO SECTION -->
<section class="hero-bg">
  <div class="hero-content parallax flex flex-col items-center justify-center text-center">
    <div class="space-y-4">
      <h1 class="text-5xl md:text-7xl font-playfair drop-shadow-lg leading-tight">
        Empowering Digital Education
      </h1>
      <h2 class="text-2xl md:text-3xl font-semibold text-green-200 drop-shadow-md">
        San Jose National High School Student Portal
      </h2>
      <p class="text-lg md:text-xl text-gray-100 leading-relaxed max-w-2xl mx-auto">
        Inspiring Excellence through Technology and Innovation.
      </p>
    </div>

    <!-- Buttons (Fade-Up Animation) -->
    <div class="button-group flex flex-col sm:flex-row justify-center gap-4 mt-10 opacity-0 translate-y-6 transition-all duration-1000 ease-out">
      <a href="{{ route('login.form') }}"
        class="btn bg-green-400 text-white font-semibold border-none rounded-full hover:bg-green-500 btn-glow">
        Enter Portal
      </a>
      <a href="#features"
        class="btn btn-outline border-white text-white rounded-full hover:bg-white hover:text-green-700 font-semibold">
        Explore Features
      </a>
    </div>
  </div>
</section>


  <!-- Features -->
  <section id="features" class="py-20 bg-gray-50 text-center">
    <h2 class="text-4xl font-playfair mb-12 text-green-700 fade-up">Portal Capabilities</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all slide-in">
        <i class="fa-solid fa-medal text-5xl text-green-500 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">Academic Excellence</h3>
        <p class="text-gray-600">Track grades, attendance, and academic performance with transparency.</p>
      </div>
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all slide-in">
        <i class="fa-solid fa-users text-5xl text-green-500 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">Community Engagement</h3>
        <p class="text-gray-600">Unite teachers and students through a connected, interactive platform.</p>
      </div>
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all slide-in">
        <i class="fa-solid fa-book-open text-5xl text-green-500 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">Research Resources</h3>
        <p class="text-gray-600">Explore e-libraries and archives with seamless academic access.</p>
      </div>
    </div>
  </section>
<!-- Portal Overview Section -->
<section id="overview" class="py-20 bg-white text-center">
  <div class="max-w-6xl mx-auto px-6 slide-in">
    <h2 class="text-4xl font-playfair mb-8 text-green-700">Portal Overview</h2>
    <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
      The <span class="font-semibold text-green-700">San Jose National High School Student Portal</span> is an integrated digital platform designed to enhance communication, streamline academic processes, and support digital learning.  
      It empowers students, teachers, and administrators by providing easy access to grades, announcements, research materials, and interactive campus updates—all within a single, secure system.
    </p>
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-10">
      <div class="p-6 bg-green-50 rounded-2xl shadow-md hover:shadow-xl transition-all">
        <i class="fa-solid fa-user-graduate text-4xl text-green-600 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">For Students</h3>
        <p class="text-gray-600">View grades, assignments, schedules, and academic achievements conveniently online.</p>
      </div>
      <div class="p-6 bg-green-50 rounded-2xl shadow-md hover:shadow-xl transition-all">
        <i class="fa-solid fa-chalkboard-teacher text-4xl text-green-600 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">For Teachers</h3>
        <p class="text-gray-600">Post announcements, manage class records, and connect with students effectively.</p>
      </div>
      <div class="p-6 bg-green-50 rounded-2xl shadow-md hover:shadow-xl transition-all">
        <i class="fa-solid fa-school text-4xl text-green-600 mb-4"></i>
        <h3 class="text-2xl font-semibold mb-2">For Administrators</h3>
        <p class="text-gray-600">Monitor performance, manage data, and maintain secure information flow across departments.</p>
      </div>
    </div>
  </div>
</section>

<!-- User Manual Section -->
<section id="manual" class="py-20 bg-gray-50 text-center">
  <div class="max-w-6xl mx-auto px-6 slide-in">
    <h2 class="text-4xl font-playfair mb-8 text-green-700">User Manual</h2>
    <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto mb-10">
      Follow this simple guide to get started with the Student Portal.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">1. Login / Register</h3>
        <p class="text-gray-600">Access the portal using your official school credentials. New users must register first to activate their accounts.</p>
      </div>
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">2. Update Your Profile</h3>
        <p class="text-gray-600">Fill in or update your personal and academic information to ensure accuracy and security.</p>
      </div>
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">3. Explore Features</h3>
        <p class="text-gray-600">Navigate through modules like Grades, Announcements, Research, and Campus Life to stay informed.</p>
      </div>
      <div class="p-8 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all md:col-span-3">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">4. Stay Updated</h3>
        <p class="text-gray-600">Check regularly for new announcements, updates, and academic opportunities within the portal dashboard.</p>
      </div>
    </div>
  </div>
</section>

  <!-- Footer -->
  <footer class="footer p-10 footer-gradient text-gray-300">
    <div>
      <span class="footer-title text-white font-playfair">Our School</span>
      <a class="link link-hover">About Us</a>
      <a class="link link-hover">Programs</a>
      <a class="link link-hover">Research</a>
      <a class="link link-hover">Community</a>
    </div>
    <div>
      <span class="footer-title text-white font-playfair">Portal</span>
      <a class="link link-hover">Features</a>
      <a class="link link-hover">Support</a>
      <a class="link link-hover">Guidelines</a>
      <a class="link link-hover">Privacy</a>
    </div>
    <div>
      <span class="footer-title text-white font-playfair">Contact</span>
      <a class="link link-hover">San Jose, Philippines</a>
      <a class="link link-hover">info@sjnational.edu</a>
      <a class="link link-hover">+63 900 123 4567</a>
      <div class="flex gap-4 mt-2">
        <a><i class="fab fa-facebook-f hover:text-green-400"></i></a>
        <a><i class="fab fa-twitter hover:text-green-400"></i></a>
        <a><i class="fab fa-linkedin hover:text-green-400"></i></a>
        <a><i class="fab fa-youtube hover:text-green-400"></i></a>
      </div>
    </div>
  </footer>
  <footer class="footer footer-center p-4 bg-black text-gray-400">
    <p>© 2025 San Jose National High School. All rights reserved.</p>
  </footer>

<script>
  // Fade-up button animation on load
  window.addEventListener('load', () => {
    const btnGroup = document.querySelector('.button-group');
    setTimeout(() => {
      btnGroup.classList.remove('opacity-0', 'translate-y-6');
      btnGroup.classList.add('opacity-100', 'translate-y-0');
    }, 800); // Delay to sync with text fade
  });
</script>
  <!-- Scripts -->
  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
      const nav = document.querySelector('.nav-glass');
      nav.classList.toggle('scrolled', window.scrollY > 30);
    });

    // Scroll progress bar
    const progressBar = document.getElementById('progress-bar');
    window.addEventListener('scroll', () => {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      progressBar.style.width = (scrollTop / docHeight) * 100 + "%";
    });

    // Section reveal animation
    const slides = document.querySelectorAll('.slide-in');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('slide-visible');
      });
    }, { threshold: 0.2 });
    slides.forEach(el => observer.observe(el));

    // Parallax hero text
    const heroContent = document.querySelector('.parallax');
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY;
      heroContent.style.transform = `translateY(${scrollY * 0.25}px)`;
    });
  </script>
</body>
</html>

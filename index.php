<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aplikasi Pengaduan Masyarakat</title>

  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="css/output.css" />

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />

  <!-- Font Google -->
  <link
    href="css/font.css"
    rel="stylesheet" />

  <!-- Remixicons -->
  <link href="css/remixicon.css" rel="stylesheet" />

  <!-- Boxicons -->
  <link href="css/boxicons2.min.css" rel="stylesheet" />

  <!-- Drop Down Menu -->
  <link href="css/tailwind.min.css" rel="stylesheet">
  <script defer src="js/cdn.min.js"></script>

  <script>
    if (localStorage.theme === "dark" || (!("theme" in localStorage) && window.matchMedia(
        "(prefers-color-scheme: dark)").matches)) {
      document.documentElement.classList.add("dark");
    } else {
      document.documentElement.classList.remove("dark");
    }
  </script>

  <!-- Scroll Reveal JS -->
  <script src="js/scrollreveal.min.js"></script>

  <!-- CSS untuk ikon pesan mengambang -->
  <style>
    /* Gaya untuk ikon pesan mengambang */
    .floating-whatsapp {
      position: fixed;
      width: 60px;
      height: 60px;
      bottom: 40px;
      right: 40px;
      background-color: #25D366;
      color: #FFF;
      border-radius: 50px;
      text-align: center;
      font-size: 30px;
      box-shadow: 2px 2px 3px #999;
      z-index: 1000;
    }

    .floating-whatsapp img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
    }
  </style>
</head>

<body class="scrollbar">
  <!-- Navbar Section -->
  <header class="header-nav">
    <nav class="container">
      <div class="container flex items-center justify-between mx-auto">
	<!-- Theme Change Button -->
        <div class="flex">
          <!-- <span class="mr-2 font-poppins text-sm text-primary">Mode</span>
          <input type="checkbox" class="hidden" id="dark-toggle" />
          <label for="dark-toggle">
            <div class="flex h-5 w-10 cursor-pointer items-center rounded-full bg-slate-400 p-0.5">
              <div class="toggle-circle h-4 w-4 rounded-full bg-white transition duration-300">
                <span class="flex items-center justify-center text-base text-yellow-500 dark:text-darkTheme">
                  <i class="bx bxs-sun" id="iconNow"></i>
                </span>
              </div>
            </div>
          </label> -->
        </div>
        <a href='cek.php' class="btn-ghost">Masuk / Daftar</a>
        <!-- Nav Menu -->
        <div class="nav-menu">
          <ul class="nav-list">
            <a href="#home" class="nav-link active-link"><i class="ri-home-4-fill"></i><span
                class="nav-name">Beranda</span></a>
            <a href="#about" class="nav-link"><i class="ri-user-3-fill"></i><span class="nav-name">Tentang</span></a>
            <a href="#alur" class="nav-link"><i class="ri-book-2-fill"></i><span class="nav-name">Alur</span></a>
            <a href="#contact" class="nav-link"><i class="ri-message-2-fill"></i><span
                class="nav-name">Hubungi</span></a>
            <svg class="indicator" width="94" height="56" xmlns="http://www.w3.org/2000/svg">
              <ellipse cx="47" cy="28" rx="24" ry="28" />
              <path d="M24 20C24 20 28 55.9999 48 56L0 55.9997C18 55.9998 24 20 24 20Z" />
              <path d="M70 20C70 20 66 55.9999 46 56L94 55.9997C76 55.9998 70 20 70 20Z" />
            </svg>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section id="home" class="dark-mode py-28">
    <div class="container">
      <!-- Automatic Column View -->
      <div class="flex flex-wrap">
        <!-- Greetings -->
        <div class="home-greets">
          <h1 class="dark-mode-text my-1 block text-4xl font-bold text-dark lg:text-[40px]">Sistem Pengaduan Masyarakat</h1>
          <h3 class="dark-mode-text mb-5 text-base font-semibold text-secondary md:text-lg">(RT 5 Kupang Praupan 1)
          </h3>
          <p class="dark-mode-text mb-10 text-base leading-relaxed text-secondary md:text-base">
            <span class="font-bold md:text-xl">"</span>Yuk.... kenali apa itu Pengaduan dan bagaimana cara melakukan pengaduan, pilih aja menu yang tersedia<span
              class="font-bold md:text-xl">"</span>
            <br />
            <!-- <span class="text-red-500">*</span><span class="text-sm">Attention, please use this file </span><span class="text-sm font-semibold">according to the applicable procedure</span> -->
          </p>
          <!-- <a download="Nope" href="" class="btn-ghost mb-10"><i
              class="bx bxs-download bx-burst mr-2"></i>Nope</a> -->
          <a href="#contact" class="btn-ghost">Kontak</a>
        </div>
        <!-- Profile Img -->
        <div class="home-image">
          <div class="relative mt-10 lg:right-0 lg:mt-0">
            <img src="img/kup1.jpeg" alt="profile-img"
              class="mx-auto max-w-full rounded-xl dark:relative dark:z-10" width="700" />
            <span class="absolute bottom-5 left-1/2 -z-10 -translate-x-1/2 dark:z-0 md:scale-110 lg:scale-125">
              <!--<img src="dist/img/blob.svg" alt="blob" />-->
              <!-- <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill="#77bef8"
                    d="M67.6,-22.3C74.6,-0.5,58.2,28.5,35.2,44.2C12.2,59.9,-17.4,62.3,-39.8,47.7C-62.2,33.1,-77.3,1.5,-69.5,-21.4C-61.7,-44.4,-30.8,-58.7,-0.3,-58.6C30.3,-58.5,60.6,-44,67.6,-22.3Z"
                    transform="translate(300 300) scale(1.1)"
                  />
                </svg> -->
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <style>
  .text-title, .text-subtitle {
    color: white;
  }
</style>

<section id="about" class="dark-mode py-24">
    <div class="container">
      <div class="title-main">
        <h2 class="text-title">PENGADUAN MASYARAKAT</h2>
        <br>
        <span class="text-subtitle block mb-6 text-base text-secondary md:text-lg">Selamat datang di Website Pengaduan RT 5 Kupang Praupan 1, 
          dimana disediakan untuk menjebatani sekaligus memudahkan masyarakat RT 5 khususnya untuk melayangkan aspirasi, saran, kritik, pengaduan kepada pengurus RT 5 Kupang Praupan 1 kota Surabaya. 
          Silahkan layangkan pengaduan anda untuk RT 5 Kupang Praupan 1 yang lebih baik.</span>
      </div>
    </div>
</section>


  <!-- Skill Section -->
  <section id="alur" class="dark-mode py-24">
    <div class="container">
      <div class="title-main">
        <h2 class="text-title">Alur Pengaduan</h2>
      </div>

      <div class="skill-data">
        <!-- Frontend -->
        <div class="w-full py-4 px-2 md:w-5/2 lg:w-5/2 xl:w-5/3">
          <div class="skill-card">
            <div class="pt-5 pb-7 text-center">
              <h3 class="skill-title">Alur Pengaduan</h3>
            </div>
            <div class="flex flex-wrap px-2 pb-5">
              <div class="w-5/2">
                <div class="skill-list">
                  <i class="text-3xl text-[#E34F26]"></i>
                  <span class="skill-list-name">1. Input pengaduan anda dengan login website</span>
                </div>
                <div class="skill-list">
                  <i class="text-3xl text-[#1572B6]"></i>
                  <span class="skill-list-name">2. Pengaduan telah diterima dan diverifikasi</span>
                </div>
                <div class="skill-list">
                  <i class="text-3xl text-[#7952B3]"></i>
                  <span class="skill-list-name">3. Pengaduan akan didisposisi ke ODP terkait</span>
                </div>
                <div class="skill-list">
                  <i class="text-3xl text-[#06B6D4]"></i>
                  <span class="skill-list-name">4. Pengaduan akan ditindaklanjuti oleh ODP dan menjawab pengaduan masyarakat</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="dark-mode pt-24 pb-28">
    <div class="container">
      <div class="title-main">
        <h2 class="text-title">Kontak</h2>
        <span class="text-subtitle block">RT 5 KUPANG PRAUPAN 1</span>
      </div>
      <div class="contact-data">
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://maps.app.goo.gl/6256qpD9sGyoTNCQ7" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/icon/location.gif" alt="phone" width="80px">
              <i class="bx bxl-location text-6xl lg:text-8xl"></i>
              <h3 class="contact-title">Location</h3>
              <span class="contact-subtitle">Jl. Kupang Praupan 1, Kec. Tegalsari kota Surabaya, Jawa Timur</span>
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="mailto:kupangpraupan1@gmail.com" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/icon/email.gif" alt="phone" width="100px">
              <i class="bx bxl-email text-6xl lg:text-8xl"></i>
              <h3 class="contact-title">Email</h3>
              <span class="contact-subtitle">kupangpraupan1@gmail.com</span>
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://kupangpraupan1.my.id" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/icon/browser.gif" alt="phone" width="100px">
              <i class="bx bxl-website text-6xl lg:text-8xl"></i>
              <h3 class="contact-title">Website</h3>
              <span class="contact-subtitle">kupangpraupan1.my.id</span>
            </div>
          </a>
        </div>
        <!--<div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="#" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/icon/phone.gif" alt="phone" width="100px">
              <i class="bx bxl-phone text-6xl lg:text-8xl"></i>
              <h3 class="contact-title">Telepon/Whatsapp</h3>
              <span class="contact-subtitle">(0831)47635527</span>
            </div>-->
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section 2-->
  <section id="contact" class="dark-mode pt-24 pb-28">
    <div class="container">
      <div class="title-main">
        <h2 class="text-title">Galeri</h2>
        <span class="text-subtitle block">RT 5 KUPANG PRAUPAN 1</span>
      </div>
      <div class="contact-data">
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup1.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="mailto:kupangpraupan1@gmail.com" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup2.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://kupangpraupan1.my.id" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup6.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://kupangpraupan1.my.id" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup3.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://kupangpraupan1.my.id" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup4.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="https://kupangpraupan1.my.id" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/kup5.jpeg" alt="phone" width="300px">
            </div>
          </a>
        </div>
        <!--<div class="w-full p-4 md:w-1/2 lg:w-1/2 xl:w-1/3">
          <a href="#" target="_blank" class="contact-icons">
            <div class="contact-card hover:border-[#33cccc] hover:text-[#33cccc]"> <img align="center" src="img/icon/phone.gif" alt="phone" width="100px">
              <i class="bx bxl-phone text-6xl lg:text-8xl"></i>
              <h3 class="contact-title">Telepon/Whatsapp</h3>
              <span class="contact-subtitle">(0831)47635527</span>
            </div>-->
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="dark-mode py-24">
    <div class="container">
      <div class="title-main">
        <h2 class="text-title">Struktur Kepengurusan RT 5 Kupang Praupan 1</h2>
        <br>
        <img src="img/strukturrt.png" alt="profile-img"
              class="mx-auto max-w-full rounded-xl dark:relative dark:z-10" width="400" />
      </div>
    </div>
</section>

  <!-- Footer -->
  <footer class="bg-primary pt-16 pb-12">
    <div class="container">

      <div class="w-full border-t border-slate-400 pt-10">
        <span class="ml-4 text-sm text-icons">&#169; 2024 <span class="font-semibold">Pengurus RT 5 Kupang Praupan 1</span>. All Rights
          Reserved</span>
      </div>
      <!-- <ul class="text-icons text-sm flex justify-start gap-6 mb-1">
          <li><a href="#about" class="footer-link">About</a></li>
          <li><a href="#portfolio" class="footer-link">Portfolio</a></li>
        </ul> -->
    </div>
  </footer>

  <!-- Ikon Pesan Mengambang -->
  <a href="https://wa.me/6282257006430?text=Halo!%20Selamat%20datang%20di%20Pusat%20bantuan%20Pengaduan%20Masyarakat%20RT%205%20Kupang%20Praupan%201.%20Silahkan%20Tuliskan%20Pertanyaan%20Anda" class="floating-whatsapp" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp">
</a>

  <!-- JS -->
  <script src="js/main.js"></script>

  <!-- Swiper JS -->
  <script src="js/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    let swiperPortfolio = new Swiper(".portfolio-list", {
      spaceBetween: 24,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
      },
    });
  </script>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $title ?? 'Tri Virya Nusantara' }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('/front/img/LOGO TVN.png')}}" rel="icon">
  <link href="{{asset('/front/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('/front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/front/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('/front/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('/front/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('/front/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('/front/css/main.css')}}" rel="stylesheet">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    @livewireStyles
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{asset('/front/img/LOGO TVN.png')}}" alt="Tri Virya Nusantara Logo" rel="icon">
        <h1 class="sitename">Tri Virya Nusantara</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
            <li><a href="{{ route('home') }}#about">Tentang Kami</a></li>
          <li><a href="{{ route('home') }}#services">Layanan</a></li>
          <li><a href="{{ route('home') }}#portfolio">Proyek</a></li>
          <li><a href="{{ route('home') }}#team">Tim</a></li>
          <li class="dropdown"><a href="#"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Berita</a></li>
              <li><a href="#">Lowongan Pekerjaan</a></li>
            </ul>
          </li>
          <li><a href="{{ route('home') }}#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      {{-- <a class="cta-btn" href="index.html#about">Get Started</a> --}}

    </div>
  </header>

  {{ $slot }}

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Tri Virya Nusantara</span>
          </a>
          <div class="footer-contact pt-3">
          @if ($contact)
          <p>{{ $contact->address }}</p>
          <p><strong>Phone:</strong> <span>{{ $contact->phone }}</span></p>
          <p><strong>Email:</strong> <span>{{ $contact->email }}</span></p>
          @else
          <p>Belum ada informasi kontak.</p>
          @endif
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Layanan</a></li>
            {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li> --}}
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            @foreach($services as $service)
              <li>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('servicePage', $service->id) }}">{{ $service->title }}</a>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">PT Tri Virya Nusantara <script>document.write(new Date().getFullYear())</script> </strong> <span>All Rights Reserved</span></p>
      <div class="credits">
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('/front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('/front/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('/front/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('/front/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('/front/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('/front/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('/front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('/front/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('/front/js/main.js')}}"></script>

  <script>
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
      }
    }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Swiper(".clientSwiper", {
      loop: true,
      slidesPerView: 2,
      spaceBetween: 20,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        1024: {
          slidesPerView: 5,
        },
      },
    });
  });
</script>

    @livewireScripts
</body>

{{-- Tes Fitur Automasi --}}

</html>

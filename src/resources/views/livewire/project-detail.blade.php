<main>
    @php use Illuminate\Support\Str; @endphp
        <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Halaman Proyek</h1>
        <p>Berikut adalah iformasi detail dari proyek kami.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Informasi Proyek</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

<section id="portfolio-details" class="portfolio-details section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      <!-- Gambar-gambar dari JSON (images[]) -->
      <div class="col-lg-8">
        <div class="portfolio-details-slider swiper init-swiper">

          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>

          <div class="swiper-wrapper align-items-center">
            @foreach ($project->images as $image)
              <div class="swiper-slide">
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}">
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- Informasi Proyek -->
      <div class="col-lg-4">
        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
          <h3>Informasi Proyek</h3>
          <ul>
            <li><strong>Kategory</strong>: {{ $project->service->title ?? 'Uncategorized' }}</li>
            <li><strong>Status Proyek</strong>: {{ $project->project_status }}</li>
          </ul>
        </div>
        <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
          <h2>{{ $project->title }}</h2>
          <p>{!! $project->description !!}</p>
        </div>
      </div>

    </div>
  </div>
</section>

</main>

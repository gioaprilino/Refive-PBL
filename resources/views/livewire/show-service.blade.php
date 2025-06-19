<main>

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Service Details</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Service Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

<div class="container">
    <div class="row">

    <div class="col-lg-4">
      <div class="services-list d-flex flex-column gap-3">
          @foreach ($services as $srv)
              <a href="{{ route('servicePage', $srv->id) }}"
                 class="{{ $service->id == $srv->id ? 'active' : '' }}">
                 {{ $srv->title }}
              </a>
          @endforeach
      </div>
    </div>

    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200"> {{-- Konten kanan --}}
      <img src="{{ asset('storage/' . $service->photo) }}" class="img-fluid size" alt="{{ $service->title }}">
      <h3>{{ $service->title }}</h3>
      <p>{!! $service->description !!}</p>
    </div>

  </div>
</div>
      </div>

    </section><!-- /Service Details Section -->
</main>

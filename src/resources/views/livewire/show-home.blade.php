<main class="main">

    {{-- <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{asset('/front/img/hero-bg.jpg')}}" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">MAJU. CEPAT. TEGAS.</h2>
        <p data-aos="fade-up" data-aos-delay="200">Kami adalah Perusahaan yang bergerak di bidang migas.</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
        </div>
      </div>

    </section><!-- /Hero Section --> --}}

    @livewire('show-hero')
    @livewire('show-about')
    {{-- @livewire('client-section') --}}

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center gy-4">
          @foreach ($clients as $client)
            <div class="col-xl-2 col-md-3 col-6 client-logo">
              <img src="{{ asset('storage/' . $client->image) }}" class="img-fluid" alt="{{ $client->name }}">
            </div><!-- End Client Item -->
          @endforeach
        </div>
      </div>
    </section><!-- /Clients Section -->


    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan</h2>
        <p>Layanan Kami<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if ($services->isNotEmpty())
          @foreach ($services->chunk(3) as $chunk)
            <div class="row justify-content-center gy-5">
              @foreach ($chunk as $service)
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                  <div class="service-item">
                    <div class="img">
                      <img src="{{ asset('storage/' . $service->photo) }}" class="img-fluid" alt="{{ $service->title }}">
                    </div>
                    <div class="details position-relative">
                      <div class="icon">
                        <i class="bi bi-activity"></i>
                      </div>
                      <a href="{{ route('servicePage', $service->id) }}" class="stretched-link">
                        <h3>{{ $service->title }}</h3>
                      </a>
                      <p>{{ $service->short_desc }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endforeach
        @endif
      </div>


    </section><!-- /Services Section -->


    @livewire('show-project')

    <!-- Team Section -->
    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>TIM</h2>
        <p>TIM KAMI</p>
      </div><!-- End Section Title -->

<div class="container">
  @if ($members->isNotEmpty())

  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      @foreach ($members as $member)
      <div class="swiper-slide">
        <div class="member">
          <div class="pic">
            <img src="{{ asset('/storage/' . $member->image) }}" class="img-fluid" alt="">
          </div>
          <div class="member-info">
            <h4>{{ $member->name }}</h4>
            <span>{{ $member->designation }}</span>
            <div class="social">
              <a href="{{ $member->x_url }}"><i class="bi bi-twitter-x"></i></a>
              <a href="{{ $member->fb_url }}"><i class="bi bi-facebook"></i></a>
              <a href="{{ $member->ig_url }}"><i class="bi bi-instagram"></i></a>
              <a href="{{ $member->in_url }}"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Swiper Slide -->
      @endforeach
    </div>

    <!-- Navigation buttons -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  @endif
</div>


    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Informasi layanan kontak</p>
      </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            @livewire('contact-map')
          </div>

          <div class="col-lg-6">
            <livewire:contact-form />
          </div>



        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

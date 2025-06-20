<main>
    <section id="hero" class="hero section dark-background">
  @if($hero->background_image)
    <img src="{{ asset('storage/' . $hero->background_image) }}" alt="Hero Background" data-aos="fade-in"
         style="width: 100%; height: auto; max-height: 700px; object-fit: cover;">
  @endif

  <div class="container d-flex flex-column align-items-center">
    <h2 data-aos="fade-up" data-aos-delay="100">{{ $hero->heading }}</h2>
    <p data-aos="fade-up" data-aos-delay="200">{{ $hero->subheading }}</p>
  </div>
</section>

</main>

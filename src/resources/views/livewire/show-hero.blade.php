<main>
    <section id="hero" class="hero section dark-background">
  @if($hero->background_image ?? null)
    <img src="{{ asset('storage/' . $hero->background_image) }}" alt="Hero Background" data-aos="fade-in"
         style="width: 100%; height: 100%; max-height: auto; object-fit: cover;">
  @endif

  <div class="container d-flex flex-column align-items-center">
    <h2 data-aos="fade-up" data-aos-delay="100">{{ $hero->heading ?? 'Default Heading' }}</h2>
    <p data-aos="fade-up" data-aos-delay="200">{{ $hero->subheading ?? 'Default Subheading' }}</p>
  </div>
</section>

</main>

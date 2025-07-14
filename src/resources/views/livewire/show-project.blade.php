<main>
    @php use Illuminate\Support\Str; @endphp

<section id="portfolio" class="portfolio section">
  <div class="container section-title" data-aos="fade-up">
    <h2>ProyeK</h2>
    <p>PROYEK KAMI</p>
  </div>

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

      <!-- Dynamic Filter Buttons -->
      <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
        <li data-filter="*" class="filter-active">All</li>
        @foreach ($services as $service)
          <li data-filter=".filter-{{ Str::slug($service->title) }}">{{ $service->title }}</li>
        @endforeach
      </ul>

      <!-- Dynamic Portfolio Items -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        @foreach ($projects as $project)
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($project->service->title ?? 'uncategorized') }}">
            <div class="portfolio-content h-100">
              <img src="{{ asset('storage/' . $project->thumbnail) }}" class="img-fluid" alt="{{ $project->title }}">
              <div class="portfolio-info">
                <h4>{{ $project->service->title ?? 'Uncategorized' }}</h4>
                <p>{{ Str::limit($project->title, 60) }}</p>
                <a href="{{ asset('storage/' . $project->thumbnail) }}"
                   data-gallery="portfolio-gallery-{{ Str::slug($project->service->title ?? 'project') }}"
                   class="glightbox preview-link" title="{{ $project->title }}">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="{{ route('projectPage', $project->id) }}" class="details-link" title="More Details">
                  <i class="bi bi-link-45deg"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div><!-- End Portfolio Container -->

    </div>
  </div>
</section>

</main>

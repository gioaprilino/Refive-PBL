<main>

<!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Lowongan Pekerjaan</h1>
        <p>Berikut adalah daftar lowongan pekerjaan terbaru perusahaan kami.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Lowongan Pekerjaan</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container py-5">
    <h2 class="mb-4">Lowongan Pekerjaan</h2>
    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="background: var(--surface-color);">
                    @if($job->thumbnail)
                        <img src="{{ asset('storage/' . $job->thumbnail) }}"
                             class="card-img-top"
                             alt="{{ $job->title }}"
                             style="height: 250px; object-fit: cover; object-position: center; border-radius: 8px 8px 0 0;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2" style="font-family: var(--heading-font); font-weight: 700;">
                            <a href="{{ route('jobs.show', $job) }}" class="job-title-link">
                                {{ $job->title }}
                            </a>
                        </h5>
                        <small class="text-muted mb-2 d-block">
                            <i class="fas fa-user me-1"></i>By {{ $job->author ?? 'HRD' }} |
                            <i class="fas fa-calendar-alt me-1 ms-2"></i>{{ $job->created_at->format('d M Y') }}
                        </small>

                        @if($job->deadline)
                            <small class="text-muted mb-2 d-block">
                                <i class="fas fa-calendar-times me-1"></i>Batas: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                            </small>
                        @endif

                        <p class="card-text mt-2" style="color: var(--default-color);">
                            {{ Str::limit(strip_tags($job->description), 100) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('jobs.show', $job) }}"
                               class="btn btn-outline-primary me-2 mb-2">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <a href="{{ route('jobs.apply', $job->id) }}"
                               class="btn btn-primary mb-2"
                               style="background: var(--accent-color); border: none;">
                                <i class="fas fa-paper-plane me-1"></i>Lamar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($jobs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links() }}
        </div>
    @endif
</div>
</main>

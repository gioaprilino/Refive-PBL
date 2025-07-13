<main>
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Detail Lowongan Pekerjaan</h1>
        <p>Informasi lengkap tentang lowongan pekerjaan yang tersedia.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('jobs.index') }}">Lowongan Pekerjaan</a></li>
            <li class="current">{{ $job->title }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h2 class="mb-3" style="font-family: var(--heading-font); font-weight: 700; color: var(--heading-color);">
                            {{ $job->title }}
                        </h2>

                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-user me-2"></i>By {{ $job->author ?? 'HRD' }} |
                                <i class="fas fa-calendar-alt me-2 ms-3"></i>{{ $job->created_at->format('d M Y') }}
                            </small>
                        </div>

                        @if($job->thumbnail)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $job->thumbnail) }}"
                                     class="img-fluid rounded"
                                     alt="{{ $job->title }}"
                                     style="width: 100%; height: 400px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="job-description mt-4">
                            <h5 class="mb-3" style="color: var(--heading-color);">Detail Lowongan</h5>
                            <div class="content">
                                {!! $job->description !!}
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <div class="mt-5 text-center">
                            <a href="{{ route('jobs.apply', $job->id) }}"
                               class="btn btn-primary btn-lg px-5 py-3"
                               style="background: var(--accent-color); border: none; border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background: var(--accent-color); color: white;">
                        <h5 class="mb-0">Informasi Lowongan</h5>
                    </div>
                    <div class="card-body">
                        <div class="job-info">
                            <div class="info-item mb-3">
                                <strong><i class="fas fa-briefcase me-2"></i>Title:</strong>
                                <p class="mb-0">{{ $job->title }}</p>
                            </div>

                            <div class="info-item mb-3">
                                <strong><i class="fas fa-calendar-plus me-2"></i>Dipublikasikan:</strong>
                                <p class="mb-0">{{ $job->created_at->format('d M Y') }}</p>
                            </div>

                            @if($job->deadline)
                                <div class="info-item mb-3">
                                    <strong><i class="fas fa-calendar-times me-2"></i>Batas Lamaran:</strong>
                                    <p class="mb-0">{{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</p>
                                </div>
                            @endif


                            <div class="info-item mb-3">
                                <strong><i class="fas fa-user-tie me-2"></i>Contact Person:</strong>
                                <p class="mb-0">{{ $job->author ?? 'hrd@tvn.com' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

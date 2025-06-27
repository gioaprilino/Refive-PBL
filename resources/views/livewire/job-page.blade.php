<main>

<!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Halaman Berita</h1>
        <p>Berikut adalah daftar berita terbaru perusahaan kami.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Informasi Berita</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container py-5">
    <h2 class="mb-4">Lowongan Pekerjaan</h2>
    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($job->thumbnail)
                        <img src="{{ asset('storage/' . $job->thumbnail) }}" class="card-img-top" alt="{{ $job->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <small class="text-muted">By {{ $job->author ?? 'HRD' }} | {{ $job->created_at->format('d M Y') }}</small>
                        <p class="card-text mt-2">{{ Str::limit(strip_tags($job->description), 100) }}</p>
                        <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-primary mt-2">Lamar Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $jobs->links() }}
</div>
</main>

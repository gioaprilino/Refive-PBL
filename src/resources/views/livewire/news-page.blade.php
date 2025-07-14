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
        <div class="row">
           @foreach($newsList as $news)
                <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                    <div class="card h-100 shadow-sm border-0" style="background: var(--surface-color);">
                        @if($news->thumbnail)
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 250px; object-fit: cover; object-position: center; border-radius: 8px 8px 0 0;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2" style="font-family: var(--heading-font); font-weight: 700;">
                                <a href="{{ route('news.show', $news) }}" class="news-title-link">
                                    {{ $news->title }}
                                </a>
                            </h5>
                            <small class="text-muted mb-2 d-block">
                                By {{ $news->author ?? 'Admin' }} | {{ $news->created_at->format('d M Y') }}
                            </small>
                            @if($news->short_desc)
                                <p class="card-text mt-2" style="color: var(--default-color);">{{ $news->short_desc }}</p>
                            @else
                                <p class="card-text mt-2" style="color: var(--default-color);">{{ Str::limit(strip_tags($news->description), 100) }}</p>
                            @endif
                            <a href="{{ route('news.show', $news) }}" class="btn btn-primary mt-auto" style="background: var(--accent-color); border: none;">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $newsList->links() }}
    </div>
</main>

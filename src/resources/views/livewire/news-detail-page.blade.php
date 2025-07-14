<main>
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

    <div class="container py-5">
        <h2>{{ $news->title }}</h2>
        <div class="mb-2">
            <small class="text-muted">
                By {{ $news->author ?? 'Admin' }} | {{ $news->created_at->format('d M Y') }}
            </small>
        </div>
        @if($news->thumbnail)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="img-fluid" alt="{{ $news->title }}">
            </div>
        @endif
        <div class="mt-3">
            {!! $news->description !!}
        </div>
    </div>
</main>

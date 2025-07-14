<main>

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('/front/img/page-title-bg.webp') }});">
      <div class="container position-relative">
        <h1>Apply Lowongan Pekerjaan</h1>
        <p>Isi form berikut untuk mengirim lamaran pekerjaan.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Lowongan Pekerjaan</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container py-5">
    <h2>Lamar Pekerjaan: {{ $job->title }}</h2>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" wire:model="email">
            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" class="form-control" wire:model="phone">
            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <label>CV / Surat Lamaran (PDF/DOC, max 2MB)</label>
            <input type="file" class="form-control" wire:model="cv">
            @error('cv') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button class="btn btn-primary" type="submit">Kirim Lamaran</button>
    </form>
</div>

</main>

<main>
<section id="about" class="about section">
  <div class="container">
    <div class="row gy-4">

      {{-- Kiri: Heading, Gambar 1, Deskripsi 1 --}}
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <h3>{{ $about->heading }}</h3>

        @if($about->image_1)
          <img
            src="{{ asset('storage/' . $about->image_1) }}"
            class="img-fluid rounded-4 mb-4"
            style="width: 100%; height: 300px; object-fit: cover;"
            alt=""
          >
        @endif

        {!! $about->description_1 !!}
      </div>

      {{-- Kanan: Deskripsi 2, Gambar 2 dengan Play Button --}}
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
        <div class="content ps-0 ps-lg-5">
          {!! $about->description_2 !!}

          @if($about->image_2)
            <div class="position-relative mt-4">
              <img
                src="{{ asset('storage/' . $about->image_2) }}"
                class="img-fluid rounded-4"
                style="width: 100%; height: 300px; object-fit: cover;"
                alt=""
              >
            </div>
          @endif
        </div>
      </div>

    </div>
  </div>
</section>
</main>

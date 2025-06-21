<main>
    <form wire:submit.prevent="submit" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

            <div class="col-md-6">
                <input type="text" wire:model.defer="name" class="form-control" placeholder="Your Name">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <input type="email" wire:model.defer="email" class="form-control" placeholder="Your Email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12">
                <input type="text" wire:model.defer="subject" class="form-control" placeholder="Subject">
                @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12">
                <textarea wire:model.defer="message" class="form-control" rows="4" placeholder="Message"></textarea>
                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 text-center mt-3">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <button type="submit">Send Message</button>
            </div>

        </div>
    </form>

</main>

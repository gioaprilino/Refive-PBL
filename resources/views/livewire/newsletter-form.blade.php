<div class="col-lg-4 col-md-12 footer-newsletter">
  <h4>Our Newsletter</h4>
  <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>

  <form wire:submit.prevent="submit" class="php-email-form">
    <div class="newsletter-form">
        <input type="email" wire:model="email" placeholder="Your email">
        <input type="submit" value="Subscribe" wire:loading.attr="disabled">
    </div>

    <div wire:loading class="loading">Memproses...</div>

    @error('email')
        <div class="error-message">{{ $message }}</div>
    @enderror

    @if($successMessage)
        <div class="sent-message">{{ $successMessage }}</div>
    @endif

    @if($errorMessage)
        <div class="error-message">{{ $errorMessage }}</div>
    @endif
</form>
</div>

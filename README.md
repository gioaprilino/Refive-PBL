# Tri Virya Nusantara Website

Website resmi PT Tri Virya Nusantara, dibangun menggunakan [Laravel](https://laravel.com/) dan [Filament Admin](https://filamentphp.com/). Proyek ini menyediakan halaman publik perusahaan, manajemen konten, serta dashboard administrasi untuk pengelolaan proyek, layanan, berita, staff, dan presensi.

## Third-party / Library yang Digunakan

- [Laravel Framework](https://laravel.com/)
- [Filament Admin Panel](https://filamentphp.com/)
- [Livewire](https://livewire.laravel.com/)
- [Dotswan Filament Map Picker](https://filamentphp.com/plugins/dotswan-map-picker)
- [Bootstrap](https://getbootstrap.com/)
- [Swiper.js](https://swiperjs.com/)
- [Carbon](https://carbon.nesbot.com/)
- [Font Awesome](https://fontawesome.com/)
- [PestPHP](https://pestphp.com/) (testing)
- [PHPUnit](https://phpunit.de/)

## Langkah Instalasi & Cara Menjalankan

1. **Clone repository**
   ```sh
   git clone https://github.com/gioaprilino/Refive-PBL.git
   cd Refive-PBL/src
   ```

2. **Install dependency**
   ```sh
   composer install
   npm install
   ```

3. **Copy file environment**
   ```sh
   cp .env.example .env
   ```

4. **Generate key**
   ```sh
   php artisan key:generate
   ```

5. **Migrasi & seed database**
   ```sh
   php artisan migrate --seed
   ```

6. **Build frontend**
   ```sh
   npm run build
   ```

7. **Jalankan server**
   ```sh
   php artisan serve
   ```

8. **(Opsional) Buat storage link untuk upload file**
   ```sh
   php artisan storage:link
   ```

## Akun untuk Akses Login

| Role   | Email              | Password   | Panel      |
|--------|--------------------|------------|------------|
| Admin  | admin@tvn.com      | password   | /admin     |
| HRD    | hrd@tvn.com        | password   | /hrd       |

> Akun di atas tersedia jika Anda menjalankan seeder bawaan. Silakan sesuaikan di database jika diperlukan.

---

Website ini dikembangkan untuk kebutuhan internal PT Tri Virya Nusantara dan sebagai proyek PBL Prodi D4 TRPL Jurusan Teknologi Informasi Politeknik Negeri Padang.

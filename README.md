# Tri Virya Nusantara Website
ANJENG
<p align="center">
  <a href="https://github.com/gioaprilino/Refive-PBL/stargazers"><img src="https://img.shields.io/github/stars/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Stargazers"></a>
  <a href="https://github.com/gioaprilino/Refive-PBL/issues"><img src="https://img.shields.io/github/issues/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Issues"></a>
  <a href="https://github.com/gioaprilino/Refive-PBL/network/members"><img src="https://img.shields.io/github/forks/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Forks"></a>
</p>
<br>
<h2 align="center">ID | <a href="README-en.md">EN</a></h2>

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

## Cara Berkontribusi & Mengembangkan Project

Jika Anda ingin mengembangkan atau berkontribusi pada project ini, berikut langkah-langkah yang dapat dilakukan:

1. **Star & Fork Repository**
   - Klik tombol ⭐️ (Star) di halaman repository untuk mendukung project.
   - Klik tombol Fork untuk membuat salinan repository ke akun GitHub Anda.

2. **Clone Repository Fork**
   - Clone repository hasil fork ke komputer Anda

3. **Buat Branch Baru**
   - Buat branch baru untuk fitur atau perbaikan yang ingin Anda tambahkan:
     ```sh
     git checkout -b nama-fitur-anda
     ```

4. **Lakukan Perubahan & Commit**
   - Lakukan perubahan kode, lalu commit:
     ```sh
     git add .
     git commit -m "Deskripsi perubahan"
     ```

5. **Push ke GitHub & Pull Request**
   - Push branch ke repository fork Anda:
     ```sh
     git push origin nama-fitur-anda
     ```
   - Buka Pull Request ke repository utama.

6. **Diskusi & Review**
   - Tim Refive-PBL akan melakukan review dan diskusi jika diperlukan sebelum perubahan digabungkan.

---


Website ini dikembangkan untuk kebutuhan internal PT. Tri Virya Nusantara dan sebagai proyek PBL Prodi D4 TRPL Jurusan Teknologi Informasi Politeknik Negeri Padang.

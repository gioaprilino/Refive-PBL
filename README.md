# Tri Virya Nusantara Website

Website resmi PT Tri Virya Nusantara, dibangun menggunakan [Laravel](https://laravel.com/) dan [Filament Admin](https://filamentphp.com/). Proyek ini menyediakan halaman publik perusahaan, manajemen konten, serta dashboard administrasi untuk pengelolaan proyek, layanan, berita, dan staff.

## Fitur Utama

- **Landing Page**: Informasi perusahaan, layanan, portofolio proyek, tim, dan kontak.
- **Manajemen Proyek**: CRUD proyek beserta kategori layanan.
- **Manajemen Staff & Tugas**: Modul HRD untuk mengelola proyek dan tugas karyawan.
- **Berita & Lowongan**: Publikasi berita dan lowongan pekerjaan.
- **Presesni**: Sistem presensi staff berbasi shift dan lokasi.
- **Dashboard Admin**: Panel admin berbasis Filament untuk mengelola seluruh data.
- **Autentikasi**: Sistem login untuk admin dan staff.

## Struktur Direktori

- `app/Filament/Resources/` — Resource Filament untuk admin (Proyek, Layanan, dsb)
- `app/Filament/Hrd/Resources/` — Resource HRD untuk manajemen proyek & tugas karyawan
- `app/Filament/Staff/Resources/` — Resource untuk staff (proyek yang di-assign)
- `app/Livewire/` — Komponen Livewire untuk halaman publik
- `resources/views/components/layouts/app.blade.php` — Layout utama frontend
- `public/` — Aset publik (gambar, CSS, JS)
- `routes/` — Definisi routing aplikasi

## Instalasi

1. **Clone repository**
   ```sh
   git clone <repo-url>
   cd tvn-filament
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

## Konfigurasi

- **File upload**: Pastikan storage sudah di-link dengan `php artisan storage:link`.
- **Env**: Atur koneksi database dan konfigurasi lain di file `.env`.

## Kontribusi

Pull request dan issue sangat diterima! Silakan fork repo ini dan ajukan perubahan Anda.

## Lisensi

Proyek ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

---

> Website ini dikembangkan untuk menyelesaikan Proyek PBL Prodi D4 TRPL Jurusan Teknologi Informasi Politeknik Negeri Padang dan kebutuhan internal PT Tri Virya Nusantara.

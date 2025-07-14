# Tri Virya Nusantara Website

<p align="center">
  <a href="https://github.com/gioaprilino/Refive-PBL/stargazers"><img src="https://img.shields.io/github/stars/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Stargazers"></a>
  <a href="https://github.com/gioaprilino/Refive-PBL/issues"><img src="https://img.shields.io/github/issues/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Issues"></a>
  <a href="https://github.com/gioaprilino/Refive-PBL/network/members"><img src="https://img.shields.io/github/forks/gioaprilino/Refive-PBL.svg?style=for-the-badge" alt="Forks"></a>
</p>
<br>
<h2 align="center"><a href="README.md">ID</a> | EN</h2>

Official website of PT Tri Virya Nusantara, built using [Laravel](https://laravel.com/) and [Filament Admin](https://filamentphp.com/). This project provides a public company page, content management, and an admin dashboard for managing projects, services, news, staff, and attendance.

## Third-party / Libraries Used

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

## Installation & Usage Steps

1. **Clone the repository**
   ```sh
   git clone https://github.com/gioaprilino/Refive-PBL.git
   cd Refive-PBL/src
   ```

2. **Install dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Copy environment file**
   ```sh
   cp .env.example .env
   ```

4. **Generate key**
   ```sh
   php artisan key:generate
   ```

5. **Migrate & seed database**
   ```sh
   php artisan migrate --seed
   ```

6. **Build frontend**
   ```sh
   npm run build
   ```

7. **Run server**
   ```sh
   php artisan serve
   ```

8. **(Optional) Create storage link for file uploads**
   ```sh
   php artisan storage:link
   ```

## Login Accounts

| Role   | Email              | Password   | Panel      |
|--------|--------------------|------------|------------|
| Admin  | admin@tvn.com      | password   | /admin     |
| HRD    | hrd@tvn.com        | password   | /hrd       |

> The above accounts are available if you run the default seeder. Please adjust in the database if needed.

---

## How to Contribute & Develop the Project

If you want to contribute or develop this project, here are the steps you can follow:

1. **Star & Fork the Repository**
   - Click the ⭐️ (Star) button on the repository page to support the project.
   - Click Fork to create a copy of the repository in your GitHub account.

2. **Clone Your Forked Repository**
   - Clone your forked repository to your computer

3. **Create a New Branch**
   - Create a new branch for the feature or fix you want to add:
     ```sh
     git checkout -b your-feature-name
     ```

4. **Make Changes & Commit**
   - Make code changes, then commit:
     ```sh
     git add .
     git commit -m "Description of changes"
     ```

5. **Push to GitHub & Pull Request**
   - Push your branch to your forked repository:
     ```sh
     git push origin your-feature-name
     ```
   - Open a Pull Request to the main repository.

6. **Discussion & Review**
   - The Refive-PBL team will review and discuss if needed before merging changes.

---

This website is developed for internal needs of PT Tri Virya Nusantara and as a PBL project for D4 TRPL Program, Department of Information Technology, Politeknik Negeri Padang.

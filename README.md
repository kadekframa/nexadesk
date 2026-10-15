# NexaDesk

Starter project NexaDesk, aplikasi yang berdiri sendiri (tidak terintegrasi dengan SSO).
Fondasinya disalin dari project **ID Management (IDMS)** (branch `new-design-sistem`,
commit `aea79a5`), tanpa modul bisnis IDMS dan tanpa integrasi SSO.

## Stack

| Bagian        | Versi / package                                         |
| ------------- | ------------------------------------------------------- |
| PHP           | 8.1 (FPM) — `docker/app/Dockerfile`                     |
| Framework     | Laravel 10                                              |
| Database      | MariaDB 11.8                                            |
| Web server    | Nginx 1.28 — `docker/nginx/app.conf`                    |
| Tema          | Metronic 8 + lapisan warna NexaDesk                     |
| Login         | Email & password, tabel `users` milik NexaDesk sendiri  |
| Lainnya       | Yajra DataTables, Maatwebsite Excel, Laravel Repository Service |

## Menjalankan di lokal (Docker)

1. Siapkan `.env` (untuk mesin ini sudah dibuat; di mesin lain salin dari `.env.example`),
   lalu isi `DB_PASSWORD`, `USER`, dan `GROUP`.
2. Nyalakan container:
   ```bash
   docker compose up -d --build
   ```
3. Siapkan aplikasi:
   ```bash
   docker compose exec app composer install        # jika folder vendor belum ada
   docker compose exec app php artisan key:generate # jika APP_KEY masih kosong
   docker compose exec app php artisan migrate
   ```
4. Buat akun pertama, lalu login di `APP_URL` (default `http://localhost:92`):
   ```bash
   docker compose exec app php artisan user:create
   ```

| Service     | Container            | Port host |
| ----------- | -------------------- | --------- |
| Nginx       | `nexadesk-webserver` | 92, 452   |
| PHP-FPM     | `nexadesk-app`       | -         |
| MariaDB     | `nexadesk-mariadb`   | 3312      |

Port dipilih supaya tidak bentrok dengan project lain di mesin ini: sso (85/4442/3308),
idmanagement (89/450/3311), dan sds (91/3310/6380). Data MariaDB tersimpan di
`docker/mariadb/` (tidak di-commit).

> MariaDB hanya membaca `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` saat pertama kali
> `docker/mariadb/` dibuat. Kalau nilainya diubah setelah itu, ubah juga langsung di database.

## Akun & login

- Halaman di dalam grup middleware `auth` mengarahkan tamu ke `/login`.
- Login memakai email + password dari tabel `users`. Setelah 5 kali gagal untuk email + IP
  yang sama, login dikunci sementara.
- Akun dibuat lewat `php artisan user:create` (nama, email, password minimal 8 karakter).
  Belum ada halaman registrasi, kelola pengguna, atau reset password.

## Hak akses menu & halaman

Hak akses memakai Gate Laravel. Definisikan ability di
`app/Providers/AuthServiceProvider.php`, misalnya:

```php
Gate::define('master-data', fn (User $user) => /* aturan Anda */);
```

Lalu pakai di `config/menu.php` (kunci `permission`), di Blade (`@can('master-data')`),
atau di route (`->middleware('can:master-data')`). Menu sidebar tampil bila pengguna
diizinkan minimal satu ability di `permission`-nya.

## Struktur & konvensi

| Kebutuhan                 | Tempat                                                                 |
| ------------------------- | ---------------------------------------------------------------------- |
| Rute halaman              | `routes/web.php`, di dalam grup middleware `auth`                      |
| Login & logout            | `app/Http/Controllers/Auth/LoginController.php`, `resources/views/pages/auth/login.blade.php` |
| Menu sidebar              | `config/menu.php`                                                      |
| Breadcrumb                | `routes/breadcrumbs.php`                                               |
| Layout                    | `<x-default-layout>`, `<x-auth-layout>`, `<x-system-layout>`           |
| Nama, slogan, mode tema   | `config/settings.php` (nama dari `APP_NAME`, slogan opsional dari `APP_SLOGAN`) |
| Logo & favicon            | `public/assets/media/logos/nexadesk.svg`, `nexadesk.ico` (salinannya di `public/favicon.ico`); path diatur di `config/settings.php` → `KT_THEME_ASSETS` |
| Warna tema                | `public/assets/css/nexadesk-theme.css` (variabel `--nexadesk-*`)       |
| Repository & service      | `php artisan make:repository Nama`, `php artisan make:service Nama`    |
| Helper global             | `app/Helpers/WebHelper.php` (`sweetAlert()` + `@include('components.result')`) |

`routes/example.php` adalah rute contoh bawaan template Metronic; view contohnya memang tidak
disertakan (sama seperti di IDMS).

## Testing

```bash
docker compose exec app php artisan test
```

Test memakai SQLite in-memory (lihat `phpunit.xml`), jadi tidak menyentuh database MariaDB.

# zistrack

zistrack adalah aplikasi berbasis Laravel yang dirancang untuk membantu pelacakan dan manajemen data secara efisien.

## Fitur Utama
- Otentikasi pengguna
- Manajemen data berbasis Eloquent ORM
- Struktur modern Laravel 12
- Pengujian otomatis dengan Pest
- Konfigurasi siap produksi

## Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/zaiimrq/zistrack
   cd zistrack
   ```
2. Install dependensi PHP:
   ```bash
   composer install
   ```
3. Install dependensi frontend:
   ```bash
   npm install
   ```
4. Salin file environment:
   ```bash
   cp .env.example .env
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

## Menjalankan Aplikasi
- Jalankan server lokal:
  ```bash
  php artisan serve
  ```
- Untuk frontend (Vite):
  ```bash
  npm run dev
  ```

## Testing
- Jalankan seluruh pengujian:
  ```bash
  php artisan test
  ```

## Struktur Direktori
- `app/` - Kode aplikasi utama (model, controller, provider)
- `routes/` - Definisi routing aplikasi
- `database/` - Migrasi, seeder, dan factory
- `resources/` - View dan asset frontend
- `tests/` - Pengujian otomatis

## Lisensi
Aplikasi ini menggunakan lisensi [MIT](LICENSE).


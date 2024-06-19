## Langkah-Langkah Instalasi Projek PPDB Online HB

1. **Kloning Repositori**
   Mulai dengan mengkloning repositori GitHub ke lokal Anda menggunakan perintah:
   ```
   git clone https://github.com/sizuwanoadi/PPDB-Online-HB
   ```

2. **Instalasi Dependensi**
   Install semua dependensi yang diperlukan dengan Composer:
   ```
   composer install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` ke `.env` untuk mengatur konfigurasi lingkungan:
   ```
   cp .env.example .env
   ```
   Atau gunakan:
   ```
   copy .env.example .env
   ```
   Sesuaikan pengaturan database dan tambahkan API key aplikasi Anda dalam file `.env`. Ikuti panduan pembuatan API key yang tersedia di dokumentasi.

4. **Generate Application Key**
   Buat kunci aplikasi dengan artisan command:
   ```
   php artisan key:generate
   ```

5. **Migrasi dan Seeding Database**
   Lakukan migrasi dan seeding ke database:
   ```
   php artisan migrate --seed
   ```

6. **Menjalankan Server**
   Jalankan server pengembangan Laravel:
   ```
   php artisan serve
   ```

7. **Akses Aplikasi**
   Buka browser dan akses aplikasi melalui URL yang diberikan, misalnya:
   ```
   http://localhost:8000
   ```
   Informasi login (email dan password) dapat ditemukan dalam seeder berdasarkan role pengguna.

## Langkah-Langkah Instalasi Projek PPDB Online HB

| **Langkah** | **Deskripsi** | **Deploy** |
|-------------|---------------|------------|
| 1. **Kloning Repositori** | Mulai dengan mengkloning repositori GitHub ke lokal Anda menggunakan perintah: <br> ``` https://github.com/rivando-al-rasyid/ppdb-online-xendit.git ``` | - |
| 2. **Instalasi Dependensi** | Install semua dependensi yang diperlukan dengan Composer: <br> ``` composer install ``` | - |
| 3. **Konfigurasi Environment** | Salin file `.env.example` ke `.env` untuk mengatur konfigurasi lingkungan: <br> ``` cp .env.example .env ``` <br> Atau gunakan: <br> ``` copy .env.example .env ``` <br> Sesuaikan pengaturan database dan tambahkan API key aplikasi Anda dalam file `.env`. Ikuti panduan pembuatan API key yang tersedia di dokumentasi. | - |
| 4. **Generate Application Key** | Buat kunci aplikasi dengan artisan command: <br> ``` php artisan key:generate ``` | - |
| 5. **Migrasi dan Seeding Database** | Lakukan migrasi dan seeding ke database: <br> ``` php artisan migrate --seed ``` | - |
| 6. **Menjalankan Server** | Jalankan server pengembangan Laravel: <br> ``` php artisan serve ``` | - |
| 7. **Akses Aplikasi** | Buka browser dan akses aplikasi melalui URL yang diberikan, misalnya: <br> ``` http://localhost:8000 ``` <br> Informasi login (email dan password) dapat ditemukan dalam seeder berdasarkan role pengguna. | - |

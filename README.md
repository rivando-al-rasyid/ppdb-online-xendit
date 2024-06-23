## Langkah-Langkah Instalasi Projek PPDB Online HB

| **Langkah** | **Local** | **Deploy** | **Deskripsi** |
|-------------|---------------|------------|-----------|
| **Kloning Repositori** | ``` git clone https://github.com/rivando-al-rasyid/ppdb-online-xendit.git ``` | Lakukan hal yang sama |  Mulai dengan mengkloning repositori GitHub ke lokal/hosting Anda  |
| **Instalasi Dependensi** |  ``` composer install ``` | - | Install semua dependensi yang diperlukan dengan Composer. |
| **Konfigurasi Environment** | Salin file `.env.example` ke `.env` untuk mengatur konfigurasi lingkungan: <br> ``` cp .env.example .env ``` <br> Atau gunakan: <br> ``` copy .env.example .env ``` <br> Sesuaikan pengaturan database dan tambahkan API key aplikasi Anda dalam file `.env`. Ikuti panduan pembuatan API key yang tersedia di dokumentasi. | - | - |
| **Generate Application Key** | Buat kunci aplikasi dengan artisan command: <br> ``` php artisan key:generate ``` | - | - |
| **Migrasi dan Seeding Database** | Lakukan migrasi dan seeding ke database: <br> ``` php artisan migrate --seed ``` | - | - |
| **Menjalankan Server** | Jalankan server pengembangan Laravel: <br> ``` php artisan serve ``` | - | - |
| **Akses Aplikasi** | Buka browser dan akses aplikasi melalui URL yang diberikan, misalnya: <br> ``` http://localhost:8000 ``` <br> Informasi login (email dan password) dapat ditemukan dalam seeder berdasarkan role pengguna. | - | - |

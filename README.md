| **Langkah** | **Local** | **Deploy** | **Deskripsi** |
|-------------|---------------|------------|-----------|
| **Kloning Repositori** | ``` git clone https://github.com/rivando-al-rasyid/ppdb-online-xendit.git ``` | ``` git clone https://github.com/rivando-al-rasyid/ppdb-online-xendit.git ``` | Mulai dengan mengkloning repositori GitHub ke lokal atau hosting Anda. |
| **Instalasi Dependensi** |  ``` composer install ``` | ``` composer install --optimize-autoloader --no-dev ``` | Install semua dependensi yang diperlukan dengan Composer. |
| **Konfigurasi Environment** | ``` cp .env.example .env ``` <br> ``` copy .env.example .env ``` <br> Sesuaikan pengaturan di `.env`. | ``` cp .env.example .env ``` <br> Sesuaikan pengaturan di `.env`. | Atur database dan API key di `.env`. |
| **Generate Application Key** |  ``` php artisan key:generate ``` | ``` php artisan key:generate ``` | Generate kunci aplikasi yang diperlukan untuk enkripsi. |
| **Migrasi dan Seeding Database** | Lakukan migrasi dan seeding ke database: <br> ``` php artisan migrate --seed ``` | ``` php artisan migrate --seed ``` | Migrasi database dan isi dengan data awal yang diperlukan. |
| **Menjalankan Server** | Jalankan server pengembangan Laravel: <br> ``` php artisan serve ``` | Setup server sesuai dengan konfigurasi hosting (Apache/Nginx) | Menjalankan server lokal untuk pengembangan atau konfigurasi server pada hosting. |
| **Akses Aplikasi** | Buka browser dan akses: <br> ``` http://localhost:8000 ``` <br> Informasi login ada di seeder. | Akses aplikasi melalui domain/URL di hosting Anda. | Pastikan instalasi berjalan dengan baik. |

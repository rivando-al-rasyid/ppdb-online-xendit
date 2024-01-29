Cara Install Projek Ini

    Jalankan git clone https://github.com/sizuwanoadi/PPDB-Online-HB
    Jalankan composer install.
    Jalankan cp .env.example .env or copy .env.example .env.
    Sesuaikan konfigurasi database anda di .env
    Jalankan php artisan key:generate
    Jalankan php artisan migrate --seed
    Jalankan php artisan serve
    Buka website sesuai dengan localhost dan portnya di web browser anda contoh http://localhost:8000
    email dan password ada di seeder berdasarkan role nya

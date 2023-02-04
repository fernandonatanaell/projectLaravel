<p align="center"><a href="#"><img src="https://i.ibb.co/18MJ8z9/LOGOKITA.png" alt="AsiaTeknik" width="290"></a></p>
 
<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1>About AsiaTeknik</h1>
AsiaTeknik adalah sebuah web yang digunakan untuk mengatur segala proses bisnis dari perusahaan servis barang elektronik yang bernama Asia Teknik. Website ini merupakan hasil dari salah satu tugas mata kuliah yang bernama "Framework Pemrograman Web".
 
<h3>Link website</h3>
<a href="project-sdp.lukasbudi.my.id">https://project-sdp.lukasbudi.my.id</a>

<h3>Akun untuk login</h3>

- Sebagai Owner => 
    Username : fernandonatanaell
    Password : 123
- Sebagai Manajer =>
    Username : agnessisilia
    Password : 123
- Sebagai Teknisi =>
    Username : garitdewana
    Password : 123
- Sebagai Kasir =>
    Username : natashadonabella
    Password : 123

<h1>Langkah-langkah sebelum menjalankan aplikasi</h1>

1. Ubah pada file .env menjadi berikut
    
    ```sh
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:+8Cj/uIr/1Gp4Tg5bup8Kus2oI4hjSdYtgJvuDcDbvw=
    APP_DEBUG=true
    APP_URL=http://localhost

    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=proyek_fpw
    DB_USERNAME=root
    DB_PASSWORD=

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    MEMCACHED_HOST=127.0.0.1

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false

    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=mt1

    VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    VITE_PUSHER_HOST="${PUSHER_HOST}"
    VITE_PUSHER_PORT="${PUSHER_PORT}"
    VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
    VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

    MIDTRANS_SERVER_KEY=SB-Mid-server-sflLw7nCXe5RuJ0j5Ar6hC5S
    MIDTRANS_CLIENT_KEY=SB-Mid-client-Ngy3me4GyFzaauNa
    MIDTRANS_IS_PRODUCTION=false
    MIDTRANS_IS_SANITIZED=true
    MIDTRANS_IS_3DS=true
    ```
2. Lakukan composer install melalui terminal dengan mengketikan "composer install"
3. Jalankan perintah untuk migrate database melalui terminal dengan mengketikan "php artisan migrate"
4. Import DB_SCHEMA.sql dengan menggunakan phpMyAdmin milik Anda maupun SQLyog
5. Pada terminal ketikan "php artisan serve"
6. Kemudian buka di browser Anda dan ketikan "localhost:8000" pada bagian URLnya

# Laravel 8 Rest Api

Studi kasus aplikasi surat menyurat

### Langkah Instalasi

-   Update composernya dulu

```bash
composer update
```

-   Copy env

```bash
cp .env.example .env
```

-   Generate key

```bash
php artisan key:generate
```

-   Buat database dan atur file `.env` nya

-   Migrasi database

```bash
php artisan migrate
```

-   Seeding data awal (data divisi dan pegawai)

```bash
php artisan db:seed
```

-   Buat simbolik link

```bash
php artisan storage:link
```

-   Jalankan server

```bash
php artisan serve
```

#### Yang saya pelajari
- php artisan make:migration create_student_table
- php artisan migrate
- php artisan make:model Student
- php artisan make:controller StudentController
- php artisan make:seeder StudentSeeder
- php artisan db:seed --class StudentSeeder

#### Noted
- setelah make:seeder, jangan lupa untuk call di database/seeders/DatabaseSeeder.php atau gunakan --class StudentSeeder.


guru saya: [chat gpt](https://chat.openai.com/c/aa5afd2b-c407-4277-b270-50563c332145)

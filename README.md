# Panduan Instalasi dan Menjalankan Proyek Laravel

## Prasyarat
Sebelum memulai, pastikan komputer Anda telah memenuhi persyaratan berikut:
- PHP versi 8.1 atau lebih baru
- Composer (https://getcomposer.org/)
- Node.js dan NPM
- Database MySQL/MariaDB

## Langkah Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/username/nama-repository.git
cd nama-repository
```

### 2. Install Dependensi Composer
```bash
composer install
```

### 3. Konfigurasi Environment
1. Salin file `.env.example` menjadi `.env`
```bash
cp .env.example .env
```

2. Generate Application Key
```bash
php artisan key:generate
```

### 4. Konfigurasi Database
1. Buka file `.env` dan sesuaikan pengaturan database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
```

2. Jalankan migrasi database
```bash
php artisan migrate
```

### 5. Install Dependensi Frontend
```bash
npm install
npm run dev
```

### 6. Jalankan Server Pengembangan
```bash
# Jalankan server Laravel
php artisan serve

# Buka terminal baru untuk menjalankan vite
npm run dev
```

Aplikasi akan berjalan di `http://localhost:8000`

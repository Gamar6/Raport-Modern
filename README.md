## 🚀 Fitur

- Autentikasi Laravel (opsional jika ada)
- Analisis dan visualisasi data siswa
- Grafik interaktif dengan Chart.js
- Dark mode toggle (Alpine.js)
- Desain responsif dengan Tailwind CSS

---

## 📦 Requirements

Sebelum menjalankan project ini, pastikan kamu sudah menginstall:

- PHP >= 8.4
- Composer
- Node.js & npm
- MySQL / MariaDB
- Git (untuk clone)

---

## 🛠️ Cara Install

Ikuti langkah-langkah berikut untuk menjalankan project ini secara lokal:

```bash
# 1. Clone repository
git clone https://github.com/Gamar6/Raport-Modern

# 2. Masuk ke folder project
cd Raport-Modern

# 3. Install dependencies PHP
composer install

# 4. Copy file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database
# Edit file .env dan atur DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 7. Jalankan migrasi (jika ada)
php artisan migrate

# 8. Install frontend dependencies
npm install

# 9. Compile asset (untuk development)
npm run dev

# 10. Jalankan server Laravel
php artisan serve

# INSTRUKSI SETUP DATABASE PET HOTEL

## ✅ Database Sudah Dibuat!
Database `pet_hotel_testing` sudah berhasil dibuat di MySQL.

## 📝 Langkah Selanjutnya:

### 1. Periksa File .env
Buka file `.env` di root project dan pastikan konfigurasi database seperti ini:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pet_hotel_testing
DB_USERNAME=root
DB_PASSWORD=
```

**PENTING**: 
- `DB_DATABASE` harus `pet_hotel_testing`
- `DB_USERNAME` biasanya `root` di Laragon
- `DB_PASSWORD` biasanya **kosong** di Laragon (biarkan kosong tanpa nilai)

### 2. Clear Cache Laravel
Setelah update .env, jalankan:
```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Jalankan Migration
```bash
php artisan migrate:fresh --seed
```

---

## 🔧 Troubleshooting

### Jika masih error "Connection refused":
1. **Pastikan MySQL Service Running**:
   - Buka Laragon
   - Klik tombol "Start All" 
   - Pastikan MySQL dan Apache berjalan (warna hijau)

2. **Test Koneksi MySQL**:
   ```bash
   mysql -u root -e "SHOW DATABASES;"
   ```
   (jika command tidak ditemukan, gunakan path lengkap)

3. **Cek Port MySQL**:
   - Buka Laragon Menu → MySQL → my.ini
   - Cari baris `port = 3306`
   - Pastikan port di .env sama dengan port di my.ini

### Jika database sudah ada tapi masih error:
```bash
# Drop dan recreate database
php artisan db:wipe
php artisan migrate --seed
```

---

## 📋 Setelah Migration Berhasil

Anda akan memiliki tabel-tabel berikut:
- users (dengan role: admin, customer)
- owners
- pets
- rooms
- bookings
- invoices
- notifications
- migrations
- dll

Dan data seeder akan mengisi database dengan sample data untuk testing.

---

## 🚀 Menjalankan Aplikasi

Setelah migration selesai:
```bash
# Compile assets
npm install
npm run dev

# Di terminal terpisah, jalankan server
php artisan serve
```

Akses aplikasi di: http://localhost:8000

---

**Note**: Jika Anda masih mengalami masalah, mohon share error message lengkapnya atau screenshots dari:
1. Laragon status (MySQL running/stopped)
2. Isi file .env bagian DB_*
3. Error message dari `php artisan migrate`

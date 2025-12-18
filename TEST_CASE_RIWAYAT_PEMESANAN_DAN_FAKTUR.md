# TEST CASE: MELIHAT RIWAYAT PEMESANAN DAN FAKTUR
## Pet Hotel Application Testing

**Teknik Testing**: Equivalence Partitioning  
**Tanggal**: 18 Desember 2025  
**Fitur yang Diuji**: Melihat Riwayat Pemesanan dan Faktur (Invoice)  
**Route/Endpoint**:
- Customer Invoices List: `/customer/invoices` - `customer.invoices.index`
- Invoice Detail: `/customer/invoices/{invoice}` - `customer.invoices.show`

---

## 1. IDENTIFIKASI EQUIVALENCE PARTITIONS

### A. PARTISI INPUT - Jumlah Data Faktur
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-01 (Valid)** | Customer memiliki invoice (1-10 invoice) | 5 invoices | Menampilkan list semua invoice dengan pagination |
| **EP-02 (Valid)** | Customer memiliki banyak invoice (>10 invoice) | 25 invoices | Menampilkan 10 invoice dengan pagination, total 3 halaman |
| **EP-03 (Boundary)** | Customer tidak memiliki invoice sama sekali | 0 invoices | Menampilkan pesan "No invoices yet" |

### B. PARTISI INPUT - Status Pembayaran Invoice
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-04 (Valid)** | Invoice dengan status "Paid" | paid = true, paid_at = timestamp | Badge hijau "Paid" dan tanggal pembayaran ditampilkan |
| **EP-05 (Valid)** | Invoice dengan status "Unpaid" | paid = false, paid_at = null | Badge kuning "Unpaid" dan pesan "Payment Pending" |

### C. PARTISI INPUT - Relasi Data Invoice
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-06 (Valid)** | Invoice dengan data booking lengkap (pet, room, owner) | Semua relasi ada | Menampilkan nama pet, room code, tanggal booking, dan amount |
| **EP-07 (Invalid)** | Invoice dengan booking yang dihapus | booking = null | Error 500 atau handling khusus |

### D. PARTISI INPUT - User Authentication & Authorization
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-08 (Valid)** | User customer yang login melihat invoice miliknya | User A login, invoice milik User A | Invoice ditampilkan dengan benar |
| **EP-09 (Invalid)** | User customer mencoba akses invoice user lain | User A login, akses invoice User B | Error 403 Unauthorized |
| **EP-10 (Invalid)** | User belum login (guest) | Tidak ada session | Redirect ke halaman login |

### E. PARTISI INPUT - Format & Tipe Data Amount
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-11 (Valid)** | Amount dalam range normal (Rp 100.000 - Rp 10.000.000) | amount = 500000 | Tampil "Rp 500.000" dengan format yang benar |
| **EP-12 (Boundary)** | Amount sangat kecil | amount = 1 | Tampil "Rp 1" |
| **EP-13 (Boundary)** | Amount sangat besar | amount = 999999999 | Tampil "Rp 999.999.999" |
| **EP-14 (Invalid)** | Amount negatif | amount = -50000 | Sistem tidak boleh menyimpan atau handling error |
| **EP-15 (Invalid)** | Amount null | amount = null | Error atau default value 0 |

### F. PARTISI INPUT - Tanggal & Durasi Booking
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-16 (Valid)** | Durasi booking 1 hari | start_date = 2025-12-18, end_date = 2025-12-18 | Tampil "1 days" |
| **EP-17 (Valid)** | Durasi booking beberapa hari (2-30 hari) | start_date = 2025-12-18, end_date = 2025-12-23 | Tampil "6 days" |
| **EP-18 (Valid)** | Durasi booking lama (>30 hari) | start_date = 2025-12-01, end_date = 2026-01-15 | Tampil "46 days" |

### G. PARTISI INPUT - Pagination
| Partisi | Kondisi | Nilai Test | Expected Result |
|---------|---------|------------|-----------------|
| **EP-19 (Valid)** | Halaman pertama | page = 1 | Menampilkan invoice 1-10 |
| **EP-20 (Valid)** | Halaman tengah | page = 2 | Menampilkan invoice 11-20 |
| **EP-21 (Valid)** | Halaman terakhir | page = 3 (dari total 25 invoice) | Menampilkan invoice 21-25 |
| **EP-22 (Invalid)** | Halaman tidak valid | page = 999 | Halaman kosong atau error handling |
| **EP-23 (Invalid)** | Halaman negatif | page = -1 | Redirect ke page 1 |

---

## 2. TEST CASES LENGKAP

### **TC-001: Melihat Daftar Invoice - Customer Memiliki Invoice**
- **Equivalence Partition**: EP-01
- **Precondition**: 
  - User sudah login sebagai customer
  - Customer memiliki owner_id yang valid
  - Terdapat 5 invoice terkait dengan booking customer
- **Test Steps**:
  1. Login sebagai customer
  2. Navigasi ke menu "My Invoices" atau akses `/customer/invoices`
  3. Verifikasi tampilan halaman
- **Expected Result**:
  - Halaman "My Invoices" ditampilkan
  - Terlihat 5 invoice dalam bentuk list
  - Setiap invoice menampilkan: Invoice No, Status Badge (Paid/Unpaid), Pet Name, Room Code, Tanggal Booking, Amount
  - Tombol "View Details" tersedia pada setiap invoice
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-002: Melihat Daftar Invoice - Customer Memiliki Banyak Invoice (>10)**
- **Equivalence Partition**: EP-02
- **Precondition**: 
  - User sudah login sebagai customer
  - Customer memiliki 25 invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices`
  3. Periksa jumlah invoice yang ditampilkan
  4. Periksa pagination
- **Expected Result**:
  - Menampilkan 10 invoice per halaman
  - Pagination menunjukkan 3 halaman (25 ÷ 10)
  - Navigasi antar halaman berfungsi
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-003: Melihat Daftar Invoice - Customer Tidak Memiliki Invoice**
- **Equivalence Partition**: EP-03
- **Precondition**: 
  - User sudah login sebagai customer
  - Customer belum pernah membuat booking/invoice
- **Test Steps**:
  1. Login sebagai customer baru
  2. Akses `/customer/invoices`
- **Expected Result**:
  - Halaman ditampilkan dengan empty state
  - Muncul icon dokumen abu-abu
  - Pesan "No invoices yet" ditampilkan
  - Tidak ada error
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-004: Menampilkan Invoice dengan Status Paid**
- **Equivalence Partition**: EP-04
- **Precondition**: 
  - Customer memiliki invoice dengan paid = true
  - paid_at timestamp tersedia
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices`
  3. Periksa invoice yang sudah paid
- **Expected Result**:
  - Badge hijau dengan text "Paid" ditampilkan
  - Tanggal pembayaran ditampilkan (format: "01 Jan 2025, 14:30")
  - Checkmark icon berwarna hijau muncul
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-005: Menampilkan Invoice dengan Status Unpaid**
- **Equivalence Partition**: EP-05
- **Precondition**: 
  - Customer memiliki invoice dengan paid = false
  - paid_at = null
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices`
  3. Periksa invoice yang belum paid
- **Expected Result**:
  - Badge kuning dengan text "Unpaid" ditampilkan
  - Tidak ada tanggal pembayaran
  - Warning icon berwarna kuning muncul saat lihat detail
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-006: Melihat Invoice dengan Data Booking Lengkap**
- **Equivalence Partition**: EP-06
- **Precondition**: 
  - Invoice memiliki relasi booking yang valid
  - Booking memiliki pet, room, dan owner yang valid
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices`
  3. Periksa detail invoice
- **Expected Result**:
  - Pet name ditampilkan
  - Room code ditampilkan
  - Tanggal check-in dan check-out ditampilkan
  - Amount total ditampilkan dengan format "Rp xxx.xxx"
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-007: Akses Invoice dengan Booking yang Dihapus**
- **Equivalence Partition**: EP-07
- **Precondition**: 
  - Invoice ada tapi booking_id nya merujuk ke data yang sudah dihapus
- **Test Steps**:
  1. Buat invoice dengan booking valid
  2. Hapus booking (soft delete atau hard delete)
  3. Login sebagai customer
  4. Akses `/customer/invoices`
- **Expected Result**:
  - Sistem menampilkan error handling yang baik
  - Atau menampilkan "N/A" untuk data yang hilang
  - Tidak terjadi crash/error 500
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-008: Customer Melihat Invoice Milik Sendiri**
- **Equivalence Partition**: EP-08
- **Precondition**: 
  - User A login sebagai customer
  - Invoice terkait dengan owner_id User A
- **Test Steps**:
  1. Login sebagai User A
  2. Akses `/customer/invoices`
  3. Pilih salah satu invoice
  4. Klik "View Details"
- **Expected Result**:
  - Invoice detail ditampilkan dengan benar
  - Semua informasi sesuai dengan data invoice User A
  - Status code 200 OK
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-009: Customer Mencoba Akses Invoice User Lain (Unauthorized)**
- **Equivalence Partition**: EP-09
- **Precondition**: 
  - User A login sebagai customer
  - Terdapat invoice milik User B (id = 5)
- **Test Steps**:
  1. Login sebagai User A
  2. Akses langsung URL `/customer/invoices/5` (invoice milik User B)
- **Expected Result**:
  - Error 403 Forbidden muncul
  - Pesan "Unauthorized action." ditampilkan
  - User tidak dapat melihat data invoice orang lain
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-010: Guest (Belum Login) Mengakses Halaman Invoice**
- **Equivalence Partition**: EP-10
- **Precondition**: 
  - User belum login (no session)
- **Test Steps**:
  1. Logout atau gunakan incognito mode
  2. Akses URL `/customer/invoices`
- **Expected Result**:
  - Redirect ke halaman login `/login`
  - Flash message meminta untuk login terlebih dahulu
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-011: Format Amount Normal (Rp 100.000 - Rp 10.000.000)**
- **Equivalence Partition**: EP-11
- **Precondition**: 
  - Invoice memiliki amount = 500000
- **Test Steps**:
  1. Login sebagai customer
  2. Akses invoice dengan amount 500000
  3. Periksa format tampilan
- **Expected Result**:
  - Amount ditampilkan sebagai "Rp 500.000"
  - Separator ribuan menggunakan titik (.)
  - Tidak ada desimal
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-012: Format Amount Sangat Kecil (Boundary)**
- **Equivalence Partition**: EP-12
- **Precondition**: 
  - Invoice memiliki amount = 1
- **Test Steps**:
  1. Buat invoice dengan amount = 1
  2. Login dan lihat invoice tersebut
- **Expected Result**:
  - Amount ditampilkan sebagai "Rp 1"
  - Tidak ada error
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-013: Format Amount Sangat Besar (Boundary)**
- **Equivalence Partition**: EP-13
- **Precondition**: 
  - Invoice memiliki amount = 999999999
- **Test Steps**:
  1. Buat invoice dengan amount = 999999999
  2. Login dan lihat invoice tersebut
- **Expected Result**:
  - Amount ditampilkan sebagai "Rp 999.999.999"
  - Format tetap benar dengan separator
  - Tidak overflow atau terpotong
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-014: Invoice dengan Amount Negatif (Invalid)**
- **Equivalence Partition**: EP-14
- **Precondition**: 
  - Percobaan membuat invoice dengan amount negatif
- **Test Steps**:
  1. Manipulasi database atau API untuk insert amount = -50000
  2. Coba akses invoice tersebut
- **Expected Result**:
  - Sistem validation mencegah penyimpanan amount negatif
  - Atau menampilkan error handling yang baik
  - Tidak crash
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-015: Invoice dengan Amount NULL**
- **Equivalence Partition**: EP-15
- **Precondition**: 
  - Invoice dengan amount = null di database
- **Test Steps**:
  1. Manipulasi data untuk set amount = null
  2. Akses invoice tersebut
- **Expected Result**:
  - Sistem menampilkan "Rp 0" atau pesan error
  - Tidak terjadi crash
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-016: Durasi Booking 1 Hari**
- **Equivalence Partition**: EP-16
- **Precondition**: 
  - Booking dengan start_date = 2025-12-18, end_date = 2025-12-18
- **Test Steps**:
  1. Login sebagai customer
  2. Buka detail invoice untuk booking tersebut
  3. Periksa field durasi
- **Expected Result**:
  - Durasi ditampilkan sebagai "1 days" atau "1 hari"
  - Perhitungan: (end_date - start_date) + 1 = 1
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-017: Durasi Booking Beberapa Hari (2-30 hari)**
- **Equivalence Partition**: EP-17
- **Precondition**: 
  - Booking dengan start_date = 2025-12-18, end_date = 2025-12-23
- **Test Steps**:
  1. Login sebagai customer
  2. Buka detail invoice
  3. Periksa durasi
- **Expected Result**:
  - Durasi ditampilkan sebagai "6 days"
  - Perhitungan benar: 18-23 Des = 6 hari
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-018: Durasi Booking Lama (>30 hari)**
- **Equivalence Partition**: EP-18
- **Precondition**: 
  - Booking dengan start_date = 2025-12-01, end_date = 2026-01-15
- **Test Steps**:
  1. Buat booking dengan durasi panjang
  2. Lihat detail invoice
- **Expected Result**:
  - Durasi ditampilkan sebagai "46 days"
  - Perhitungan akurat meskipun melewati bulan berbeda
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-019: Pagination - Halaman Pertama**
- **Equivalence Partition**: EP-19
- **Precondition**: 
  - Customer memiliki 25 invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices` (default page 1)
  3. Periksa data yang ditampilkan
- **Expected Result**:
  - Menampilkan invoice 1-10 (terbaru)
  - Link "Next" atau "2" tersedia
  - Link "Previous" tidak aktif/hilang
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-020: Pagination - Halaman Tengah**
- **Equivalence Partition**: EP-20
- **Precondition**: 
  - Customer memiliki 25 invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices?page=2`
- **Expected Result**:
  - Menampilkan invoice 11-20
  - Link "Previous" dan "Next" keduanya tersedia
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-021: Pagination - Halaman Terakhir**
- **Equivalence Partition**: EP-21
- **Precondition**: 
  - Customer memiliki 25 invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices?page=3`
- **Expected Result**:
  - Menampilkan invoice 21-25 (5 invoice)
  - Link "Next" tidak aktif/hilang
  - Link "Previous" tersedia
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-022: Pagination - Halaman Tidak Valid**
- **Equivalence Partition**: EP-22
- **Precondition**: 
  - Customer memiliki 25 invoice (hanya 3 halaman)
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices?page=999`
- **Expected Result**:
  - Menampilkan halaman kosong atau
  - Redirect ke halaman terakhir yang valid (page 3)
  - Tidak error 500
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-023: Pagination - Halaman Negatif**
- **Equivalence Partition**: EP-23
- **Precondition**: 
  - Customer memiliki minimal 1 invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices?page=-1`
- **Expected Result**:
  - Redirect ke page 1
  - Atau menampilkan halaman pertama
  - Tidak terjadi error
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-024: Melihat Detail Invoice - Data Lengkap**
- **Equivalence Partition**: EP-06, EP-08
- **Precondition**: 
  - Customer login
  - Invoice memiliki semua relasi data lengkap
- **Test Steps**:
  1. Login sebagai customer
  2. Akses `/customer/invoices`
  3. Klik "View Details" pada salah satu invoice
  4. Periksa semua field detail
- **Expected Result**:
  - Halaman detail invoice ditampilkan
  - **Header**: Invoice No, Tanggal, Status Badge
  - **Booking Details**: Pet Name, Species, Room Code, Room Type, Check-in Date, Check-out Date, Duration, Rate per Day
  - **Amount**: Total Amount dalam format Rupiah
  - **Payment Status**: Pesan "Payment Received" (jika paid) atau "Payment Pending" (jika unpaid)
  - Tombol "Back to Invoices" berfungsi
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-025: Tombol "View Details" Berfungsi dengan Benar**
- **Equivalence Partition**: EP-08
- **Precondition**: 
  - Customer login dan memiliki invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Di halaman `/customer/invoices`, klik tombol "View Details"
  3. Periksa URL dan konten halaman
- **Expected Result**:
  - Redirect ke `/customer/invoices/{invoice_id}`
  - Detail invoice sesuai dengan ID yang dipilih
  - Tidak ada error
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-026: Format Tanggal sesuai Locale**
- **Equivalence Partition**: EP-04, EP-06
- **Precondition**: 
  - Invoice memiliki created_at dan paid_at timestamp
  - Locale aplikasi diset (Indonesia/English)
- **Test Steps**:
  1. Login sebagai customer
  2. Buka detail invoice
  3. Periksa format tanggal
- **Expected Result**:
  - Tanggal ditampilkan dengan format: "Senin, 18 Desember 2025" (jika locale ID)
  - Atau "Monday, 18 December 2025" (jika locale EN)
  - Jam ditampilkan dengan format 24 jam "14:30"
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-027: Tombol "Back to Invoices" dari Detail Invoice**
- **Equivalence Partition**: Navigation Test
- **Precondition**: 
  - User berada di halaman detail invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Buka detail invoice
  3. Klik tombol "Back to Invoices"
- **Expected Result**:
  - Redirect kembali ke `/customer/invoices`
  - Tidak ada data loss
  - Posisi pagination tetap diingat (opsional)
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

### **TC-028: Responsive Design - Mobile View**
- **Equivalence Partition**: UI/UX Test
- **Precondition**: 
  - Customer login dan memiliki invoice
- **Test Steps**:
  1. Login sebagai customer
  2. Akses halaman invoice melalui mobile browser atau resize ke 375px
  3. Periksa tampilan
- **Expected Result**:
  - Layout responsive dan tidak overlap
  - Grid berubah dari 4 kolom ke 1 kolom
  - Tombol dan teks masih terbaca
  - Scroll berfungsi dengan baik
- **Actual Result**: _[To be filled during testing]_
- **Status**: _[Pass/Fail]_

---

## 3. SUMMARY EQUIVALENCE PARTITIONS

| ID | Kategori | Total Partisi | Valid | Invalid | Boundary |
|----|----------|--------------|-------|---------|----------|
| A | Jumlah Data Faktur | 3 | 2 | 0 | 1 |
| B | Status Pembayaran | 2 | 2 | 0 | 0 |
| C | Relasi Data | 2 | 1 | 1 | 0 |
| D | Authentication & Authorization | 3 | 1 | 2 | 0 |
| E | Format & Tipe Data Amount | 5 | 1 | 2 | 2 |
| F | Tanggal & Durasi | 3 | 3 | 0 | 0 |
| G | Pagination | 5 | 3 | 2 | 0 |
| **TOTAL** | **7 Kategori** | **23** | **13** | **7** | **3** |

---

## 4. TEST EXECUTION GUIDELINE

### Urutan Eksekusi Test:
1. **Authentication Tests** (TC-008, TC-009, TC-010) - Pastikan security berfungsi
2. **Data Display Tests** (TC-001, TC-002, TC-003) - Verifikasi tampilan data
3. **Business Logic Tests** (TC-004, TC-005, TC-006, TC-007) - Validasi logika bisnis
4. **Data Validation Tests** (TC-011 - TC-015) - Periksa format dan validasi
5. **Calculation Tests** (TC-016 - TC-018) - Verifikasi perhitungan durasi
6. **Pagination Tests** (TC-019 - TC-023) - Uji navigasi pagination
7. **Detail & Navigation Tests** (TC-024 - TC-027) - Uji fitur detail dan navigasi
8. **UI/UX Tests** (TC-028) - Uji responsive design

### Environment Setup:
- **Browser**: Chrome, Firefox, Edge (latest version)
- **Database**: MySQL/PostgreSQL dengan test data
- **Test Users**:
  - Customer A (memiliki 5 invoice)
  - Customer B (memiliki 25 invoice)
  - Customer C (tidak memiliki invoice)
  - Customer D (invoice dengan data edge cases)

### Test Data Preparation:
```sql
-- Contoh script untuk prepare test data
-- Customer dengan berbagai kondisi invoice
INSERT INTO owners (name, email, phone, address) VALUES 
('Customer A', 'customer.a@test.com', '081234567890', 'Jakarta'),
('Customer B', 'customer.b@test.com', '081234567891', 'Bandung'),
('Customer C', 'customer.c@test.com', '081234567892', 'Surabaya');

-- Invoice dengan berbagai status dan amount
-- Sesuaikan dengan kebutuhan setiap equivalence partition
```

---

## 5. METRICS & REPORTING

### Success Criteria:
- ✅ Semua test case valid (EP-01 sampai EP-21) PASS = **100% coverage**
- ⚠️ Minimal 90% test case PASS untuk go-live
- ❌ Jika ada critical test (authentication, authorization) FAIL = **TIDAK BOLEH go-live**

### Bug Priority:
- **P0 (Critical)**: TC-009, TC-010 (Security issues)
- **P1 (High)**: TC-001, TC-004, TC-005, TC-008 (Core functionality)
- **P2 (Medium)**: TC-011 sampai TC-018 (Data validation)
- **P3 (Low)**: TC-028 (UI/UX)

---

## 6. NOTES

### Catatan Penting:
1. **Equivalence Partitioning** membantu mengurangi jumlah test case dengan tetap menjaga coverage yang baik
2. Setiap partisi mewakili behavior sistem yang sama, sehingga cukup test 1 nilai dari setiap partisi
3. Boundary values tetap diuji karena error sering terjadi di batas-batas nilai
4. Invalid partitions penting untuk memastikan sistem menangani error dengan baik

### Rekomendasi:
- Gunakan **automated testing** untuk regression test
- Lakukan **manual testing** untuk UI/UX aspects
- Update test case ketika ada perubahan requirement atau fitur baru
- Dokumentasikan semua bug yang ditemukan dengan screenshot dan steps to reproduce

---

**Prepared by**: QA Team  
**Last Updated**: 18 Desember 2025  
**Version**: 1.0

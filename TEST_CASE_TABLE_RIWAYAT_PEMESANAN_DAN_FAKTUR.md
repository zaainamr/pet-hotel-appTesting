# TEST CASE - MELIHAT RIWAYAT PEMESANAN DAN FAKTUR
## Pet Hotel Application - Equivalence Partitioning Testing

**Feature**: Melihat Riwayat Pemesanan dan Faktur (Invoice)  
**Module**: Customer Dashboard - Invoice Management  
**Test Date**: 18 Desember 2025  
**Tester**: [Your Name]  
**Testing Technique**: Equivalence Partitioning  

---

## TEST CASE TABLE

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
|------------|---------|---------------|------|-----------|---------------|-------|-------------------|-----------------|-------------------|
| **TS-01** | TC-001 | Melihat Daftar Invoice | Positive | Customer Memiliki Invoice (1-10 invoice) | 1. User sudah login sebagai customer<br>2. Customer memiliki owner_id yang valid<br>3. Terdapat 5 invoice terkait dengan booking customer | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Navigasi ke menu "My Invoices" atau akses `/customer/invoices`<br>3. Verifikasi tampilan halaman | 1. Halaman "My Invoices" ditampilkan<br>2. Terlihat 5 invoice dalam bentuk list<br>3. Setiap invoice menampilkan: Invoice No, Status Badge (Paid/Unpaid), Pet Name, Room Code, Tanggal Booking, Amount<br>4. Tombol "View Details" tersedia pada setiap invoice | [ ] Pass<br>[ ] Fail |
| **TS-01** | TC-002 | Melihat Daftar Invoice | Positive | Customer Memiliki Banyak Invoice (>10) | 1. User sudah login sebagai customer<br>2. Customer memiliki 25 invoice dalam database | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Akses `/customer/invoices`<br>3. Periksa jumlah invoice yang ditampilkan<br>4. Periksa pagination | 1. Menampilkan 10 invoice per halaman<br>2. Pagination menunjukkan 3 halaman (25 ÷ 10)<br>3. Navigasi antar halaman berfungsi<br>4. Data invoice urut dari terbaru | [ ] Pass<br>[ ] Fail |
| **TS-01** | TC-003 | Melihat Daftar Invoice | Boundary | Customer Tidak Memiliki Invoice | 1. User sudah login sebagai customer<br>2. Customer belum pernah membuat booking/invoice<br>3. Database invoice kosong untuk customer ini | 1<br>2<br>3 | 1. Login sebagai customer baru<br>2. Akses `/customer/invoices`<br>3. Periksa tampilan empty state | 1. Halaman ditampilkan dengan empty state<br>2. Muncul icon dokumen abu-abu<br>3. Pesan "No invoices yet" ditampilkan<br>4. Tidak ada error | [ ] Pass<br>[ ] Fail |
| **TS-02** | TC-004 | Status Pembayaran Invoice | Positive | Invoice dengan Status Paid | 1. Customer memiliki invoice dengan paid = true<br>2. paid_at timestamp tersedia<br>3. User sudah login | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses `/customer/invoices`<br>3. Periksa invoice yang sudah paid | 1. Badge hijau dengan text "Paid" ditampilkan<br>2. Tanggal pembayaran ditampilkan (format: "01 Jan 2025, 14:30")<br>3. Checkmark icon berwarna hijau muncul | [ ] Pass<br>[ ] Fail |
| **TS-02** | TC-005 | Status Pembayaran Invoice | Positive | Invoice dengan Status Unpaid | 1. Customer memiliki invoice dengan paid = false<br>2. paid_at = null<br>3. User sudah login | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses `/customer/invoices`<br>3. Periksa invoice yang belum paid | 1. Badge kuning dengan text "Unpaid" ditampilkan<br>2. Tidak ada tanggal pembayaran<br>3. Warning icon berwarna kuning muncul saat lihat detail | [ ] Pass<br>[ ] Fail |
| **TS-03** | TC-006 | Relasi Data Invoice | Positive | Invoice dengan Data Booking Lengkap | 1. Invoice memiliki relasi booking yang valid<br>2. Booking memiliki pet, room, dan owner yang valid<br>3. User sudah login | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses `/customer/invoices`<br>3. Periksa detail invoice | 1. Pet name ditampilkan<br>2. Room code ditampilkan<br>3. Tanggal check-in dan check-out ditampilkan<br>4. Amount total ditampilkan dengan format "Rp xxx.xxx" | [ ] Pass<br>[ ] Fail |
| **TS-03** | TC-007 | Relasi Data Invoice | Negative | Invoice dengan Booking yang Dihapus | 1. Invoice ada tapi booking_id nya merujuk ke data yang sudah dihapus<br>2. User sudah login | 1<br>2<br>3<br>4 | 1. Buat invoice dengan booking valid<br>2. Hapus booking (soft delete atau hard delete)<br>3. Login sebagai customer<br>4. Akses `/customer/invoices` | 1. Sistem menampilkan error handling yang baik<br>2. Atau menampilkan "N/A" untuk data yang hilang<br>3. Tidak terjadi crash/error 500 | [ ] Pass<br>[ ] Fail |
| **TS-04** | TC-008 | Authentication & Authorization | Positive | Customer Melihat Invoice Milik Sendiri | 1. User A login sebagai customer<br>2. Invoice terkait dengan owner_id User A<br>3. Database memiliki invoice milik User A | 1<br>2<br>3<br>4 | 1. Login sebagai User A<br>2. Akses `/customer/invoices`<br>3. Pilih salah satu invoice<br>4. Klik "View Details" | 1. Invoice detail ditampilkan dengan benar<br>2. Semua informasi sesuai dengan data invoice User A<br>3. Status code 200 OK | [ ] Pass<br>[ ] Fail |
| **TS-04** | TC-009 | Authentication & Authorization | Negative | Customer Akses Invoice User Lain (Unauthorized) | 1. User A login sebagai customer<br>2. Terdapat invoice milik User B (id = 5)<br>3. User A tahu URL invoice User B | 1<br>2<br>3 | 1. Login sebagai User A<br>2. Akses langsung URL `/customer/invoices/5` (invoice milik User B)<br>3. Periksa response | 1. Error 403 Forbidden muncul<br>2. Pesan "Unauthorized action." ditampilkan<br>3. User tidak dapat melihat data invoice orang lain | [ ] Pass<br>[ ] Fail |
| **TS-04** | TC-010 | Authentication & Authorization | Negative | Guest (Belum Login) Akses Invoice | 1. User belum login (no session)<br>2. Browser dalam mode incognito atau sudah logout | 1<br>2<br>3 | 1. Logout atau gunakan incognito mode<br>2. Akses URL `/customer/invoices`<br>3. Periksa redirect | 1. Redirect ke halaman login `/login`<br>2. Flash message meminta untuk login terlebih dahulu<br>3. Session redirect benar | [ ] Pass<br>[ ] Fail |
| **TS-05** | TC-011 | Format Amount | Positive | Amount Normal (Rp 100.000 - 10.000.000) | 1. Invoice memiliki amount = 500000<br>2. User sudah login<br>3. Invoice dapat diakses | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses invoice dengan amount 500000<br>3. Periksa format tampilan | 1. Amount ditampilkan sebagai "Rp 500.000"<br>2. Separator ribuan menggunakan titik (.)<br>3. Tidak ada desimal | [ ] Pass<br>[ ] Fail |
| **TS-05** | TC-012 | Format Amount | Boundary | Amount Sangat Kecil | 1. Invoice memiliki amount = 1<br>2. User sudah login | 1<br>2<br>3 | 1. Buat invoice dengan amount = 1<br>2. Login dan lihat invoice tersebut<br>3. Periksa tampilan amount | 1. Amount ditampilkan sebagai "Rp 1"<br>2. Tidak ada error<br>3. Format tetap konsisten | [ ] Pass<br>[ ] Fail |
| **TS-05** | TC-013 | Format Amount | Boundary | Amount Sangat Besar | 1. Invoice memiliki amount = 999999999<br>2. User sudah login | 1<br>2<br>3 | 1. Buat invoice dengan amount = 999999999<br>2. Login dan lihat invoice tersebut<br>3. Periksa tampilan | 1. Amount ditampilkan sebagai "Rp 999.999.999"<br>2. Format tetap benar dengan separator<br>3. Tidak overflow atau terpotong | [ ] Pass<br>[ ] Fail |
| **TS-05** | TC-014 | Format Amount | Negative | Amount Negatif (Invalid) | 1. Database manipulation atau API test<br>2. Attempt insert amount negatif | 1<br>2<br>3 | 1. Manipulasi database atau API untuk insert amount = -50000<br>2. Coba akses invoice tersebut<br>3. Periksa response | 1. Sistem validation mencegah penyimpanan amount negatif<br>2. Atau menampilkan error handling yang baik<br>3. Tidak crash | [ ] Pass<br>[ ] Fail |
| **TS-05** | TC-015 | Format Amount | Negative | Amount NULL | 1. Invoice dengan amount = null di database<br>2. Data manipulation | 1<br>2<br>3 | 1. Manipulasi data untuk set amount = null<br>2. Akses invoice tersebut<br>3. Periksa error handling | 1. Sistem menampilkan "Rp 0" atau pesan error<br>2. Tidak terjadi crash<br>3. User friendly error message | [ ] Pass<br>[ ] Fail |
| **TS-06** | TC-016 | Durasi Booking | Positive | Durasi 1 Hari | 1. Booking dengan start_date = 2025-12-18, end_date = 2025-12-18<br>2. Invoice terkait booking tersebut<br>3. User sudah login | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Buka detail invoice untuk booking tersebut<br>3. Periksa field durasi<br>4. Verifikasi perhitungan | 1. Durasi ditampilkan sebagai "1 days" atau "1 hari"<br>2. Perhitungan: (end_date - start_date) + 1 = 1<br>3. Sesuai dengan logika bisnis | [ ] Pass<br>[ ] Fail |
| **TS-06** | TC-017 | Durasi Booking | Positive | Durasi Beberapa Hari (2-30 hari) | 1. Booking dengan start_date = 2025-12-18, end_date = 2025-12-23<br>2. Invoice tersedia<br>3. User sudah login | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Buka detail invoice<br>3. Periksa durasi<br>4. Verifikasi kalkulasi | 1. Durasi ditampilkan sebagai "6 days"<br>2. Perhitungan benar: 18-23 Des = 6 hari<br>3. Amount sesuai dengan durasi × rate_per_day | [ ] Pass<br>[ ] Fail |
| **TS-06** | TC-018 | Durasi Booking | Positive | Durasi Lama (>30 hari) | 1. Booking dengan start_date = 2025-12-01, end_date = 2026-01-15<br>2. Invoice tersedia<br>3. User sudah login | 1<br>2<br>3<br>4 | 1. Buat booking dengan durasi panjang<br>2. Lihat detail invoice<br>3. Periksa perhitungan durasi<br>4. Verifikasi amount | 1. Durasi ditampilkan sebagai "46 days"<br>2. Perhitungan akurat meskipun melewati bulan berbeda<br>3. Total amount = 46 × rate_per_day | [ ] Pass<br>[ ] Fail |
| **TS-07** | TC-019 | Pagination | Positive | Halaman Pertama | 1. Customer memiliki 25 invoice<br>2. User sudah login<br>3. Pagination diset 10 per page | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Akses `/customer/invoices` (default page 1)<br>3. Periksa data yang ditampilkan<br>4. Periksa link pagination | 1. Menampilkan invoice 1-10 (terbaru)<br>2. Link "Next" atau "2" tersedia<br>3. Link "Previous" tidak aktif/hilang<br>4. Page indicator menunjukkan "1" | [ ] Pass<br>[ ] Fail |
| **TS-07** | TC-020 | Pagination | Positive | Halaman Tengah | 1. Customer memiliki 25 invoice<br>2. User sudah login | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Akses `/customer/invoices?page=2`<br>3. Periksa invoice yang ditampilkan<br>4. Periksa navigation links | 1. Menampilkan invoice 11-20<br>2. Link "Previous" dan "Next" keduanya tersedia<br>3. Page indicator menunjukkan "2"<br>4. Data urut dengan benar | [ ] Pass<br>[ ] Fail |
| **TS-07** | TC-021 | Pagination | Positive | Halaman Terakhir | 1. Customer memiliki 25 invoice<br>2. User sudah login | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Akses `/customer/invoices?page=3`<br>3. Periksa data<br>4. Periksa link navigation | 1. Menampilkan invoice 21-25 (5 invoice)<br>2. Link "Next" tidak aktif/hilang<br>3. Link "Previous" tersedia<br>4. Page indicator menunjukkan "3" | [ ] Pass<br>[ ] Fail |
| **TS-07** | TC-022 | Pagination | Negative | Halaman Tidak Valid | 1. Customer memiliki 25 invoice (hanya 3 halaman)<br>2. User sudah login | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses `/customer/invoices?page=999`<br>3. Periksa response | 1. Menampilkan halaman kosong atau<br>2. Redirect ke halaman terakhir yang valid (page 3)<br>3. Tidak error 500 | [ ] Pass<br>[ ] Fail |
| **TS-07** | TC-023 | Pagination | Negative | Halaman Negatif | 1. Customer memiliki minimal 1 invoice<br>2. User sudah login | 1<br>2<br>3 | 1. Login sebagai customer<br>2. Akses `/customer/invoices?page=-1`<br>3. Periksa behavior | 1. Redirect ke page 1<br>2. Atau menampilkan halaman pertama<br>3. Tidak terjadi error | [ ] Pass<br>[ ] Fail |
| **TS-08** | TC-024 | Detail Invoice | Positive | Melihat Detail Invoice Lengkap | 1. Customer login<br>2. Invoice memiliki semua relasi data lengkap<br>3. Invoice dapat diakses oleh customer | 1<br>2<br>3<br>4<br>5 | 1. Login sebagai customer<br>2. Akses `/customer/invoices`<br>3. Klik "View Details" pada salah satu invoice<br>4. Periksa semua field detail<br>5. Verifikasi data accuracy | 1. Halaman detail invoice ditampilkan<br>2. **Header**: Invoice No, Tanggal, Status Badge<br>3. **Booking Details**: Pet Name, Species, Room Code, Room Type, Check-in, Check-out, Duration, Rate<br>4. **Amount**: Total Amount format Rupiah<br>5. **Payment Status**: "Payment Received" atau "Payment Pending"<br>6. Tombol "Back to Invoices" berfungsi | [ ] Pass<br>[ ] Fail |
| **TS-08** | TC-025 | Detail Invoice | Positive | Tombol "View Details" Berfungsi | 1. Customer login dan memiliki invoice<br>2. Berada di halaman list invoice | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Di halaman `/customer/invoices`, klik tombol "View Details"<br>3. Periksa URL dan konten halaman<br>4. Verifikasi data yang ditampilkan | 1. Redirect ke `/customer/invoices/{invoice_id}`<br>2. Detail invoice sesuai dengan ID yang dipilih<br>3. Tidak ada error<br>4. Loading smooth tanpa delay berlebihan | [ ] Pass<br>[ ] Fail |
| **TS-09** | TC-026 | Format Tanggal | Positive | Format Tanggal sesuai Locale | 1. Invoice memiliki created_at dan paid_at timestamp<br>2. Locale aplikasi diset (Indonesia/English)<br>3. User sudah login | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Buka detail invoice<br>3. Periksa format tanggal<br>4. Periksa konsistensi format | 1. Tanggal ditampilkan: "Senin, 18 Desember 2025" (locale ID)<br>2. Atau "Monday, 18 December 2025" (locale EN)<br>3. Jam format 24 jam "14:30"<br>4. Konsisten di semua halaman | [ ] Pass<br>[ ] Fail |
| **TS-10** | TC-027 | Navigation | Positive | Tombol "Back to Invoices" | 1. User berada di halaman detail invoice<br>2. Sudah login sebagai customer | 1<br>2<br>3<br>4 | 1. Login sebagai customer<br>2. Buka detail invoice<br>3. Klik tombol "Back to Invoices"<br>4. Verifikasi redirect | 1. Redirect kembali ke `/customer/invoices`<br>2. Tidak ada data loss<br>3. Posisi pagination tetap diingat (opsional)<br>4. Smooth navigation | [ ] Pass<br>[ ] Fail |
| **TS-11** | TC-028 | UI/UX | Positive | Responsive Design - Mobile View | 1. Customer login dan memiliki invoice<br>2. Browser support responsive design | 1<br>2<br>3<br>4<br>5 | 1. Login sebagai customer<br>2. Akses halaman invoice melalui mobile browser atau resize ke 375px<br>3. Periksa tampilan<br>4. Test navigasi<br>5. Test semua interaksi | 1. Layout responsive dan tidak overlap<br>2. Grid berubah dari 4 kolom ke 1 kolom<br>3. Tombol dan teks masih terbaca<br>4. Scroll berfungsi dengan baik<br>5. Touch interaction bekerja | [ ] Pass<br>[ ] Fail |

---

## EQUIVALENCE PARTITIONS SUMMARY

| Scenario ID | Test Scenario | Total Test Cases | Positive | Negative | Boundary |
|------------|---------------|------------------|----------|----------|----------|
| TS-01 | Melihat Daftar Invoice | 3 | 2 | 0 | 1 |
| TS-02 | Status Pembayaran Invoice | 2 | 2 | 0 | 0 |
| TS-03 | Relasi Data Invoice | 2 | 1 | 1 | 0 |
| TS-04 | Authentication & Authorization | 3 | 1 | 2 | 0 |
| TS-05 | Format Amount | 5 | 1 | 2 | 2 |
| TS-06 | Durasi Booking | 3 | 3 | 0 | 0 |
| TS-07 | Pagination | 5 | 3 | 2 | 0 |
| TS-08 | Detail Invoice | 2 | 2 | 0 | 0 |
| TS-09 | Format Tanggal | 1 | 1 | 0 | 0 |
| TS-10 | Navigation | 1 | 1 | 0 | 0 |
| TS-11 | UI/UX | 1 | 1 | 0 | 0 |
| **TOTAL** | **11 Scenarios** | **28** | **18** | **7** | **3** |

---

## TEST EXECUTION SUMMARY

| Metric | Value |
|--------|-------|
| **Total Test Cases** | 28 |
| **Executed** | 0 |
| **Passed** | 0 |
| **Failed** | 0 |
| **Blocked** | 0 |
| **Pass Rate** | 0% |
| **Fail Rate** | 0% |

---

## BUG SEVERITY CLASSIFICATION

| Priority | Description | Related Test Cases |
|----------|-------------|-------------------|
| **P0 - Critical** | Security & Authentication issues | TC-009, TC-010 |
| **P1 - High** | Core functionality broken | TC-001, TC-004, TC-005, TC-008, TC-024 |
| **P2 - Medium** | Data validation & formatting | TC-011, TC-012, TC-013, TC-014, TC-015 |
| **P3 - Low** | UI/UX improvements | TC-028 |

---

## TEST ENVIRONMENT

| Component | Details |
|-----------|---------|
| **Application** | Pet Hotel Management System |
| **Version** | 1.0 |
| **Framework** | Laravel 10.x |
| **Database** | MySQL 8.0 |
| **Web Server** | Apache/Nginx |
| **Browser** | Chrome 120+, Firefox 120+, Edge 120+ |
| **OS** | Windows 10/11, macOS, Linux |
| **Mobile Device** | iOS 15+, Android 12+ |

---

## TEST DATA REQUIREMENTS

### User Accounts
- **Customer A**: memiliki 5 invoice (mixed status)
- **Customer B**: memiliki 25 invoice (untuk test pagination)
- **Customer C**: tidak memiliki invoice (untuk test empty state)
- **Customer D**: invoice dengan edge cases (amount ekstrem, durasi panjang)

### Database State
- Minimal 30 invoices dengan berbagai kondisi
- Mix of paid (true/false) status
- Berbagai range amount (1 sampai 999999999)
- Berbagai durasi booking (1 hari sampai >30 hari)

---

## NOTES & REMARKS

### Testing Guidelines:
1. ✅ Execute test cases dalam urutan sesuai Scenario ID
2. ✅ Dokumentasikan setiap bug dengan screenshot dan error message
3. ✅ Catat actual result untuk setiap test case
4. ✅ Marking status: [X] Pass atau [X] Fail
5. ✅ Jika fail, buat bug report dengan referensi Case ID

### Success Criteria:
- **Critical Tests (TS-04)**: 100% PASS wajib
- **Overall Pass Rate**: Minimal 90% untuk production release
- **Blocker Bugs**: 0 bugs dengan severity P0

### Known Limitations:
- Pagination default 10 items per page (hardcoded)
- Locale support tergantung konfigurasi aplikasi
- Soft delete booking belum di-test (requires further investigation)

---

**Document Version**: 1.0  
**Created Date**: 18 Desember 2025  
**Last Updated**: 18 Desember 2025  
**Prepared By**: QA Team  
**Approved By**: [Project Manager Name]  

---

**Catatan**: Untuk menjalankan testing ini dengan efektif, pastikan environment testing sudah di-setup dengan benar dan test data sudah di-seed ke database.

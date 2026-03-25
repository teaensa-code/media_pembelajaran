# 👨‍🏫 PANDUAN GURU - MENGELOLA MATERI & TUGAS

## 🎯 Panduan Lengkap untuk Guru

### Login Awal Guru
```
Email: guru@example.com
Password: guru123
```

---

## 📚 BAGIAN 1: MENGELOLA MATERI PEMBELAJARAN

### Menu Materi
**Akses:** Dashboard → **"📖 Materi Pembelajaran"**
Atau buka langsung: `http://127.0.0.1:8000/materials`

### Fitur yang Tersedia untuk Guru
1. ✅ Melihat semua materi yang telah di-upload
2. ✅ Menambah materi baru
3. ✅ Menghapus materi
4. ⭕ Download link untuk setiap materi (bisa diakses siswa)

---

### Langkah 1: Menambah Materi Baru

#### A. Klik Tombol "Tambah Materi"
- Buka halaman Materi: `/materials`
- Klik tombol hijau **"➕ Tambah Materi"** (di bagian atas kanan)
- Anda akan dibawa ke form penambahan materi

#### B. Isi Form Materi
Form memiliki 3 field:

**1. Judul Materi (Wajib)**
- Contoh: "Dasar-dasar PHP", "Loop dan Kondisional", "Array di PHP"
- Maksimal 255 karakter
- Buat judul yang deskriptif dan jelas

**2. Deskripsi (Opsional)**
- Tambahkan penjelasan singkat tentang materi
- Contoh: "Pembelajaran tentang konsep dasar bahasa pemrograman PHP dan syntax dasar"
- Bisa dibiarkan kosong

**3. Upload File (Opsional)**
- Klik **"Browse"** atau **"Pilih File"**
- Pilih file materi (PDF atau Word)
- Format yang diterima:
  - ✅ PDF (.pdf)
  - ✅ Word (.doc, .docx)
- Ukuran maksimal: 10MB
- Bisa tidak menambahkan file (hanya judul/deskripsi)

#### C. Submit Form
- Klik tombol hijau **"✅ Simpan"**
- Atau klik "Batal" untuk membatalkan

#### D. Verifikasi
- Anda akan kembali ke halaman daftar materi
- Materi baru akan muncul di daftar dengan label "Baru dibuat hari ini"

---

### Langkah 2: Menghapus Materi

1. Buka halaman Materi: `/materials`
2. Temukan materi yang ingin dihapus
3. Klik tombol merah **"🗑️ Hapus"**
4. Konfirmasi dengan mengklik "OK" pada popup

⚠️ **Perhatian:**
- File materi akan dihapus dari server
- Siswa tidak akan bisa mengakses materi lagi
- Tindakan ini tidak bisa dibatalkan

---

### Langkah 3: Memantau Akses Siswa

- Saat ini, tidak ada fitur tracking akses
- Untuk mengetahui siapa yang membuka materi, Anda dapat:
  - Menanyakan langsung kepada siswa
  - Memonitor keaktifan siswa di kelas

---

## ✏️ BAGIAN 2: MENGELOLA TUGAS

### Menu Tugas
**Akses:** Dashboard → **"✏️ Tugas"**
Atau buka langsung: `http://127.0.0.1:8000/tasks`

### Fitur yang Tersedia untuk Guru
1. ✅ Melihat semua tugas yang telah di-upload
2. ✅ Menambah tugas baru dengan file soal
3. ✅ Menghapus tugas
4. ✅ Melihat daftar siswa yang sudah/belum mengumpulkan
5. ✅ Download hasil tugas dari siswa

---

### Langkah 1: Menambah Tugas Baru

#### A. Klik Tombol "Tambah Tugas"
- Buka halaman Tugas: `/tasks`
- Klik tombol hijau **"➕ Tambah Tugas"** (di bagian atas kanan)
- Anda akan dibawa ke form penambahan tugas

#### B. Isi Form Tugas
Form memiliki 3 field:

**1. Judul Tugas (Wajib)**
- Contoh: "Buat Program Sederhana", "Analisis Kode", "Praktik Loop"
- Maksimal 255 karakter
- Buat judul yang jelas

**2. Deskripsi (Opsional)**
- Tambahkan penjelasan atau petunjuk pengerjaan
- Contoh: "Buatlah program PHP yang menghitung luas persegi panjang dengan input dari user"
- Bisa berisi:
  - Tujuan tugas
  - Petunjuk pengerjaan
  - Format output yang diharapkan
  - Deadline (jika ada)

**3. Upload File Soal (Opsional)**
- Klik **"Browse"** atau **"Pilih File"**
- Pilih file soal/instruksi tugas
- Format yang diterima:
  - ✅ PDF (.pdf)
  - ✅ Word (.doc, .docx)
- Ukuran maksimal: 10MB
- Bisa tidak menambahkan file (hanya judul/deskripsi)

#### C. Submit Form
- Klik tombol hijau **"✅ Simpan"**
- Atau klik "Batal" untuk membatalkan

#### D. Verifikasi
- Anda akan kembali ke halaman daftar tugas
- Tugas baru akan muncul di daftar

---

### Langkah 2: Melihat Pengumpulan Tugas

#### A. Akses Halaman Pengumpulan
1. Buka halaman Tugas: `/tasks`
2. Temukan tugas yang ingin Anda pantau
3. Klik tombol biru **"👥 Lihat Pengumpulan"**
4. Anda akan melihat tabel dengan semua pengumpulan siswa

#### B. Tabel Pengumpulan Menampilkan
- **Nama Siswa:** Nama lengkap siswa
- **Status:** "Sudah" atau "Belum" dikumpulkan
- **File:** Link untuk download file dari siswa
- **Tanggal Pengumpulan:** Kapan siswa mengirim (jika sudah)

#### C. Download Hasil Tugas Siswa
1. Di tabel pengumpulan, klik nama siswa atau tombol download
2. File hasil tugas siswa akan diunduh
3. Buka file dan beri penilaian

#### D. Statistik Pengumpulan
Di bagian atas halaman pengumpulan, Anda bisa melihat:
- Total siswa
- Sudah mengumpulkan (jumlah)
- Belum mengumpulkan (jumlah)

---

### Langkah 3: Menghapus Tugas

1. Buka halaman Tugas: `/tasks`
2. Temukan tugas yang ingin dihapus
3. Klik tombol merah **"🗑️ Hapus"**
4. Konfirmasi dengan mengklik "OK"

⚠️ **Perhatian:**
- File soal akan dihapus
- SEMUA pengumpulan siswa untuk tugas ini akan dihapus juga
- Tindakan ini tidak bisa dibatalkan

---

## 📊 ALUR KERJA LENGKAP (GURU)

### 1. Persiapan Materi

```
1. Siapkan file materi (PDF atau Word)
2. Buka /materials
3. Klik "➕ Tambah Materi"
4. Isi judul, deskripsi, upload file
5. Klik "✅ Simpan"
✅ Materi tersedia untuk siswa
```

### 2. Membuat Tugas

```
1. Siapkan file soal/instruksi (PDF atau Word)
2. Buka /tasks
3. Klik "➕ Tambah Tugas"
4. Isi judul, deskripsi, upload file soal
5. Klik "✅ Simpan"
✅ Tugas tersedia untuk siswa
```

### 3. Memantau Pengumpulan

```
1. Buka /tasks
2. Klik "👥 Lihat Pengumpulan" pada tugas
3. Lihat daftar siswa yang sudah/belum mengumpulkan
4. Download file dari siswa untuk diperiksa
✅ Monitor pengumpulan tugas
```

### 4. Memberikan Feedback

```
1. Download file tugas siswa
2. Beri komentar/nilai di file (atau notes terpisah)
3. Komunikasikan feedback kepada siswa
   (via email, chat, atau tatap muka)
✅ Proses pembelajaran berlanjut
```

---

## 💾 ATURAN FILE & KEAMANAN

### File yang Diperbolehkan

**Format:**
- ✅ PDF (.pdf)
- ✅ Microsoft Word (.doc, .docx)

**Ukuran:**
- ✅ Maksimal: 10 MB per file
- ⚠️ Jika file lebih besar, kompres dulu

**Lokasi Penyimpanan:**
- Materi: `/storage/app/public/materials/`
- Tugas: `/storage/app/public/tasks/`
- Pengumpulan: `/storage/app/public/submissions/`

### Keamanan

✅ **File disimpan dengan aman**
✅ **Hanya siswa yang login bisa download**
✅ **File dilindungi dari akses publik**
✅ **Backup otomatis saat penghapusan**

---

## 🛠️ TROUBLESHOOTING

| Masalah | Solusi |
|---------|--------|
| Tidak bisa upload file | Pastikan format PDF/Word dan ukuran < 10MB |
| File tidak muncul setelah upload | Refresh halaman atau bersihkan cache |
| Tidak bisa delete materi/tugas | Pastikan Anda login sebagai guru |
| Siswa tidak bisa download | Periksa apakah file masih ada di server |
| Pengumpulan siswa tidak muncul | Refresh halaman atau cek kembali |

---

## 📋 CHECKLIST UNTUK GURU

- [ ] Saya bisa login dengan email dan password guru
- [ ] Saya bisa membuka halaman Materi
- [ ] Saya bisa menambah materi baru
- [ ] Saya bisa upload file materi (PDF/Word)
- [ ] Saya bisa menghapus materi
- [ ] Saya bisa membuka halaman Tugas
- [ ] Saya bisa menambah tugas baru
- [ ] Saya bisa upload file soal (PDF/Word)
- [ ] Saya bisa melihat pengumpulan tugas
- [ ] Saya bisa download hasil tugas siswa
- [ ] Saya bisa menghapus tugas
- [ ] Siswa bisa mengakses materi dan tugas saya
- [ ] Siswa bisa upload pengumpulan tugas

---

## 📝 CONTOH KASUS PENGGUNAAN

### Contoh 1: Upload Materi PHP

```
1. File materi: "Bab1_Pengenalan_PHP.pdf" (2MB)
2. Buka /materials → Klik "➕ Tambah Materi"
3. Isi:
   - Judul: "Bab 1: Pengenalan PHP dan Instalasi"
   - Deskripsi: "Pembelajaran tentang apa itu PHP, 
     mengapa penting, dan cara instalasi di komputer"
   - File: Upload "Bab1_Pengenalan_PHP.pdf"
4. Klik "✅ Simpan"
5. Siswa bisa membuka dan download materi
```

### Contoh 2: Buat Tugas dengan Soal

```
1. File soal: "Tugas1_Program_Sederhana.docx" (1.5MB)
2. Buka /tasks → Klik "➕ Tambah Tugas"
3. Isi:
   - Judul: "Tugas 1: Buat Program Kalkulator Sederhana"
   - Deskripsi: "Buatlah program PHP yang berfungsi 
     sebagai kalkulator untuk operasi +, -, *, /. 
     Input dari form HTML. Deadline: 5 Februari 2026"
   - File: Upload "Tugas1_Program_Sederhana.docx"
4. Klik "✅ Simpan"
5. Siswa bisa download soal dan submit jawaban
```

### Contoh 3: Cek Pengumpulan Tugas

```
1. Buka /tasks
2. Pada "Tugas 1: Buat Program Kalkulator Sederhana"
   klik "👥 Lihat Pengumpulan"
3. Lihat tabel:
   - Siswa: Sudah = 1, Belum = 1
4. Download file dari Siswa yang sudah submit
5. Periksa dan beri feedback
```

---

## 🎯 BEST PRACTICES

### ✅ DO (Lakukan)

1. **Buat judul yang jelas dan deskriptif**
   - ✅ "Tugas 1: Buat Program Hitung Gaji"
   - ❌ "Tugas 1"

2. **Berikan deskripsi lengkap**
   - ✅ Tuliskan tujuan, instruksi, format output
   - ❌ Biarkan kosong

3. **Upload file berkualitas**
   - ✅ File terformat rapi, font jelas
   - ❌ Foto atau screenshot yang buram

4. **Set deadline yang wajar**
   - ✅ Minimal 3-5 hari untuk pengerjaan
   - ❌ Deadline hari yang sama

5. **Pantau pengumpulan berkala**
   - ✅ Cek status pengumpulan setiap hari
   - ❌ Baru cek sehari sebelum deadline

### ❌ DON'T (Jangan Lakukan)

1. ❌ Jangan upload file yang terlalu besar (>10MB)
2. ❌ Jangan menghapus tugas tanpa backup
3. ❌ Jangan memberi tugas tanpa soal/instruksi
4. ❌ Jangan lupa untuk monitor pengumpulan
5. ❌ Jangan komunikasikan deadline hanya di file

---

## 📞 KONTAK TEKNIS

Jika mengalami masalah teknis atau pertanyaan:
- 📧 Hubungi admin sistem pembelajaran
- 💬 Check dokumentasi di aplikasi
- 🕐 Support tersedia pada jam kerja

---

## ✨ RINGKASAN

| Fitur | Guru | Siswa |
|-------|------|-------|
| Lihat materi | ✅ | ✅ |
| Tambah materi | ✅ | ❌ |
| Delete materi | ✅ | ❌ |
| Download materi | ✅ | ✅ |
| Lihat tugas | ✅ | ✅ |
| Tambah tugas | ✅ | ❌ |
| Delete tugas | ✅ | ❌ |
| Download soal | ✅ | ✅ |
| Submit tugas | ❌ | ✅ |
| Lihat pengumpulan | ✅ | ❌ |
| Download pengumpulan | ✅ | ✅ (milik sendiri) |

---

## 🚀 SELAMAT MENGAJAR!

Sistem pembelajaran ini dirancang untuk memudahkan:
- 📚 Berbagi materi pembelajaran
- ✏️ Memberikan tugas terstruktur
- 📊 Memantau pengumpulan tugas
- 🎯 Pembelajaran yang terorganisir

**Semoga aplikasi ini membantu kesuksesan pembelajaran Anda!** ✨

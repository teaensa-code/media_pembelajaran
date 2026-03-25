# 📚 PANDUAN SISWA - MENGAKSES MATERI & MENGUMPULKAN TUGAS

## 🎯 Panduan Lengkap untuk Siswa

### Login Pertama Kali
```
Email: siswa@example.com
Password: siswa123
```

---

## 📖 BAGIAN 1: MENGAKSES MATERI PEMBELAJARAN

### Langkah 1: Buka Halaman Materi
1. Setelah login, Anda akan melihat dashboard
2. Klik **"📖 Materi Pembelajaran"** di halaman dashboard
3. Atau langsung buka: `http://127.0.0.1:8000/materials`

### Langkah 2: Lihat Daftar Materi
- Anda akan melihat semua materi yang telah di-upload oleh guru
- Setiap materi ditampilkan dalam bentuk kartu (card)
- Untuk setiap materi, Anda bisa melihat:
  - 📚 Judul materi
  - 📝 Deskripsi materi
  - 📅 Tanggal materi dibuat
  - 📥 Tombol Download (jika ada file)

### Langkah 3: Download Materi
1. Cari materi yang ingin Anda pelajari
2. Klik tombol **"📥 Download"** (berwarna biru)
3. File akan diunduh ke komputer Anda (PDF atau Word)
4. Buka file tersebut untuk mempelajari isinya

### Contoh Materi yang Tersedia
- ✅ Materi 1: Pengenalan PHP (Download tersedia)
- ✅ Materi 2: Variabel dan Tipe Data (Download tersedia)

---

## ✏️ BAGIAN 2: MELIHAT DAN MENGUMPULKAN TUGAS

### Langkah 1: Buka Halaman Tugas
1. Setelah login, klik **"✏️ Tugas"** di dashboard
2. Atau langsung buka: `http://127.0.0.1:8000/tasks`

### Langkah 2: Lihat Daftar Tugas
- Anda akan melihat semua tugas yang diberikan oleh guru
- Setiap tugas ditampilkan dalam bentuk kartu (card)
- Untuk setiap tugas, Anda bisa melihat:
  - ✏️ Judul tugas
  - 📝 Deskripsi tugas (keterangan tugas)
  - 📥 Tombol Download (untuk mengunduh soal, jika ada)
  - 📊 Status pengerjaan:
    - ✅ **"Sudah dikumpulkan"** = Anda sudah mengirim tugas
    - ⏳ **"Belum dikumpulkan"** = Anda belum mengirim tugas
  - 📤 Tombol "Kumpulkan Tugas"

### Langkah 3: Download Soal Tugas (Opsional)
1. Klik tombol **"📥 Download Soal"** (jika ada)
2. File soal akan diunduh
3. Baca soal dan kerjakan di komputer Anda
4. Siapkan file jawaban (dalam format PDF atau Word)

### Langkah 4: Mengumpulkan Tugas
1. Klik tombol **"📤 Kumpulkan Tugas"** (berwarna hijau)
2. Anda akan dibawa ke halaman pengumpulan tugas
3. Di halaman ini Anda akan melihat:
   - Judul dan deskripsi tugas
   - Status pengumpulan sebelumnya (jika ada)
   - Tombol "📥 Download Soal" (untuk mengunduh ulang)
   - **Form pengumpulan dengan upload file**

### Langkah 5: Upload File Jawaban
1. Di form pengumpulan, klik **"Browse"** atau **"Pilih File"**
2. Pilih file jawaban Anda (PDF atau Word)
3. Pastikan file Anda:
   - ✅ Format: PDF (.pdf) atau Word (.doc, .docx)
   - ✅ Ukuran: Maksimal 10MB
   - ✅ Nama file jelas (misalnya: "Jawaban_Tugas_1.pdf")

### Langkah 6: Submit Tugas
1. Setelah memilih file, klik tombol **"📤 Kumpulkan"** (berwarna hijau)
2. Tunggu beberapa detik...
3. Anda akan kembali ke halaman daftar tugas
4. Status akan berubah menjadi:
   - ✅ **"Sudah dikumpulkan"** dengan tanggal dan jam pengumpulan

### Langkah 7: Verifikasi Pengumpulan
1. Pastikan status menunjukkan "Sudah dikumpulkan"
2. Jika ada link **"📥 Download Kiriman"**, Anda bisa mengklik untuk:
   - Memverifikasi file yang telah dikirim
   - Mendownload kembali file Anda sendiri

---

## 🔄 MENGUBAH/MENGIRIM ULANG TUGAS

### Jika Anda Ingin Mengirim Ulang (Re-submit)
1. Buka halaman tugas (`/tasks`)
2. Tugas yang sudah dikumpulkan akan menunjukkan:
   - ✅ Status: "Sudah dikumpulkan"
   - Link "📥 Download Kiriman"
   - Tombol **"📤 Kumpulkan Tugas"** masih tersedia
3. Klik **"📤 Kumpulkan Tugas"** lagi
4. Pilih file baru/yang sudah direvisi
5. Klik **"📤 Kumpulkan"**
6. **File lama akan otomatis diganti** dengan file baru
7. Tanggal pengumpulan akan diperbarui

---

## 💡 TIPS & TRIK

### ✅ Tips Mengumpulkan Tugas
1. **Buat nama file yang jelas:**
   - ❌ Hindari: `file1.pdf`, `document.pdf`, `tugas.pdf`
   - ✅ Gunakan: `Jawaban_Tugas1_PHP_Basis.pdf`

2. **Periksa ukuran file:**
   - Jika file lebih besar dari 10MB, kompres terlebih dahulu
   - Untuk file Word, bisa gunakan "Compress Pictures"
   - Untuk PDF, gunakan tools online atau aplikasi PDF

3. **Backup file:**
   - Simpan copy jawaban Anda di tempat aman
   - Jangan hapus file original sampai guru memberikan feedback

4. **Format dokumen:**
   - Pastikan dokumen rapi dan mudah dibaca
   - Gunakan font yang jelas (Arial, Calibri, Times New Roman)
   - Ukuran font minimal 11pt

5. **Waktu pengumpulan:**
   - Jangan menunggu sampai menit terakhir
   - Uploadlah tugas lebih awal untuk menghindari kesalahan teknis

---

## ❌ MASALAH UMUM & SOLUSI

| Masalah | Solusi |
|---------|--------|
| Tombol tidak merespons | Refresh halaman atau bersihkan cache browser |
| File tidak bisa diupload | Pastikan format PDF/Word dan ukuran < 10MB |
| Tidak bisa login | Pastikan email dan password benar |
| Status masih "Belum dikumpulkan" setelah submit | Refresh halaman, biasanya akan update otomatis |
| File hasil download tidak bisa dibuka | Coba download ulang atau gunakan aplikasi lain |
| Browser lamban | Tutup tab lain atau gunakan browser berbeda |

---

## 📞 KONTAK GURU

Jika mengalami masalah teknis:
- 📧 Email guru: guru@example.com
- 💬 Hubungi guru saat jam pelajaran
- 🕐 Hubungi secepatnya jika ada deadline

---

## 🎯 RINGKASAN CEPAT

### Materi Pembelajaran
```
Dashboard → 📖 Materi Pembelajaran → Lihat Materi → 📥 Download
```

### Mengumpulkan Tugas
```
Dashboard → ✏️ Tugas → 📤 Kumpulkan Tugas → Pilih File → 📤 Kumpulkan
```

### Mengecek Status
```
Dashboard → ✏️ Tugas → Lihat Status (✅ atau ⏳) → 📥 Download Kiriman
```

---

## ✅ CHECKLIST UNTUK SISWA

- [ ] Saya bisa login dengan email dan password
- [ ] Saya bisa membuka halaman Materi Pembelajaran
- [ ] Saya bisa melihat daftar materi
- [ ] Saya bisa mendownload file materi
- [ ] Saya bisa membuka halaman Tugas
- [ ] Saya bisa melihat daftar tugas
- [ ] Saya bisa mendownload soal tugas
- [ ] Saya bisa melihat status pengumpulan
- [ ] Saya bisa mengupload file jawaban
- [ ] Saya bisa melihat file yang telah dikirim
- [ ] Saya bisa mengirim ulang tugas jika diperlukan

---

## 📝 CATATAN PENTING

⚠️ **Jangan lupa:**
- Selalu backup file jawaban Anda
- Cek status pengumpulan setelah submit
- Jangan menghapus file sampai guru memberi feedback
- Hubungi guru jika ada pertanyaan tentang tugas
- Keluar (logout) setelah selesai, terutama di komputer publik

✅ **Semoga sukses dalam pembelajaran!**

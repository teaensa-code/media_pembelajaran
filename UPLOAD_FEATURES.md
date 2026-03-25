# Fitur Upload Materi dan Tugas - Aplikasi Pembelajaran Laravel

## 📋 Overview

Fitur upload memungkinkan:
- **Guru**: Upload materi dan tugas dalam format PDF/Word
- **Siswa**: Download materi dan tugas, serta upload pengumpulan tugas
- **Kontrol File**: Penyimpanan file di storage Laravel public disk dengan validasi keamanan

## 🏗️ Struktur Teknis

### Database
- **materials** table: tambahan kolom `file_path` (string, nullable)
- **tasks** table: tambahan kolom `file_path` (string, nullable)
- **task_submissions** table (baru): 
  - `id` (bigint, primary key)
  - `task_id` (foreign key ke tasks)
  - `user_id` (foreign key ke users)
  - `file_path` (string)
  - `submitted_at` (timestamp)
  - `created_at`, `updated_at` (timestamps)

### Models
- **Material**: fillable `['title', 'description', 'file_path']`
- **Task**: fillable `['title', 'description', 'file_path']`, hasMany submissions
- **TaskSubmission** (baru): relasi belongsTo task dan user

### Controllers
- **MaterialController**:
  - `store()`: Handle upload file materi
  - `download(Material)`: Download file materi

- **TaskController**:
  - `store()`: Handle upload file tugas
  - `download(Task)`: Download file soal tugas
  - `submitForm(Task)`: Tampilkan form pengumpulan
  - `storeSubmission(Task)`: Handle upload pengumpulan
  - `submissions(Task)`: Lihat daftar pengumpulan (guru)
  - `downloadSubmission(Submission)`: Download file submission

### Routes
```php
// Materi download
GET /materials/{material}/download

// Tugas
GET /tasks/{task}/download              // Download soal
GET /tasks/{task}/submit               // Form pengumpulan
POST /tasks/{task}/submission          // Upload pengumpulan
GET /submissions/{submission}/download // Download submission (guru)
GET /tasks/{task}/submissions          // Lihat pengumpulan (guru)
```

### File Storage
- Materi: `storage/app/public/materials/`
- Tugas: `storage/app/public/tasks/`
- Pengumpulan: `storage/app/public/submissions/`

## 🔒 Validasi

**File Validation**:
- Format: PDF, DOC, DOCX
- Ukuran maksimal: 10MB
- Validasi di controller menggunakan Laravel validation rules

**Access Control**:
- Guru: Bisa upload materi/tugas
- Siswa: Download materi/tugas, upload pengumpulan
- Download submission: Hanya guru atau siswa yang submit

## 📱 User Interface

### Siswa
1. **Halaman Materi**:
   - Lihat daftar materi
   - Tombol "Download" untuk setiap materi dengan file

2. **Halaman Tugas**:
   - Lihat daftar tugas
   - Tombol "Download Soal" untuk unduh
   - Status pengumpulan (belum/sudah dikumpulkan)
   - Tombol "Kumpulkan Tugas" untuk submit
   
3. **Form Pengumpulan**:
   - Upload file dengan validasi
   - Lihat detail tugas
   - Opsi re-upload (mengganti submission lama)

### Guru
1. **Halaman Materi**:
   - Tombol "Tambah Materi" dengan form upload
   - Tampilkan file yang sudah di-upload

2. **Halaman Tugas**:
   - Tombol "Tambah Tugas" dengan form upload
   - Tombol "Lihat Pengumpulan" untuk melihat submissions
   
3. **Halaman Pengumpulan**:
   - Tabel daftar siswa yang sudah submit
   - Tombol download untuk setiap submission

## ⚙️ Penggunaan

### Guru Upload Materi:
1. Login sebagai guru
2. Ke menu "Materi"
3. Klik "Tambah Materi"
4. Isi judul, deskripsi, dan upload file
5. Submit

### Siswa Download Materi:
1. Login sebagai siswa
2. Ke menu "Materi"
3. Lihat daftar materi
4. Klik tombol "Download" untuk file

### Guru Upload Tugas:
1. Login sebagai guru
2. Ke menu "Tugas"
3. Klik "Tambah Tugas"
4. Isi judul, deskripsi, dan upload file soal
5. Submit

### Siswa Submit Pengumpulan:
1. Login sebagai siswa
2. Ke menu "Tugas"
3. Lihat tugas yang belum dikumpulkan
4. Klik "Kumpulkan Tugas"
5. Upload file jawaban
6. Submit

### Guru Lihat Pengumpulan:
1. Login sebagai guru
2. Ke menu "Tugas"
3. Klik "Lihat Pengumpulan" pada tugas
4. Lihat tabel siswa yang submit
5. Download file pengumpulan

## 🔧 Setup (Jika Menjalankan Manual)

```bash
# Jalankan migration
php artisan migrate

# Setup storage link (jika belum)
php artisan storage:link

# Seed data (opsional)
php artisan db:seed
```

## 📂 File Locations

- **Controllers**: `app/Http/Controllers/`
  - MaterialController.php
  - TaskController.php

- **Models**: `app/Models/`
  - Material.php
  - Task.php
  - TaskSubmission.php (baru)

- **Migrations**: `database/migrations/`
  - 2026_01_31_000004_add_file_uploads.php

- **Views**: `resources/views/`
  - materials/index.blade.php (updated)
  - materials/create.blade.php (updated)
  - tasks/index.blade.php (updated)
  - tasks/create.blade.php (updated)
  - tasks/submissions.blade.php (baru)
  - tasks/submit.blade.php (baru)

- **Routes**: `routes/web.php` (updated)

## 🛡️ Keamanan

1. **Middleware**: Hanya user login yang bisa akses
2. **Role-Based**: Guru dan siswa punya akses berbeda
3. **File Validation**: Validasi tipe dan ukuran file
4. **Storage Path**: File disimpan di public storage dengan unique name
5. **Authorization**: Download submission hanya bisa guru atau siswa yang submit

## 📝 Contoh Implementasi

### Upload Materi di Controller:
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('materials', 'public');
    }

    Material::create([...]);
}
```

### Download File:
```php
public function download(Material $material)
{
    return Storage::disk('public')->download($material->file_path);
}
```

## 🎯 Testing Checklist

- [ ] Guru bisa upload materi dengan file
- [ ] Siswa bisa download materi
- [ ] Guru bisa upload tugas dengan file
- [ ] Siswa bisa download tugas
- [ ] Siswa bisa upload pengumpulan
- [ ] Guru bisa lihat daftar pengumpulan
- [ ] Guru bisa download pengumpulan
- [ ] File validation berfungsi (hanya pdf/doc/docx)
- [ ] Size validation berfungsi (max 10MB)
- [ ] Akses kontrol berfungsi (siswa tidak bisa upload materi)

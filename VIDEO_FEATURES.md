# Fitur Upload Video - Aplikasi Pembelajaran Laravel

## 📋 Overview

Fitur upload video memungkinkan:
- **Guru**: Upload video file (MP4/AVI) atau masukkan link video (YouTube, dll)
- **Siswa**: Menonton video via player HTML5 atau embed dari link
- **Kontrol File**: File disimpan di storage Laravel public disk dengan validasi keamanan
- **Fleksibel**: Dua mode upload - file atau link

## 🏗️ Struktur Teknis

### Database
- **videos** table: tambahan kolom `file_path` (string, nullable) dan `video_link` (string, nullable)
  - `id` (bigint, primary key)
  - `title` (string)
  - `description` (text, nullable)
  - `file_path` (string, nullable) - Path ke file video
  - `video_link` (string, nullable) - URL video (YouTube, dll)
  - `created_at`, `updated_at` (timestamps)

### Models
- **Video**: 
  - fillable `['title', 'description', 'file_path', 'video_link']`
  - Accessor `getEmbedLinkAttribute()` - Convert YouTube URLs to embed format
  - Method `isFileVideo()` - Check if video is file-based
  - Method `isLinkVideo()` - Check if video is link-based

### Controllers
- **VideoController**:
  - `index()`: Tampilkan daftar video
  - `create()`: Tampilkan form upload dengan pilihan file/link
  - `store()`: Handle upload file atau penyimpanan link
  - `download(Video)`: Download file video
  - `destroy(Video)`: Hapus video dan file

### Routes
```php
// Video view
GET /videos                     // Daftar video
GET /videos/{video}/download    // Download file video

// Video management (guru)
GET /videos/create              // Form upload
POST /videos                    // Submit form
DELETE /videos/{video}          // Hapus video
```

### File Storage
- Video Files: `storage/app/public/videos/`
- Subdirectory: Organized by upload date

## 🔒 Validasi

**File Validation**:
- Format: MP4, AVI
- Ukuran maksimal: 50MB
- Validasi di controller menggunakan Laravel validation rules

**Link Validation**:
- Harus URL valid (https://...)
- Support YouTube, Vimeo, dan video link lainnya
- Auto-convert YouTube URLs ke embed format

**Access Control**:
- Guru: Bisa upload video file atau link
- Siswa: Download file atau watch embed
- Download: Hanya siswa login yang bisa akses

## 📱 User Interface

### Siswa
1. **Halaman Video**:
   - Lihat daftar semua video
   - Video dari file: Player HTML5 built-in
   - Video dari link: Embed iframe (YouTube) atau link
   - Responsif dan mobile-friendly

### Guru
1. **Halaman Video**:
   - Tombol "Tambah Video" dengan form upload
   - Preview video (file atau link)
   - Tombol hapus untuk setiap video

2. **Form Upload**:
   - Radio button untuk pilih: File atau Link
   - Jika File: File input (MP4/AVI, max 50MB)
   - Jika Link: URL input dengan validasi
   - Dynamic form sesuai pilihan upload type

## ⚙️ Penggunaan

### Guru Upload File Video:
1. Login sebagai guru
2. Ke menu "🎬 Video Pembelajaran"
3. Klik "➕ Tambah Video"
4. Pilih "Upload File Video (MP4/AVI - Max 50MB)"
5. Isi judul, deskripsi, dan pilih file
6. Submit

### Guru Tambah Link Video:
1. Login sebagai guru
2. Ke menu "🎬 Video Pembelajaran"
3. Klik "➕ Tambah Video"
4. Pilih "Masukkan Link Video (YouTube, dll)"
5. Isi judul, deskripsi, dan link YouTube
6. Submit

### Siswa Menonton Video:
1. Login sebagai siswa
2. Ke menu "🎬 Video Pembelajaran"
3. Lihat daftar video
4. **Untuk file**: Player akan tampil, klik play untuk menonton
5. **Untuk link**: Klik embed atau link untuk menonton

### Guru Hapus Video:
1. Login sebagai guru
2. Ke menu "🎬 Video Pembelajaran"
3. Klik tombol "🗑️ Hapus" pada video
4. Konfirmasi hapus

## 📂 File Locations

- **Controller**: `app/Http/Controllers/VideoController.php`
- **Model**: `app/Models/Video.php`
- **Migration**: `database/migrations/2026_01_31_000005_add_video_uploads.php`
- **Views**: 
  - `resources/views/videos/index.blade.php`
  - `resources/views/videos/create.blade.php`
- **Routes**: `routes/web.php`

## 🛡️ Keamanan

1. **Middleware**: Hanya user login yang bisa akses
2. **Role-Based**: Guru upload, siswa view
3. **File Validation**: Tipe (MP4/AVI) dan ukuran (50MB)
4. **Link Validation**: URL harus valid
5. **Storage Path**: File disimpan di public storage
6. **Auto-Delete**: File dihapus saat delete video

## 💻 Implementasi Detail

### Upload File Video:
```php
$validated = $request->validate([
    'upload_type' => 'required|in:file,link',
    'file' => 'nullable|required_if:upload_type,file|file|mimes:mp4,avi|max:51200',
]);

if ($validated['upload_type'] === 'file') {
    $filePath = $request->file('file')->store('videos', 'public');
}

Video::create(['file_path' => $filePath]);
```

### Display Video:
```blade
@if($video->isFileVideo())
    <video width="100%" controls>
        <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
    </video>
@elseif($video->isLinkVideo())
    <iframe src="{{ $video->embedLink }}"></iframe>
@endif
```

### YouTube URL Converter:
```php
// Extract video ID dan convert ke embed URL
preg_match('/(youtu\.be|youtube\.com).*[?&]v=([^&]*)/i', $url, $matches);
$embedUrl = 'https://www.youtube.com/embed/' . $matches[2];
```

## 📝 Testing Checklist

- [ ] Guru bisa upload file MP4/AVI dengan validasi ukuran
- [ ] Guru bisa tambah link YouTube
- [ ] Siswa bisa lihat video dari file dengan player
- [ ] Siswa bisa lihat video dari link dengan embed
- [ ] Player controls berfungsi (play, pause, volume, fullscreen)
- [ ] Link validation berfungsi
- [ ] File size validation berfungsi (max 50MB)
- [ ] File type validation berfungsi (hanya MP4/AVI)
- [ ] Download file video berfungsi
- [ ] Hapus video menghapus file juga
- [ ] Akses kontrol berfungsi (siswa tidak bisa upload)
- [ ] Form toggle (file/link) berfungsi dengan baik

## 🎯 Supported Video Formats

**File Upload**:
- MP4 (MPEG-4 Video)
- AVI (Audio Video Interleave)
- Max size: 50MB

**Link Support**:
- YouTube (auto-convert ke embed)
- Vimeo
- Custom video URLs
- Lebih dari 50MB bisa via link

## 📊 Data Example

```sql
-- File video
INSERT INTO videos VALUES (
    1, 'Tutorial PHP Dasar', 'Belajar PHP dari nol', 
    'videos/2026/01/tutorial.mp4', NULL, NOW(), NOW()
);

-- Link video
INSERT INTO videos VALUES (
    2, 'Video YouTube', 'Lihat di YouTube', 
    NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', NOW(), NOW()
);
```

## 🚀 Setup Commands

```bash
# Jalankan migration
php artisan migrate

# Seed data (opsional)
php artisan db:seed

# Setup storage link (jika belum)
php artisan storage:link
```

## 🔗 Links & Resources

- Laravel File Storage: https://laravel.com/docs/storage
- HTML5 Video: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/video
- YouTube Embed: https://developers.google.com/youtube/iframe_api_reference

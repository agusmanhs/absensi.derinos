# Absensi Derinos — Panduan Proyek untuk Agen

## Gambaran Umum

**Absensi Derinos** adalah sistem manajemen presensi (absensi) karyawan berbasis web yang dibangun dengan Laravel 12. Sistem ini mencakup verifikasi GPS real-time, manajemen izin, laporan PDF, dan notifikasi Telegram. Target pengguna adalah perusahaan Indonesia dengan banyak lokasi kantor.

---

## Model Bisnis

### Aktor

| Aktor | Level | Akses |
|-------|-------|-------|
| Admin | `level = Admin` | Kelola seluruh sistem: karyawan, lokasi, jabatan, laporan, persetujuan izin |
| Karyawan (User) | `level = User` | Absen masuk/keluar, ajukan izin, lihat riwayat absen sendiri |

### Entitas Utama

```
Users (akun login)
  └── Pegawai (data karyawan: NIK, foto, alamat, telepon)
        └── Jabatan (jabatan kerja)
              └── Lokasi (kantor: koordinat GPS, jam kerja, radius geofence)

Absensis (record absensi harian: waktu, GPS, status)
Libur   (tanggal libur/hari merah yang dikonfigurasi admin)
```

### Relasi Antar Entitas

```
Users      ──1:1──> Pegawai
Pegawai    ──N:1──> Jabatan
Jabatan    ──N:1──> Lokasi
Users      ──1:N──> Absensis
Lokasi     ──(menentukan jam kerja & geofence untuk Absensis)
Libur      ──(standalone, mempengaruhi validasi hari absen)
```

---

## Alur Bisnis Utama

### 1. Absen Masuk (Check-In)

```
Karyawan buka dashboard
    │
    ├─► Sistem cek: apakah hari ini Minggu atau ada di tabel Libur?
    │       └─ YA  → Tampilkan "Hari ini libur", hentikan proses
    │
    ├─► Sistem cek: apakah sudah absen hari ini?
    │       └─ YA  → Tampilkan tombol absen keluar (checkout), hentikan proses check-in
    │
    ├─► Karyawan kirim koordinat GPS perangkat
    │
    ├─► Sistem hitung jarak ke kantor (dari Jabatan → Lokasi.lokasi)
    │       └─ Jarak > (Lokasi.batas_jarak + 20m buffer)?
    │               └─ YA  → Tolak, tampilkan pesan jarak terlalu jauh
    │
    ├─► Bandingkan waktu sekarang vs Lokasi.jam_masuk:
    │       ├─ Tepat waktu → ket_masuk = "Tepat Waktu"
    │       └─ Terlambat   → ket_masuk = "Terlambat X menit / X jam Y menit"
    │
    ├─► Simpan record Absensis:
    │       status="hadir", absen_masuk=NOW(), lokasi_masuk=GPS, tanggal=TODAY
    │
    └─► Kirim notifikasi Telegram ke grup admin
```

### 2. Absen Keluar (Check-Out)

```
Karyawan klik absen keluar
    │
    ├─► Karyawan kirim koordinat GPS perangkat
    │
    ├─► Sistem validasi jarak ke kantor (sama seperti check-in)
    │       └─ Jarak > batas → Tolak
    │
    ├─► Bandingkan waktu sekarang vs Lokasi.jam_keluar:
    │       ├─ < (jam_keluar - 1 jam)  → ket_keluar = "Pulang Cepat X jam Y menit"
    │       ├─ antara keduanya          → ket_keluar = "Tepat Waktu"
    │       └─ > jam_keluar             → ket_keluar = "Lembur X jam Y menit"
    │
    ├─► Update record Absensis:
    │       absen_keluar=NOW(), lokasi_keluar=GPS, ket_keluar=keterangan
    │
    └─► Kirim notifikasi Telegram ke grup admin
```

### 3. Pengajuan Izin

```
Karyawan isi form izin (tanggal + alasan)
    │
    ├─► Validasi: tanggal harus hari ini atau masa depan
    │
    ├─► Buat/update record Absensis:
    │       status="pending", ket_izin=alasan, tanggal=tanggal_izin
    │
    ├─► Kirim notifikasi Telegram ke grup admin
    │
    └─► Admin lihat daftar izin pending di panel admin
            │
            ├─► Setujui → status="izin", notifikasi Telegram ke karyawan
            └─► Tolak   → hapus record, notifikasi Telegram ke karyawan
```

### 4. Laporan Absensi

```
Admin pilih jenis laporan:
    ├─► Laporan Harian:
    │       - Daftar semua karyawan + status hari ini
    │       - Export PDF
    │
    └─► Laporan Bulanan:
            - Pilih bulan & tahun, atau filter per karyawan
            - Periode: tanggal 25 bulan sebelumnya s/d tanggal 24 bulan ini
            - Matriks: tiap hari × tiap karyawan (jam masuk, jam keluar, ket)
            - Ringkasan: total hadir, izin, alfa, terlambat, lembur
            - Export PDF
```

---

## Aturan Bisnis Penting

| Aturan | Detail |
|--------|--------|
| **Geofence** | Karyawan harus berada dalam radius `batas_jarak + 20m` dari kantor untuk bisa absen |
| **Hari libur** | Minggu + tanggal di tabel `libur` → absen ditolak |
| **Periode laporan** | Satu periode = tanggal 25 bulan lalu s/d tanggal 24 bulan ini |
| **Izin** | Tidak bisa absen masuk di tanggal yang sudah disetujui izin |
| **Satu absen per hari** | Sistem mencegah duplikasi check-in dalam satu hari kalender |
| **Lembur** | Otomatis dihitung jika keluar setelah `jam_keluar` |
| **Pulang cepat** | Dihitung jika keluar lebih dari 1 jam sebelum `jam_keluar` |

---

## Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Framework | Laravel 12 (PHP 8.2+) |
| Database | MySQL |
| Frontend | Blade + Tailwind CSS v4 + Vite |
| PDF | barryvdh/laravel-dompdf |
| Notifikasi | Telegram Bot (irazasyed/telegram-bot-sdk) |
| Maps | Google Maps iframe embed |
| Auth | Laravel session-based, bcrypt (12 rounds) |

---

## Integrasi Telegram

- **Bot webhook**: `POST /api/telegram/webhook`
- **Grup admin chat ID**: `-5046766680` (konfigurasi di `.env` → `TELEGRAM_CHAT_ID`)
- **Notifikasi dikirim untuk**:
  - Absen masuk baru
  - Absen keluar
  - Pengajuan izin baru
  - Persetujuan/penolakan izin
- **Controller**: `app/Http/Controllers/TelegramController.php`

---

## Struktur File Penting

```
app/
├── Http/Controllers/
│   ├── AbsenController.php      # Logic check-in/check-out karyawan
│   ├── AdminController.php      # Dashboard & manajemen admin
│   ├── IzinController.php       # Pengajuan & persetujuan izin
│   ├── LaporanController.php    # Generate laporan PDF
│   ├── LaporanBulananController.php
│   ├── PegawaiController.php    # CRUD data karyawan
│   ├── JabatanController.php    # CRUD jabatan
│   ├── LokasiController.php     # CRUD lokasi kantor
│   ├── LiburController.php      # CRUD hari libur
│   └── TelegramController.php   # Webhook & notifikasi Telegram
├── Models/
│   ├── User.php
│   ├── Pegawai.php
│   ├── Jabatan.php
│   ├── Lokasi.php
│   ├── Absensi.php
│   └── Libur.php
└── Helpers/
    └── Helper.php               # Kalkulasi jarak, format durasi waktu

routes/
├── web.php   # Semua route UI (admin & user panel)
└── api.php   # Telegram webhook endpoint

resources/views/
├── admin/    # Tampilan panel admin
└── user/     # Tampilan panel karyawan
```

---

## Status Field pada Absensis

| Status | Keterangan |
|--------|------------|
| `hadir` | Karyawan hadir (check-in tercatat) |
| `pending` | Izin diajukan, menunggu persetujuan admin |
| `izin` | Izin disetujui admin |

---

## Catatan Khusus Implementasi

- Timezone: Aplikasi menggunakan UTC di DB, tapi logic absen mengacu ke GMT+7/WIB
- Buffer geofence: 20 meter ditambahkan ke `batas_jarak` (di config: `config('absensi.buffer_jarak', 20)`)
- Foto karyawan: Disimpan di `storage/app/public/foto/`
- Lembur minimum: Dihitung jika keluar setelah `jam_keluar` tanpa batas maksimum
- Admin melihat semua absen; User hanya melihat absen milik sendiri

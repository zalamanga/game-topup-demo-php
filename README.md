# Game Top-up Demo (PHP)

Latihan PHP dan MySQL untuk katalog paket Mobile Legends, Free Fire, dan PUBG, pendaftaran, login, serta pencatatan pesanan. Aplikasi ini tidak mengirim kredit game dan tidak terhubung ke payment gateway.

## Yang tersedia

- Registrasi akun user dan login dengan password hash.
- Admin mengelola paket dan membaca daftar transaksi.
- Pengguna memilih paket dan mencatat pesanan; harga diambil kembali dari database.
- Role admin diperiksa pada server. Admin dibuat melalui CLI, bukan melalui form registrasi.

## Menjalankan di lokal

Gunakan PHP 8.1+ dengan mysqli/mysqlnd dan MySQL atau MariaDB. Buat database kosong bernama `game_topup_demo`, lalu impor `database/schema.sql`. SQL tersebut hanya membentuk tabel, tanpa akun atau transaksi asli.

PHP native tidak membaca `.env` otomatis. `.env.example` menjelaskan nama variabel; tetapkan variabel pada terminal. Contoh PowerShell dari folder proyek:

```powershell
$env:DB_HOST='127.0.0.1'
$env:DB_USER='demo_user'
$env:DB_PASSWORD='isi-password-database-lokal'
$env:DB_NAME='game_topup_demo'
$env:ADMIN_USERNAME='admin_demo'
$env:ADMIN_PASSWORD='ganti-password-demo-anda'
php scripts/create-admin.php
php -S 127.0.0.1:8088
```

Nilai di atas hanya contoh. Pengguna database perlu izin pada database demo tersebut. Buka `http://127.0.0.1:8088/login.php`. Masuk sebagai admin dan tambahkan paket sebelum mencoba pesanan. Akun biasa dibuat lewat `registrasi.php`.

## Struktur

`function.php` berisi koneksi, query, password hashing, dan pemeriksaan admin. `admin.php`, `ff.php`, dan `pubg.php` menampilkan paket. `mldm.php`, `ffdm.php`, dan `pubgdm.php` mencatat pesanan. `database/schema.sql` adalah skema kosong; `scripts/create-admin.php` hanya boleh berjalan melalui CLI.

## Batas implementasi

Ini masih aplikasi latihan dengan halaman PHP lama. Link penghapusan masih menggunakan GET; CSRF token dan pembatasan percobaan login belum tersedia. Form pesanan belum memakai integrasi pembayaran atau pemenuhan otomatis. Jangan memakai akun, identitas pemain, atau transaksi pelanggan nyata untuk latihan.

## Verifikasi ekspor

Pemeriksaan sintaks PHP dilakukan pada ekspor ini; ringkasan hasil tercatat pada laporan persiapan lokal. Alur database dan browser tidak dinyatakan lulus sebelum benar-benar dijalankan. Tidak ada dump database, konfigurasi asli, atau riwayat Git lokal yang disertakan.

## Asal dan lisensi

Berasal dari proyek PHP lokal yang dipisahkan dari koleksi kerja. Nama serta gambar game mengikuti aset sumber. Belum ada lisensi proyek yang ditetapkan pada sumber ini; periksa `NOTICE.md` sebelum mendistribusikan ulang aset.

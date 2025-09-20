# Changelog - CI4-RegMan

## [Unreleased]

## [0.2.0] - 2025-09-21

### Added

- Validasi registrasi diperbaiki:
  - Password sekarang pakai regex tunggal (cek huruf besar, kecil, angka, simbol, min. 12).
  - Rule `birthdate` ditambah dengan custom validation `check_age` (usia minimal 17 tahun).
- Halaman register (`register.php`) sudah menampilkan error dengan `$validation->listErrors()`.

### Changed

- `Users::list()` sekarang memisahkan user lokal (hasil registrasi) dari daftar user API.
  - User lokal ditampilkan sederhana (alert info, nama + email).
  - User API dari reqres.in tetap tampil menggunakan card Bootstrap.
- Perbaikan view `list.php`:
  - Hapus tombol Edit yang berada di luar looping (penyebab error Whoops).
  - Tambahkan section user aktif di atas daftar user API.

### Fixed

- Bug `Whoops` setelah registrasi karena penggunaan banyak `regex_match` dan `$user` undefined di list view.

### Added

- Controller `Users.php`:
  - Method `list()` untuk menampilkan daftar user gabungan (session + API reqres.in).
  - Method `createForm()` untuk menampilkan form create user.
  - Method `create()` untuk menambahkan user baru via API (POST).
- View `users/list.php`:
  - Layout dengan Bootstrap Card untuk menampilkan user API.
  - Flash message (success/error) menggunakan Bootstrap alert.
  - Tombol "Tambah User Baru".
- View `users/create.php` untuk form tambah user baru.
- Integrasi alert flash message di halaman list.

### Changed

- `Auth::register()`:
  - Redirect berhasil ke `/users/list` setelah registrasi, bukan ke halaman register lagi.

### Fixed

- Bug tampilan "Whoops!" saat session user tidak memiliki avatar → diganti placeholder avatar.
- Bug cURL request `401 Missing API Key` pada Create User → dialihkan ke fallback `file_get_contents()` agar kompatibel dengan environment lokal.

## [0.1.0] - Initial Release

### Added

- Halaman registrasi user dengan validasi email, password, dan umur.
- Penyimpanan data user sementara di session.
- Integrasi API `reqres.in`:
  - List Users (GET)
- Struktur proyek CI4 standar (via composer).
- Dokumentasi awal proyek.

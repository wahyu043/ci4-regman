# Changelog - CI4-RegMan

## [Unreleased]
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

# Changelog - CI4-RegMan

## [Released]

## [0.6.0]

### Added

- Fitur **Edit User**:
  - Form edit user (`edit.php`) dengan field `name` & `job`.
  - Update data ke API reqres.in via `PUT`.
  - Flash message success/error setelah update.
- Fitur **Delete User**:
  - Tombol delete di setiap card user.
  - Proses delete dengan delay 3 detik (`sleep(3)`).
  - Blocking UI saat delete dengan overlay spinner.
  - Flash message success/error setelah delete.
- Fitur **Logout**:
  - Tombol logout di halaman list user.
  - Hapus session aktif dengan `session()->destroy()`.
  - Redirect ke halaman register dengan flash `success`.

### Changed

- Flash message di semua halaman pakai **Bootstrap dismissible alert** (bisa ditutup).
- `Auth::logout()` redirect ke `/register` agar konsisten dengan route yang ada.
- Routing dibersihkan:
  - AutoRoute dimatikan (`setAutoRoute(false)`).
  - Hanya route yang relevan untuk proyek ini yang dipertahankan (`register`, `register/process`, `users/*`, `logout`).

### Fixed

- Bug `401 Unauthorized` saat ambil detail user → semua request sekarang lewat helper `getApi()` dengan fallback.
- Bug "Whoops" saat buka Edit User ID 1 → ditangani dengan fallback, meski data user tetap kosong (keterbatasan API dummy).
- Pesan error saat Delete User ditangani agar lebih jelas.

### Known Issues

- API `reqres.in` adalah dummy:
  - Data hasil create/update/delete tidak benar-benar tersimpan.
  - User ID 1 (`George Bluth`) kadang tidak bisa diambil datanya dari endpoint `/users/1`.

## [0.5.0]

### Added

- Fitur Logout sederhana:
  - Session user dihancurkan.
  - Redirect ke halaman register dengan flash `success`.

## [0.4.0]

### Added

- Fitur Create User:
  - Form create user (`create.php`) dengan field `name` & `job`.
  - Simpan data via API `reqres.in` (POST).
  - Flash message hasil create.
- Integrasi flash `success`/`error` di view dengan Bootstrap alert.

### Changed

- `Users::list()` menampilkan tombol Edit dan Delete di setiap card user.

## [0.3.0]

### Added

- Daftar user dari API `reqres.in` ditampilkan dalam card Bootstrap.
- Tampilkan user aktif dari session di atas daftar user API.

## [0.2.0]

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

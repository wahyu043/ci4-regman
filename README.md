# CI4-RegMan

Aplikasi sederhana menggunakan **CodeIgniter 4** untuk implementasi API [reqres.in](https://reqres.in/).

## ✨ Fitur

- **Registrasi User**
  - Email wajib `@rumahweb.co.id`.
  - Password minimal 12 karakter, harus ada huruf besar, huruf kecil, angka, dan simbol.
  - Validasi umur minimal 17 tahun.
  - Data user disimpan sementara di session.
- **CRUD User via API reqres.in**
  - **List**: Menampilkan daftar user API dalam card Bootstrap.
  - **Create**: Tambah user baru via `POST`.
  - **Edit**: Update data user via `PUT`.
  - **Delete**: Hapus user via `DELETE` dengan delay 3 detik dan UI blocking spinner.
- **Logout**
  - Hapus session user aktif.
  - Redirect ke halaman registrasi dengan flash message.
- **Frontend**
  - Bootstrap 5.
  - Flash message pakai alert dismissible (bisa ditutup).
  - Responsive design.

## 🚀 Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/username/ci4-regman.git
   cd ci4-regman
   ```
2. Install dependency:
   ```bash
   composer install
   ```
3. Copy konfigurasi environment:
   ```bash
   cp env .env
   ```
4. Edit `.env`:
   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://ci4-regman.local/'
   ```
5. Jalankan server:
   ```bash
   php spark serve
   ```
6. Akses di browser:
   ```
   http://ci4-regman.local/register
   ```

## 🧑‍💻 Penggunaan

- Registrasi user baru → otomatis login & diarahkan ke halaman **Daftar User**.
- Tambah/Edit/Delete user dari daftar user API reqres.in.
- Logout untuk keluar dan kembali ke halaman register.

## ⚠️ Catatan

- API `reqres.in` adalah **dummy API**:
  - Data hasil create/update/delete tidak benar-benar tersimpan.
  - User ID 1 (`George Bluth`) kadang gagal diambil dari endpoint `/users/1`.
- Aplikasi **tidak menggunakan database** (hanya session).

## 📄 Dokumentasi

Dokumentasi penggunaan aplikasi tersedia dalam file PDF di dalam repository.

## 🏷️ Versi

Lihat [CHANGELOG.md](CHANGELOG.md) untuk detail perubahan.

---

👨‍💻 Dibuat oleh Wahyu Mahmudiyanto – 2025

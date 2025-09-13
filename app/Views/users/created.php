<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create User</title>
</head>
<body>
<div class="container mt-5">
    <h2>Tambah User Baru</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/users/create" method="post">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="job">Pekerjaan</label>
            <input type="text" class="form-control" name="job" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/users/list" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>

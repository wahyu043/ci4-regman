<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Registrasi</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <form action="/register/process" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Email (wajib @rumahweb.co.id)</label>
                <input type="email" name="email" class="form-control" required value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <label>Password (min. 12 karakter, huruf besar, kecil, angka, dan simbol)</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="birthdate" class="form-control" required value="<?= old('birthdate') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

</body>

</html>
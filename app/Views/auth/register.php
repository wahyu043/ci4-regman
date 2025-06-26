<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Form Registrasi</div>
                    <div class="card-body">

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('register') ?>" method="post">
                            <?= csrf_field() ?>


                            <div class="form-group">
                                <label>Email (@rumahweb.co.id)</label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <small class="form-text text-muted">Minimal 12 karakter, huruf besar, kecil, angka & 2 simbol</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="birthdate" class="form-control" value="<?= old('birthdate') ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
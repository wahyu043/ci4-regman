<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
  <h2>Form Tambah User</h2>

  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form action="/users/create" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Pekerjaan</label>
      <input type="text" name="job" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah</button>
  </form>
</div>

</body>
</html>
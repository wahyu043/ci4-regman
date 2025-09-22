<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h2>Edit User</h2>

    <?= form_open('/users/update/' . $user['id']) ?>
    <div class="mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control"
            value="<?= esc($user['first_name'] . ' ' . $user['last_name']) ?>">
    </div>
    <div class="mb-3">
        <label for="job">Job</label>
        <input type="text" name="job" class="form-control" placeholder="Isi pekerjaan">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/users/list" class="btn btn-secondary">Batal</a>
    <?= form_close() ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <?= session()->getFlashdata('error') ?>
    <?= session()->getFlashdata('success') ?>

    <div class="container mt-4">
        <h2>Edit User</h2>
        <form method="post" action="<?= base_url('users/update/' . $user['id']) ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= esc($user['first_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= esc($user['last_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('users/list') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar User</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Daftar User dari reqres.in</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= esc($error) ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="<?= esc($user['avatar']) ?>" class="card-img-top" alt="<?= esc($user['first_name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></h5>
                            <p class="card-text"><?= esc($user['email']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>
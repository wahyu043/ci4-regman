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
        <?php if (!empty($activeUser)): ?>
            <div class="alert alert-info">
                Sedang aktif sebagai <strong><?= esc($activeUser['name']) ?></strong><br>
                <?= esc($activeUser['email']) ?>
            </div>
        <?php endif; ?>

        <h2>Daftar User dari reqres.in</h2>

        <a href="/users/create" class="btn btn-success mb-3">Tambah User Baru</a>
        <a href="<?= site_url('logout') ?>" class="btn btn-danger mb-3">Logout</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= esc($error) ?></div>
        <?php endif; ?>

        <div class="row">

            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="<?= esc($user['avatar'] ?? 'https://via.placeholder.com/150') ?>"
                                class="card-img-top"
                                alt="<?= esc($user['first_name'] ?? '-') ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= esc(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
                                </h5>
                                <p class="card-text"><?= esc($user['email'] ?? '-') ?></p>

                                <a href="/users/edit/<?= esc($user['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= site_url('users/delete/' . $user['id']) ?>"
                                    class="btn btn-sm btn-danger btn-delete">Delete</a>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada data user.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus user ini?')) {
                    e.preventDefault();
                    return;
                }

                // Tampilkan overlay blocking
                const overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = 0;
                overlay.style.left = 0;
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                overlay.style.display = 'flex';
                overlay.style.alignItems = 'center';
                overlay.style.justifyContent = 'center';
                overlay.style.zIndex = 9999;
                overlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                document.body.appendChild(overlay);
            });
        });
    </script>


</body>

</html>
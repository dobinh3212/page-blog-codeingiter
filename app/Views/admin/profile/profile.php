<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="container-fluid" style="font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('dashboard.index') ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('getUser') ?>">Profile</a>
                </li>
                <li class="breadcrumb-item active"><span>Show</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <div class="card mb-3">
        <form action="<?= route_to('editProfile', $user['id']) ?>" method="post">
            <div style="font-size: 30px;" class="card-header d-flex">
                <div class="col-6">
                    <span class="small ms-1">PROFILE</span>
                </div>
                <div class="d-flex col-6 justify-content-end mb-4">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            <div class="body flex-grow-1 px-5 mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name: <?= esc($user['name']) ?></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email: <?= esc($user['email']) ?></label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container-lg">
    <div class="card mb-4">
        <div style="font-size: 30px;" class="card-header d-flex">
            <div class="col-6">
                <span class="small ms-1">PROVIDER</span>
            </div>
        </div>
        <div class="body flex-grow-1 px-5 mt-3">
            <?php foreach ($providers as $provider) : ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name: <?= esc($provider->name) ?></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Provider_id: <?= esc($provider->provider_id) ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
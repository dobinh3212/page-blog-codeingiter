<?= $this->extend('admin/layouts/layout'); ?>

<?= $this->section('content'); ?>
<div class="header header-sticky">
    <div class="container-fluid" style="font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('post'); ?>">Post</a>
                </li>
                <li class="breadcrumb-item active"><span>Show</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <div class="card mb-4">
        <div style="font-size: 30px;" class="card-header d-flex">
            <div class="col-6">
                <span class="small ms-1">Show</span>
            </div>
            <div class="d-flex col-6 justify-content-end">
                <a href="<?= route_to('post'); ?>" class="btn btn-success btn-xs">
                    List
                </a>
            </div>
        </div>
        <div class="body flex-grow-1 px-5 mt-3">
            <div class="card-body d-flex justify-content-center">
                <div class="mb-3 col-7">
                    <h1 class="fw-bold"><?= $post['title']; ?></h1>
                    <?= $post['content']; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

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
                    <a class="text-decoration-none" href="<?= route_to('user.index') ?>">User</a>
                </li>
                <li class="breadcrumb-item active"><span>Create</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <div class="card mb-4">
        <div style="font-size: 24px;" class="card-header d-flex">
            <div class="col-6">
                <span class="small ms-1">Form</span>
            </div>
            <div class="d-flex col-6 justify-content-end">
                <a href="<?= route_to('user') ?>" class="btn btn-success btn-xs">
                    List
                </a>
            </div>
        </div>
        <div class="body flex-grow-1 px-5 mt-3">
            <?= view('errors/errors') ?>
            <div class="card-body d-flex">
                <div class="col-12 d-flex justify-content-center">
                    <form action="<?= route_to('user.store') ?>" method="post" class="col-8" style="font-size: 18px;">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input name="email" type="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input name="name" type="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-4 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="type"]').change(function () {
            if ($(this).val() === "2") {
                $("#parent_id").val(null).prop('disabled', true);
            } else {
                $("#parent_id").prop('disabled', false);
            }
        });
    });
</script>

<?= $this->endSection() ?>

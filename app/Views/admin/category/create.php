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
                    <a class="text-decoration-none" href="<?= route_to('category.index') ?>">Category</a>
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
                <a href="<?= route_to('category') ?>" class="btn btn-success btn-xs">
                    List
                </a>
            </div>
        </div>
        <div class="body flex-grow-1 px-5 mt-3">
            <?= view('errors/errors') ?>
            <div class="card-body d-flex">
                <div class="col-12 d-flex justify-content-center">
                    <form action="<?= route_to('category.store') ?>" method="post" class="col-8" style="font-size: 18px;">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type:</label>
                            <div class="d-flex">
                                <div class="me-4">
                                    <input type="radio" name="type" value="1" id="typeA" required>
                                    <label for="typeA">Category</label>
                                </div>
                                <div>
                                    <input type="radio" name="type" value="2" id="typeB" required>
                                    <label for="typeB">Tag</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" id="parent_select">
                            <label class="form-label">Parent:</label>
                            <div>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">-- select --</option>
                                    <?php foreach ($categorys as $category) : ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
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

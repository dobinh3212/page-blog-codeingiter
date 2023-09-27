<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('content') ?>
<div class="header header-sticky">
    <div class="container-fluid" style="font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('dashboard.index') ?>">Admin</a>
                </li>
                <li class="breadcrumb-item active"><span>Category</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <div class="card mb-4">
        <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session('error') ?>
        </div>
        <?php endif ?>

        <?php if (session()->has('success') || !empty($success)) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success') ?? $success ?>
        </div>
        <?php endif ?>
        <div style="font-size: 24px;" class="card-header d-flex">
            <div class="col-6">
                <span class="small ms-1">List</span>
            </div>
            <div class="d-flex col-6 justify-content-end">
                <a href="<?= route_to('category.create') ?>" class="btn btn-success btn-xs">
                    Create
                </a>
            </div>
        </div>
        <form class="d-flex mt-3 justify-content-center" method="GET" action="<?= route_to('category.index') ?>">
            <div class="d-flex me-2">
                <input name="search" class="form-control" placeholder="search" value="<?= old('search') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="body flex-grow-1 px-5 mt-3">
            <div class="card-body d-flex">
                <table style="font-size: 18px;" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Parent</th>
                            <th style="width: 200px;" class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorys as $category) : ?>
                        <tr>
                            <th><?= $category['id'] ?></th>
                            <td><?= $category['name'] ?></td>
                            <td><?= $category['type'] == 1 ? 'Category' : ($category['type'] == 2 ? 'Tag' : '') ?></td>
                            <td><?= $category['parent_name'] ?? '' ?></td>
                            <td style="text-align: center; width: 230px;">
                                <form method="POST" action="<?= route_to('category.delete', $category['id']) ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <div>
                                        <a href="<?= route_to('category.show', $category['id']) ?>" class="btn btn-primary btn-xs">
                                            show
                                        </a>
                                        <a href="<?= route_to('category.edit', $category['id']) ?>" class="btn btn-primary btn-xs ms-1">
                                            edit
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs ms-1" onclick="return confirm('Bạn có chắc không?')">
                                            <i class="far fa-trash-alt"></i> delete
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end me-3">
     
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

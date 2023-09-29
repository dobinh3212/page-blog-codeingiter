<?= $this->extend('client/layouts/layout'); ?>

<?= $this->section('content'); ?>
<div class="container col-12 mb-5">
    <div class="d-flex justify-content-center">
        <div class="col-7">
            <span class="fs-44 fw-bold">Blog</span>
            <?php foreach ($datas as $data): ?>
            <div class="mt-5 border-bottom">
                <a class="fs-30 fw-500 text-dark text-decoration-none" href="<?= route_to('post.postDetail', $data['post']->slugs) ?>"><?= $data['post']->title ?></a>
                <div class="mb-2 mt-3 d-flex">
                    <span class="me-3"><?= $data['post']->created_at ?></span>
                    <span class="me-3">|</span>
                    <?php foreach ($data['categorys'] as $category): ?>
                    <?php if ($category->type == 1): ?>
                    <a class="text-secondary text-decoration-none" href="<?= route_to('blog.blog') . '?' . http_build_query(['category' => $category->name]) ?>"><?= $category->name ?>, &nbsp</a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <p class="w-60"><?= $data['post']->description ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var elementToModify = document.getElementById("isActiveBlog");
        if (elementToModify) {
            elementToModify.classList.add("isActive");
        }
    });
</script>
<?= $this->endSection(); ?>

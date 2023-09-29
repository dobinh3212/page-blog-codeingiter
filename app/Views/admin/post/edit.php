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
                <li class="breadcrumb-item active"><span>Edit</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <div class="card mb-4">
        <?php if (session('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (session('success') || !empty($success)) : ?>
            <div class="alert alert-success" role="alert">
                <?= session('success') ?? $success; ?>
            </div>
        <?php endif; ?>
        <div style="font-size: 24px;" class="card-header d-flex">
            <div class="col-6">
                <span class="small ms-1 fw-bold">Form</span>
            </div>
            <div class="d-flex col-6 justify-content-end">
                <a href="<?= route_to('post'); ?>" class="btn btn-success btn-xs fw-bold">
                    List
                </a>
            </div>
        </div>
        <div class="body flex-grow-1 mt-3">
            <div class="card-body d-flex">
                <form action="<?= route_to('post.update', $post['id']); ?>" method="post" class="col-8" style="font-size: 18px;" id="myForm" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="method" value="PUT">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Title:</label>
                        <input name="title" class="form-control" required value="<?= $post['title']; ?>">
                    </div>
                    <div class="mb-3" id="parent_select">
                        <label class="form-label fw-bold">Category:</label>
                        <div class="d-flex row">
                            <?php foreach ($categorys as $category) : ?>
                                <?php if ($category['type'] == 1) : ?>
                                    <div for="category_id" class="ms-3 col-2">
                                        <input type="checkbox" id="<?= $category['id']; ?>" name="category_id[]" value="<?= $category['id']; ?>" <?= in_array($category['id'], $categoryIds) ? 'checked' : ''; ?>>
                                        <label for="<?= $category['id']; ?>"><?= $category['name']; ?></label>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3" id="parent_select">
                        <label class="form-label fw-bold">Tags:</label>
                        <input class="form-control" type="text" id="tag-input" placeholder="Add tag and Enter">
                        <div class="tag-container mt-2" id="tag-container">
                        </div>
                        <input type="hidden" name="tag_name" id="tagInput1" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description:</label>
                        <input name="description" class="form-control" value="<?= $post['description']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Content:</label>
                        <textarea name='content' class="form-control" id="mytextarea1" required><?= $post['content']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Image:</label>
                        <div class="d-flex col-8">
                            <input type="file" name="img" id="image" accept="image/*" onchange="previewImage(event)">
                            <img id="preview" src="<?= base_url($post['img']??''); ?>" width='100px' height='80px'>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-4 mt-3" onclick="submitForm()">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    const tagContainer = document.getElementById('tag-container');
    const tagInput = document.getElementById('tag-input');
    var tagName = <?= json_encode($tagNames); ?>;
    const tags = new Set(tagName);
    const tagArray = [];
    const tagInput1 = document.getElementById("tagInput1");

    function addTag(tagName) {
        const tag = document.createElement('div');
        tag.className = 'tag';
        tag.innerHTML = `
        <span class="tag-text">${tagName}</span>
        <span class="tag-remove fww-bold" data-name="${tagName}">x</span>
    `;
        tagContainer.appendChild(tag);
    }

    function updateTags() {
        tagContainer.innerHTML = '';
        tags.forEach(tag => {
            addTag(tag);
        });
    }

    function updateTagsFromController() {
        tagContainer.innerHTML = '';
        tags.forEach(tag => {
            tagArray.push(tag);
            tagInput1.value = tagArray;
            addTag(tag);
        });
    }
    updateTagsFromController();
    tagInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && tagInput.value.trim() !== '') {
            const tagName = tagInput.value.trim();
            if (!tags.has(tagName)) {
                addTag(tagName);
                tagInput.value = '';
                tags.add(tagName);
                tagArray.push(tagName);
                tagInput1.value = tagArray;

                updateTags();
            }
        }
    });
    tagContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('tag-remove')) {
            const tagName = event.target.getAttribute('data-name');
            if (tags.has(tagName)) {
                tags.delete(tagName);

                const index = tagArray.indexOf(tagName)
                tagArray.splice(index, 1);
                tagInput1.value = tagArray;

                updateTags();
            }
        }
    });

    function submitForm() {
        console.log(tagArray);
        var form = document.getElementById("myForm");
        form.submit();
    }
</script>
<?= $this->endSection(); ?>

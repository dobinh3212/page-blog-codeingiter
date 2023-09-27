<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('content') ?>
<div class="header header-sticky">
    <div class="container-fluid" style="font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('dashboard') ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="<?= route_to('post') ?>">Post</a>
                </li>
                <li class="breadcrumb-item active"><span>Create</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-lg mt-4">
    <?php if(session()->has('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $errors??'' ?>
    </div>
    <?php endif; ?>
    <div class="card mb-4">
        <div style="font-size: 24px;" class="card-header d-flex">
            <div class="col-6">
                <span class="ms-1 fw-bold">Form</span>
            </div>
            <div class="d-flex col-6 justify-content-end">
                <a href="<?= route_to('post') ?>" class="btn btn-success btn-xs fw-bold">
                    List
                </a>
            </div>
        </div>
        <div class="body flex-grow-1 px-5 mt-3">
            <div class="card-body d-flex">
                <div class="col-12 d-flex justify">
                    <form action="<?= route_to('post.store') ?>" id="myForm" method="post" class="col-8" style="font-size: 18px;" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title:</label>
                            <input name="title" class="form-control">
                        </div>
                        <div class="mb-3" id="parent_select">
                            <label class="form-label fw-bold">Category:</label>
                            <div class="d-flex row">
                                <?php foreach ($categorys as $category): ?>
                                <?php if($category['type'] == 1): ?>
                                <div for="category_id" class="ms-2 col-2">
                                    <input type="checkbox" id="<?= $category['id'] ?>" name="category_id[]" value="<?= $category['id'] ?>">
                                    <label for="<?= $category['id'] ?>"><?= $category['name'] ?></label>
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
                            <input name="description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Content:</label>
                            <textarea id="mytextarea1" name="content"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Image:</label>
                            <input type="file" name="img" class="form-control" id="image">
                        </div>
                        <button type="button" class="btn btn-primary mb-4 mt-3 fw-bold" onclick="submitForm()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const tagContainer = document.getElementById('tag-container');
    const tagInput = document.getElementById('tag-input');
    const tags = new Set();
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
        var form = document.getElementById("myForm");
        form.submit();
    }
</script>
<?= $this->endSection() ?>

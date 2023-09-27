<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard Blog</title>
    <link href="<?= base_url('/template/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/template/css/examples.css') ?>" rel="stylesheet">
</head>

<body>
    <style>
        .tag-container {
            display: flex;
            flex-wrap: wrap;
        }

        .tag {
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            margin-right: 3px;
        }

        .tag .tag-text {
            margin-right: 5px;
        }

        .tag .tag-remove {
            cursor: pointer;
            font-weight: bold;
        }
    </style>
    <?php echo view('admin/layouts/sidebar'); ?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <?php echo view('admin/layouts/header'); ?>
        <?php echo $this->renderSection('content'); ?>
        <?php echo view('admin/layouts/footer'); ?>
    </div>
</body>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea1',
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
    });
</script>

</html>
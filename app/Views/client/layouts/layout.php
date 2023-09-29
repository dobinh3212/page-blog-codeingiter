<!DOCTYPE html>
<html>
<head>
    <title>My Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <?php echo view('client/layouts/header'); ?>

    <?php echo $this->renderSection('content'); ?>

    <?php echo view('client/layouts/footer'); ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?= $title ?? 'CodeIgniter 4' ?></title> -->
    <title>1 Blend Feeds</title>
    <link rel="icon" href="<?= base_url('assets/logo.png') ?>" type="image/x-icon"> 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>
<style>
    body {
        background: linear-gradient(to bottom right, #f9fff0, #fffef7);
    }
</style>
<body>
    <?php if (!isset($hide_header) || !$hide_header): ?>
        <?= $this->include('partials/header') ?>
    <?php endif; ?>
    
    <?= $this->renderSection('content') ?>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
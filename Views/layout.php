<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 Blend Feeds</title>
    <link rel="icon" href="<?= base_url('assets/logo.png') ?>" type="image/x-icon"> 
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/datatables/datatables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin_lte/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin_lte/dist/css/adminlte.min.css') ?>">

    <script src="<?= base_url('assets/jquery-3.7.1.min.js') ?>"></script>
</head>
<style>
    body {
        background:rgb(244, 247, 242);
    }
    #logout_button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    p {
        margin: 0;
        font-size: 1.2rem;
    }
    hr {
        border-top: 1px solid #000;
    }
</style>
<body>
    <?php if (!isset($hide_header) || !$hide_header): ?>
        <?= $this->include('partials/header') ?>
    <?php endif; ?>
    
    <?= $this->renderSection('content') ?>

    <?php if (!isset($hide_header) || !$hide_header): ?>
        <button id="logout_button" class="btn btn-primary"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
    <?php endif; ?>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin_lte/plugins/select2/js/select2.full.min.js')?>"></script>
    <script src="<?= base_url('assets/admin_lte/dist/js/adminlte.min.js')?>"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $('#logout_button').click(function() {
            $.ajax({
            url: '<?= base_url('login/logout') ?>',
            type: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.href = '<?= base_url('login') ?>';
                }
            }
        });
    });
    </script>
</body>
</html>
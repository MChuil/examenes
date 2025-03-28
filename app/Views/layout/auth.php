<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= env("TITLE") ?> | Iniciar sesión</title>

        <!-- Bootstrap -->
        <link href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= base_url('vendors/nprogress/nprogress.css')?>" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?= base_url('vendors/animate.css/animate.min.css')?>" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= base_url('build/css/custom.min.css')?>" rel="stylesheet">
    </head>
    <body class="login">
        <div>
            <?= $this->renderSection("content") ?>
        </div>
    </body>
</html>
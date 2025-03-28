<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title><?= env("TITLE") ?> | <?= $this->renderSection('title') ?></title>
    <!-- Bootstrap -->
    <link href="<?= base_url("vendors/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url("vendors/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url("vendors/nprogress/nprogress.css") ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url("vendors/iCheck/skins/flat/green.css") ?>" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?= base_url("vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css") ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?= base_url("vendors/jqvmap/dist/jqvmap.min.css") ?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url("vendors/bootstrap-daterangepicker/daterangepicker.css") ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url("build/css/custom.min.css") ?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- sidebar -->
        <?= $this->include("layout/common/sidebar.php") ?>
        <!-- /sidebar -->
        
        <!-- top navigation -->
        <?= $this->include("layout/common/top-navigation.php") ?>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
          <?= $this->renderSection("content") ?>
        </div>
        <!-- /page content -->

        <!-- footer -->
        <?= $this->include("layout/common/footer.php") ?>
        <!-- /footer -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url("vendors/jquery/dist/jquery.min.js") ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- FastClick -->
    <script src="<?= base_url("vendors/fastclick/lib/fastclick.js") ?>"></script>
    <!-- NProgress -->
    <script src="<?= base_url("vendors/nprogress/nprogress.js") ?>"></script>
    <!-- Chart.js -->
    <script src="<?= base_url("vendors/Chart.js/dist/Chart.min.js") ?>"></script>
    <!-- gauge.js -->
    <script src="<?= base_url("vendors/gauge.js/dist/gauge.min.js") ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= base_url("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js") ?>"></script>
    <!-- iCheck -->
    <script src="<?= base_url("vendors/iCheck/icheck.min.js") ?>"></script>
    <!-- Skycons -->
    <script src="<?= base_url("vendors/skycons/skycons.js") ?>"></script>
    <!-- Flot -->
    <script src="<?= base_url("vendors/Flot/jquery.flot.js") ?>"></script>
    <script src="<?= base_url("vendors/Flot/jquery.flot.pie.js") ?>"></script>
    <script src="<?= base_url("vendors/Flot/jquery.flot.time.js") ?>"></script>
    <script src="<?= base_url("vendors/Flot/jquery.flot.stack.js") ?>"></script>
    <script src="<?= base_url("vendors/Flot/jquery.flot.resize.js") ?>"></script>
    <!-- Flot plugins -->
    <script src="<?= base_url("vendors/flot.orderbars/js/jquery.flot.orderBars.js") ?>"></script>
    <script src="<?= base_url("vendors/flot-spline/js/jquery.flot.spline.min.js") ?>"></script>
    <script src="<?= base_url("vendors/flot.curvedlines/curvedLines.js") ?>"></script>
    <!-- DateJS -->
    <script src="<?= base_url("vendors/DateJS/build/date.js") ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url("vendors/jqvmap/dist/jquery.vmap.js") ?>"></script>
    <script src="<?= base_url("vendors/jqvmap/dist/maps/jquery.vmap.world.js") ?>"></script>
    <script src="<?= base_url("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js") ?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url("vendors/moment/min/moment.min.js") ?>"></script>
    <script src="<?= base_url("vendors/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url("build/js/custom.min.js") ?>"></script>
	
    <?= $this->renderSection("scripts") ?>
  </body>
</html>
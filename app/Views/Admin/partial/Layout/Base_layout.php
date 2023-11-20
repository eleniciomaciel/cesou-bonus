<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/templates/template-admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/templates/template-admin/img/favicon.png">
    <title>
        Cestou::Admin
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>/templates/template-admin/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>/templates/template-admin/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">

        <?= $this->include('Admin/partial/includes/aside') ?>

    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
            <?= $this->include('Admin/partial/includes/nav') ?>

        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
            <?= $this->include('Admin/partial/includes/card') ?>
            </div>

            <div class="row my-4">

                <?= $this->renderSection('content') ?>

            </div>

            <footer class="footer pt-3  ">
            <?= $this->include('Admin/partial/includes/footer') ?>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>/templates/template-admin/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/plugins/chartjs.min.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/sweetalert2.js"></script>
    <script src="<?= base_url() ?>/templates/template-admin/js/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    

    
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>//templates/template-admin/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>
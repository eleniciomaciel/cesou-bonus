<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/public/templates/template-admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/public/templates/template-admin/img/favicon.png">
    <title>
        Atendimento::Bradesco
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>/public/templates/template-admin/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/public/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>/public/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>/public/templates/template-admin/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="/bradesco_panel">
                <img src="<?= base_url() ?>/public/templates/template-admin/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Cestou.Top</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <?= $this->include('usuarioBradesco/Layout/includes/navbar') ?>
        </div>

    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
            <?= $this->include('usuarioBradesco/Layout/includes/nav_menu') ?>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="row">
                <?= $this->include('usuarioBradesco/Layout/includes/card') ?>
            </div>


            <?= $this->renderSection('content') ?>



            <footer class="footer pt-3  ">
                <?= $this->include('usuarioBradesco/Layout/includes/footer') ?>
            </footer>
        </div>
    </main>
    <div class="fixed-plugin">
        <?= $this->include('usuarioBradesco/Layout/includes/fixed-plugin') ?>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>/public/templates/template-admin/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/plugins/chartjs.min.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/sweetalert2.js"></script>
    <script src="<?= base_url() ?>/public/templates/template-admin/js/jquery.mask.min.js"></script>
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
    <script src="<?= base_url() ?>/templates/template-admin/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
    <?= $this->renderSection('scripts_bradesco'); ?>
</body>

</html>
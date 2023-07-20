<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url()?>/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url()?>/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url()?>/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?= site_url()?>/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?= site_url()?>/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>
        Cestou::Loja
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

        <?= $this->include('Gestor/partial/include/aside') ?>

    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <?= $this->include('Gestor/partial/include/nav') ?>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            
                <?= $this->include('Gestor/partial/include/card') ?>
                <?= $this->renderSection('content') ?>
 

            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                Todos os direitos reservados <i class="fa fa-heart"></i> by
                                <a href="#" class="font-weight-bold" target="_blank">Cestou.Top</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <div class="fixed-plugin">

        <?= $this->include('Gestor/partial/include/fixed-plugin') ?>

    </div>
    <?= $this->include('Gestor/partial/popap/popap-perfil') ?>
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    
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
    <?= $this->include('Gestor/partial/scripts/perfil-script') ?>
    <?= $this->renderSection('scripts'); ?>
    
</body>

</html>
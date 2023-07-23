<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= site_url()?>/templates/template-admin/img/apple-icon.png">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url()?>/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url()?>/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url()?>/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?= site_url()?>/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?= site_url()?>/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>
        LOGIN::CESTOU.TOP
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= site_url()?>/templates/template-admin/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= site_url()?>/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= site_url()?>/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= site_url()?>/templates/template-admin/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
                            Cestou.Top
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="https://cestou.top/">
                                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                        Pagina inicial
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/refatora_login">
                                        <i class="fa fa-user opacity-6  me-1" aria-hidden="true"></i>
                                        Esqueci a senha
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/fazer-cadastro">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        Fazer inscrição
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Bem vindo a Cestou.Top</h3>
                                    <p class="mb-0">Entre com seu email e senha de usuário</p>
                                    <?php if (isset($validation)) : ?>
                                        <div class="col-12">
                                            <div class="alert alert-danger" role="alert">
                                                <?= $validation->listErrors() ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <form action="/login" method="POST" role="form">
                                        <?= csrf_field() ?>
                                        <label>Email:</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Ex.: ana@email.com" name="email" id="email">
                                        </div>
                                        <label>Senha:</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Ex.: 123456789" name="password" id="password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('<?= site_url()?>/templates/template-admin/img/curved-images/curved6.png')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">

                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright © <script>
                            document.write(new Date().getFullYear())
                        </script> Cestou.Top todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="<?= site_url()?>/templates/template-admin/js/core/popper.min.js"></script>
    <script src="<?= site_url()?>/templates/template-admin/js/core/bootstrap.min.js"></script>
    <script src="<?= site_url()?>/templates/template-admin/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= site_url()?>/templates/template-admin/js/plugins/smooth-scrollbar.min.js"></script>
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
    <script src="<?= site_url()?>/templates/template-admin/js/soft-ui-dashboard.min.js?v=1.0.6"></script>

</body>

</html>
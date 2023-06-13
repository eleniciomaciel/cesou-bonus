<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url()?>favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url()?>favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url()?>favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?= site_url()?>favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?= site_url()?>favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>
        cestou.top::usuário
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

<body class="g-sidenav-show">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <?= $this->include('Usuarios/partial/includes/menu') ?>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
            <?= $this->include('Usuarios/partial/includes/nav') ?>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <?= $this->renderSection('content') ?>
            <div class="row my-4">
                <div class="container-fluid py-4">
                    <?= $this->include('Usuarios/partial/includes/promocoes') ?>
                </div>
            </div>

            <footer class="footer pt-3  ">
                <?= $this->include('Usuarios/partial/includes/footer') ?>
            </footer>
        </div>
    </main>


    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient">Atualizar Perfíl</h3>
                            <p class="mb-0">Informações pessoal do usuário Cestou.Top</p>
                        </div>
                        <div class="card-body">


                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-simple" role="tab" aria-controls="profile" aria-selected="true">
                                            Dados pessoal
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                                            Dados de acesso
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body p-3 mt-2">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show position-relative active border-radius-lg" id="profile-tabs-simple" role="tabpanel" aria-labelledby="profile-tabs-simple">

                                        <form role="form text-left" action="/user/atualiza-perfil" method="POST" id="form_perfil">
                                            <?= csrf_field() ?>

                                            <input type="hidden" name="id_perfil" value="<?= session()->get('reg_nome') ?>">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Nome:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_name" id="perfil_name" value="<?= session()->get('reg_nome') ?>">
                                                        <span class="text-danger error-text perfil_name_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">CPF:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_cpf" id="perfil_cpf" value="<?= session()->get('reg_cpf') ?>" />
                                                        <span class="text-danger error-text perfil_cpf_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">TELEFONE:</label>
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control" name="perfil_telefone" id="perfil_telefone" value="<?= session()->get('reg_telefone') ?>" />
                                                        <span class="text-danger error-text perfil_telefone_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">CEP:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_cep" id="perfil_cep" value="<?= session()->get('reg_cep') ?>" />
                                                        <span class="text-danger error-text perfil_cep_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">UF:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_uf" id="perfil_uf" value="<?= session()->get('reg_uf') ?>" />
                                                        <span class="text-danger error-text perfil_uf_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-7">
                                                    <label for="">CIDADE:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_cidade" id="perfil_cidade" value="<?= session()->get('reg_cidade') ?>" />
                                                        <span class="text-danger error-text perfil_cidade_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">BAIRRO:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_bairro" id="perfil_bairro" value="<?= session()->get('reg_bairro') ?>" />
                                                        <span class="text-danger error-text perfil_bairro_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">ENDEREÇO:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="perfil_endereco" id="perfil_endereco" value="<?= session()->get('reg_endereco') ?>" />
                                                        <span class="text-danger error-text perfil_endereco_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <button type="submit" class="class_load_envia_up_perfil btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" id="id_btn_load_up_perfil">ATUALIZAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane fade position-relative height-400 border-radius-lg" id="dashboard-tabs-simple" role="tabpanel" aria-labelledby="dashboard-tabs-simple" style="background-image: url('../../assets/img/bg-smart-home-2.jpg'); background-size:cover;">

                                        <form action="/user/atualiza_acesso_login" method="POST" id="form_perfil_acesso" role="form text-left">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id_perfil_login" value="<?= session()->get('reg_nome') ?>">
                                            <label>Email de acesso</label><br>
                                            <span class="text-danger error-text acesso_email_error"></span>
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control" name="acesso_email" id="acesso_email" value="<?= session()->get('reg_email') ?>">
                                            </div>
                                            <label>Nova Senha:</label><br>
                                            <span class="text-danger error-text acesso_senha_error"></span>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="acesso_senha" id="acesso_senha">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="class_load_envia_up_perfil_acesso btn btn-round bg-gradient-danger btn-lg w-100 mt-4 mb-0" id="id_btn_load_up_perfil_acesso">ATUALIZAR</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
    <script src="<?= base_url() ?>/templates/template-admin/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
    <?= $this->renderSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $.ajax({
                    url: "<?php echo site_url('user/listaTotalCupons'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_active_cupom").append(html);
                });

            $.ajax({
                    url: "<?php echo site_url('user/listaCuponsConpensados'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_compendados_cupom").append(html);
                });

            $.ajax({
                    url: "<?php echo site_url('user/listaCuponRestantes'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_restantes_cupom").append(html);
                });

            $.ajax({
                    url: "<?php echo site_url('user/listVencidosTrocados'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_cupons_vencidos_resgatados").html(html);
                });

            /**lista card promocional
             * 
             */
            $.ajax({
                    url: "<?php echo site_url('user/listPromocionalLojas'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_card_promocional").html(html);
                });

            /**
             * lista menu promoçõe
             */
            $.ajax({
                    url: "<?php echo site_url('user/listPromocaoMenu'); ?>",
                    cache: false
                })
                .done(function(html) {
                    $("#results_menu_promocional").html(html);
                });


            /**
             * atualização de perfil
             */
            let preload_btn_up_perfil = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Salvando, aguarde...';
            let btn_default_up_perfil = 'Atualizar';

            $('#form_perfil').submit(function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                        $('.class_load_envia_up_perfil').html(preload_btn_up_perfil);
                        $('.class_load_envia_up_perfil').attr('disabled', 'disabled');
                    },
                    complete: function() {
                        $('#id_btn_load_up_perfil').html(btn_default_up_perfil);
                        $('.class_load_envia_up_perfil').attr('disabled', false);
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            if (data.code == 1) {
                                Swal.fire(
                                    'Ok!',
                                    data.msg,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Ops!',
                                    'Algo deu errado, corrija por favor.',
                                    'success'
                                );
                            }
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val);
                            });
                        }
                    }
                });
            });


            /**
             * atualiza acesso senha
             */
            let preload_btn_up_acesso = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Salvando, aguarde...';
            let btn_default_up_acesso = 'Atualizar';

            $('#form_perfil_acesso').submit(function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                        $('.class_load_envia_up_perfil_acesso').html(preload_btn_up_acesso);
                        $('.class_load_envia_up_perfil_acesso').attr('disabled', 'disabled');
                    },
                    complete: function() {
                        $('#id_btn_load_up_perfil_acesso').html(btn_default_up_acesso);
                        $('.class_load_envia_up_perfil_acesso').attr('disabled', false);
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            if (data.code == 1) {
                                Swal.fire(
                                    'Ok!',
                                    data.msg,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Ops!',
                                    'Algo deu errado, corrija por favor.',
                                    'success'
                                );
                            }
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val);
                            });
                        }
                    }
                });
            });


            /**
             * consulta senha de acesso para liberar cadastro do valor
             */
            let preload_btn_up_senha_caixa = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Salvando, aguarde...';
            let btn_default_up_senha_caixa = 'Atualizar';

            $('#acesso_libera_senha_caixa').submit(function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                        $('.class_load_envia_up_senha_caixa').html(preload_btn_up_senha_caixa);
                        $('.class_load_envia_up_senha_caixa').attr('disabled', 'disabled');
                    },
                    complete: function() {
                        $('#id_btn_load_up_senha_caixa').html(btn_default_up_senha_caixa);
                        $('.class_load_envia_up_senha_caixa').attr('disabled', false);
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            if (data.code == 1) {
                                Swal.fire(
                                    'Ok!',
                                    data.msg,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Ops!',
                                    'Algo deu errado, corrija por favor.',
                                    'success'
                                );
                            }
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val);
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
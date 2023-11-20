<?= $this->extend('Usuarios/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <?= $this->include('Usuarios/partial/includes/card') ?>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">

            <div class="card-header d-flex align-items-center border-bottom py-3">
                <div class="d-flex align-items-center">
                    <h6 class="mb-1">SERVIÇOS</h6>
                </div>
                <div class="text-end ms-auto">
                    <button type="button" class="gerarQrIdDoCleinte btn btn-sm btn bg-gradient-warning mb-0" id="<?= session()->get('id') ?>">
                        <i class="fa fa-qrcode pe-2" aria-hidden="true"></i> CÓD. CLIENTE
                    </button>
                </div>
            </div>

            <div class="card-body p-3">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="<?= base_url() ?>/templates/template-admin/img/cestou-atendimento-bradesco-2.jpeg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <a href="javascript:;">
                                    <h5>
                                        ATENDIMENTO BRADESCO
                                    </h5>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/user/bradesco-express" type="button" class="btn btn-outline-primary btn-sm mb-0">AGENDAMENTO</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="<?= base_url() ?>/templates/template-admin/img/cestou-leva-e-traz.jpeg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <a href="javascript:;">
                                    <h5>
                                        LEVA E TRAZ
                                    </h5>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/user/leva-e-traz" type="button" class="btn btn-outline-primary btn-sm mb-0">AGENDAMENTO</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="<?= base_url() ?>/templates/template-admin/img/cestou-bonus.jpeg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <a href="javascript:;">
                                    <h5>
                                        BÔNUS CESTOU
                                    </h5>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/user/shopping-cashback" type="button" class="btn btn-outline-primary btn-sm mb-0">CUPÔNS DE DESCONTO</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="<?= base_url() ?>/templates/template-admin/img/cestou ponto.jpeg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <a href="javascript:;">
                                    <h5>
                                        CESTOU PONTOS
                                    </h5>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/user/pontos-desconto" type="button" class="btn btn-outline-primary btn-sm mb-0">CUPÔNS DE DESCONTO</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Usuarios/partial/popap/popap-gerar-qrcode'); ?>
<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/html5-qrcode.min.js"></script>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/classyqr.min.js"></script>
<script>
    /**
     * gera qrcode do ID DO CLIENTE
     */

    $(document).on('click', '.gerarQrIdDoCleinte', function() {
        const id = $(this).attr('id');
      
        $.ajax({
            url: "<?= site_url('user/qrcode_build_client'); ?>",
            method: "GET",
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                let cod_id = data['id'];

                $('#modal-id_usuario_qrcode').modal('show');
                $("#qr7").ClassyQR({
                    type: 'text',
                    text: + cod_id
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
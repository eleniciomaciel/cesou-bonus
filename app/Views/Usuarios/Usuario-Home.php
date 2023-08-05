<?= $this->extend('Usuarios/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <?= $this->include('Usuarios/partial/includes/card') ?>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1">SERVIÇOS</h6>
                <p class="text-sm">ESCOLHA SEU CANAL DE ATENDIMENTO</p>
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
<?= $this->endSection() ?>
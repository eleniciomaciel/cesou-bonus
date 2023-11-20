<?= $this->extend('Caixa/Layout') ?>
<?= $this->section('content') ?>


<div class="row">
    <div class="col-12">
        <h4>Resgate de Pontos</h4>
        <div class="col-6 d-flex align-items-center">
            <button type="button" class="btn_scanner btn bg-gradient-info mt-lg-7 mb-0">
                <i class="fas fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;LER PONTOS
            </button>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn bg-gradient-dark mt-lg-7 mb-0" onclick="reloadPage()">
                <i class="fas fa-sync" aria-hidden="true"></i>&nbsp;&nbsp;Atualizar
                </a>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>COMPENSAR PONTOS</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CLIENTE</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">PONTO</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (!empty($clientes) && is_array($clientes)) : ?>

                                <?php foreach ($clientes as $news_item) : ?>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= esc($news_item['reg_nome']) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= esc($news_item['pontos']) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0"><?= date('d/m/Y', strtotime($news_item['created_at'])) ?></p>
                                        </td>

                                    </tr>

                                <?php endforeach ?>

                            <?php else : ?>

                                <tr>
                                    <td colspan="5" class="text-center">SEM REGISTROS PARA HOJE</td>
                                </tr>

                            <?php endif ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-notificatio_leitor_pontos" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Leitor de pontos</h6>
                <button type="button" class="close_pontos btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Compensar pontos!</h4>
                    <div id="reader" width="600px"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success ml-auto" data-bs-dismiss="modal" id="stopButton">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dadosConsultaPontos" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resgatar pontos</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/Caixa/desconta_ponto" id="formPontosSave">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_do_ponto" id="id_do_ponto">
                    <input type="hidden" name="id_do_cliente" id="id_do_cliente">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">Cliente:</label>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input type="text" class="form-control form-control-alternative" name="sou_cliente" id="sou_cliente" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">pontos:</label>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <input class="form-control" name="id_cli_ponto" id="id_cli_ponto" type="text" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Trocar</label>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <select class="form-control" name="selectPontosOption" id="selectPontosOption">
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="cls_btn_credit btn btn bg-gradient-warning btn-lg w-100" id="id_btn_credit">Resgatar</button>
                            <div id="message" class="text-center"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
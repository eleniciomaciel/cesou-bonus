<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Atendimento</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">Local de atendimento</h6>
                            <span class="mb-2 text-xs">Rua: <span class="text-dark font-weight-bold ms-sm-2">Av. João Durval Carneiro, 1333</span></span>
                            <span class="mb-2 text-xs">Bairro: <span class="text-dark ms-sm-2 font-weight-bold">Vila Nova</span></span>
                            <span class="text-xs">Cidade: <span class="text-dark ms-sm-2 font-weight-bold">Senhor do Bonfim (Cesta do Povo)</span></span>
                        </div>
                    </li>

                </ul>
                <form action="/user/bradesco-agenda" method="POST" id="formAddAgenda">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Usuário:</label>
                                <input type="text" class="form-control" name="agenda_nome" id="agenda_nome" value="<?= session()->get('reg_nome') ?>" readonly>
                                <span class="text-danger error-text agenda_nome_error"></span>
                            </div>
                        </div>

                        <input type="hidden" name="id_usuario" value="<?= session()->get('id') ?>">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Data:</label>
                                <input type="date" name="agenda_data" id="agenda_data" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+ 3 days')) ?>" class="form-control" />
                                <span class="text-danger error-text agenda_data_error"></span>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text">Horas:</span>
                                <select class="form-control" name="agenda_hora" id="agenda_hora">
                                    <option value="" selected disabled>--</option>
                                    <?php for ($i = 1; $i < 25; $i++) : ?>
                                        <option value="<?= esc($i < 10 ? '0' . $i : $i) ?>"><?= esc($i < 10 ? '0' . $i : $i) ?></option>
                                    <?php endfor; ?>
                                </select>
                                <select class="form-control" name="agenda_minut" id="agenda_minut">
                                    <option value="" selected disabled>--</option>
                                    <?php for ($i = 0; $i < 59; $i += 5) : ?>
                                        <option value="<?= esc($i < 10 ? '0' . $i : $i) ?>"><?= esc($i < 10 ? '0' . $i : $i) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            
                            <span class="text-danger error-text agenda_hora_error"></span>
                            <span class="text-danger error-text agenda_minut_error"></span>
                        </div>
                    </div>
                    <br>
                    <button class="class_load_envia btn bg-gradient-dark ms-auto mb-0 js-btn-next" id="id_btn_load" type="submit">Salvar</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
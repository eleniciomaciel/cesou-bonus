<!-- Modal -->
<div class="modal fade" id="exampleModalLevaeTraz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitação de atendimento Leva e traz</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/user/solicita-leva-traz" method="POST" id="solicitaLevaTraz">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">SOLICITANTE</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lvt_solicitante" id="lvt_solicitante" value="<?= session()->get('reg_nome') ?>">
                                <span class="text-danger error-text lvt_solicitante_error"></span>
                            </div>
                        </div>

                        <input type="hidden" name="id_solicitante_lvt" value="<?= session()->get('id') ?>">

                        <div class="col-md-4">
                            <label for="">TEL.: WHATSAPP</label>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="lvt_tel_um" id="lvt_tel_um" value="<?= session()->get('reg_telefone') ?>" readonly />
                                <span class="text-danger error-text lvt_tel_um_error"></span>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <label for="">DATA:</label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="data_lvt" id="data_lvt" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+ 3 days')) ?>" />
                                <span class="text-danger error-text data_lvt_error"></span>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <label for="">Escolha uma de  data p/ burcar-mos você:</label><br>
                            <span class="text-danger error-text data_lvt_error">*</span>
                            <div class="card-header d-flex align-items-center border-bottom py-3">
                                <div class="d-flex align-items-center">
                                    <input type="date" class="form-control" name="data_lvt" id="data_lvt" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+ 3 days')) ?>" />
                                    
                                </div>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio1" value="09:00">
                                <label class="custom-control-label" for="customRadio1">09:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio2" value="09:30">
                                <label class="custom-control-label" for="customRadio2">09:30</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio3" value="10:00">
                                <label class="custom-control-label" for="customRadio2">10:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio4" value="10:30">
                                <label class="custom-control-label" for="customRadio2">10:30</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio5" value="11:00">
                                <label class="custom-control-label" for="customRadio2">11:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio6" value="11:30">
                                <label class="custom-control-label" for="customRadio2">11:30</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio7" value="12:00">
                                <label class="custom-control-label" for="customRadio2">12:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio8" value="12:30">
                                <label class="custom-control-label" for="customRadio2">12:30</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio9" value="13:00">
                                <label class="custom-control-label" for="customRadio2">13:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio10"  value="13:30">
                                <label class="custom-control-label" for="customRadio2">13:30</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio11" value="14:00">
                                <label class="custom-control-label" for="customRadio2">14:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio12" value="15:00">
                                <label class="custom-control-label" for="customRadio2">15:00</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hora_lvt" id="customRadio13" value="15:30">
                                <label class="custom-control-label" for="customRadio2">15:30</label>
                            </div>
                        </div>
                        <span class="text-danger error-text hora_lvt_error"></span>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Bairro:</label>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Ex.: Centro" name="lvt_bairro" id="lvt_bairro" value="<?= session()->get('reg_bairro') ?>">
                                </div>
                                <span class="text-danger error-text lvt_bairro_error"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">Rua:</label>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Ex.: Cotegipe nº 100" name="lvt_rua" id="lvt_rua" value="<?= session()->get('reg_endereco') ?>">
                                </div>
                                <span class="text-danger error-text lvt_rua_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacao_lvt">Referência da localização:</label>
                                <textarea class="form-control" name="lvt_observacao" id="lvt_observacao" rows="3" placeholder="Digite aqui..."></textarea>
                                <span class="text-danger error-text lvt_observacao_error"></span>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="cls_btn_lvt btn bg-gradient-info" id="id_btn_lvt">Solicitar</button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
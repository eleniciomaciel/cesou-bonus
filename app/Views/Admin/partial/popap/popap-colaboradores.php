<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="colaboradorUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do colaborador</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin/alterarColaborador" method="POST" id="formEditColaborador">
                    <?= csrf_field() ?>
                    <input type="hidden" name="hidden_id_colab" id="hidden_id_colab">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nome_colab">NOME:</label>
                            <span class="text-danger error-text colaborador_error"></span>
                            <div class="form-group">
                                <input type="text" class="form-control" name="colaborador" id="colaborador" placeholder="Ex.: Ana Silva" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nome_colab">EMAIL:</label>
                            <span class="text-danger error-text colab_email_error"></span>
                            <div class="form-group">
                                <input type="email" class="form-control" name="colab_email" id="colab_email" placeholder="Ex.: name@example.com" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nome_colab">LOGIN:</label>
                            <span class="text-danger error-text colab_login_error"></span>
                            <div class="form-group">
                                <input type="email" class="form-control" name="colab_login" id="colab_login" placeholder="Ex.: cestou@example.com" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>STATUS:</label>
                            <span class="text-danger error-text colab_status_error"></span>
                            <select class="form-control" name="colab_status" id="colab_status">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="ativo">ATIVO</option>
                                <option value="suspenso">SUSPENSO</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>TELEFONE:</label>
                            <span class="text-danger error-text telefone_error"></span>
                            <input class="form-control" type="tel" id="telefone" name="telefone" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>CPF:</label>
                            <span class="text-danger error-text colab_cpf_error"></span>
                            <input class="form-control" type="text" name="colab_cpf" id="colab_cpf">
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>NÍVEL</label>
                            <span class="text-danger error-text colab_nivel_error"></span>
                            <select class="form-control" id="colab_nivel" name="colab_nivel">
                                <option selected disabled>Selecione aqui....</option>
                                <option value="admin">ADMINISTRADOR</option>
                                <option value="bradesco_panel">BRADESCO</option>
                                <option value="leva_traz_panel">LEVA E TRZ</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="d-flex">
                            <button class="class_load_envia_edit_colaborador btn bg-gradient-primary btn-sm mb-0 me-2" type="submit" name="button" id="id_btn_load_dit_colaborador">Salvar</button>
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
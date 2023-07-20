<!-- Modal -->
<div class="modal fade" id="exampleModalLojas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar empresa</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin/add_lojista" method="POST" id="addLojistasForm">
                <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="loja">Usuário da loja</label>
                                    <select class="form-control" name="loja_usuario" id="loja_usuario">
                                    </select>
                                </div>
                                <span class="text-danger error-text loja_usuario_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CNPJ:</label>
                                <input type="number" class="form-control" id="emp_cnpj" name="emp_cnpj" placeholder="Ex.: 41.873.669/0001-75">
                                <span class="text-danger error-text emp_cnpj_error"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nome empresarial:</label>
                                <input type="text" placeholder="Ex.: Cesta do povo" name="emp_nome_empresarial" id="emp_nome_empresarial" class="form-control"  />
                                <span class="text-danger error-text emp_nome_empresarial_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">% Desconto:</label>
                                <input type="number" placeholder="0,02" name="emp_percentual" id="emp_percentual" class="form-control" />
                                <span class="text-danger error-text emp_percentual_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" placeholder="Ex.: ana@email.com" name="emp_email" id="emp_email" class="form-control" />
                                <span class="text-danger error-text emp_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Área:</label>
                                <input type="text" name="emp_telefone_area" id="emp_telefone_area" class="form-control" />
                                <span class="text-danger error-text emp_telefone_area_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefone:</label>
                                <input type="text" name="emp_telefone" id="emp_telefone" class="form-control" />
                                <span class="text-danger error-text emp_telefone_error"></span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Nome Fantasia:</label>
                                <input type="text" class="form-control" id="emp_nome_fantasia" name="emp_nome_fantasia" placeholder="Ex.: Ceta do Povo" >
                                <span class="text-danger error-text emp_nome_fantasia_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Abertura:</label>
                                <input type="date" class="form-control" id="emp_data_abertura" name="emp_data_abertura" >
                                <span class="text-danger error-text emp_data_abertura_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CEP:</label>
                                <input type="text" class="form-control" id="emp_cep" name="emp_cep" placeholder="Ex.: 18.970-000" >
                                <span class="text-danger error-text emp_cep_error"></span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">UF:</label>
                                <input type="text" class="form-control" id="emp_uf" name="emp_uf" placeholder="Ex.: BA" >
                                <span class="text-danger error-text emp_uf_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">CIDADE:</label>
                                <input type="text" class="form-control" id="emp_ciade" name="emp_ciade" placeholder="Ex.: Senhor do Bonfim" >
                                <span class="text-danger error-text emp_ciade_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BAIRRO:</label>
                                <input type="text" class="form-control" id="emp_bairro" name="emp_bairro" placeholder="Ex.: Centro" >
                                <span class="text-danger error-text emp_bairro_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ENDEREÇO:</label>
                                <input type="text" class="form-control" id="emp_endereco" name="emp_endereco" placeholder="Ex.: Rua 7 de Setembro, nº 300." >
                                <span class="text-danger error-text emp_endereco_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="class_load_envia_add_loja btn btn-info" id="id_btn_load_add_loja">Salvar</button>
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


<!-- Modal alterar-->
<div class="modal fade" id="exampleModalAlterarLojas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar empresa</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin/up_lojista" method="POST" id="upLojistasForm">
                <?= csrf_field() ?>

                <input type="hidden" name="hidden_id_loja" id="hidden_id_loja">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="loja">Usuário da loja</label>
                                    <select class="form-control" name="up_loja_usuario_id" id="up_loja_usuario_id">
                                    </select>
                                </div>
                                <span class="text-danger error-text up_loja_usuario_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CNPJ:</label>
                                <input type="number" class="form-control" id="up_loja_cnpj" name="up_loja_cnpj" placeholder="Ex.: 41.873.669/0001-75">
                                <span class="text-danger error-text up_loja_cnpj_error"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nome empresarial:</label>
                                <input type="text" placeholder="Ex.: Cesta do povo" name="up_loja_nome_empresarial" id="up_loja_nome_empresarial" class="form-control"  />
                                <span class="text-danger error-text up_loja_nome_empresarial_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">% Desconto:</label>
                                <input type="number" placeholder="0,02" name="up_lojas_percentual" id="up_lojas_percentual" class="form-control" />
                                <span class="text-danger error-text up_lojas_percentual_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" placeholder="Ex.: ana@email.com" name="up_loja_email" id="up_loja_email" class="form-control" />
                                <span class="text-danger error-text up_loja_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Área:</label>
                                <input type="text" name="up_loja_area_tel" id="up_loja_area_tel" class="form-control" />
                                <span class="text-danger error-text up_loja_area_tel_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefone:</label>
                                <input type="text" name="up_loja_telefone" id="up_loja_telefone" class="form-control" />
                                <span class="text-danger error-text up_loja_telefone_error"></span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Nome Fantasia:</label>
                                <input type="text" class="form-control" id="up_loja_nome_fantasia" name="up_loja_nome_fantasia" placeholder="Ex.: Ceta do Povo">
                                <span class="text-danger error-text up_loja_nome_fantasia_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Abertura:</label>
                                <input type="date" class="form-control" id="up_loja_data_abertura" name="up_loja_data_abertura">
                                <span class="text-danger error-text up_loja_data_abertura_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CEP:</label>
                                <input type="text" class="form-control" id="up_loja_cep" name="up_loja_cep" placeholder="Ex.: 18.970-000">
                                <span class="text-danger error-text up_loja_cep_error"></span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">UF:</label>
                                <input type="text" class="form-control" id="up_loja_uf" name="up_loja_uf" placeholder="Ex.: BA">
                                <span class="text-danger error-text up_loja_uf_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">CIDADE:</label>
                                <input type="text" class="form-control" id="up_loja_cidade" name="up_loja_cidade" placeholder="Ex.: Senhor do Bonfim">
                                <span class="text-danger error-text up_loja_cidade_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BAIRRO:</label>
                                <input type="text" class="form-control" id="up_loja_bairro" name="up_loja_bairro" placeholder="Ex.: Centro">
                                <span class="text-danger error-text up_loja_bairro_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ENDEREÇO:</label>
                                <input type="text" class="form-control" id="up_loja_endereco" name="up_loja_endereco" placeholder="Ex.: Rua 7 de Setembro, nº 300.">
                                <span class="text-danger error-text up_loja_endereco_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">DESCRIÇÃO PROMOCIONAL:</label>
                                <textarea class="form-control" name="up_loja_promocional" id="up_loja_promocional" rows="3" placeholder="Digite aqui..."></textarea>
                                <span class="text-danger error-text up_loja_promocional_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="class_load_envia_up_loja btn btn-info" id="id_btn_load_up_loja">Alterar</button>
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
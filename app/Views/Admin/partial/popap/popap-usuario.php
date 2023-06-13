<!-- Modal -->
<div class="modal fade" id="exampleModalUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar usuario</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CNPJ:</label>
                                <input type="text" class="form-control" id="emp_cnpj" name="emp_cnpj" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nome empresarial:</label>
                                <input type="text" placeholder="Ex.: Cesta do povo" name="emp_nome_empresarial" id="emp_nome_empresarial" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" placeholder="Ex.: ana@email.com" name="emp_email" id="emp_email" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Área:</label>
                                <input type="text" name="emp_telefone_area" id="emp_telefone_area" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefone:</label>
                                <input type="text"  name="emp_telefone" id="emp_telefone" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Nome Fantasia:</label>
                                <input type="text" class="form-control" id="emp_nome_fantasia" name="emp_nome_fantasia" placeholder="Ex.: Ceta do Povo" disabled>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Abertura:</label>
                                <input type="date" class="form-control" id="emp_data_abertura" name="emp_data_abertura"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CEP:</label>
                                <input type="text" class="form-control" id="emp_cep" name="emp_cep" placeholder="Ex.: 18.970-000" disabled>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">UF:</label>
                                <input type="text" class="form-control" id="emp_uf" name="emp_uf" placeholder="Ex.: BA" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">CIDADE:</label>
                                <input type="text" class="form-control" id="emp_ciade" name="emp_ciade" placeholder="Ex.: Senhor do Bonfim" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BAIRRO:</label>
                                <input type="text" class="form-control" id="emp_bairro" name="emp_bairro" placeholder="Ex.: Centro" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ENDEREÇO:</label>
                                <input type="text" class="form-control" id="emp_endereco" name="emp_endereco" placeholder="Ex.: Rua 7 de Setembro, nº 300." disabled>
                            </div>
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

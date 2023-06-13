<!-- Modal -->
<div class="modal fade" id="exampleModalClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar clientes</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin/cadastra_cliente" method="POST" id="cadastraCliente">
                <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">NOME  COMPLETO:</label>
                                <input type="text" class="form-control" id="cli_nome" name="cli_nome" placeholder="Ex.: Jose da Silva" value="Jose da Silva">
                                <span class="text-danger error-text cli_nome_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">TELEFONE:</label>
                                <input type="tel" name="cli_tel" id="cli_tel" class="form-control" value="(99)9 7666-0099"/>
                                <span class="text-danger error-text cli_tel_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CPF:</label>
                                <input type="text" placeholder="Ex.: 000.000.000-00" name="cli_cpf" id="cli_cpf" class="form-control" value="876.777.887-55" />
                                <span class="text-danger error-text cli_cpf_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CEP:</label>
                                <input type="text" class="form-control" id="cli_cep" name="cli_cep" placeholder="Ex.: 00.000-000" value="20031-130">
                                <span class="text-danger error-text cli_cep_error"></span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">UF:</label>
                                <input type="text" class="form-control" id="cli_uf" name="cli_uf"  readonly>
                                <span class="text-danger error-text cli_uf_error"></span>
                            </div>
                        </div>
                   
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">CIDADE:</label>
                                <input type="text" class="form-control" id="cli_cidade" name="cli_cidade" placeholder="Ex.: Senhor do Bonfim" readonly>
                                <span class="text-danger error-text cli_cidade_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">BAIRRO:</label>
                                <input type="text" class="form-control" id="cli_bairro" name="cli_bairro" placeholder="Ex.: Centro">
                                <span class="text-danger error-text cli_bairro_error"></span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">ENDEREÇO:</label>
                                <input type="text" class="form-control" id="cli_endereco" name="cli_endereco" placeholder="Ex.: Rua 7 de Setembro">
                                <span class="text-danger error-text cli_endereco_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">EMAIL:</label>
                                <input type="email" class="form-control" id="cli_email" name="cli_email" placeholder="Ex.: ana@email.com" value="ana@email.com">
                                <span class="text-danger error-text cli_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">SENHA:</label>
                                <input type="text" class="form-control" id="cli_senha" name="cli_senha" placeholder="Ex.: 12345678." value="eU_123456">
                                <span class="text-danger error-text cli_senha_error"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="class_load_envia btn bg-gradient-primary" id="id_btn_load">Salvar</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class=" btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
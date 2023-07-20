<div class="col-md-4">
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Fazer troca de benefício</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="py-3 text-center">

                        <div id="qr-reader" style="width: 100%"></div>
                        <div id="qr-reader-results"></div>

                    </div>
                    <span class="text-center text-danger" id="error_qrcode"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cls_closed_cam btn btn-white" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="modal fade" id="modal-default_dados_Clientes" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Dados do cliente</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="/gestor/registra_desconto" method="POST" id="forRegistraCupom">

                        <?= csrf_field() ?>

                        <input type="hidden" name="hidden_id_cupon" id="hidden_id_cupon">
                        <input type="hidden" name="usuario_id" id="usuario_id">
                        <input type="hidden" name="hidden_id_sefaz" id="hidden_id_sefaz">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="userusuario">Nome:</label>
                                <div class="form-group">
                                    <input type="text" name="userusuario" id="userusuario" placeholder="Success" class="form-control" readonly />
                                    <span class="text-danger error-text userusuario_error"></span>
                                </div>
                            </div>
                            <!-- <div class="col-md-2">
                                <label for="userpontos">PONTOS:</label>
                                <div class="form-group has-success">
                                    <input type="number" name="userpontos" id="userpontos" placeholder="Success" class="form-control is-valid" readonly />
                                    <span class="text-danger error-text userpontos_error"></span>
                                </div>
                            </div> -->
                            <div class="col-md-5">
                                <label for="usercup_status">STATUS:</label>
                                <div class="form-group has-success">
                                    <input type="text" name="usercup_status" id="usercup_status" class="form-control is-valid" readonly />
                                    <span class="text-danger error-text usercup_status_error"></span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label for="usercpf">CPF:</label>
                                <div class="form-group has-success">
                                    <input type="text" name="usercpf" id="usercpf" placeholder="Error Input" class="form-control is-valid" readonly />
                                    <span class="text-danger error-text usercpf_error"></span>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <label for="valor_venda">VALOR DA VENDA:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                        <input type="text" class="form-control" name="valor_venda" id="valor_venda" class="form-control is-valid" required />
                                        <span class="text-danger error-text valor_venda_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="valor_desconto">DESCONTO:</label>



                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                        <input type="number" class="form-control" name="valor_desconto" id="valor_desconto" class="form-control is-valid" max="100" required />
                                        <span class="text-danger error-text valor_desconto_error"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <label for="" class="text-white">calcular</label>
                                <button type="button" class="btn bg-gradient-success" onclick="myFunction()">
                                    <i class="ni ni-check-bold"></i> Calcular
                                </button>
                            </div>
                            <div class="col-12">

                                Resultado: R$<span id="resultado" class="text-muted"></span>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="cls_btn_lvt_troca_cupon btn bg-gradient-success" id="id_btn_lvt_cupon_troca">
                                    <i class="ni ni-check-bold"></i> Trocar
                                </button>
                            </div>


                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-primary ml-auto" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default_add_cupon" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Cadastrar cupon de compras</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/user/save-scanner-qrcode" method="POST" id="addCupomFiscal" name="addCupomFiscal">
                    <?= csrf_field() ?>
                    <div class="row">

                        <div class="col-md-12">
                            Scanner QR Code do cupon
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="resultados" id="resultados"
                                    placeholder="Aqui..." aria-label="Recipient's username"
                                    aria-describedby="button-addon2" readonly>
                                <button class="btn btn-outline-primary mb-0" type="button" id="clickViewOpenReadQrCode">
                                    <i class="fa fa-qrcode"></i> Click scanner</button>
                            </div>
                            <span class="text-danger error-text resultados_error"></span>
                        </div>
                        <div class="col-md-6">
                            CHAVE DA NOTA:
                            <div class="form-group">
                                <input type="text" name="valor_chave" id="valor_chave" class="form-control" readonly />
                                <span class="text-danger error-text valor_chave_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            CNPJ DO VENDEDOR
                            <div class="form-group">
                                <input type="text" class="form-control" name="cnpj_vededor" id="cnpj_vededor"
                                    readonly />
                                <span class="text-danger error-text cnpj_vededor_error"></span>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id_usuario_cashback" value="<?= session()->get('id') ?>">
                    <div class="row">

                        <div class="col-md-12">
                            EMPRESA:
                            <div class="form-group">
                                <input type="text" name="empresa_vendedora" id="empresa_vendedora"
                                    value="CESTA DO POVO SUPERMERCADOS" class="form-control" readonly />
                                <span class="text-danger error-text empresa_vendedora_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            DATA DA COMPRA:
                            <div class="form-group">
                                <input type="date" class="form-control" name="data_compra" id="data_compra"
                                    value="<?= date('Y-m-d') ?>" />
                                <span class="text-danger error-text data_compra_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            VALOR DA NOTA:
                            <div class="form-group">
                                <input type="text" name="valor_comprado" id="valor_comprado" class="form-control" />
                                <span class="text-danger error-text valor_comprado_error"></span>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="cls_btn_lvt btn bg-gradient-primary" id="id_btn_lvt">Salvar</button>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
    aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">SCANER CUPON DE COMPRAS</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Ler QR CODE (CUPON)!</h4>

                    <div id="qr-reader" style="width:100%"></div>
                    <div id="qr-reader-results"></div>
                    <p></p>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                    data-bs-target="#modal-default_add_cupon">Fechar scanner</button>
                <button type="button" class="btn btn-link text-white ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="modal-form_caixa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-info text-gradient">Cestou.top</h3>
                <p class="mb-0">Acesso do caixa na hora da venda.</p>
              </div>
              <div class="card-body">
                <form role="form text-left" method="post" action="/user/senha-caixa" id="acesso_libera_senha_caixa">
                <?= csrf_field() ?>

                  <label>Senha:</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" name="senha_caixa" id="senha_caixa" placeholder="Senha do caixa..." aria-label="Password" aria-describedby="password-addon">
                    
                  </div>
                  <span class="text-danger error-text senha_caixa_error"></span>
                  <div class="text-center">
                    <button type="submit" class="class_load_envia_up_senha_caixa btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" id="id_btn_load_up_senha_caixa">Liberar Valor</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
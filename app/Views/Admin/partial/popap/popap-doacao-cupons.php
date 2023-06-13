<!-- Modal -->
<div class="modal fade" id="exampleModalmodalDoacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cupons de doação</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="card">

          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              <li class="list-group-item border-0  border-radius-lg">

                <div class="ms-auto text-end">
                  <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;" id="clickOpenScanner">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Inserir Cupom
                  </a>
                </div>

                <div class="d-flex flex-column">


                  <?= form_open('/admin/save-cupon-doacao', 'id="formDoacaoAdd"') ?>
                  <label>URL CHAVE</label><br>
                  <span class="text-danger error-text url_chave_cupon_doacao_error"></span>
                  <div class="input-group col-mb-12">
                    <input type="text" class="form-control" name="url_chave_cupon_doacao" id="url_chave_cupon_doacao" readonly>
                  </div>

                  <label>CHAVE</label><br>
                  <span class="text-danger error-text chave_cupon_doacao_error"></span>
                  <div class="input-group col-mb-12">
                    <input type="text" class="form-control" name="chave_cupon_doacao" id="chave_cupon_doacao" readonly>
                  </div>

                  <label>CNPJ</label><br>
                  <span class="text-danger error-text cnpj_leitor_doacao_error"></span>
                  <div class="input-group col-mb-12">
                    <input type="text" class="form-control" name="cnpj_leitor_doacao" id="cnpj_leitor_doacao" readonly>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="cls_btn_add_dc btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" id="id_btn_add_dc">SALVAR SCANNER</button>
                  </div>

                  </form>



                </div>

              </li>


            </ul>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>



<!--// modal de leitura -->

<div class="col-md-4">
  <div class="modal fade" id="modal-defaultNewDoaco" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-default">Scanner de QrCode</h6>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">


          <div id="reader" width="600px"></div>
          <p id="resultados"></p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal" onclick="stopScanner()">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!--// modal fazer doação-->

<div class="modal fade" id="fz_doacaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Doar Cupom</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <?=form_open('admin/salva-doacao','id="enviaDoacao"');?>
          <div class="form-group">
            <label for="cupom_chave_cupom">CHAVE DO CUPOM</label><br>
            <span class="text-danger error-text cupom_chave_cupom_error"></span>
            <input type="text" class="form-control" name="cupom_chave_cupom" id="cupom_chave_cupom" readonly>
          </div>

          <input type="hidden" name="doar_id" id="doar_id" />

          <div class="form-group">
            <label for="cupom_vencimento">DATA DE VENCIMENTO</label><br>
            <span class="text-danger error-text cupom_vencimento_error"></span>
            <input type="date" class="form-control" name="cupom_vencimento" id="cupom_vencimento" readonly>
          </div>
          <div class="form-group">
            <label for="cupom_status">STATUS DO CUPOM</label><br>
            <span class="text-danger error-text cupom_status_error"></span>
            <select class="form-control" name="cupom_status" id="cupom_status">
              <option selected disabled>Selecione aqui...</option>
              <option value="Ativo">Ativo</option>
              <option value="Compensado">Compensado</option>
            </select>
          </div>

          <div class="form-group">
            <label for="cliente_cupom">BENEFICIÁRIO DO CUPOM</label>
            <br> 
            <span class="text-danger error-text cliente_cupom_error"></span>
            <select class="form-control" name="cliente_cupom" id="cliente_cupom">

            </select>
          </div>

          <button type="submit" class="cls_btn_add_dc_doar btn bg-gradient-info mb-0" id="id_btn_add_dc_doar">Salvar doação</button>

        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
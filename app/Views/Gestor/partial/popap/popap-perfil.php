<div class="col-md-4">
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient">Dados de acesso</h3>
                            <p class="mb-0" style="text-align: center;">Atualizar dados de login ou senha</p>
                        </div>
                        <div class="card-body pb-3">
                            <form method="post" action="/gestor/atualizar-perfil_gestor" role="form text-left" id="perfilGestorAcesso">
                                <?= csrf_field() ?>
                                <label>Nome completo:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="g_perfil_nome" id="g_perfil_nome" placeholder="Ex.: Ana Silva" value="<?= session()->get('reg_nome') ?>">
                                    <span class="text-danger error-text g_perfil_nome_error"></span>
                                </div>
                                <label>Email:</label>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="g_perfil_email" id="g_perfil_email" placeholder="Ex.: ana@email.com" value="<?= session()->get('reg_email') ?>">
                                    <span class="text-danger error-text g_perfil_email_error"></span>
                                </div>
                                <label>Nova Senha:</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="g_perfil_senha" id="g_perfil_senha" placeholder="Ex.: 123*##" >
                                    <span class="text-danger error-text g_perfil_senha_error"></span>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="class_load_envia_g_perfil btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0" id="id_btn_load_g_perfil">Alterar</button>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
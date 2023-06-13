<?= $this->extend('Admin/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>COLABORADORES</h6>
                <button type="button" class="btn bg-gradient-warning" id="mostraForm">CRIAR NOVO</button>
            <br>

            <div class="card shadow-none border h-100" style="display: none;" id="formColaborador">
                <form action="/admin/adicionarColaborador" method="POST" id="formAddColaborador">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nome_colab">NOME:</label>
                            <span class="text-danger error-text reg_nome_error"></span>
                            <div class="form-group">
                                <input type="text" class="form-control" name="reg_nome" id="reg_nome" placeholder="Ex.: Ana Silva" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nome_colab">EMAIL:</label>
                            <span class="text-danger error-text reg_email_error"></span>
                            <div class="form-group">
                                <input type="email" class="form-control" name="reg_email" id="reg_email" placeholder="Ex.: name@example.com" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nome_colab">LOGIN:</label>
                            <span class="text-danger error-text reg_login_error"></span>
                            <div class="form-group">
                                <input type="email" class="form-control" name="reg_login" id="reg_login" placeholder="Ex.: cestou@example.com" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>STATUS:</label>
                            <span class="text-danger error-text status_error"></span>
                            <select class="form-control" name="status" id="status">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="ativo">ATIVO</option>
                                <option value="suspenso">SUSPENSO</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>TELEFONE:</label>
                            <span class="text-danger error-text reg_telefone_error"></span>
                            <input class="form-control" type="tel" id="reg_telefone" name="reg_telefone" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>CPF:</label>
                            <span class="text-danger error-text reg_cpf_error"></span>
                            <input class="form-control" type="text" name="reg_cpf" id="reg_cpf">
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>NÍVEL</label>
                            <span class="text-danger error-text role_error"></span>
                            <select class="form-control" id="role" name="role">
                                <option selected disabled>Selecione aqui....</option>
                                <option value="admin">ADMINISTRADOR</option>
                                <option value="bradesco_panel">BRADESCO</option>
                                <option value="leva_traz_panel">LEVA E TRZ</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="d-flex">
                            <button class="class_load_envia_add_colaborador btn bg-gradient-primary btn-sm mb-0 me-2" type="submit" name="button" id="id_btn_load_add_colaborador">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="card-body px-0 pt-0 pb-2">

            <div class="table-responsive p-0">

                <table class="table align-items-center mb-0" id="tableColaboradores">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOME</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ATIVIDADE</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATA</th>
                            <th class="text-secondary opacity-7">OPÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?= $this->include('Admin/partial/popap/popap-colaboradores') ?>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script>
$(document).ready(function(){
  $("#mostraForm").click(function(){
    $("#formColaborador").toggle();
  });


  $('#tableColaboradores').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        },
        processing: true,
        serverSide: true,
        ajax: '<?= site_url("admin/listaColaboradores")?>',
        columns: [
            {data: 'reg_nome'},
            {data: 'role'},
            {data: 'status'},
            {data: 'created_at'},
            {data: 'action', orderable: false},
        ]
    });

  /**
   * cadastra colaborador
   */
        let preload_btn_add_colaborador = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Salvando, aguarde...';
        let btn_default_add_colaborador = 'Salvar';

        $('#formAddColaborador').submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    $('.class_load_envia_add_colaborador').html(preload_btn_add_colaborador);
                    $('.class_load_envia_add_colaborador').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load_add_colaborador').html(btn_default_add_colaborador);
                    $('.class_load_envia_add_colaborador').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#tableColaboradores').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Ops!',
                                'Algo deu errado, corrija por favor.',
                                'success'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

                /**
         * lista dados cliente em modal
         */
        $(document).on('click', '.viewColaborador', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('admin/getOneColaborador'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#colaborador').val(data.reg_nome);
                    $('#telefone').val(data.reg_telefone);
                    $('#colab_cpf').val(data.reg_cpf);
                    $('#colab_email').val(data.reg_email);
                    $('#colab_login').val(data.reg_login);
                    $('#colab_status').val(data.status);
                    $('#colab_nivel').val(data.role);
                    $('#colaboradorUserModal').modal('show');
                    $('#hidden_id_colab').val(id);
                }
            })
        });

         /**
   * cadastra colaborador
   */
        let preload_btn_edit_colaborador = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Alterando, aguarde...';
        let btn_default_edit_colaborador = 'Alterar';

        $('#formEditColaborador').submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    $('.class_load_envia_edit_colaborador').html(preload_btn_edit_colaborador);
                    $('.class_load_envia_edit_colaborador').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load_dit_colaborador').html(btn_default_edit_colaborador);
                    $('.class_load_envia_edit_colaborador').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $('#tableColaboradores').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Ops!',
                                'Algo deu errado, corrija por favor.',
                                'success'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });
});
</script>
<?= $this->endSection() ?>
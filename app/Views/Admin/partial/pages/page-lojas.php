<?= $this->extend('Admin/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-6 col-7">
                    <h6>LOJAS</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                    </p>
                    <button type="button" name="button" class="btn bg-gradient-primary m-0 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModalLojas">+ ADICIONAR</button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="table_lojistas">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">RESPONSÁVEL</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">COMÉRCIO</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CIDADE</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">OPÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Admin/partial/popap/popap-loja') ?>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {


        /**
         * lista usuários select
         */

        $.ajax({
            url: "<?= site_url('admin/usuarios-lojas'); ?>",
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                var html = '<option value="" selected disabled>Selecione um lojista</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id + '>' + data[i].reg_nome + '</option>';
                }
                $('#loja_usuario').html(html)
            }
        });


        $.ajax({
            url: "<?= site_url('admin/usuarios-lojas'); ?>",
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                var html = '<option value="" selected disabled>Selecione um lojista</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id + '>' + data[i].reg_nome + '</option>';
                }
                $('#up_loja_usuario_id').html(html)
            }
        });

        /**
         * lista lojistas
         */
        $('#table_lojistas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('admin/lista_lojistas') ?>",
            columns: [{
                    data: 'reg_nome'
                },

                {
                    data: 'loja_nome_empresarial'
                },
                {
                    data: 'loja_cidade'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });


        $('#emp_telefone_area').mask("(00)", {
            placeholder: "(00)"
        });
        $('#emp_telefone').mask("(00)9 0000-0000", {
            placeholder: "(00)9 0000-0000"
        });

        $("#emp_cnpj").blur(function() {
            let cnpj = $('#emp_cnpj').val();
            const options = {
                method: 'GET',
                headers: {
                    'X-RapidAPI-Key': '26262e6459mshad9c1d20e37867fp11a26fjsnbf567637e5ea',
                    'X-RapidAPI-Host': 'consulta-cnpj-gratis.p.rapidapi.com',
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            };
            //alert(cnpj);
            async function loadNames() {
                const response = await fetch('https://consulta-cnpj-gratis.p.rapidapi.com/office/' + cnpj + '?simples=false', options);
                const names = await response.json();
                document.getElementById('emp_nome_fantasia').value = (names.alias);
                document.getElementById('emp_data_abertura').value = (names.founded);
                document.getElementById('emp_nome_empresarial').value = (names.company.name);
                document.getElementById('emp_cep').value = (names.address.zip);
                document.getElementById('emp_uf').value = (names.address.state);
                document.getElementById('emp_ciade').value = (names.address.city);
                document.getElementById('emp_bairro').value = (names.address.district);
                document.getElementById('emp_endereco').value = (names.address.street);

            }
            loadNames();
        });

        /**
         * adiciona lojistas
         */

        let preload_btn_add_loja = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Salvando, aguarde...';
        let btn_default_add_loja = 'Salvar';

        $('#addLojistasForm').submit(function(e) {
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
                    $('.class_load_envia_add_loja').html(preload_btn_add_loja);
                    $('.class_load_envia_add_loja').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load_add_loja').html(btn_default_add_loja);
                    $('.class_load_envia_add_loja').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#table_lojistas').DataTable().ajax.reload(null, false);
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


        /**lista loja
         * 
         */
        $(document).on('click', '.view_loja_dados', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('admin/dados_loja'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#up_loja_usuario_id').val(data.loja_usuario_id );
                    $('#up_loja_cnpj').val(data.loja_cnpj);
                    $('#up_loja_nome_empresarial').val(data.loja_nome_empresarial);
                    $('#up_loja_email').val(data.loja_email);
                    $('#up_loja_area_tel').val(data.loja_area_tel);
                    $('#up_loja_telefone').val(data.loja_telefone);
                    $('#up_loja_nome_fantasia').val(data.loja_nome_fantasia);
                    $('#up_loja_data_abertura').val(data.loja_data_abertura);
                    $('#up_loja_cep').val(data.loja_cep);
                    $('#up_loja_uf').val(data.loja_uf);
                    $('#up_loja_cidade').val(data.loja_cidade);
                    $('#up_loja_bairro').val(data.loja_bairro);
                    $('#up_loja_endereco').val(data.loja_endereco);
                    $('#up_lojas_percentual').val(data.lojas_percentual);
                    $('#up_loja_promocional').val(data.lojas_promocional);
                    $('#exampleModalAlterarLojas').modal('show');
                    $('#hidden_id_loja').val(id);
                }
            })
        });



        $(document).on('click', '.delete_loja_dados', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deletar loja?',
                text: "Deseja deletar essa loja!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url(); ?>admin/delete_loja",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                data,
                                'success'
                            )
                            $('#table_lojistas').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            })
        });

        /**
         *altera loja
         */

         let preload_btn_up_loja = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Alterando, aguarde...';
        let btn_default_up_loja = 'Alterar';

        $('#upLojistasForm').submit(function(e) {
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
                    $('.class_load_envia_up_loja').html(preload_btn_up_loja);
                    $('.class_load_envia_up_loja').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load_up_loja').html(btn_default_up_loja);
                    $('.class_load_envia_up_loja').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $('#table_lojistas').DataTable().ajax.reload(null, false);
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
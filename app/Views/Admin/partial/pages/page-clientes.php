<?= $this->extend('Admin/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-6 col-7">
                    <h6>Clientes</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                        <span class="font-weight-bold ms-1">30 clientes</span> cadastrados
                    </p>
                    <button type="button" name="button" class="btn bg-gradient-primary m-0 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModalClientes">+ ADICIONAR</button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="table_lista_clientes" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOME</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TELEDONE</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UF</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CIDADE</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EMAIL</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Admin/partial/popap/popap-clientes') ?>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {

        $('#cli_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#cli_cpf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });

        $('#cli_tel').mask("(00)9 0000-0000", {
            placeholder: "(00)9 0000-0000"
        });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#cli_endereco").val("");
            $("#cli_bairro").val("");
            $("#cli_cidade").val("");
            $("#cli_uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cli_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#cli_endereco").val("...");
                    $("#cli_bairro").val("...");
                    $("#cli_cidade").val("...");
                    $("#cli_uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#cli_endereco").val(dados.logradouro);
                            $("#cli_bairro").val(dados.bairro);
                            $("#cli_cidade").val(dados.localidade);
                            $("#cli_uf").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            Swal.fire(
                                'OPS!',
                                'CEP não encontrado!',
                                'error'
                            );
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    Swal.fire(
                        'OPS!',
                        'Formato de CEP inválido!',
                        'error'
                    );
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

        $('#table_lista_clientes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('admin/list_clientes') ?>",
            columns: [{
                    data: 'reg_nome'
                },
                {
                    data: 'reg_telefone'
                },
                {
                    data: 'reg_uf'
                },
                {
                    data: 'reg_cidade'
                },
                {
                    data: 'reg_email'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });


        let preload_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Salvabdo, aguarde...';
        let btn_default = 'Salvar';

        $('#cadastraCliente').submit(function(e) {

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
                    $('.class_load_envia').html(preload_btn);
                    $('.class_load_envia').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load').html(btn_default);
                    $('.class_load_envia').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#table_lista_clientes').DataTable().ajax.reload(null, false);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 2500
                            });
                        } else {
                            alert(data.msg);

                        }
                    } else {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Existem informações incorreta no cadastro, revise por gentileza.',
                            showConfirmButton: false,
                            timer: 2500
                        })

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
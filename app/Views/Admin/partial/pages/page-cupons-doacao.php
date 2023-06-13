<?= $this->extend('Admin/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
        <div class="card">





            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Cupons para doação</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModalmodalDoacao">
                                +&nbsp; Adicionar cupom
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="preview" aria-selected="true">
                            <i class="ni ni-badge text-sm me-2"></i> EM DOAÇÃO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="code" aria-selected="false">
                            <i class="ni ni-laptop text-sm me-2"></i> DOADOS
                        </a>
                    </li>
                </ul>


                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" style="width: 100%;" id="lista_abertos">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DOADOR</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">CHAVE</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">DATA</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">VALIDADE</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <div class="card-body px-0 pb-2">

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" style="width: 100%;" id="lista_doados">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">BENEFICIÁDO</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">CHAVE</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">DATA</th>
                                            <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">VALIDADE</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<?= $this->include('Admin/partial/popap/popap-doacao-cupons.php') ?>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/html5-qrcode.min.js"></script>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/classyqr.min.js"></script>
<script>
    $(document).ready(function() {

        lerClientes();
        /**LISTA DOAÇÃO */

        $('#lista_abertos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('admin/lista_cupons_abertos') ?>',
            columns: [
                {
                    data: 'usuario'
                },
                {
                    data: 'cd_key_cupom'
                },
                {
                    data: 'cd_data_cupom'
                },
                {
                    data: 'cd_data_vencimento_cupom'
                },
                {
                    data: 'cd_status'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });


        $('#lista_doados').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('admin/lista_cupons_doados') ?>',
            columns: [{
                    data: 'doado'
                },
                {
                    data: 'cd_key_cupom'
                },
                {
                    data: 'cd_data_cupom'
                },
                {
                    data: 'cd_data_vencimento_cupom'
                },
                {
                    data: 'cd_status'
                },
            ]
        });


        /**cadastrar doação por OCR */
        $("#clickOpenScanner").click(function() {
            $('#modal-defaultNewDoaco').modal('show');

            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);

                if (decodedText) {

                    let resultados_scanner_url = decodedText;
                    let resultados_scanner = decodedText;
                    let cnpj_verify = resultados_scanner.slice(61, 75);
                    let chave_qrcode_cefaz = resultados_scanner.slice(56, 99);

                    // alert(chave_qrcode_cefaz);
                    document.getElementById("url_chave_cupon_doacao").value = resultados_scanner_url;
                    document.getElementById("cnpj_leitor_doacao").value = cnpj_verify;
                    document.getElementById("chave_cupon_doacao").value = chave_qrcode_cefaz;
                    //document.getElementById('valor_chave').value = chave_qrcode_cefaz;
                    html5QrcodeScanner.clear();
                    $('#modal-defaultNewDoaco').modal('hide');
                    $('#exampleModalmodalDoacao').modal('show');
                }
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });


        /**salva cachback*/
        let preload_btn = '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>Salvabdo, aguarde...';
        let btn_default = 'Salvar';

        $('#formDoacaoAdd').submit(function(e) {

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
                    $('.cls_btn_add_dc').html(preload_btn);
                    $('.cls_btn_add_dc').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_add_dc').html(btn_default);
                    $('.cls_btn_add_dc').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#lista_abertos').DataTable().ajax.reload(null, false);
                            $('#lista_doados').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Ops!',
                                data.msg,
                                'success'
                            );
                        }
                    } else {

                        Swal.fire(
                            'Ops!',
                            'Existem campor fora do padrão, corrija por favor.',
                            'error'
                        );

                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });


        /**pagina de doação */
        $(document).on('click', '.faz_doacao', function() {
            var doar_id = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('admin/lista_unica_doacao_doacao'); ?>",
                method: "GET",
                data: {
                    doar_id: doar_id
                },
                dataType: "json",
                success: function(data) {

                    $('#fz_doacaoModal').modal('show');
                    $('#cupom_chave_cupom').val(data.cd_key_cupom);
                    $('#cupom_vencimento').val(data.cd_data_vencimento_cupom);
                    let status = data['cd_status'];

                    if (status == 'Ativo') {
                        $('#cupom_status').val(data.cd_status);
                        $("#cupom_status").attr("disabled", false);
                    } else {
                        $('#cupom_status').val(data.cd_status);
                        $('#cupom_status').prop('disabled', true);
                    }

                    $('#doar_id').val(doar_id);
                }
            })
        });

        lerClientes();

        function lerClientes() {
            $.ajax({
                url: "<?= site_url('admin/lista_todos_usuarios'); ?>",
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    var html = '<option selected disabled>Selecione um cliente</option>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].id + '">' + data[count].reg_nome + '</option>';
                    }
                    $('#cliente_cupom').html(html);
                }
            });
        }


        /**salva doacao*/

        $('#enviaDoacao').submit(function(e) {

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
                    $('.cls_btn_add_dc_doar').html(preload_btn);
                    $('.cls_btn_add_dc_doar').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_add_dc_doar').html(btn_default);
                    $('.cls_btn_add_dc_doar').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#lista_abertos').DataTable().ajax.reload(null, false);
                            $('#lista_doados').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Ops!',
                                data.msg,
                                'success'
                            );
                        }
                    } else {

                        Swal.fire(
                            'Ops!',
                            'Existem campor fora do padrão, corrija por favor.',
                            'error'
                        );

                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        /**deletar doação */

        $(document).on('click', '.delete_doacao', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Deletar cupom?',
                text: "Deseja deletar essa cupom!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('admin/delete_cupom'); ?>",
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
                            $('#lista_abertos').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            })
        });

    });
</script>


<?= $this->endSection() ?>
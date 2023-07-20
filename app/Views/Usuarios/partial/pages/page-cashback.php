<?= $this->extend('Usuarios/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
        <div class="card-header pb-0">

            <div class="d-lg-flex">
                <div>
                    <h5 class="mb-0">Cestou Bônus</h5>
                    <p class="text-sm mb-0">
                        Cadastre seu cupon e receba seu desconto sem sorteio.
                    </p>
                </div>
            </div>

            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">
                            <i class="ni ni-cart text-sm me-2"></i> Ativos
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">
                            <i class="ni ni-fat-remove text-sm me-2"></i> Histórico
                        </a>
                    </li>

                </ul>
            </div>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="table_list_cupons" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            VENCIMENTO</th>
                                        <th
                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            STATUS</th>
                                        <th
                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RESGATE</th>
                                        <th
                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            OPÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    <div class="card-header pb-0">
                        <h6>RESGATADOS / VENCIDOS</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side" id="results_cupons_vencidos_resgatados"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<!-- popap de senha do caixa -->

<div class="fixed-plugin ps">
    <a href="#" class="fixed-plugin-button text-dark position-fixed px-3 py-2" data-bs-toggle="modal"
        data-bs-target="#modal-form_caixa">
        <i class="fa fa-lock py-2" aria-hidden="true"> </i>
    </a>
</div>

<?= $this->include('Usuarios/partial/popap/popap-shopping-cashback'); ?>
<?= $this->include('Usuarios/partial/popap/popap-gerar-qrcode'); ?>
<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/html5-qrcode.min.js"></script>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/classyqr.min.js"></script>
<script>
    $(document).ready(function () {

        $("#clickViewOpenReadQrCode").click(function () {
            $('#modal-notification').modal('show');

            function docReady(fn) {
                // see if DOM is already available
                if (document.readyState === "complete" ||
                    document.readyState === "interactive") {
                    // call on next available tick
                    setTimeout(fn, 1);
                } else {
                    document.addEventListener("DOMContentLoaded", fn);
                }
            }

            docReady(function () {
                var resultContainer = document.getElementById('qr-reader-results');
                var lastResult, countResults = 0;
                let result = document.getElementById("resultados").value = null;


                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        ++countResults;
                        lastResult = decodedText;
                        // Handle on success condition with the decoded message.
                        console.log(`Scan result ${decodedText}`, decodedResult);

                        //let html = document.getElementById("resultados").innerHTML;
                        let resultados_scanner = document.getElementById("resultados").value = decodedText;
                        let cnpj_verify = resultados_scanner.slice(61, 75);
                        document.getElementById("cnpj_vededor").value = cnpj_verify;
                        document.getElementById('valor_chave').value = resultados_scanner.slice(56, 99);

                        if (cnpj_verify != '11114552000147') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'A leitura do cupom não é permitido.',
                                showConfirmButton: false,
                                timer: 3500
                            });
                            return false;
                        }

                        Swal.fire(
                            'OK!',
                            'Scanner realizado com sucesso!',
                            'success'
                        );

                        html5QrcodeScanner.clear();
                        $('#modal-notification').modal('hide');
                        $('#modal-default_add_cupon').modal('show');

                        if (cnpj_verify) {

                            //let key_sefaz = document.getElementById('valor_chave').value = resultados_scanner.slice(56, 99);

                            const options = {
                                method: 'GET',
                                headers: {
                                    'X-RapidAPI-Key': '26262e6459mshad9c1d20e37867fp11a26fjsnbf567637e5ea',
                                    'X-RapidAPI-Host': 'consulta-cnpj-gratis.p.rapidapi.com',
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                }
                            };

                            async function loadNames() {
                                const response = await fetch('https://consulta-cnpj-gratis.p.rapidapi.com/office/' + cnpj_verify + '?simples=false', options);
                                const names = await response.json();
                                document.getElementById('empresa_vendedora').value = (names.alias);
                                document.getElementById('cnpj_vededor').value = (company.id);
                                console.log(response);

                            }
                            loadNames();

                        }

                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
                html5QrcodeScanner.render(onScanSuccess);



            });

        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#valor_comprado').mask("#.##0,00", {
            reverse: true
        });

        $('#table_list_cupons').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('user/lista_cupons_ativos') ?>",
            columns: [{
                data: 'cup_data_vencimento_cupom'
            },
            {
                data: 'cup_status'
            },
            {
                data: 'progress'
            },
            {
                data: 'action',
                orderable: false
            },
            ],
            columnDefs: [{
                targets: 0,
                orderable: false
            },]
        });
        /**salva cachback*/
        let preload_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Salvabdo, aguarde...';
        let btn_default = 'Salvar';

        $('#addCupomFiscal').submit(function (e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                    $('.cls_btn_lvt').html(preload_btn);
                    $('.cls_btn_lvt').attr('disabled', 'disabled');
                },
                complete: function () {
                    $('#id_btn_lvt').html(btn_default);
                    $('.cls_btn_lvt').attr('disabled', false);
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#table_list_cupons').DataTable().ajax.reload(null, false);
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

                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        $(document).on('click', '.gerarQrCode', function () {
            var id = $(this).attr('id');
            $.ajax({
                url: "<?= site_url('user/qrcode_build'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    let cod_id = data['cup_id'];
                    let cod_key = data['cup_key_cupom'];
                    let cod_user = data['cup_usuario_id'];

                    $('#modal-notification_qrcode_ready').modal('show');
                    $('#hidden_cupom_id').val(id);
                    $("#qr1").ClassyQR({
                        type: 'text',
                        text: + cod_id
                    });
                }
            });


        });

    });
</script>
<?= $this->endSection() ?>
<?= $this->extend('Usuarios/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
        <div class="card-header pb-0">

            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <i class="ni ni-delivery-fast text-sm me-2"></i> Solicitações
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                            <i class="ni ni-check-bold text-sm me-2"></i> Atendidos
                        </a>
                    </li>

                </ul>
            </div>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <button type="button" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLevaeTraz">Solicitar atendimento</button>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="table_lista_leva_traz_active" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HORA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table_lista_leva_traz_cancel" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CLIENTE</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATA</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HORA</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
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

<?= $this->include('Usuarios/partial/popap/popap-levaetraz'); ?>
<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5c4dfa1951410568a108bdaf/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script>
    $(document).ready(function() {
        $('#lvt_tel_dois').mask("(00)9 0000-0000", {
            placeholder: "(00)9 0000-0000"
        });

        $('#lvt_bairro').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
        $('#lvt_rua').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        $('#table_lista_leva_traz_active').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('user/lista-leva-traz') ?>",
            columns: [{
                    data: 'lvt_date'
                },
                {
                    data: 'lvt_time'
                },
                {
                    data: 'status_viw'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });


        /*lista cancelados */
        $('#table_lista_leva_traz_cancel').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('user/cancelar_lista_leva_traz') ?>",
            columns: [{
                    data: 'lvt_solicitante'
                },
                {
                    data: 'lvt_date'
                },
                {
                    data: 'lvt_time'
                },
                {
                    data: 'status_viw'
                },
            ]
        });

        /**solicitação leva e traz */
        let preload_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Salvabdo, aguarde...';
        let btn_default = 'Salvar';

        $('#solicitaLevaTraz').submit(function(e) {
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
                    $('.cls_btn_lvt').html(preload_btn);
                    $('.cls_btn_lvt').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_lvt').html(btn_default);
                    $('.cls_btn_lvt').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $('#table_lista_leva_traz_active').DataTable().ajax.reload(null, false);
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


        /**
         * leva e traz status
         */

        $(document).on('click', '.status_leva_traz', function() {
            let id = $(this).attr('id');

            Swal.fire({
                title: 'Cancelar solicitação?',
                text: "Ao confirmar será cancelado o pedido de atendimento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Confirmar!',
                cancelButtonText: 'Não!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= site_url('user/cancelar-leva-e-traz'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            $('#table_lista_leva_traz_active').DataTable().ajax.reload(null, false);
                            $('#table_lista_leva_traz_cancel').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
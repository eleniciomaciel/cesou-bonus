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

                    <div class="card-body px-0 pb-2">

                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; Cadastrar</a>
                        <br><br>
                        <div class="table-responsive">

                            <table class="table align-items-center mb-0" id="table_bradesco" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">data</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">hora</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">opção</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                  
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="table_bradesco_satus" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">data</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">hora</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
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
<?= $this->include('Usuarios/partial/popap/popap-bradesco') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {

        $('#table_bradesco').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('user/lista-bradesco') ?>",
            columns: [{
                    data: 'brad_date'
                },
                {
                    data: 'brad_time'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ],
            columnDefs: [{
                targets: 0,
                orderable: false
            }, ]
        });


        $('#table_bradesco_satus').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('user/lista_cancelados_atendidos') ?>",
            columns: [{
                    data: 'brad_date'
                },
                {
                    data: 'brad_time'
                },
                {
                    data: 'status'
                }
            ],
            columnDefs: [{
                targets: 0,
                orderable: false
            }, ]
        });

        let preload_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Agendando, aguarde...';
        let btn_default = 'Salvar';

        $('#formAddAgenda').submit(function(e) {
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
                            $('#table_bradesco').DataTable().ajax.reload(null, false);
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
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        /**
         * lista cancelamento
         */
        $(document).on('click', '.cancela_agenda', function() {
            var id_cancela = $(this).attr("id");

            Swal.fire({
                title: 'Cancelar atendimento?',
                text: "Deseja confirmar o cancelamento do atendimento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Cancelar!',
                cancelButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                        url: "<?php echo site_url(); ?>user/cancelar-atendimento",
                        method: "GET",
                        data: {
                            id_cancela: id_cancela
                        },
                        success: function(data) {
                            Swal.fire(
                                'Ok!',
                                data,
                                'success'
                            )
                            $('#table_bradesco').DataTable().ajax.reload(null, false);
                            $('#table_bradesco_satus').DataTable().ajax.reload(null, false);
                        }
                    });

                }
            });
        });
    });
</script>

<?= $this->endSection() ?>
<?= $this->extend('usuarioBradesco/Layout/Base_layout-bradesco') ?>
<?= $this->section('content') ?>

<div class="row my-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Agendados para hoje</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">30 agendamentos</span> para hoje
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="table_lista_atendimento_bradesco">
                        <thead>
                            <tr>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CLIENTES</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA/HORA</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
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
<?= $this->endSection() ?>
<?= $this->section('scripts_bradesco'); ?>

<script>
    $(document).ready(function() {


        $('#table_lista_atendimento_bradesco').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "<?= site_url('bradesco_panel/getBradescoAtendimento') ?>",
            columns: [{
                    data: 'reg_nome'
                },
                {
                    data: 'brad_time'
                },
                {
                    data: 'novo_status'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });


        var refresh = setInterval('$("#table_lista_atendimento_bradesco").dataTable().fnDraw()', 8000);

        /**
         *  confirmar como atendido
         */
        $(document).on('click', '.clsConfirma', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Concluir atendimento?',
                text: "Confirmar como concluído o atendimento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim confirmar',
                cancelButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('bradesco_panel/atendimentoConfirma'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#table_lista_atendimento_bradesco').DataTable().ajax.reload();
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                        }
                    });
                }
            });
        });

        /**
         *  confirmar como atendido
         */
        $(document).on('click', '.clsCancela', function() {
            var id = $(this).data('id');


            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Cancelar atendimento?',
                text: "Confirmar como cancelado o atendimento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, cancelar!',
                cancelButtonText: 'Não',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('bradesco_panel/atendimentoCancelar'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            $('#table_lista_atendimento_bradesco').DataTable().ajax.reload();
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Desistiu',
                        'Você desistiu de cancelar',
                        'error'
                    )
                }
            });
        });

        /**
         * atendimento de hoje
         */
        $.ajax({
                url: "<?php echo site_url('bradesco_panel/atendimentoHoje'); ?>",
                cache: false
            })
            .done(function(html) {
                $("#results").append(html);
            });

        $.ajax({
                url: "<?php echo site_url('bradesco_panel/atendimentoHojeAtendidos'); ?>",
                cache: false
            })
            .done(function(html) {
                $("#results_atendidos").append(html);
            });

        $.ajax({
                url: "<?php echo site_url('bradesco_panel/atendimentoHojeAguardando'); ?>",
                cache: false
            })
            .done(function(html) {
                $("#results_aguardando").append(html);
            });

        $.ajax({
                url: "<?php echo site_url('bradesco_panel/atendimentoGeral'); ?>",
                cache: false
            })
            .done(function(html) {
                $("#results_geral").append(html);
            });

        /**
         * chamada de voz
         */
        $(document).on('click', '.voiceAtendimento', function() {
            var id = $(this).data('id');
            let cliente = $(this).data('username');

            Swal.fire({
                title: 'Chamar cliente?',
                text: "Deseja chamar " + cliente + " para o atendimento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Chamar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'OK!',
                        'Chamando ' + cliente + ' para o atendimento.',
                        'success'
                    );

                    if ('speechSynthesis' in window) {
                        var msg = new SpeechSynthesisUtterance();
                        msg.text = "Por favor, "+ cliente +", comparecer ao auto atendimento Bradesco.";
                        window.speechSynthesis.speak(msg);
                    } else {
                        alert("Desculpe, seu navegador não suporta conversão de texto em fala!");
                    }
                }
            })
        });



    });
</script>

<?= $this->endSection() ?>
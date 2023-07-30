<?= $this->extend('Usuarios/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 d-flex align-items-center">
        <h6 class="mb-0">Resgate</h6>
    </div>
    <div class="col-6 text-end">
        <button type="button" class="btn bg-gradient-dark mb-0" id="updateButton">
            <i class="fas fa-sync" aria-hidden="true"></i>&nbsp;&nbsp;Atualizar
        </button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="row  d-flex justify-content-center">
            <div class="col-xl-6 mb-xl-0 mb-4">
                <div class="card bg-transparent shadow-xl">
                    <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('<?= base_url() ?>/templates/template-admin/img/curved-images/curved14.jpg');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 p-3">
                            <i class="fas fa-wifi text-white p-2" aria-hidden="true"></i>
                            <h5 class="text-white mt-4 mb-5 pb-2"><?= session()->get('reg_cpf') ?></h5>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <div class="me-4">
                                        <p class="text-white text-sm opacity-8 mb-0">Card Cestou.top</p>
                                        <h6 class="text-white mb-0"><?= substr(session()->get('reg_nome'), 0, 13) ?></h6>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm opacity-8 mb-0">Expira</p>
                                        <h6 class="text-white mb-0">01/30</h6>
                                    </div>
                                </div>
                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                    <img class="w-60 mt-2" src="<?= base_url() ?>/assets/images/logo-principal-96x52.png" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="text-xs text-center">COMPENSA PONTOS</h5>
                            <div class="card-header mx-4 p-3 text-center d-flex justify-content-center">
                                <div id="qrcode-2"></div>
                            </div>
                            <div class="card-body pt-0 p-3 text-center">
                                <hr class="horizontal dark my-3">
                                <h6 class="text-center mb-0">PONTOS ACUMULADO</h6>
                                <h5 class="mb-0" id="demo_pontos">0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-lg-0 mb-4">
                <div class="card mt-4">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0 text-center">COMPENSADOS</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-3 pb-0">
                <ul class="list-group" id="notifications_list">

                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/pt-br.min.js" integrity="sha512-1IpxmBdyZx3okPiZ14mzw6+pOGa690uDmcdjqvT310Kwv3NRcjvL/aOtoSprEyvkDdAb7ZtM2um6KrLqLOY97w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    new QRCode(document.getElementById("qrcode"), "https://webisora.com");
</script>

<script>
    function total_pontos() {
        $.ajax({
            url: '<?= site_url('/user/pontos_cliente_view') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {

                    $.each(response, function(key, value) {
                        var user_id = document.getElementById("demo_pontos").innerHTML = value.point_pontos;
                    });
                } else if (response.status === 'Insucesso') {
                    document.getElementById("demo_pontos").innerHTML = value.point_pontos;
                }
            },
            error: function() {
                alert('Falha na consulta!');
            }
        });
    }

    var id = <?= session()->get('id') ?>;
    $.ajax({
        url: "<?= site_url('user/compensa_pontos_cliente/') ?>" + id,
        method: "GET",
        dataType: 'JSON',
        success: function(data) {
            let cli_id = data['point_id'];

            var qrcode = new QRCode(document.getElementById("qrcode-2"), {
                text: cli_id,
                width: 210,
                height: 210,
                colorDark: "#5868bf",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });

    function updateContent() {
        $.ajax({
            url: '/user/listaPontosCompensados',
            type: 'GET',
            dataType: 'json',
            success: function(response) {

                $('#notifications_list').empty();

                response.forEach(function(item) {
                    var dia_desconto = item.created_at;
                    $('#notifications_list').append(

                        '<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">' +
                        '<div class="d-flex flex-column">' +
                        '<h6 class="mb-1 text-dark font-weight-bold text-sm">' + moment(dia_desconto).format('LLL') + '</h6>' +
                        '</div>' +
                        '<div class="d-flex align-items-center text-sm">' + item.pontos + '</div>' +
                        '</li>'

                    );
                });
            },
            error: function() {
                alert('Erro na consulta!');
            }
        });
    }

    updateContent();
    total_pontos();
    $('#updateButton').on('click', function() {
        updateContent();
        total_pontos();
    });
</script>
<?= $this->endSection() ?>
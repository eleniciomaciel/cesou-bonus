<?= $this->extend('Gestor/partial/Layout/Base_layout') ?>
<?= $this->section('content') ?>

<div class="col-12">

    <div class="d-flex m-3">
        <div class="ms-auto d-flex">
            <div class="pe-4 mt-1 position-relative">
  
                <hr class="vertical dark mt-0">
            </div>
            <div class="ps-4">
                <button type="button" class="cls_ler_qrcode btn bg-gradient-warning">Ler cupom</button>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Clientes Beneficados</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="table_clientes_loja">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CLIENTE</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">VENDA</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESCONTO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATA</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Gestor/partial/popap/popap-ler-qrcode') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/html5-qrcode.min.js"></script>
<?= $this->include('Gestor/partial/scripts/leitor_qrcode_js') ?>
<?= $this->include('Gestor/partial/scripts/lista-clientes_js') ?>
<?= $this->include('Gestor/partial/scripts/perfil-script') ?>
<script>

</script>
<?= $this->endSection() ?>
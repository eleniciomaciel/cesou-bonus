<?= $this->extend('usuarioBradesco/Layout/Base_layout-bradesco') ?>
<?= $this->section('content') ?>

<div class="row my-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Atendimentos realizados</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Total 150</span> atendidos
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CLIENTES</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA/HORA</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list_atendidos) && is_array($list_atendidos)) : ?>

                                <?php foreach ($list_atendidos as $list_atendidos_item) : ?>

                                    <tr>
                                        <td>
                                            <?= esc($list_atendidos_item['reg_nome']) ?>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= esc($list_atendidos_item['brad_time']) ?></p>
                                        </td>
                                        <td class="text-sm">
                                            <span class="badge badge-sm bg-gradient-success"><?= esc($list_atendidos_item['status_atendimento']) ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>





                                <?php endforeach ?>

                            <?php else : ?>

                                <tr>
                                    <td colspan="5" style="text-align: center;">Sem Registro de atendimentos</td>
                                </tr>

                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
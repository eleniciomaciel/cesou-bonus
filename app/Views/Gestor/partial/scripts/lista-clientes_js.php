<script>
    $(document).ready(function() {

        $('#table_clientes_loja').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            order: [], //this mean no init order on datatable
            ajax: "<?= site_url('gestor/lista-clientes-loja') ?>",
        });

        $('#table_lista_clientes_ativos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('gestor/lista-clientes-ativos') ?>',
            columns: [{
                    data: 'reg_nome'
                },
                {
                    data: 'reg_telefone'
                },
                {
                    data: 'cup_data_vencimento_cupom'
                },
                {
                    data: 'status_vencimento',
                    orderable: false
                },
            ]
        });

        $('#table_lista_clientes_ativos_menor_que_vinte_maior_que_dez').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('gestor/cupons_ativos_menor_que_vinte_maior_que_dez') ?>',
            columns: [{
                    data: 'reg_nome'
                },
                {
                    data: 'reg_telefone'
                },
                {
                    data: 'cup_data_vencimento_cupom'
                },
                {
                    data: 'status_vencimento',
                    orderable: false
                },
            ]
        });

        $('#table_lista_clientes_ativos_menor_que_trinta_maior_que_vinte').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('gestor/cupons_ativos_menor_que_trinta_maior_que_vinte') ?>',
            columns: [{
                    data: 'reg_nome'
                },
                {
                    data: 'reg_telefone'
                },
                {
                    data: 'cup_data_vencimento_cupom'
                },
                {
                    data: 'status_vencimento',
                    orderable: false
                },
            ]
        });

        $.ajax({
            url: "<?= site_url('gestor/cupons_ativos_total') ?>",
            method: "GET",
            success: function(data) {
                $('#results_total_ativos').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/cupons_ativos_logista') ?>",
            method: "GET",
            success: function(data) {
                $('#results_total').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/total_ativos_menor_que_vinte_maior_que_dez') ?>",
            method: "GET",
            success: function(data) {
                $('#results_total_menor_que_vinte').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/total_ativos_menor_que_trinta_maior_que_vinte') ?>",
            method: "GET",
            success: function(data) {
                $('#results_total_menor_que_trinta').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/trocas_loja') ?>",
            method: "GET",
            beforeSend:function () {
                $('.cls_results_trocas_loja').html('...');
            },
            success: function(data) {
                $('#results_trocas').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/trocas_loja_total_clientes') ?>",
            method: "GET",
            beforeSend:function () {
                $('.cls_results_total_loja').html('...');
            },
            success: function(data) {
                $('#results_total_clientes_loja').html(data);
            }
        });

        $.ajax({
            url: "<?= site_url('gestor/trocas_loja_total_vendas') ?>",
            method: "GET",
            beforeSend:function () {
                $('.cls_results_total_vendas_loja').html('...');
            },
            success: function(data) {
                $('#results_total_vendas_loja').html(data);
            }
        });
        
        $.ajax({
            url: "<?php echo site_url('gestor/lista_potenciais_clientes'); ?>",
            cache: false
        })
        .done(function(html) {
            $("#results_lista_potenciais_clientes").html(html);
        });

    });
</script>
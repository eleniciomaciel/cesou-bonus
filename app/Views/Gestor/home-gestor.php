<?= $this->extend('Gestor/partial/Layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2">

            <div class="card-body p-3">
                <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>
            </div>

        </div>
    </div>

</div>



<div class="row my-4">
    <div class="col-lg-12 col-md-6 mb-md-0 mb-4">

        <div class="card">

            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Clientes/Cupons Ativos</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1" id=""><span id="results_total_ativos">0</span> Cupons</span> em vencimento
                        </p>
                    </div>
                </div>
            </div>
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-vertical" role="tab" aria-controls="preview" aria-selected="true">
                        <i class="ni ni-check-bold text-sm me-2"></i> Vencendo em 10 dias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-vertical" role="tab" aria-controls="code" aria-selected="false">
                        <i class="ni ni-check-bold text-sm me-2"></i> Vencendo em 20 dias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#payments-tabs-vertical" role="tab" aria-controls="code" aria-selected="false">
                        <i class="ni ni-check-bold text-sm me-2"></i> Vencendo em 30 dias
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="profile-tabs-vertical" role="tabpanel" aria-labelledby="profile-tabs-vertical-tab">
                    <?= $this->include('Gestor/partial/include/tab_vencendo_1') ?>
                </div>
                <div class="tab-pane fade" id="dashboard-tabs-vertical" role="tabpanel" aria-labelledby="dashboard-tabs-vertical-tab">
                    <?= $this->include('Gestor/partial/include/tab_vencendo_2') ?>
                </div>
                <div class="tab-pane fade" id="payments-tabs-vertical" role="tabpanel" aria-labelledby="payments-tabs-vertical-tab">
                    <?= $this->include('Gestor/partial/include/tab_vencendo_3') ?>
                </div>
            </div>



        </div>
    </div>
</div>

<?= $this->include('Gestor/partial/popap/popap-ler-qrcode') ?>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<?= $this->include('Gestor/partial/scripts/lista-clientes_js') ?>
<script src="<?= base_url() ?>/templates/template-admin/js/plugins/html5-qrcode.min.js"></script>
<script>
    $(document).ready(function() {

        $('#valor_venda').mask("#.##0,00", {
            reverse: true
        });
        $('#valor_compesado').mask("#.##0,00", {
            reverse: true
        });

        // $(".cls_ler_qrcode").click(function() {
        //     $('#modal-notification').modal('show');

        //     function docReady(fn) {
        //         // see if DOM is already available
        //         if (document.readyState === "complete" ||
        //             document.readyState === "interactive") {
        //             // call on next available tick
        //             setTimeout(fn, 1);
        //         } else {
        //             document.addEventListener("DOMContentLoaded", fn);
        //         }
        //     }

        //     docReady(function() {
        //         var resultContainer = document.getElementById('qr-reader-results');
        //         var lastResult, countResults = 0;
                
        //         function onScanSuccess(decodedText, decodedResult) {
        //             if (decodedText !== lastResult) {
        //                 $('#modal-notification').modal('hide');
        //                 ++countResults;
        //                 lastResult = decodedText;
        //                 // Handle on success condition with the decoded message.
        //                 console.log(`Scan result ${decodedText}`, decodedResult);

        //                 let leitura = decodedText;
                        
        //                 if (leitura) {
        //                     let key_sefax = decodedText.slice(40, 83);
        //                     let usuario_id = decodedText.slice(84, 85);
        //                     let id_cupon = decodedText.slice(86, 88);


        //                     $.ajax({
        //                         url: "<?php echo site_url('gestor/ler-qrcode/'); ?>" + id_cupon,
        //                         method: "GET",
        //                         data: {
        //                             key_sefax: key_sefax,
        //                             usuario_id: usuario_id,
        //                             id_cupon: id_cupon,
        //                         },
        //                         dataType: 'JSON',
        //                         success: function(data) {
        //                             $('#userusuario').val(data.reg_nome);
        //                             $('#usercpf').val(data.reg_cpf);
        //                             $('#userpontos').val(data.cup_pontos);
        //                             $('#usercup_status').val(data.cup_status);
        //                             $('#modal-default_dados_Clientes').modal('show');
        //                             html5QrcodeScanner.clear();
        //                             $('#hidden_id_cupon').val(id_cupon);
        //                         }
        //                     });

        //                 }
        //             }
        //         }

        //         var html5QrcodeScanner = new Html5QrcodeScanner(
        //             "qr-reader", {
        //                 fps: 10,
        //                 qrbox: 250
        //             });
        //         html5QrcodeScanner.render(onScanSuccess);

        //     });
        // });

        

    });
</script>
<script>
			google.charts.load('current', {'packages':['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawLineChart);
			google.charts.setOnLoadCallback(drawBarChart);
            // Line Chart
			function drawLineChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', ' Troque pontos por descontos'],
						<?php 
							foreach ($products as $row){
							   echo "['".$row['day']."',".$row['sell']."],";
						} ?>
				]);
				var options = {
					title: 'Vendas por período mês',
					curveType: 'function',
					legend: {
						position: 'top'
					}
				};
				var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
				chart.draw(data, options);
			}
			
			
			// Bar Chart
			google.charts.setOnLoadCallback(showBarChart);
			function drawBarChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Products Count'], 
						<?php 
							foreach ($products as $row){
							   echo "['".$row['day']."',".$row['sell']."],";
							}
						?>
				]);
				var options = {
					title: ' Bar chart products sell wise',
					is3D: true,
				};
				var chart = new google.visualization.BarChart(document.getElementById('GoogleBarChart'));
				chart.draw(data, options);
			}
			
		</script>
<?= $this->endSection() ?>
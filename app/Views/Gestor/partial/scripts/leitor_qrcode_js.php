<script>
    $(document).ready(function() {
        
                $('#valor_venda').mask("#.##0,00", {
            reverse: true
        });

        $('#valor_compesado').mask("#.##0.00", {
            reverse: true
        });

        /**CALCULA DESCONTO */
        $("#valor_desconto").change(function() {
            if (parseFloat($(this).val()) <= 100) {
                var porcentagem = (parseFloat($("#valor_venda").val()) * parseFloat($(this).val())) / 100;
                $("#valor_compesado").val(porcentagem);
            }
        });
        
        $(".cls_ler_qrcode").click(function() {
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

            docReady(function() {
                var resultContainer = document.getElementById('qr-reader-results');
                var lastResult, countResults = 0;

                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        $('#modal-notification').modal('hide');
                        $('#modal-default_dados_Clientes').modal('show');
                        ++countResults;
                        lastResult = decodedText;
                        // Handle on success condition with the decoded message.
                        console.log(`Scan result ${decodedText}`, decodedResult);

                        let leitura = decodedText;

                        if (leitura) {
                            let key_sefax = decodedText.slice(40, 83);
                            let usuario_id = decodedText.slice(84, 85);
                            let id_cupon = decodedText.slice(87, 89);

                           

                            $.ajax({
                                url: "<?php echo site_url('gestor/ler-qrcode/'); ?>" + id_cupon,
                                method: "GET",
                                data: {
                                    key_sefax: key_sefax,
                                    usuario_id: usuario_id,
                                    id_cupon: id_cupon,
                                },
                                dataType: 'JSON',

                                success: function(data) {
                                    $('#usuario_id').val(data.id);
                                    $('#userusuario').val(data.reg_nome);
                                    $('#usercpf').val(data.reg_cpf.substr(0, 6) + '.......');
                                    $('#userpontos').val(data.cup_pontos);
                                    $('#usercup_status').val(data.cup_status);
                                    $('#modal-default_dados_Clientes').modal('show');
                                    html5QrcodeScanner.clear();
                                    $('#hidden_id_cupon').val(id_cupon);
                                    $('#hidden_id_sefaz').val(key_sefax);
                                },
                                error: function(data) {
                                    console.log(data.status + ':' + data.statusText, data.responseText);
                                }
                            });

                        } else {
                            alert('Error em obter os dados.');
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


        //adiciona troca de de cupom qrcode
        let preload_btn_cls = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvabdo, aguarde...';
        let btn_default_cls = '<i class="ni ni-check-bold"></i> Trocar';

        $('#forRegistraCupom').on('submit', function(event) {
            event.preventDefault();
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
                    $('.cls_btn_lvt_troca_cupon').html(preload_btn_cls);
                    $('.cls_btn_lvt_troca_cupon').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_lvt_cupon_troca').html(btn_default_cls);
                    $('.cls_btn_lvt_troca_cupon').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            //$('#table_list_cupons').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                            $('#modal-default_dados_Clientes').modal('hide');
                            $('#modal-notification').modal('hide');
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
                            'Têm erro aí, verifique.',
                            'error'
                        );

                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            })
        });
    });
</script>
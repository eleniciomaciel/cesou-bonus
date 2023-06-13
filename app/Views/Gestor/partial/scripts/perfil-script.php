<script>
    $(document).ready(function() {

        let preload_btn_g_perfil = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&ensp;Atualizando...';
        let btn_default_g_perfil = 'Atualizar';

        $('#perfilGestorAcesso').submit(function(e) {
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
                    $('.class_load_envia_g_perfil').html(preload_btn_g_perfil);
                    $('.class_load_envia_g_perfil').attr('disabled', 'disabled');
                },
                complete: function() {
                    $('#id_btn_load_g_perfil').html(btn_default_g_perfil);
                    $('.class_load_envia_g_perfil').attr('disabled', false);
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            Swal.fire(
                                'Ok!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Ops!',
                                'Algo deu errado, corrija por favor.',
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
    });
</script>
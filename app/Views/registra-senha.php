<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= site_url()?>public/templates/template-admin/img/apple-icon.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url()?>public/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url()?>public/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url()?>public/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?= site_url()?>public/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?= site_url()?>public/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
  <title>
    Cestou - Cadastre-se
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= site_url()?>public/templates/template-admin/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= site_url()?>public/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="<?= site_url()?>public/templates/template-admin/js/fontawesome.js" crossorigin="anonymous"></script>
  <link href="<?= site_url()?>public/templates/template-admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= site_url()?>public/templates/template-admin/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="#">
        Cestou.Top
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="https://cestou.top/">
              <i class="fa fa-chart-pie opacity-6  me-1"></i>
              Página inicial
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="/fazer-login">
              <i class="fas fa-user-circle opacity-6  me-1"></i>
              Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('<?= site_url()?>public/templates/template-admin/img/curved-images/curved14.png');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Bem-vind(a)o!</h1>
              <p class="text-lead text-white">Registre seu acesso informando os dados nos campos a baixo.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Registrar acesso</h5>
              </div>

              <div class="card-body">
                <form action="/criar-conta" method="POST" role="form text-left" id="criar_conta_operador">

                  <?= csrf_field() ?>

                  <div class="mb-3">
                    <label for="">SEU CPF:</label>
                    <input type="text" class="form-control" name="reg_cpf" id="reg_cpf" placeholder="Ex.: 999.999.999-99" required>
                    <span class="text-danger error-text reg_cpf_error"></span>
                  </div>

                  <div class="mb-3">
                    <label for="">SEU EMIAL PESSOAL:</label>
                    <input type="email" style="text-transform: lowercase" class="form-control" name="reg_email" id="reg_email" placeholder="Ex.: ana@email.com" aria-label="Email" required>
                    <span class="text-danger error-text reg_email_error"></span>
                  </div>


                  <div class="mb-3">
                    <label for="">NOVA SENHA:</label>
                    <input type="password" class="form-control" name="reg_senha" id="reg_senha" placeholder="Ex.: 123" aria-label="Password" aria-describedby="password-addon" required>
                    <span class="text-danger error-text reg_senha_error"></span>
                  </div>

                  <div class="mb-3">
                    <label for="">CONFIRMAÇÃO DA SENHA:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Ex.: 123" required>
                    <span class="text-danger error-text reg_nome_error"></span>
                  </div>


                  <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" name="reg_flexCheckDefault" id="reg_flexCheckDefault" value="1">
                    <label class="form-check-label" for="flexCheckDefault">
                      Eu concordo os <a href="javascript:;" class="text-dark font-weight-bolder" data-bs-toggle="modal" data-bs-target="#exampleModal">Termos e Condições</a>
                    </label>
                    <span class="text-danger error-text reg_flexCheckDefault_error"></span>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="class_load_envia btn bg-gradient-dark w-100 my-4 mb-2" id="id_btn_load">Criar conta</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Já tem uma conta? <a href="/fazer-login" class="text-dark font-weight-bolder">Fazer login</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">

          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">

            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-instagram"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-pinterest"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-github"></span>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Cestou.Top todos os direitos reservdos.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  </main>





  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Termos e condições</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <p>Bem-vindo ao website CESTOU.TOP, onde todos os serviços são ofertados pela empresa cestou.top, cujo nome/ função social é “…”, inscrito sob o CNPJ nº …, com endereço na Rua…, CEP nº…, Cidade…, estado…, representado por meio dessa página na web.</p><br>
          <p>Bem-vindo ao website “…”, onde todos os serviços são ofertados por meio da pessoa física”…”, inscrito sob o CPF nº…, e RG nº…, endereço eletrônico…, com endereço para receber notificações na Rua…, CEP nº…, Cidade…, Estado…, representado nessa página eletrônica.</p><br>
          <p>Avisamos previamente que ao acessar esse site você concorda tacitamente com as disposições contidas nesse documento, por isso muito atenção ao ler cada uma das cláusulas e obrigações dispostas a seguir:</p><br>
          <p>1.Do Objeto</p><br>
          <p>Essa plataforma tem como finalidade de “e-commerce”, ou seja, disponibilizar a venda de produtos e serviços online disponibilizados na nossa plataforma ou aplicativo. Este documento foi criado pelo advogado Diego Castro e modificado com permissão para este website.</p><br>
          <p>2. Da reserva de produtos</p><br>
          <p>2.1 O nosso website não trabalha com nenhuma possibilidade de reservar qualquer um dos produtos ofertados em nossa plataforma.</p><br>

          <p>2.2 O fato de o produto estar no carrinho de compras não é tido como uma reserva e não impossibilita que outras pessoas possam adquirir o produto e eles venham a se esgotar.</p>
          <p>3. Das obrigações do cliente</p>
          <p>3.1 O cliente deverá informar os dados de forma completa e correta no momento de cadastro em nossa plataforma.</p>
          <p>3.2 É responsabilidade do cliente qualquer erro na escrita ou na transmissão errônea dos dados.</p>
          <p>3.3 Para efetuar qualquer compra em nosso website ou adicionar produtos ao carrinho é necessário logar com o usuário e senha que foi fornecido no momento do cadastro.</p>
          <p>3.4 Não informar os seus dados de login a terceiros sob pena de ser responsabilizado por qualquer conduta advinda desse uso.</p>
          <p>3.5 Cada cliente só poderá efetuar um cadastro, não sendo aceito mais de uma conta por CPF.</p>
          <p>3.6 Usar a plataforma respeitando a ética, bons costumes, legislações e ordenamentos vigentes no país, sob pena de sofrer sanções.</p>
          <p>3.7 Ser maior de idade (18 anos) e ter capacidade plena para realizar o cadastro e efetuar compras em nossa plataforma.</p>
          <p>3.7.1 Se um menor de idade ou pessoa física sem capacidade plena vir a adquirir algum produto ou serviço ofertado em nossa plataforma, entenderemos que os responsáveis autorizaram, respondendo esses por toda e qualquer situação que advir, bem como pela compra.</p>
          <p>3.8 Não comentar ou enviar imagens nas avaliações que possam ir de encontro com a ética e o respeito, ou que tenha cunho difamatório, ofensivo, de ódio ou preconceituoso.</p>
          <p>3.9 O primeiro login de acesso será feito através de um link enviado para o seu e-mail cadastrado.</p>
          <p>3.10 Não fornecer qualquer informação falsa, fraudulenta ou que não seja correspondente aos seus dados.</p>
          <p>4. Das obrigações do proprietário do e-commerce</p>
          <p>4.1 Informar de forma ostensiva e verdadeira sobre as características e especificações do produto disponível para venda de forma clara e completa. ( Ex: Cores, altura, material ou largura).</p>
          <p>4.2 Enviar os produtos dentro do prazo estabelecido.</p>
          <p>4.3 Disponibilizar uma plataforma segura.</p>
          <p>4.4 Disponibilizar imagens, áudios e vídeos informativos sobre os produtos ofertados, e condizentes com o que será entregue ao cliente.</p>
          <p>4.5 Emitir a nota fiscal do produto que será enviado e enviá-la ao cliente junto do produto.</p>
          <p>4.6 Informar como deve ocorrer o manuseio, a limpeza ou lavagem do produto e qualquer informação considerada relevante relacionada ao produto.</p>
          <p>5. Isenção de responsabilidade</p>
          <p>5.1 Não nos responsabilizamos pelo mau uso ou manuseio errado do produto, bem como de qualquer dano que possa ocorrer na instalação de qualquer produto adquirido em nossa plataforma.</p>
          <p>5.2 Todos os produtos que vendemos estão dentro dos padrões e condições que vem de fábrica, do distribuidor ou da empresa que revendeu o produto.</p>
          <p>5.3 Fornecemos todas as informações pertinentes relacionadas ao produto, bem como os mesmos vão acompanhados de instruções de uso e cuidados em suas caixas ou através de manual de instruções.</p>
          <p>6. Da Propriedade intelectual</p>
          <p>6.1 Todo o design e paginação são de propriedade do nosso website, e foram desenvolvidos por um prestador de serviços que foi contratado para tal finalidade.</p>
          <p>6.2 Toda imagem, ilustração, obras de arte, HTML, nomes comerciais, softwares ou vídeo disponibilizados em nossa plataforma por um dos gerenciadores da página são de nossa propriedade.</p>
          <p>6.2.1 As imagens e vídeos são meramente ilustrativas, pois dependendo do monitor ou da tela do aparelho eletrônico o mesmo pode apresentar variação de cores ou tons.</p>
          <p>6.3 A logo, a marca e toda a aparência da webempresa/empresa são de nossa propriedade.</p>
          <p>6.4 É vedada a cópia sem autorização de qualquer imagem, vídeo, design, áudios, aparência ou descrições de produtos existentes em nossa web página, sob pena se responder por sanções quem desobedecer.</p>
          <p>6.5 Não nos responsabilizamos por links externos que possam vir a aparecer em nossa página.</p>
          <p>6.5.1 Há algumas áreas que poderão apresentar propagandas ou divulgação de links, mas não temos qualquer tipo de relação, por isso muito cuidado ao navegar por essas páginas e ao fornecer os seus dados, pois navegar por essas páginas é responsabilidade do usuário/cliente.</p>
          <p>6.6 Nada contido em nossa web página garante o direito a concessão de licença ou direito de uso sem o consentimento expresso de um dos gerenciadores da página ou do proprietário da página.</p>
          <p>6.7 O consentimento de cópia ou compartilhamento deve vir por escrito de forma clara e expressa.</p>
          <p>6.8 É vedado compartilhar, copiar, plagiar ou disponibilizar qualquer conteúdo, foto, vídeo ou áudio encontrado em nosso site sem consentimento expresso.</p>
          <p>7. Formas de pagamento</p>
          <p>7.1 As formas de pagamento aceitas em nosso e-commerce são cartão de crédito e débito, ou boleto bancário.</p>
          <p>7.2 O boleto bancário poderá ser emitido no momento em que você escolheu a opção, preencheu os dados requisitados e gerou.</p>
          <p>7.2.1 O boleto tem vencimento na data exposta no mesmo, não sendo aceito após a data de vencimento.</p>
          <p>7.2.2 Se o boleto vencer e o pagamento não tiver sido efetuado, o produto voltará a ficar disponível para venda e será necessário realizar uma nova compra para adquiri-lo.</p>
          <p>7.3 O produto será enviado assim que o pagamento for processado, registrado e confirmado em nossa plataforma.</p>
          <p>7.4 Qualquer outra forma de pagamento não é aceita por nosso e-commerce.</p>
          <p>7.5 Cupons de descontos são aceitos, desde que tenhamos disponibilizados, estando sujeitos a esgotarem ou terem vigência cancelada a qualquer momento.</p>
          <p>7.5 Se o cliente quiser parcelar o produto em mais vezes deverá arcar com os juros da operadora.</p>
          <p>7.6 Para solicitar o estorno entre em contato com a nossa Central de Atendimento ou SAC.</p>
          <p>8. Entrega e envio do produto</p>
          <p>8.1 O produto será enviado assim que o pagamento for confirmado, podendo ser enviado até 3 dias após a confirmação do pagamento.</p>
          <p>8.2 Os custos de envio e entrega estarão dispostos no momento em que você estiver quase finalizando a compra, na aba de frete/entrega/envio, onde você informará o seu endereço e CEP.</p>
          <p>8.3 O cliente pagará pela entrega e o envio do produto com faixas pré-definidas, ou de acordo com o peso padrão da categoria.</p>
          <p>9. Troca e devolução</p>
          <p>9.1 O cliente poderá devolver o produto ou trocar que foi adquirido em nosso e-commerce em até 7 dias, seja qual for a razão, conforme a previsão expressa no Código de Defesa do Consumidor em seu art. 49.</p>
          <p>9.1.1 Para que ocorra a troca ou a devolução é necessário que o produto esteja conforme foi entregue, com todos os acessórios, manual e embalagem, caixa.</p>
          <p>9.1.2 O produto que será devolvido ou trocado não poderá apresentar qualquer marca de uso, como o produto estar trincado, riscado ou apresentar sinais de quedas.</p>
          <p>9.2 Se você requisitou a troca do produto o novo será enviado para o endereço e você será notificado sobre o envio via e-mail.</p>
          <p>9.3 Se você solicitou o reembolso, a devolução do valor ocorrerá da forma como foi efetuado o pagamento.</p>
          <p>9.3.1 Se foi via cartão de crédito ou débito o valor será creditado ou debitado na fatura atual ou na seguinte do cartão, pois informaremos a administradora do cartão.</p>
          <p>9.3.2 Se o pagamento foi feito via boleto bancário, o valor de reembolso será restituído dentro de 30 dias úteis diretamente na conta que solicitaremos no momento de sua requisição de devolução.</p>
          <p>10. Política de Privacidade e Proteção de Dados</p>
          <p>10.1 Você pode conferir a nossa política de privacidade no link de rodapé, onde informamos como ocorre a coleta e o tratamentos dos dados cadastrados em nosso site, bem como da navegação.</p>
          <p>11. Do Foro</p>
          <p>11. Fica eleito o foro da Cidade da nossa empresa, para dirimir quaisquer controvérsias, dúvidas, desentendimentos, litígios ou questões advindas da relação cliente e e-commerce, mesmo que possa existir algum local, por mais privilegiado que possa ser.</p>
          <p>12. Do documento</p>
          <p>12.1 Este documento foi feito pelo Advogado Diego Castro (OAB/PI 15.613) e foi modificado com permissão para uso neste site.</p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!--   Core JS Files   -->
  <script src="<?= site_url()?>public/templates/template-admin/js/jquery.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/core/popper.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/core/bootstrap.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/jquery.mask.min.js"></script>
  <script src="<?= site_url()?>public/templates/template-admin/js/sweetalert2.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= site_url()?>public/templates/template-admin/js/soft-ui-dashboard.min.js?v=1.0.6"></script>

  <script>
    $(document).ready(function() {

      let preload_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Salvabdo, aguarde...';
      let btn_default = 'Salvar';

      $('#reg_telefone').mask("(00)9 0000-0000", {
        placeholder: "(00)9 0000-0000"
      });
      $('#reg_cpf').mask("000.000.000-00", {
        placeholder: "000.000.000-00"
      });
      $('#reg_cep').mask("00.000-000", {
        placeholder: "00.000-000"
      });



      var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
      var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

      $('#criar_conta_operador').submit(function(e) {

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
                //$(form)[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                });
              } else {
                alert(data.msg);
                
              }
            } else {

              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Existem informações incorreta no cadastro, revise por gentileza.',
                showConfirmButton: false,
                timer: 2500
              })

              $.each(data.error, function(prefix, val) {
                $(form).find('span.' + prefix + '_error').text(val);
              });
            }
          }
        });

      });
    });
  </script>

</body>

</html>
<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get("fazer-cadastro", function () {
    return view("fazer-inscricao"); 
});

$routes->get("fazer-login", function () {
    return view("login"); 
});

$routes->get("refatora_login", function () {
    return view("registra-senha"); 
});

$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);

$routes->match(['get', 'post'], 'login/registra-acesso', 'UserController::acesso', ["filter" => "noauth"]);

//$routes->post('registra-acesso', 'UserController::acesso');


$routes->match(['get', 'post'], 'criar-conta', 'UserController::fazSenhaUsuario', ["filter" => "noauth"]);

// Admin routes
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "AdminController::index");
    $routes->get("clientes", "AdminController::clientes");
    $routes->post("cadastra_cliente", "AdminController::cadastrosClientes");
    $routes->get("list_clientes", "AdminController::listLojasGestor");
    $routes->get("lostaUsuario", "LojasAdmimController::getUsuarios");
    $routes->post("add_lojista", "LojasAdmimController::adicionaLojistas");
    $routes->get("lista_lojistas", "LojasAdmimController::getLojistas");

    $routes->get("lojas", "LojasAdmimController::index");
    $routes->get("lojas", "LojasAdmimController::index");



    $routes->get("usuarios-lojas", "ColaboradoresAdmimController::getUsuariosLojas");
    /**
     * cadastro usuários
     */
    $routes->get('colabordores','ColaboradoresAdmimController::cadastroUsuariosColaboradores');
    $routes->post('adicionarColaborador','ColaboradoresAdmimController::addUserColaboradores');
    $routes->get('listaColaboradores','ColaboradoresAdmimController::getListaColaboradores');
    $routes->get('getOneColaborador','ColaboradoresAdmimController::getOneColaborador');
    $routes->post('alterarColaborador','ColaboradoresAdmimController::updateUserColaboradores');

    /**
     * delete cliente loja
     */
    $routes->get('delete_loja','LojasAdmimController::deleteEmpresa');
    $routes->get('dados_loja','LojasAdmimController::getDadosLoja');
    $routes->post('up_lojista','LojasAdmimController::upLogista');

    /**
     * doação do cupon
     */
    $routes->get('cupons-doacoes', 'Cupons\CuponsDoacoesController::index');
    $routes->post('save-cupon-doacao', 'Cupons\CuponsDoacoesController::salvaCupomDoacao');
    $routes->get('lista_cupons_abertos','Cupons\CuponsDoacoesController::listaAbertos');
    $routes->get('lista_cupons_doados','Cupons\CuponsDoacoesController::listCuponsDoados');
    $routes->get('lista_unica_doacao_doacao','Cupons\CuponsDoacoesController::listUniqDoacao');
    $routes->get("lista_todos_usuarios", "Cupons\CuponsDoacoesController::listaUsuariosRecebeCupom");
    $routes->post('salva-doacao','Cupons\CuponsDoacoesController::salvarDoacao');
    $routes->get('delete_cupom','Cupons\CuponsDoacoesController::deleteCupom');

});
// Editor routes
$routes->group("gestor", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "GestorController::index");
    $routes->get("valida-qrcode/(:num)/(:num)/(:num)", "GestorController::trocaQrcode/$1/$2/$3");
    $routes->get("clientes", "GestorController::listClientes");
    $routes->get("ler-qrcode/(:num)", "GestorController::getDadosCupom/$1");
    $routes->post("registra_desconto", "GestorController::trocaQrcode");

    //lista de clientes
    $routes->get("lista-clientes-loja", "GestorController::clientesLista");
    $routes->get("lista-clientes-ativos", "GestorController::clientesAtivos");
    $routes->get("cupons_ativos_total", "GestorController::cuponsTotalAtivos");
    $routes->get("cupons_ativos_logista", "GestorController::cuponsNaoVencidos");
    $routes->get("cupons_ativos_menor_que_vinte_maior_que_dez", "GestorController::clientesAtivosMenorQueVinteMaiorQueDez");
    $routes->get("cupons_ativos_menor_que_trinta_maior_que_vinte", "GestorController::clientesAtivosMenorQueTrintaMaiorQueVinte");
    $routes->get("total_ativos_menor_que_vinte_maior_que_dez", "GestorController::cuponsMenosVinteMaior10");
    $routes->get("total_ativos_menor_que_trinta_maior_que_vinte", "GestorController::cuponsMenosTrintaMaior20");

    /**
     * totalizador de trocas 16/05/2023 08:10
     */
    $routes->get("trocas_loja","GestorController::cuponsTrocadosComALoja");
    $routes->get("trocas_loja_total_clientes","GestorController::cuponsTrocadosComALojaClientes");
    $routes->get("trocas_loja_total_vendas","GestorController::cuponsTrocadosVendasLoja");
    
    /**POTENCIAIS CLIENTES */
    $routes->get('lista_potenciais_clientes','GestorController::getListPotenciaisClientes');
    
        /**
     * dados do perfil
     */
    $routes->match(['get', 'post'], 'atualizar-perfil_gestor', 'GestorController::atualizaPerfilGestir');
});

$routes->group("user", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "UsuariosController::index");

    /**
     * Bradesco
     */
    $routes->get("bradesco-express", "UsuariosController::bradesco");
    $routes->post("bradesco-agenda", "BradescoController::index");
    $routes->get("lista-bradesco", "BradescoController::getListaBradescoAtendimento");
    $routes->get("cancelar-atendimento", "BradescoController::cancelamentoAtendimento");
    $routes->get("lista_cancelados_atendidos", "BradescoController::listaAtendidosCancelados");

    /**
     * leva e traz
     */
    $routes->post("solicita-leva-traz", "LevaTrazController::index");
    $routes->get("lista-leva-traz", "LevaTrazController::listCollunmLevaTraz");
    $routes->get('cancelar-leva-e-traz', 'LevaTrazController::cancelarLevaTraz');
    $routes->get('cancelar_lista_leva_traz', 'LevaTrazController::listCollunmLevaTrazCancelados');
    
    /**
     * Cupons
     */
    $routes->post("save-scanner-qrcode", "CupomUsuarioController::index");
    $routes->get("lista_cupons_ativos", "CupomUsuarioController::listaCupons");
    $routes->get("qrcode_build", "CupomUsuarioController::qrcodeBuild");
   

    /**
     * leva e traz
     */
    $routes->get("leva-e-traz", "UsuariosController::levaTraz");
    $routes->get("shopping-cashback", "UsuariosController::shoppingCashback");
    
    /**
     * dados do card
     */
    $routes->get("listaPontos", "CupomUsuarioController::getTotalPontos");
    $routes->get("listaTotalCupons", "CupomUsuarioController::getTotalCubonsAtivivo");
    $routes->get("listaCuponsConpensados", "CupomUsuarioController::getCubonsCompensados");
    $routes->get("listaCuponRestantes", "CupomUsuarioController::getParaTrocas");
    $routes->get("listVencidosTrocados", "CupomUsuarioController::getCuponsListVencidosTrocados");
    $routes->get("listPromocionalLojas", "CupomUsuarioController::getListaPromocao");
    $routes->get('listPromocaoMenu', 'CupomUsuarioController::getListaMenuPromocional');
    $routes->post('atualiza-perfil', 'CupomUsuarioController::atualizaPerfil');
    $routes->post('atualiza_acesso_login', 'CupomUsuarioController::atualizaPerfilLogin');

    /**
     * SENHA DO CAIXA
     */
    $routes->match(['get', 'post'], 'senha-caixa', 'SenhaCaixaController::index');

});

/**
 * área do brades co
 */
$routes->group("bradesco_panel", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "UsuarioBradescoController::index");
    $routes->get("getBradescoAtendimento", "UsuarioBradescoController::getListaAtendimentosAguardando");
    $routes->get("atendimentoConfirma", "UsuarioBradescoController::getConfirma");
    $routes->get("atendimentoCancelar", "UsuarioBradescoController::getCancela");
    $routes->get("atendimentoHoje", "UsuarioBradescoController::totalHoje");
    $routes->get("atendimentoHojeAtendidos", "UsuarioBradescoController::totalHojeAtendidos");
    $routes->get("atendimentoHojeAguardando", "UsuarioBradescoController::totalHojeAguardando");
    $routes->get("atendimentoGeral", "UsuarioBradescoController::totalGeral");
    $routes->get("atendidos", "UsuarioBradescoController::atendidosBradesco");
    //$routes->get("valida-qrcode/(:num)/(:num)/(:num)", "GestorController::trocaQrcode/$1/$2/$3");
    //$routes->get("clientes", "GestorController::listClientes");
    //$routes->get("ler-qrcode/(:num)", "GestorController::getDadosCupom/$1");
    //$routes->post("registra_desconto", "GestorController::trocaQrcode");
});

$routes->group('leva_traz_panel', static function ($routes) {
    $routes->get('/', 'Levatraz\LevraTrazController::index');
    $routes->get('status_pedido', 'Levatraz\LevraTrazController::dadoClienteLevaTraz');
    $routes->post('formAtualizaLevaTraz', 'Levatraz\LevraTrazController::atualizaClienteLevaTraz');
});


$routes->get('logout', 'UserController::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

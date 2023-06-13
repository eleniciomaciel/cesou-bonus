<div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
        <?php
        if (url_is('gestor')) {
        ?>
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Início</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Painel principal</li>
            </ol>
        <?php
        } else {
        ?>
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/gestor">Início</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Painel de desconto</li>
            </ol>
        <?php
        }

        ?>
        <h6 class="font-weight-bolder mb-0">Área do Lojista</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">

            </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">

            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Usuário</span>
                </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                </a>
            </li>

        </ul>
    </div>
</div>
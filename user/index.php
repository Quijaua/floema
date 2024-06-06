<?php
    session_start();
    ob_start();
    include('../config.php');

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['msg'] = "Por favor faça login para acessar essa página!";
        header("Location: " . INCLUDE_PATH . "login/");
        exit();
    }
    
    // Tabela que sera feita a consulta
    $tabela = "tb_clientes";

    // ID que você deseja pesquisar
    $id = $_SESSION['user_id'];

    // Consulta SQL
    $sql = "SELECT * FROM $tabela WHERE id = :id";

    // Preparar a consulta
    $stmt = $conn->prepare($sql);

    // Vincular o valor do parâmetro
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado como um array associativo
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o resultado foi encontrado
    if ($resultado) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $nome = $resultado['nome'];
        $phone = $resultado['phone'];
        $email = $resultado['email'];
        $cpf = $resultado['cpf'];
        $cep = $resultado['cep'];
        $endereco = $resultado['endereco'];
        $numero = $resultado['numero'];
        $complemento = $resultado['complemento'];
        $municipio = $resultado['municipio'];
        $cidade = $resultado['cidade'];
        $uf = $resultado['uf'];
        $asaas_id = $resultado['asaas_id'];
    } else {
        // ID não encontrado ou não existente
        $_SESSION['msg'] = "ID não encontrado.";
        header("Location: " . INCLUDE_PATH . "login/");
        exit;
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="pt-BR">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Floema Doar - Painel do usuário</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="Solução para recebimentos de doações">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/ionicons-npm/css/ionicons.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/linearicons-master/dist/web-font/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/base.css" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/custom.css" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo INCLUDE_PATH; ?>assets/google/jquery/3.5.1/jquery.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>assets/ajax/1.16.0/popper.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>assets/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Animated Checkbox -->
                        <div class="no-results">
                            <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>
                            <div class="results-subtitle mt-4">Salvo com sucesso!</div>
                            <div class="results-title">
                                <?php
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                ?>
                            </div>
                            <div class="mt-3 mb-3"></div>
                            <div class="text-center">
                                <button type="button" class="btn-shadow btn-wide btn btn-success btn-lg" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
            //Mostrar modal ao salvar as informacoes
            if(isset($_SESSION['show_modal'])){
                echo $_SESSION['show_modal'];
                unset($_SESSION['show_modal']);
            }
        ?>

        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-left">
                        <ul class="header-megamenu nav">
                            <li class="nav-item p-1">
                                    <i class="nav-link-icon pe-7s-global"></i>
                                    <a href="<?php echo INCLUDE_PATH; ?>" target="_blank">Website</a>
                            </li>
                            <li class="nav-item p-1">
                                    <i class="nav-link-icon pe-7s-cash"></i>
                                    <a href="https://www.asaas.com" target="_blank">Asaas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a href="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/logout.php" class="btn btn-info btn-shadow">
                                                Sair
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Configurações</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-help1"></i>
                                        Ajuda
                                    </a>
                                </li>
                        </div>
                    </div>
                </div>
                <div class="app-main__outer">
                    <?php
                        //Url Amigavel
                        $url = isset($_GET['url']) ? $_GET['url'] : 'user';
                        if(file_exists('pages/'.$url.'.php')){
                            include('pages/'.$url.'.php');
                        }else{
                            //a pagina nao existe
                            header('Location: '.INCLUDE_PATH_ADMIN.'404');
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="app-drawer-wrapper">
            <div class="drawer-nav-btn">
                <button type="button" class="hamburger hamburger--elastic is-active">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
            <div class="drawer-content-wrapper">
                <div class="scrollbar-container">
                    <h3 class="drawer-heading">Servers Status</h3>
                    <div class="drawer-section">
                        <div class="row">
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 1</h4>
                                    <div class="circle-progress circle-progress-gradient-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 2</h4>
                                    <div class="circle-progress circle-progress-success-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 3</h4>
                                    <div class="circle-progress circle-progress-danger-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="mt-3">
                            <h5 class="text-center card-title">Live Statistics</h5>
                            <div id="sparkline-carousel-3"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-warning fsize-3">43</div>
                                            <div class="widget-subheading pt-1">Packages</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-danger fsize-3">65</div>
                                            <div class="widget-subheading pt-1">Dropped</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-success fsize-3">18</div>
                                            <div class="widget-subheading pt-1">Invalid</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="text-center mt-2 d-block">
                                <button class="mr-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button>
                                <button class="border-0 btn-transition btn btn-outline-success">Support Center</button>
                            </div>
                        </div>
                    </div>
                    <h3 class="drawer-heading">File Transfers</h3>
                    <div class="drawer-section p-0">
                        <div class="files-box">
                            <ul class="list-group list-group-flush">
                                <li class="pt-2 pb-2 pr-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 mr-3 text-primary center-elem">
                                                <i class="fa fa-file-alt"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading font-weight-normal">TPSReport.docx</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pr-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 mr-3 text-warning center-elem">
                                                <i class="fa fa-file-archive"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading font-weight-normal">Latest_photos.zip</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pr-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 mr-3 text-danger center-elem">
                                                <i class="fa fa-file-pdf"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading font-weight-normal">Annual Revenue.pdf</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pr-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 mr-3 text-success center-elem">
                                                <i class="fa fa-file-excel"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading font-weight-normal">Analytics_GrowthReport.xls</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="drawer-heading">Tasks in Progress</h3>
                    <div class="drawer-section p-0">
                        <div class="todo-box">
                            <ul class="todo-list-wrapper list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-warning"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox1266" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox1266">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">
                                                    Wash the car
                                                    <div class="badge badge-danger ml-2">Rejected</div>
                                                </div>
                                                <div class="widget-subheading">
                                                    <i>Written by Bob</i>
                                                </div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-focus"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox1666" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox1666">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Task with hover dropdown menu</div>
                                                <div class="widget-subheading">
                                                    <div>
                                                        By Johnny
                                                        <div class="badge badge-pill badge-info ml-2">NEW</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <div class="d-inline-block dropdown">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" class="border-0 btn-transition btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                                        class="dropdown-menu dropdown-menu-right">
                                                        <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                        <button type="button" disabled="" tabindex="-1"
                                                            class="disabled dropdown-item">
                                                            Action
                                                        </button>
                                                        <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                                        <div tabindex="-1" class="dropdown-divider"></div>
                                                        <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-primary"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox4777" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox4777">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">Badge on the right task</div>
                                                <div class="widget-subheading">This task has show on hover actions!</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                            <div class="widget-content-right ml-3">
                                                <div class="badge badge-pill badge-success">Latest Task</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-info"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox2444" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox2444">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="42" class="rounded" src="images/avatars/1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Go grocery shopping</div>
                                                <div class="widget-subheading">A short description ...</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-sm btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-success"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox3222" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox3222">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">Development Task</div>
                                                <div class="widget-subheading">Finish React ToDo List App</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="badge badge-warning mr-2">69</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="drawer-heading">Urgent Notifications</h3>
                    <div class="drawer-section">
                        <div class="notifications-box">
                            <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>Yet another one, at
                                                <span class="text-success">15:00 PM</span>
                                            </p>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Build the production release
                                                <div class="badge badge-danger ml-2">NEW</div>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Something not important
                                                <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/1.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/2.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/3.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/4.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/5.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/6.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/7.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            <img src="images/avatars/8.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                        <div class="avatar-icon">
                                                            <i>+</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">This dot has an info state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon is-hidden"></span>
                                        <div class="vertical-timeline-element-content is-hidden">
                                            <h4 class="timeline-title">This dot has a dark state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-drawer-overlay d-none animated fadeIn"></div>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/moment/moment.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/demo.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/scrollbar.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/app.js"></script>

    </body>
</html>

<?php
    session_start();
    ob_start();
    include('../config.php');

    // Tabela que sera feita a consulta
    $tabela = "tb_checkout";

    // ID que você deseja pesquisar
    $id = 1;

    // Consulta SQL
    $sql = "SELECT nome, logo, title, descricao, titulo, conteudo, razao_social, privacidade, faq, contato FROM $tabela WHERE id = :id";

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
        $logo = $resultado['logo'];
        $title = $resultado['title'];
        $descricao = $resultado['descricao'];
        $titulo = $resultado['titulo'];
        $conteudo = $resultado['conteudo'];
        $razao_social = $resultado['razao_social'];
        $privacidade = $resultado['privacidade'];
        $faq = $resultado['faq'];
        $contato = $resultado['contato'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="pt-BR">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Form Layouts - Build whatever layout you need with our Architect framework.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="Build whatever layout you need with our Architect framework.">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/ionicons-npm/css/ionicons.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/linearicons-master/dist/web-font/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/base.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                        <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="Type to search">
                                <button class="search-icon">
                                    <span></span>
                                </button>
                            </div>
                            <button class="close"></button>
                        </div>
                        <ul class="header-megamenu nav">
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-placement="bottom" rel="popover-focus"
                                    data-offset="300" data-toggle="popover-custom" class="nav-link">
                                    <i class="nav-link-icon pe-7s-gift"></i>
                                    Mega Menu
                                    <i class="fa fa-angle-down ml-2 opacity-5"></i>
                                </a>
                                <div class="rm-max-width">
                                    <div class="d-none popover-custom-content">
                                        <div class="dropdown-mega-menu">
                                            <div class="grid-menu grid-menu-3col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item"> Overview</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-inbox"></i>
                                                                    <span> Contacts</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-book"></i>
                                                                    <span> Incidents</span>
                                                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-picture"></i>
                                                                    <span> Companies</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a disabled="" href="javascript:void(0);" class="nav-link disabled">
                                                                    <i class="nav-link-icon lnr-file-empty"></i>
                                                                    <span> Dashboards</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item"> Favourites</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link"> Reports Conversions</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Quick Start
                                                                    <div class="ml-auto badge badge-success">New</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Users &amp; Groups</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Proprieties</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item">Sales &amp; Marketing</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Queues</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Resource Groups</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Goal Metrics
                                                                    <div class="ml-auto badge badge-warning">3</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Campaigns</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="btn-group nav-item">
                                <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                    <span class="badge badge-pill badge-danger ml-0 mr-2">4</span>
                                    Settings
                                    <i class="fa fa-angle-down ml-2 opacity-5"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-secondary">
                                            <div class="menu-header-image opacity-5" style="background-image: url('images/dropdown-header/abstract2.jpg');"></div>
                                            <div class="menu-header-content">
                                                <h5 class="menu-header-title">Overview</h5>
                                                <h6 class="menu-header-subtitle">Dropdown menus for everyone</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-area-xs">
                                        <div class="scrollbar-container">
                                            <h6 tabindex="-1" class="dropdown-header">Key Figures</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Service Calendar</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Knowledge Base</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Accounts</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Products</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Rollup Queries</button>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn nav-item">
                                            <button class="btn-wide btn-shadow btn btn-danger btn-sm">Cancel</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown nav-item">
                                <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                                    <i class="nav-link-icon pe-7s-settings"></i>
                                    Projects
                                    <i class="fa fa-angle-down ml-2 opacity-5"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-success">
                                            <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/abstract3.jpg');"></div>
                                            <div class="menu-header-content text-left">
                                                <h5 class="menu-header-title">Overview</h5>
                                                <h6 class="menu-header-subtitle">Unlimited options</h6>
                                                <div class="menu-header-btn-pane">
                                                    <button class="mr-2 btn btn-dark btn-sm">Settings</button>
                                                    <button class="btn-icon btn-icon-only btn btn-warning btn-sm">
                                                        <i class="pe-7s-config btn-icon-wrapper"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"></i>
                                        Graphic Design
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"></i>
                                        App Development
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"></i>
                                        Icon Design
                                    </button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"></i>
                                        Miscellaneous
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"></i>
                                        Frontend Dev
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="app-header-right">
                        <div class="header-dots">
                            <div class="dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-primary"></span>
                                        <i class="icon text-primary ion-android-apps"></i>
                                    </span>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-plum-plate">
                                            <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract4.jpg');"></div>
                                            <div class="menu-header-content text-white">
                                                <h5 class="menu-header-title">Grid Dashboard</h5>
                                                <h6 class="menu-header-subtitle">Easy grid navigation inside dropdowns</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid-menu grid-menu-xl grid-menu-3col">
                                        <div class="no-gutters row">
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Automation
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Reports
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Settings
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Content
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Activity
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Contacts
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn text-center nav-item">
                                            <button class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown"  class="p-0 mr-2 btn btn-link">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-danger"></span>
                                        <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                        <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                                    </span>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header mb-0">
                                        <div class="dropdown-menu-header-inner bg-deep-blue">
                                            <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                            <div class="menu-header-content text-dark">
                                                <h5 class="menu-header-title">Notifications</h5>
                                                <h6 class="menu-header-subtitle">You have
                                                    <b>21</b> unread messages
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-messages-header">
                                                <span>Messages</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header">
                                                <span>Events</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header">
                                                <span>System Errors</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="p-3">
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
                                                                                <span class="badge badge-danger ml-2">NEW</span>
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
                                                                                            <img src="images/avatars/9.jpg" alt="">
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
                                                                                <span class="badge badge-danger ml-2">NEW</span>
                                                                            </h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
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
                                        <div class="tab-pane" id="tab-events-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="p-3">
                                                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sic amet, today at
                                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <p>Another meeting today, at
                                                                            <b class="text-danger">12:00 PM</b>
                                                                        </p>
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production release</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sic amet, today at
                                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <p>Another meeting today, at
                                                                            <b class="text-danger">12:00 PM</b>
                                                                        </p>
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production release</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="no-results pt-3 pb-0">
                                                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                            <span class="swal2-success-line-tip"></span>
                                                            <span class="swal2-success-line-long"></span>
                                                            <div class="swal2-success-ring"></div>
                                                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                        </div>
                                                        <div class="results-subtitle">All caught up!</div>
                                                        <div class="results-title">There are no system errors!</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn text-center nav-item">
                                            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button type="button" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-focus"></span>
                                        <span class="language-icon opacity-8 flag large DE"></span>
                                    </span>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="rm-pointers dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                                            <div class="menu-header-image opacity-05" style="background-image: url('images/dropdown-header/city2.jpg');"></div>
                                            <div class="menu-header-content text-center text-white">
                                                <h6 class="menu-header-subtitle mt-0"> Choose Language</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <span class="mr-3 opacity-8 flag large US"></span>
                                        USA
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <span class="mr-3 opacity-8 flag large CH"></span>
                                        Switzerland
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <span class="mr-3 opacity-8 flag large FR"></span>
                                        France
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <span class="mr-3 opacity-8 flag large ES"></span>
                                        Spain
                                    </button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <h6 tabindex="-1" class="dropdown-header">Others</h6>
                                    <button type="button" tabindex="0" class="dropdown-item active">
                                        <span class="mr-3 opacity-8 flag large DE"></span>
                                        Germany
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <span class="mr-3 opacity-8 flag large IT"></span>
                                        Italy
                                    </button>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button type="button" aria-haspopup="true" data-toggle="tooltip" data-placement="bottom"
                                    title="Tooltip on bottom" aria-expanded="false" class="p-0 btn btn-link dd-chart-btn">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-success"></span>
                                        <i class="icon text-success ion-ios-analytics"></i>
                                    </span>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-premium-dark">
                                            <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract4.jpg');"></div>
                                            <div class="menu-header-content text-white">
                                                <h5 class="menu-header-title">Users Online</h5>
                                                <h6 class="menu-header-subtitle">Recent Account Activity Overview</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-chart">
                                        <div class="widget-chart-content">
                                            <div class="icon-wrapper rounded-circle">
                                                <div class="icon-wrapper-bg opacity-9 bg-focus"></div>
                                                <i class="lnr-users text-white"></i>
                                            </div>
                                            <div class="widget-numbers">
                                                <span>344k</span>
                                            </div>
                                            <div class="widget-subheading pt-2">
                                                Profile views since last login
                                            </div>
                                            <div class="widget-description text-danger">
                                                <span class="pr-1">
                                                    <span>176%</span>
                                                </span>
                                                <i class="fa fa-arrow-left"></i>
                                            </div>
                                        </div>
                                        <div class="widget-chart-wrapper">
                                            <div id="dashboard-sparkline-carousel-3-pop"></div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider mt-0 nav-item"></li>
                                        <li class="nav-item-btn text-center nav-item">
                                            <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                                <i class="fa fa-cog fa-spin mr-2"></i>
                                                View Details
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="images/avatars/1.jpg" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-info">
                                                        <div class="menu-header-image opacity-2" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                                        <div class="menu-header-content text-left">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <img width="42" class="rounded-circle"
                                                                            src="images/avatars/1.jpg"  alt="">
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading">Alina Mcloughlin</div>
                                                                        <div class="widget-subheading opacity-8">A short profile description</div>
                                                                    </div>
                                                                    <div class="widget-content-right mr-2">
                                                                        <button class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="scroll-area-xs" style="height: 150px;">
                                                    <div class="scrollbar-container ps">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item">Activity</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Chat
                                                                    <div class="ml-auto badge badge-pill badge-info">8</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Recover Password</a>
                                                            </li>
                                                            <li class="nav-item-header nav-item">
                                                                My Account
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Settings
                                                                    <div class="ml-auto badge badge-success">New</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Messages
                                                                    <div class="ml-auto badge badge-warning">512</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Logs</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider mb-0 nav-item"></li>
                                                </ul>
                                                <div class="grid-menu grid-menu-2col">
                                                    <div class="no-gutters row">
                                                        <div class="col-sm-6">
                                                            <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                                                <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                                Message Inbox
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                                <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                                <b>Support Tickets</b>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider nav-item"></li>
                                                    <li class="nav-item-btn text-center nav-item">
                                                        <button class="btn-wide btn btn-primary btn-sm"> Open Messages</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading"> Alina Mclourd</div>
                                        <div class="widget-subheading"> VP People Manager</div>
                                    </div>
                                    <div class="widget-content-right header-user-info ml-3">
                                        <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                            <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-btn-lg">
                            <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
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
                                <li class="app-sidebar__heading">Menu</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboards
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="index.html">
                                                <i class="metismenu-icon"></i>
                                                Analytics
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboards-commerce.html">
                                                <i class="metismenu-icon"></i>
                                                Commerce
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboards-sales.html">
                                                <i class="metismenu-icon"></i>
                                                Sales
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Minimal
                                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="dashboards-minimal-1.html">
                                                        <i class="metismenu-icon"></i>
                                                        Variation 1
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="dashboards-minimal-2.html">
                                                        <i class="metismenu-icon"></i>
                                                        Variation 2
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboards-crm.html">
                                                <i class="metismenu-icon"></i>
                                                CRM
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-browser"></i>
                                        Pages
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="pages-login.html">
                                                <i class="metismenu-icon"></i>
                                                Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pages-login-boxed.html">
                                                <i class="metismenu-icon"></i>
                                                Login Boxed
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pages-register.html">
                                                <i class="metismenu-icon"></i>
                                                Register
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pages-register-boxed.html">
                                                <i class="metismenu-icon"></i>
                                                Register Boxed
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pages-forgot-password.html">
                                                <i class="metismenu-icon"></i>
                                                Forgot Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pages-forgot-password-boxed.html">
                                                <i class="metismenu-icon"></i>
                                                Forgot Password Boxed
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-plugin"></i>
                                        Applications
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="apps-mailbox.html">
                                                <i class="metismenu-icon"></i>
                                                Mailbox
                                            </a>
                                        </li>
                                        <li>
                                            <a href="apps-chat.html">
                                                <i class="metismenu-icon"></i>
                                                Chat
                                            </a>
                                        </li>
                                        <li>
                                            <a href="apps-faq-section.html">
                                                <i class="metismenu-icon"></i>
                                                FAQ Section
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Forums
                                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="apps-forum-list.html">
                                                        <i class="metismenu-icon"></i>
                                                        Forum Listing
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="apps-forum-threads.html">
                                                        <i class="metismenu-icon"></i>
                                                        Forum Threads
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="apps-forum-discussion.html">
                                                        <i class="metismenu-icon"></i>
                                                        Forum Discussion
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">UI Components</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Elements
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Buttons
                                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="elements-buttons-standard.html">
                                                        <i class="metismenu-icon"></i>
                                                        Standard
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="elements-buttons-pills.html">
                                                        <i class="metismenu-icon"></i>
                                                        Pills
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="elements-buttons-square.html">
                                                        <i class="metismenu-icon"></i>
                                                        Square
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="elements-buttons-shadow.html">
                                                        <i class="metismenu-icon"></i>
                                                        Shadow
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="elements-buttons-icons.html">
                                                        <i class="metismenu-icon"></i>
                                                        With Icons
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="elements-dropdowns.html">
                                                <i class="metismenu-icon"></i>
                                                Dropdowns
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-icons.html">
                                                <i class="metismenu-icon"></i>
                                                Icons
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-badges-labels.html">
                                                <i class="metismenu-icon"></i>
                                                Badges
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-cards.html">
                                                <i class="metismenu-icon"></i>
                                                Cards
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-loaders.html">
                                                <i class="metismenu-icon"></i>
                                                Loading Indicators
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-list-group.html">
                                                <i class="metismenu-icon"></i>
                                                List Groups
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-navigation.html">
                                                <i class="metismenu-icon"></i>
                                                Navigation Menus
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-timelines.html">
                                                <i class="metismenu-icon"></i>
                                                Timeline
                                            </a>
                                        </li>
                                        <li>
                                            <a href="elements-utilities.html">
                                                <i class="metismenu-icon"></i>
                                                Utilities
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-car"></i>
                                        Components
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="components-tabs.html">
                                                <i class="metismenu-icon"></i>
                                                Tabs
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-accordions.html">
                                                <i class="metismenu-icon"></i>
                                                Accordions
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-notifications.html">
                                                <i class="metismenu-icon"></i>
                                                Notifications
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-modals.html">
                                                <i class="metismenu-icon"></i>
                                                Modals
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-loading-blocks.html">
                                                <i class="metismenu-icon"></i>
                                                Loading Blockers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-progress-bar.html">
                                                <i class="metismenu-icon"></i>
                                                Progress Bar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-tooltips-popovers.html">
                                                <i class="metismenu-icon"></i>
                                                Tooltips &amp; Popovers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-carousel.html">
                                                <i class="metismenu-icon"></i>
                                                Carousel
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-calendar.html">
                                                <i class="metismenu-icon"></i>
                                                Calendar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-pagination.html">
                                                <i class="metismenu-icon"></i>
                                                Pagination
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-count-up.html">
                                                <i class="metismenu-icon"></i>
                                                Count Up
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-scrollable-elements.html">
                                                <i class="metismenu-icon"></i>
                                                Scrollable
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-tree-view.html">
                                                <i class="metismenu-icon"></i>
                                                Tree View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-maps.html">
                                                <i class="metismenu-icon"></i>
                                                Maps
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-ratings.html">
                                                <i class="metismenu-icon"></i>
                                                Ratings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-image-crop.html">
                                                <i class="metismenu-icon"></i>
                                                Image Crop
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-guided-tours.html">
                                                <i class="metismenu-icon"></i>
                                                Guided Tours
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Tables
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="tables-data-tables.html">
                                                <i class="metismenu-icon"></i>
                                                Data Tables
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tables-regular.html">
                                                <i class="metismenu-icon"></i>
                                                Regular Tables
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tables-grid.html">
                                                <i class="metismenu-icon"></i>
                                                Grid Tables
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Dashboard Widgets</li>
                                <li>
                                    <a href="widgets-chart-boxes.html">
                                        <i class="metismenu-icon pe-7s-graph"></i>
                                        Chart Boxes 1
                                    </a>
                                </li>
                                <li>
                                    <a href="widgets-chart-boxes-2.html">
                                        <i class="metismenu-icon pe-7s-way"></i>
                                        Chart Boxes 2
                                    </a>
                                </li>
                                <li>
                                    <a href="widgets-chart-boxes-3.html">
                                        <i class="metismenu-icon pe-7s-ball"></i>
                                        Chart Boxes 3
                                    </a>
                                </li>
                                <li>
                                    <a href="widgets-profile-boxes.html">
                                        <i class="metismenu-icon pe-7s-id"></i>
                                        Profile Boxes
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Forms</li>
                                <li class="mm-active">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-light"></i>
                                        Elements
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-show">
                                        <li>
                                            <a href="forms-controls.html">
                                                <i class="metismenu-icon"></i>
                                                Controls
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-layouts.html" class="mm-active">
                                                <i class="metismenu-icon"></i>
                                                Layouts
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-validation.html">
                                                <i class="metismenu-icon"></i>
                                                Validation
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-wizard.html">
                                                <i class="metismenu-icon"></i>
                                                Wizard
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-joy"></i>
                                        Widgets
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="forms-datepicker.html">
                                                <i class="metismenu-icon"></i>
                                                Datepicker
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-range-slider.html">
                                                <i class="metismenu-icon"></i>
                                                Range Slider
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-input-selects.html">
                                                <i class="metismenu-icon"></i>
                                                Input Selects
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-toggle-switch.html">
                                                <i class="metismenu-icon"></i>
                                                Toggle Switch
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-wysiwyg-editor.html">
                                                <i class="metismenu-icon"></i>
                                                WYSIWYG Editor
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-input-mask.html">
                                                <i class="metismenu-icon"></i>
                                                Input Mask
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-clipboard.html">
                                                <i class="metismenu-icon"></i>
                                                Clipboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="forms-textarea-autosize.html">
                                                <i class="metismenu-icon"></i>
                                                Textarea Autosize
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Charts</li>
                                <li>
                                    <a href="charts-chartjs.html">
                                        <i class="metismenu-icon pe-7s-graph2"></i>
                                        ChartJS
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-apexcharts.html">
                                        <i class="metismenu-icon pe-7s-graph"></i>
                                        Apex Charts
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-sparklines.html">
                                        <i class="metismenu-icon pe-7s-graph1"></i>
                                        Chart Sparklines
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="app-main__outer">
                    <?php
                        //Url Amigavel
                        $url = isset($_GET['url']) ? $_GET['url'] : 'sobre';
                        
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
        <!-- plugin dependencies -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/moment/moment.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/metismenu/dist/metisMenu.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/jquery-circle-progress/dist/circle-progress.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/toastr/build/toastr.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/apexcharts/dist/apexcharts.min.js"></script>
        <!-- custome.js -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/charts/apex-charts.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/circle-progress.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/demo.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/scrollbar.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/toastr.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/treeview.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/form-components/toggle-switch.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/app.js"></script>
        <!-- Image Preview -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/imagePreview.js"></script>
    </body>
</html>

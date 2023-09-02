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
    $tabela = "tb_checkout";

    // ID que você deseja pesquisar
    $id = 1;

    // Consulta SQL
    $sql = "SELECT nome, logo, title, descricao, privacidade, faq, facebook, instagram, linkedin, youtube, website, cep, rua, numero, bairro, cidade, estado, telefone, email, color, hover, progress FROM $tabela WHERE id = :id";

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
        $privacidade = $resultado['privacidade'];
        $faq = $resultado['faq'];
        $facebook = $resultado['facebook'];
        $instagram = $resultado['instagram'];
        $linkedin = $resultado['linkedin'];
        $youtube = $resultado['youtube'];
        $website = $resultado['website'];
        $cep = $resultado['cep'];
        $rua = $resultado['rua'];
        $numero = $resultado['numero'];
        $bairro = $resultado['bairro'];
        $cidade = $resultado['cidade'];
        $estado = $resultado['estado'];
        $telefone = $resultado['telefone'];
        $email = $resultado['email'];
        $color = $resultado['color'];
        $hover = $resultado['hover'];
        $progress = $resultado['progress'];
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
        <title>Floema Doar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="Solução para recebimentos de doações">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/ionicons-npm/css/ionicons.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/linearicons-master/dist/web-font/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/base.css" rel="stylesheet">
        
        <link href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
            type="text/css">
        <script src="<?php echo INCLUDE_PATH; ?>assets/jquery/3.5.1/jquery.min.js"></script>
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
                                    <i class="nav-link-icon pe-7s-settings"></i>
                                    <a href="<?php echo INCLUDE_PATH; ?>" target="_blank">Website</a>
                            </li>
                            
                            <li class="nav-item p-1">
                                    <i class="nav-link-icon pe-7s-settings"></i>
                                    <a href="https://www.asaas.com" target="_blank">
                                    Asaas
                                </a>
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
                                <li class="app-sidebar__heading">Menu</li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>">
                                        <i class="metismenu-icon pe-7s-browser"></i>
                                        Checkout
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Perfil</li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>editar-perfil">
                                        <i class="metismenu-icon pe-7s-id"></i>
                                        Senha
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
        <div class="app-drawer-overlay d-none animated fadeIn"></div>
        <!-- plugin dependencies -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/moment/moment.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>vendors/toastr/build/toastr.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/demo.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/scrollbar.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/app.js"></script>

        
    </body>
</html>

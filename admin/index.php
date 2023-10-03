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
    $tabela_2 = "tb_integracoes";
    $tabela_3 = "tb_mensagens";
    $tabela_4 = "tb_doacoes";
    $tabela_5 = "tb_clientes";
    $tabela_6 = "tb_transacoes";

    // ID que você deseja pesquisar
    $id = 1;

    // Consulta SQL
    $sql = "SELECT nome, logo, title, descricao, privacidade, faq, facebook, instagram, linkedin, twitter, youtube, website, cep, rua, numero, bairro, cidade, estado, telefone, email, nav_color, nav_background, background, color, hover, text_color, load_btn, monthly_1, monthly_2, monthly_3, monthly_4, monthly_5, yearly_1, yearly_2, yearly_3, yearly_4, yearly_5, once_1, once_2, once_3, once_4, once_5 FROM $tabela WHERE id = :id";
    $sql_2 = "SELECT fb_pixel, gtm, g_analytics FROM $tabela_2 WHERE id = :id";
    $sql_3 = "SELECT welcome_email, privacy_policy, use_privacy FROM $tabela_3 WHERE id = :id";
    $sql_4 = "SELECT * FROM $tabela_4";
    $sql_5 = "SELECT * FROM $tabela_5";
    /*$sql_6 = "SELECT * FROM $tabela_6";*/
    date_default_timezone_set('America/Sao_Paulo');
    $now = date("Y-m-d");
    $start_date = new DateTime($now);
    $st_date_str = date_format($start_date, "Y-m-d");
    $end_date = date_sub($start_date, date_interval_create_from_date_string("90 days"));
    $ed_date_str = date_format($end_date, "Y-m-d");
    //$sql_6 = "SELECT * FROM $tabela_6 WHERE payment_date_created > CAST($ed_date_str as DATE)";
    $sql_6 = "SELECT * FROM $tabela_6 as t6 JOIN $tabela_5 as t5 ON t6.customer_id = t5.asaas_id WHERE payment_date_created > CAST($ed_date_str as DATE)";

    // Preparar a consulta
    $stmt = $conn->prepare($sql);
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_3 = $conn->prepare($sql_3);
    $stmt_4 = $conn->prepare($sql_4);
    $stmt_5 = $conn->prepare($sql_5);
    $stmt_6 = $conn->prepare($sql_6);

    // Vincular o valor do parâmetro
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_3->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a consulta
    $stmt->execute();
    $stmt_2->execute();
    $stmt_3->execute();
    $stmt_4->execute();
    $stmt_5->execute();
    $stmt_6->execute();

    // Obter o resultado como um array associativo
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    $resultado_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);
    $resultado_4 = $stmt_4->fetchAll(PDO::FETCH_ASSOC);
    $resultado_5 = $stmt_5->fetchAll(PDO::FETCH_ASSOC);
    $resultado_6 = $stmt_6->fetchAll(PDO::FETCH_ASSOC);

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
        $twitter = $resultado['twitter'];
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
        $nav_color = $resultado['nav_color'];
        $nav_background = $resultado['nav_background'];
        $background = $resultado['background'];
        $color = $resultado['color'];
        $hover = $resultado['hover'];
        $text_color = $resultado['text_color'];
        $load_btn = $resultado['load_btn'];
        $monthly_1 = $resultado['monthly_1'];
        $monthly_2 = $resultado['monthly_2'];
        $monthly_3 = $resultado['monthly_3'];
        $monthly_4 = $resultado['monthly_4'];
        $monthly_5 = $resultado['monthly_5'];
        $yearly_1 = $resultado['yearly_1'];
        $yearly_2 = $resultado['yearly_2'];
        $yearly_3 = $resultado['yearly_3'];
        $yearly_4 = $resultado['yearly_4'];
        $yearly_5 = $resultado['yearly_5'];
        $once_1 = $resultado['once_1'];
        $once_2 = $resultado['once_2'];
        $once_3 = $resultado['once_3'];
        $once_4 = $resultado['once_4'];
        $once_5 = $resultado['once_5'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

    // Verificar se o resultado_2 foi encontrado
    if ($resultado_2) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $fb_pixel = $resultado_2['fb_pixel'];
        $gtm = $resultado_2['gtm'];
        $g_analytics = $resultado_2['g_analytics'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

    // Verificar se o resultado_3 foi encontrado
    if ($resultado_3) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $welcome_email = $resultado_3['welcome_email'];
        $privacy_policy = $resultado_3['privacy_policy'];
        $use_privacy = $resultado_3['use_privacy'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

    if($resultado_4) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $doacoes = $resultado_4;
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

    if($resultado_5) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $clientes = $resultado_5;
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

    $transacoes = $resultado_6;
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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/ionicons-npm/css/ionicons.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/linearicons-master/dist/web-font/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/base.css" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo INCLUDE_PATH; ?>assets/google/jquery/jquery.min.js"></script>
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
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>">
                                        <i class="metismenu-icon pe-7s-browser"></i>
                                        Checkout
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>doadores">
                                        <i class="metismenu-icon pe-7s-graph2"></i>
                                        Doadores
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>financeiro">
                                        <i class="metismenu-icon pe-7s-piggy"></i>
                                        Financeiro
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>integracoes">
                                        <i class="metismenu-icon pe-7s-settings"></i>
                                        Integrações
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>mensagens">
                                        <i class="metismenu-icon pe-7s-paper-plane"></i>
                                        Mensagens
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>politica-de-privacidade">
                                        <i class="metismenu-icon pe-7s-info"></i>
                                        Privacidade e Termo
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>aparencia">
                                        <i class="metismenu-icon pe-7s-paint"></i>
                                        Aparência
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>cabecalho">
                                        <i class="metismenu-icon pe-7s-plugin"></i>
                                        Cabeçalho
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo INCLUDE_PATH_ADMIN; ?>rodape">
                                        <i class="metismenu-icon pe-7s-map-marker"></i>
                                        Rodapé
                                    </a>
                                </li>
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
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/moment/moment.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/demo.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/scrollbar.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/app.js"></script>

    </body>
</html>

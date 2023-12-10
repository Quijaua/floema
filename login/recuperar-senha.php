<?php
    // Caso prefira o .env apenas descomente o codigo e comente o "include('parameters.php');" acima
	// Carrega as variáveis de ambiente do arquivo .env

    // Caminho para o diretório pai
    $parentDir = dirname(__DIR__);

	require $parentDir . '/vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable($parentDir);
	$dotenv->load();

    // Informacoes para PHPMailer
	$smtp_host = $_ENV['SMTP_HOST'];
	$smtp_from = $_ENV['SMTP_FROM'];
	$smtp_username = $_ENV['SMTP_USERNAME'];
	$smtp_password = $_ENV['SMTP_PASSWORD'];
	$smtp_secure = $_ENV['SMTP_SECURE'];
	$smtp_port = $_ENV['SMTP_PORT'];
    
    session_start();
    ob_start();
    include('../config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './../lib/vendor/autoload.php';

    // Crie uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    // Tabela que sera feita a consulta
    $tabela = "tb_clientes";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SendRecupPassword"])) {
        //var_dump($dados);
        // Informacoes da instituicao
        $query_instituicao = "SELECT nome, email 
                    FROM tb_checkout 
                    WHERE id =:id  
                    LIMIT 1";
        $result_instituicao = $conn->prepare($query_instituicao);
        $result_instituicao->bindValue(':id', 1, PDO::PARAM_INT);
        $result_instituicao->execute();
        
        $row_instituicao = $result_instituicao->fetch(PDO::FETCH_ASSOC);
            
        $query_usuario = "SELECT id, nome, email 
                    FROM $tabela 
                    WHERE email =:email  
                    LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

            $token = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
            //echo "Chave $token <br>";

            $query_up_usuario = "UPDATE $tabela 
                        SET recup_password =:recup_password 
                        WHERE id =:id 
                        LIMIT 1";
            $result_up_usuario = $conn->prepare($query_up_usuario);
            $result_up_usuario->bindParam(':recup_password', $token, PDO::PARAM_STR);
            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

            if ($result_up_usuario->execute()) {
                $mail = new PHPMailer(true);
        
                $link = INCLUDE_PATH . "login/atualizar-senha.php?token=$token";

                try {
                    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = $smtp_host;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $smtp_username;
                    $mail->Password   = $smtp_password;
                    $mail->SMTPSecure = $smtp_secure;
                    $mail->Port       = $smtp_port;

                    $mail->setFrom($smtp_from, 'Atendimento - ' . $row_instituicao['nome']);
                    $mail->addReplyTo($smtp_from, 'Atendimento - ' . $row_instituicao['nome']);
                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']);

                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>Clique Aqui Para Recuperar Sua Senha</a><br><br>Ou<br><br>Cole esse link no seu navegador:<br><p>" . $link . "</p><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nOu\n\nCole esse link no seu navegador:\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                    $mail->send();

                    $_SESSION['msgcad'] = "Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!";
                    header("Location: " . INCLUDE_PATH . "login/");
                } catch (Exception $e) {
                    $_SESSION['msg'] = "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $_SESSION['msg'] = "Erro: Usuário não encontrado!";
            }
        }
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Floema Doar - Recuperar senha</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="Solução para recebimentos de doações">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/base.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_ADMIN; ?>styles/css/custom.css" rel="stylesheet">
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow">
            <div class="app-container">
                <div class="h-100">
                    <div class="h-100 no-gutters row">
                        <div class="d-none d-lg-block col-lg-4">
                            <div class="slider-light">
                                <div class="slick-slider">
                                    <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                            <div class="slide-img-bg" style="background-image: url('<?php echo INCLUDE_PATH_ADMIN; ?>images/donate.jpg');"></div>
                                            <div class="slider-content">
                                                <h3>Doação é amor em dobro: preenche o coração de quem dá e de quem recebe.</h3>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                                <div class="app-logo"></div>
                                <h4 class="mb-0">
                                    <span class="d-block">Esqueceu a senha?</span>
                                    <span>Digite seu e-mail abaixo para recuperar sua senha.</span>
                                </h4>
                                <br>
                                <p class="text-danger">
                                    <?php
                                        if(isset($_SESSION['msg'])){
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                            echo "<br>";
                                        }
                                    ?>
                                </p>
                                <div class="divider row"></div>
                                <div>
                                    <form action="<?php echo INCLUDE_PATH; ?>login/recuperar-senha.php" method="post">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="email" class="">E-mail</label>
                                                    <input name="email" id="email"
                                                        placeholder="Seu e-mail..." type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider row"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-auto">
                                                <a href="<?php echo INCLUDE_PATH; ?>" class="d-block"><?php echo $_SESSION['project_name']; ?></a>
                                            </div>
                                            <div class="ml-auto">
                                                <a href="#" onclick="voltarPagina()" class="btn-lg btn btn-link">Voltar</a>
                                                <button type="submit" class="btn btn-primary btn-lg" name="SendRecupPassword">Recuperar Senha</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- plugin dependencies -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/slick-carousel/slick/slick.min.js"></script>
        <!-- custome.js -->
        <script type="text/javascript" src="<?php echo INCLUDE_PATH_ADMIN; ?>js/carousel-slider.js"></script>
        <script>
            function voltarPagina() {
                history.back();
            }
        </script>
    </body>
</html>

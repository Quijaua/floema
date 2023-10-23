<?php
    session_start();
    ob_start();
    include('../config.php');
    
    if (isset($_GET["token"])) {
        $token = $_GET["token"];

        // Tabela que sera feita a consulta
        $tabela = "tb_clientes";
        
        $query_usuario = "SELECT id 
                            FROM $tabela 
                            WHERE recup_password = :recup_password  
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':recup_password', $token, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {

            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $recup_password = null;

                $query_up_usuario = "UPDATE $tabela 
                        SET password = :password,
                        recup_password = :recup_password
                        WHERE id = :id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':password', $password, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recup_password', $recup_password, PDO::PARAM_NULL);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "Senha atualizada com sucesso!";
                    header("Location: " . INCLUDE_PATH_ADMIN . "back-end/logout.php");
                } else {
                    $_SESSION['msgcad'] = "Erro: Tente novamente!";
                }
            }
        } else {
            $_SESSION['msg'] = "Erro: Link inválido, solicite novo link para atualizar a senha!";
            header("Location: " . INCLUDE_PATH . "login/recuperar-senha.php");
        }
    }

    $usuario = "";
    if (isset($_POST['password'])) {
        $usuario = $_POST['password'];
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Floema Doar - Atualizar senha</title>
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
                                    <span class="d-block">Atualizar Senha</span>
                                </h4>
                                <br>
                                <p class="text-danger">
                                    <?php
                                        if(isset($_SESSION['msgcad'])){
                                            echo $_SESSION['msgcad'];
                                            unset($_SESSION['msgcad']);
                                            echo "<br>";
                                        }
                                    ?>
                                </p>
                                <div class="divider row"></div>
                                <div>
                                    <form action="<?php echo INCLUDE_PATH; ?>login/atualizar-senha.php?token=<?php echo $token; ?>" method="post">
                                        <p id="message"></p>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="password" class="">Senha</label>
                                                    <input name="password" id="password"
                                                        placeholder="Nova senha..." type="password" class="form-control" onblur="validatePassword()" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="confirmPassword" class="">Confirmar Senha</label>
                                                    <input name="confirmPassword" id="confirmPassword"
                                                        placeholder="Confirme sua senha..." type="password" class="form-control" onblur="validatePassword()" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider row"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-auto">
                                                <a href="<?php echo INCLUDE_PATH; ?>" class="d-block"><?php echo $_SESSION['project_name']; ?></a>
                                            </div>
                                            <div class="ml-auto">
                                                <a href="<?php echo INCLUDE_PATH; ?>login/" class="btn-lg btn btn-link">Voltar</a>
                                                <button type="submit" class="btn btn-primary btn-lg" id="SendNewPassword" name="SendNewPassword" disabled>Atualizar Senha</button>
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
            function validatePassword() {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirmPassword").value;
                
                var SendNewPassword = document.getElementById("SendNewPassword");

                if (password.length  < 7) {
                    document.getElementById("message").innerHTML = "A senha deve ter no minimo 8 caracteres";
                    document.getElementById("message").style.color = "red";
                    SendNewPassword.disabled = true;
                } else {
                    if (password !== confirmPassword) {
                        document.getElementById("message").innerHTML = "As senhas não coincidem";
                        document.getElementById("message").style.color = "red";
                        SendNewPassword.disabled = true;
                    } else {
                        document.getElementById("message").innerHTML = "";
                        SendNewPassword.disabled = false;
                    }
                }
            }
        </script>
    </body>
</html>

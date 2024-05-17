<?php
    // Carrega as variáveis de ambiente do arquivo .env
    require dirname(__DIR__).'/vendor/autoload.php';
    require_once dirname(__DIR__).'/back-end/functions.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
    $client = new GuzzleHttp\Client();

    // Acessa as variáveis de ambiente
    $hcaptcha = $_ENV['HCAPTCHA_CHAVE_SECRETA'];

    session_start();
    ob_start();
    include('../../config.php');

    $responseKey = $dataForm['h-captcha-response']; // Chave de resposta do hCaptcha

    // Verifique se a chave de resposta está presente
    if (isset($responseKey) && !empty($responseKey)) {
        // Faça uma solicitação para validar a resposta do hCaptcha
        $url = 'https://hcaptcha.com/siteverify';
        $data = [
            'secret' => $hcaptcha,
            'response' => $responseKey
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        // Verifique a resposta
        if ($response && isset($response['success']) && $response['success'] === true) {


            //Tabela que será solicitada
            $tabela = 'tb_clientes';

            // Recebe os dados do formulário
            $email = $_POST['email'];

            // Consulta SQL
            $sql = "SELECT id, roles, email, password FROM $tabela WHERE email = :email";

            // Preparar a consulta
            $stmt = $conn->prepare($sql);

            // Vincular o valor do parâmetro
            $stmt->bindValue(':email', $email);

            // Executar a consulta
            $stmt->execute();

            // Obter o resultado como um array associativo
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar se o resultado foi encontrado
            if ($resultado) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $roles = $resultado['roles'];
            
                    if ($email === $resultado['email'] && password_verify($password, $resultado['password'])) {
                        if ($roles == 0) {
                            $_SESSION['user_id'] = $resultado['id']; // Você pode definir informações do usuário aqui
                            //header("Location: " . INCLUDE_PATH_USER);
                            header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
                            exit();
                        } else {
                            $_SESSION['user_id'] = $resultado['id']; // Você pode definir informações do usuário aqui
                            //header("Location: " . INCLUDE_PATH_ADMIN);
                            header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
                            exit();
                        }
                    } else {
                        $_SESSION['msg'] = "Credenciais inválidas.";
                        header("Location: " . INCLUDE_PATH . "login/");
                    }
                }
            } else {
                // ID não encontrado ou não existente
                $_SESSION['msg'] = "ID não encontrado.";
                header("Location: " . INCLUDE_PATH . "login/");
            }

            
        } else {
            echo json_encode(["status"=>400, "message" => "Falha na validação do hCaptcha"]);
        }
        } else {
        echo json_encode(["status"=>400, "message" => "Por favor preencha o hCaptcha para continuar"]);
        }
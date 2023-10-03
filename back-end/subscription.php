<?php
//Atualmente esta chamando $config['asaas_api_url'] e $config['asaas_api_key'] pelo param.php
//Esta sendo feita uma consulta no banco de dados e puxando com pdo
// include('parameters.php');

// // Acessa as variáveis de ambiente
// $recaptcha_key = $config['recaptcha_token'];

// Caso prefira o .env apenas descomente o codigo e comente o "include('parameters.php');" acima
// Carrega as variáveis de ambiente do arquivo .env
require dirname(__DIR__).'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Acessa as variáveis de ambiente
$config['asaas_api_url'] = $_ENV['ASAAS_API_URL'];
$config['asaas_api_key'] = $_ENV['ASAAS_API_KEY'];
$config['recaptcha_token'] = $_ENV['RECAPTCHA_CHAVE_SECRETA'];

//Decodificando base64 e passando para $dataForm
$dataForm = [];
parse_str(base64_decode($_POST['params']), $dataForm);

// // Capturar o token do recaptcha enviado pelo front-end
// $recaptchaToken = $dataForm['recaptcha_token'];

// // Verificar o token do recaptcha
// $recaptchaSecretKey = '6LdeWbcmAAAAAJpl6AlTbWNDacHiioI50Woma1_g';

// // Construir a URL da solicitação
// $url = 'https://www.google.com/recaptcha/api/siteverify';
// $data = array(
//     'secret' => $recaptchaSecretKey,
//     'response' => $recaptchaToken
// );

// $options = array(
//     'http' => array(
//         'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method' => 'POST',
//         'content' => http_build_query($data)
//     )
// );

// $context = stream_context_create($options);
// $response = file_get_contents($url, false, $context);
// $result = json_decode($response);

// // Verificar a resposta do servidor do Google
// if ($result && $result->success && $result->score >= 0.5) {
//     // O token do recaptcha é válido, continue com o processamento do formulário
//     // Coloque aqui o código para processar os dados recebidos do formulário
//     // ...

    if(isset($_POST)) {
        $dataForm['name'] = $dataForm['name'] . " " . $dataForm['surname'];

        include('config.php');
        include_once('criar_cliente.php');
        include_once('assinatura_cartao.php');
        include_once('assinatura_boleto.php');
        include_once('cobranca_cartao.php');
        include_once('cobranca_pix.php');
        include_once('cobranca_boleto.php');
        include_once('qr_code.php');
        include_once('linha_digitavel.php');
    
        switch($_POST["method"]) {
            case '100':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    $payment_id = asaas_CriarAssinaturaCartao($customer_id, $dataForm, $config);
                }else if($dataForm['inlineRadioOptions'] == "option3"){
                    $payment_id = asaas_CriarCobrancaCartao($customer_id, $dataForm, $config);
                }
                echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                break;
            case '101':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    $payment_id = asaas_CriarAssinaturaBoleto($customer_id, $dataForm, $config);
                } else if($dataForm['inlineRadioOptions'] == "option3"){
                    $payment_id = asaas_CriarCobrancaBoleto($customer_id, $dataForm, $config);
                }
                //$payment_id = asaas_CriarCobrancaBoleto($customer_id, $dataForm, $config);
                asaas_ObterLinhaDigitavelBoleto($payment_id, $config);
                echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                break;
            case '102':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                $payment_id = asaas_CriarCobrancaPix($customer_id, $dataForm, $config);
                asaas_ObterQRCodePix($payment_id, $config);
                echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                break;
            default:
                echo json_encode(['status' => 404, 'message' => 'Método de pagamento inválido!']);
                break;
        }
    
    }

// } else {
//     // O token do recaptcha é inválido ou a pontuação é baixa, trata-se de uma ação suspeita
//     // Retorne uma resposta para o front-end indicando a falha na validação do recaptcha
//     $response = array(
//         'status' => 400,
//         'message' => 'Falha na validação do Recaptcha.'
//     );
// }

// Retorne a resposta como JSON para o front-end
header('Content-Type: application/json');
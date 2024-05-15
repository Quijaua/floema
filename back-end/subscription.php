<?php
// Carrega as variáveis de ambiente do arquivo .env
require dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/back-end/functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$client = new GuzzleHttp\Client();

// Acessa as variáveis de ambiente
$config['asaas_api_url'] = $_ENV['ASAAS_API_URL'];
$config['asaas_api_key'] = $_ENV['ASAAS_API_KEY'];

$hcaptcha = $_ENV['HCAPTCHA_CHAVE_SECRETA'];

//Decodificando base64 e passando para $dataForm
$dataForm = [];
parse_str(base64_decode($_POST['params']), $dataForm);

// Verifica se o honeypot está vazio antes de processar a solicitação
if (!empty($dataForm['email'])) {
    // Honeypot preenchido, retorna status 200 sem fazer alterações
    $response = array(
        'status' => 200,
        'message' => 'Requisição processada com sucesso.'
    );

    echo json_encode($response);
    exit; // Encerra o script aqui para evitar processamento adicional
}

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
        // Tudo certo cria a cobrança
        makeDonation($dataForm, $config);
    } else {
        echo json_encode(["status"=>400, "message" => "Falha na validação do hCaptcha"]);
    }
} else {
    echo json_encode(["status"=>400, "message" => "Por favor preencha o hCaptcha para continuar"]);
}

$response = array(
    'status' => 200,
    'message' => 'Requisição processada com sucesso.'
);

return json_encode($response);

function makeDonation($dataForm, $config){

    if(isset($_POST)) {
        $dataForm['name'] = $dataForm['name'] . " " . $dataForm['surname'];

        // Passando valor do email
        $dataForm['email'] = $dataForm['eee'];

        // Iniciando variavel "$subscription_id"
        $subscription_id = null;

        include('config.php');
        include_once('criar_cliente.php');
        include_once('assinatura_cartao.php');
        include_once('assinatura_pix.php');
        include_once('assinatura_boleto.php');
        include_once('cobranca_cartao.php');
        include_once('cobranca_pix.php');
        include_once('cobranca_boleto.php');
        include_once('listar_cobranca_assinatura.php');
        include_once('qr_code.php');
        include_once('linha_digitavel.php');
    
        switch($_POST["method"]) {
            case '100':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    $payment_id = asaas_CriarAssinaturaCartao($customer_id, $dataForm, $config);
                }else if($dataForm['inlineRadioOptions'] == "ONLY"){
                    $payment_id = asaas_CriarCobrancaCartao($customer_id, $dataForm, $config);
                }
                echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                break;
            case '101':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    $subscription_id = asaas_CriarAssinaturaBoleto($customer_id, $dataForm, $config);
                    $payment_id = asaas_ObterIdPagamento($subscription_id, $config);
                } else {
                    $payment_id = asaas_CriarCobrancaBoleto($customer_id, $dataForm, $config);
                }
                asaas_ObterLinhaDigitavelBoleto($subscription_id, $payment_id, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    echo json_encode(["status"=>200, "code"=>$subscription_id, "id"=>$customer_id]);
                } else {
                    echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                }
                break;
            case '102':
                $customer_id = asaas_CriarCliente($dataForm, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    $subscription_id = asaas_CriarAssinaturaPix($customer_id, $dataForm, $config);
                    $payment_id = asaas_ObterIdPagamento($subscription_id, $config);
                } else {
                    $payment_id = asaas_CriarCobrancaPix($customer_id, $dataForm, $config);
                }
                asaas_ObterQRCodePix($subscription_id, $payment_id, $config);
                if($dataForm['inlineRadioOptions'] == "MONTHLY" || $dataForm['inlineRadioOptions'] == "YEARLY"){
                    echo json_encode(["status"=>200, "code"=>$subscription_id, "id"=>$customer_id]);
                } else {
                    echo json_encode(["status"=>200, "code"=>$payment_id, "id"=>$customer_id]);
                }
                break;
            default:
                echo json_encode(['status' => 404, 'message' => 'Método de pagamento inválido!']);
                break;
        }
    
    }
}
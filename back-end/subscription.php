<?php
//Atualmente esta chamando $config['asaas_api_url'] e $config['asaas_api_key'] pelo param.php
//Esta sendo feita uma consulta no banco de dados e puxando com pdo
// include('parameters.php');

// // Acessa as variáveis de ambiente
// $recaptcha_key = $config['recaptcha_token'];

// Caso prefira o .env apenas descomente o codigo e comente o "include('parameters.php');" acima
// Carrega as variáveis de ambiente do arquivo .env
require dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/back-end/functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$client = new GuzzleHttp\Client();

// Acessa as variáveis de ambiente
$config['asaas_api_url'] = $_ENV['ASAAS_API_URL'];
$config['asaas_api_key'] = $_ENV['ASAAS_API_KEY'];

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

makeDonation($dataForm, $config);

$response = array(
    'status' => 200,
    'message' => 'Requisição processada com sucesso.'
);

return json_encode($response);

function makeDonation($dataForm, $config){

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
                } else {
                    $payment_id = asaas_CriarCobrancaBoleto($customer_id, $dataForm, $config);
                }
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
}
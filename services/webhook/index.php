<?php
require '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->load();

// Acessa as variáveis de ambiente
$recaptcha_key = $_ENV['RECAPTCHA_CHAVE_DE_SITE'];
$groupName = $_ENV['GROUPNAME'];

session_start();
ob_start();
include('../../config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capture the incoming webhook data
    $data = json_decode(file_get_contents("php://input"), true);

    // Perform actions based on the data
    if ($data) {
        // Verifica se o campo groupName está presente e se é igual a variável $groupName
        if (isset($data["payment"]['groupName']) && $data["payment"]['groupName'] === $groupName) {
            $event = $data["event"] ? $data["event"] : NULL;
            $payment_id = isset($data["payment"]["id"]) ? $data["payment"]["id"] : NULL;
            $payment_date_created = isset($data["payment"]["dateCreated"]) ? $data["payment"]["dateCreated"] : NULL;
            $customer_id = isset($data["payment"]["customer"]) ? $data["payment"]["customer"] : NULL;
            $subscription_id = isset($data["payment"]["subscription"]) ? $data["payment"]["subscription"] : NULL;
            $value = isset($data["payment"]["value"]) ? $data["payment"]["value"] : NULL;
            $net_value = isset($data["payment"]["netValue"]) ? $data["payment"]["netValue"] : NULL;
            $description = isset($data["payment"]["description"]) ? $data["payment"]["description"] : NULL;
            $billing_type = isset($data["payment"]["billingType"]) ? $data["payment"]["billingType"] : NULL;
            $confirmed_date = isset($data["payment"]["confirmedDate"]) ? $data["payment"]["confirmedDate"] : NULL;
            $credit_card_number = isset($data["payment"]["creditCard"]["creditCardNumber"]) ? $data["payment"]["creditCard"]["creditCardNumber"] : NULL;
            $credit_card_brand = isset($data["payment"]["creditCard"]["creditCardBrand"]) ? $data["payment"]["creditCard"]["creditCardBrand"] : NULL;
            $credit_card_token = isset($data["payment"]["creditCard"]["creditCardToken"]) ? $data["payment"]["creditCard"]["creditCardToken"] : NULL;
            $status = isset($data["payment"]["status"]) ? $data["payment"]["status"] : NULL;
            $credit_date = isset($data["payment"]["creditDate"]) ? $data["payment"]["creditDate"] : NULL;
            $estimated_credit_date = isset($data["payment"]["estimatedCreditDate"]) ? $data["payment"]["estimatedCreditDate"] : NULL;

            // TENTA IDENTIFICAR A TRANSAÇÃO PELO ID, SE ENCONTRAR EXECUTA O UPDATE, SENÃO EXECUTA O CREATE
            // Tabela que sera feita a consulta
            $tabela = "tb_transacoes";
            $sql = "SELECT event, payment_date_created, value, net_value, confirmed_date, credit_card_number, credit_card_brand, credit_card_token, status, credit_date, estimated_credit_date FROM $tabela WHERE payment_id = :payment_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':payment_id', $payment_id);
            $stmt->execute();
            $transacao = $stmt->fetch(PDO::FETCH_ASSOC);

            if($transacao) {
                // Atualize o item no banco de dados
                $sql = "UPDATE $tabela SET event = :event, payment_date_created = :payment_date_created, value = :value, net_value = :net_value, confirmed_date = :confirmed_date, credit_card_number = :credit_card_number, credit_card_brand = :credit_card_brand, credit_card_token = :credit_card_token, status = :status, credit_date = :credit_date, estimated_credit_date = :estimated_credit_date WHERE payment_id = :payment_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':event', $event);
                $stmt->bindParam(':payment_date_created', $payment_date_created);
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':net_value', $net_value);
                $stmt->bindParam(':confirmed_date', $confirmed_date);
                $stmt->bindParam(':credit_card_number', $credit_card_number);
                $stmt->bindParam(':credit_card_brand', $credit_card_brand);
                $stmt->bindParam(':credit_card_token', $credit_card_token);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':credit_date', $credit_date);
                $stmt->bindParam(':estimated_credit_date', $estimated_credit_date);
                $stmt->bindParam(':payment_id', $payment_id);

                $stmt->execute();
                return false;

            } else {
                // CREATE
                $sql = "INSERT INTO $tabela (event, payment_id, payment_date_created, customer_id, subscription_id, value, net_value, description, billing_type, confirmed_date, credit_card_number, credit_card_brand, credit_card_token, status, credit_date, estimated_credit_date) VALUES (:event, :payment_id, :payment_date_created, :customer_id, :subscription_id, :value, :net_value, :description, :billing_type, :confirmed_date, :credit_card_number, :credit_card_brand, :credit_card_token, :status, :credit_date, :estimated_credit_date)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':event', $event, PDO::PARAM_STR);
                $stmt->bindParam(':payment_id', $payment_id, PDO::PARAM_STR);
                $stmt->bindParam(':payment_date_created', $payment_date_created, PDO::PARAM_STR);
                $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
                $stmt->bindParam(':subscription_id', $subscription_id, PDO::PARAM_STR);
                $stmt->bindParam(':value', $value, PDO::PARAM_STR);
                $stmt->bindParam(':net_value', $net_value, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':billing_type', $billing_type, PDO::PARAM_STR);
                $stmt->bindParam(':confirmed_date', $confirmed_date, PDO::PARAM_STR);
                $stmt->bindParam(':credit_card_number', $credit_card_number, PDO::PARAM_STR);
                $stmt->bindParam(':credit_card_brand', $credit_card_brand, PDO::PARAM_STR);
                $stmt->bindParam(':credit_card_token', $credit_card_token, PDO::PARAM_STR);
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->bindParam(':credit_date', $credit_date, PDO::PARAM_STR);
                $stmt->bindParam(':estimated_credit_date', $estimated_credit_date, PDO::PARAM_STR);

                $stmt->execute();
                return false;
            };
        }
    } else {
        // Handle invalid data or errors
        http_response_code(400); // Bad Request
        return false;
    };
} else {
    echo "Method not allowed.";
    return false;
}
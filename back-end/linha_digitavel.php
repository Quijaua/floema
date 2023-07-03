<?php

function asaas_ObterLinhaDigitavelBoleto($payment_id, $config) {
	include('config.php');

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $config["asaas_api_url"]."/api/v3/payments/$payment_id/identificationField",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'access_token: '.$config["asaas_api_key"]
        )
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $retorno = json_decode($response, true);

    if(!empty($retorno["barCode"])) {

        $tabela = 'tb_doacoes';

        $stmt = $conn->prepare("UPDATE $tabela SET boleto_barCode = :boleto_barCode, boleto_nossoNumero = :boleto_nossoNumero, boleto_identificationField = :boleto_identificationField WHERE payment_id = :payment_id");
        
        // Bind dos parâmetros
        $stmt->bindValue(':boleto_barCode', $retorno['barCode']);
        $stmt->bindValue(':boleto_nossoNumero', $retorno['nossoNumero']);
        $stmt->bindValue(':boleto_identificationField', $retorno['identificationField']);
        $stmt->bindValue(':payment_id', $payment_id);
    
        // Executando o update
        $stmt->execute();

    } else {
        echo $response;
        exit();
    }
}
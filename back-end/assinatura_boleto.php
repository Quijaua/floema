<?php
function asaas_CriarAssinaturaBoleto($customer_id, $dataForm, $config) {
    include('config.php');

    $curl = curl_init();

    $fields = [
        "customer" => $customer_id,
        "billingType" => "BOLETO",
        "description" => "Plano de assinatura",
        "value" => $dataForm["value"],
        "nextDueDate" => date('Y-m-d'),
        "cycle" => $dataForm["inlineRadioOptions"]
    ];

    curl_setopt_array($curl, array(
        CURLOPT_URL => $config['asaas_api_url'].'subscriptions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'access_token: '.$config['asaas_api_key']
        )
        ));

    $response = curl_exec($curl);

    curl_close($curl);

    $retorno = json_decode($response, true);

	if($retorno['object'] == 'subscription') {

        $tabela = 'tb_doacoes';

        $stmt = $conn->prepare("INSERT INTO $tabela (customer_id, payment_id, valor, forma_pagamento, link_pagamento, status, data_vencimento, cycle, cartao_numero, cartao_bandeira) VALUES (
            :customer_id, :payment_id, :value, :forma_pagamento, :link_pagamento, :status, :data_vencimento, :cycle, :cartao_numero, :cartao_bandeira)");
        
        // Bind dos parâmetros
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        $stmt->bindParam(':payment_id', $retorno['id'], PDO::PARAM_STR);
        $stmt->bindParam(':value', $retorno['value'], PDO::PARAM_STR);
        $stmt->bindParam(':forma_pagamento', $retorno['billingType'], PDO::PARAM_STR);
        $stmt->bindParam(':link_pagamento', $retorno['invoiceUrl'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $retorno['status'], PDO::PARAM_STR);
        $stmt->bindParam(':data_vencimento', $vencimento, PDO::PARAM_STR);
        $stmt->bindParam(':cycle', $retorno['cycle'], PDO::PARAM_STR);
        $stmt->bindParam(':cartao_numero', $retorno['creditCard']['creditCardNumber'], PDO::PARAM_STR);
        $stmt->bindParam(':cartao_bandeira', $retorno['creditCard']['creditCardBrand'], PDO::PARAM_STR);
    
        // Executando o update
        $stmt->execute();

		return $retorno['id'];
	} else {
		echo $response;
		exit();
	}
}
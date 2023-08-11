<?php

function asaas_CriarCliente($dataForm, $config) {

	include('config.php');

	//removendo campos que não serão usados para incluir o cliente
	unset($dataForm['value']);

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $config['asaas_api_url'].'/api/v3/customers',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($dataForm),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'access_token: '.$config['asaas_api_key']
		)
	));
	$response = curl_exec($curl);
	curl_close($curl);

	$retorno = json_decode($response, true);

	if($retorno['object'] == 'customer') {

		$tabela = 'tb_clientes';

		$stmt = $conn->prepare("INSERT INTO $tabela (nome, email, phone, cpf, cep, endereco, numero, complemento, municipio, cidade, uf, asaas_id) VALUES (
			:name, :email, :phone, :cpfCnpj, :postalCode, :address, :addressNumber, :complement, :province, :city, :state, :id)");
		
		// Bind dos parâmetros
		$stmt->bindParam(':name', $retorno['name'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $retorno['email'], PDO::PARAM_STR);
		$stmt->bindParam(':phone', $retorno['phone'], PDO::PARAM_STR);
		$stmt->bindParam(':cpfCnpj', $retorno['cpfCnpj'], PDO::PARAM_STR);
		$stmt->bindParam(':postalCode', $retorno['postalCode'], PDO::PARAM_STR);
		$stmt->bindParam(':address', $retorno['address'], PDO::PARAM_STR);
		$stmt->bindParam(':addressNumber', $retorno['addressNumber'], PDO::PARAM_INT);
		$stmt->bindParam(':complement', $retorno['complement'], PDO::PARAM_STR);
		$stmt->bindParam(':province', $retorno['province'], PDO::PARAM_STR);
		$stmt->bindParam(':city', $retorno['city'], PDO::PARAM_STR);
		$stmt->bindParam(':state', $retorno['state'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $retorno['id'], PDO::PARAM_STR);

		// Executando o update
		$stmt->execute();

		return $retorno['id'];
	} else {
		echo $response;
		exit();
	}

}
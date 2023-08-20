<?php
	// //Parametros
	// //Atualmente esta chamando $config['asaas_api_url'] e $config['asaas_api_key'] pelo param.php
	// //Esta sendo feita uma consulta no banco de dados e puxando com pdo
	// include('./back-end/parameters.php');

	// // Acessa as variáveis de ambiente
	// $recaptcha_key = $config['recaptcha_chave_de_site'];

	// Caso prefira o .env apenas descomente o codigo e comente o "include('parameters.php');" acima
	// Carrega as variáveis de ambiente do arquivo .env
	require __DIR__.'/vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	// Acessa as variáveis de ambiente
	$recaptcha_key = $_ENV['RECAPTCHA_CHAVE_DE_SITE'];

    session_start();
    ob_start();
    include('./config.php');

    // Tabela que sera feita a consulta
    $tabela = "tb_checkout";

    // ID que você deseja pesquisar
    $id = 1;

    // Consulta SQL
    $sql = "SELECT * FROM $tabela WHERE id = :id";

    // Preparar a consulta
    $stmt = $conn->prepare($sql);

    // Vincular o valor do parâmetro
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado como um array associativo
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o resultado foi encontrado
    if ($resultado) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $nome = $resultado['nome'];
        $logo = $resultado['logo'];
        $title = $resultado['title'];
        $descricao = $resultado['descricao'];
        $privacidade = $resultado['privacidade'];
        $faq = $resultado['faq'];
        $facebook = $resultado['facebook'];
        $instagram = $resultado['instagram'];
        $linkedin = $resultado['linkedin'];
        $youtube = $resultado['youtube'];
        $website = $resultado['website'];
        $cep = $resultado['cep'];
        $rua = $resultado['rua'];
        $numero = $resultado['numero'];
        $bairro = $resultado['bairro'];
        $cidade = $resultado['cidade'];
        $estado = $resultado['estado'];
        $telefone = $resultado['telefone'];
        $email = $resultado['email'];
        $color = $resultado['color'];
        $hover = $resultado['hover'];
        $progress = $resultado['progress'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }
?>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title><?php echo ($title !== '') ? $title : 'Colabore com o Projeto '.$nome; ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="<?php echo INCLUDE_PATH; ?>assets/google/fonts/open-sans" rel="stylesheet" type="text/css">
	<link href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
		  type="text/css">
	<link href="<?php echo INCLUDE_PATH; ?>assets/google/fonts/newsreader" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>assets/css/main.css"/>
</head>
<body>


<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 p-3">
				<a href="https://link#fake.com.br/">
					<img src="assets/img/<?php echo $logo; ?>" class="w-75">
				</a>
			</div>
			<div class="col-md-8 mt-4">
				<h1 class="h2">Colabore com o Projeto  <?php echo $nome; ?></h1>
			</div>
		</div>
	</div>
</nav>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-5 mb-3">

			<h3 class="highlight mb-3"> Faça sua doação</h3>
			<div id="div-container-form">
				<form id="form-checkout">
					<div class="mb-3" style="display: flex;justify-content: space-between">
						<div class="form-check form-check-inline">
							<input onclick="setPeriodOption('monthly')" class="form-check-input" type="radio"
								name="inlineRadioOptions" checked="checked" id="inlineRadio1" value="MONTHLY">
							<label class="form-check-label text-default" for="inlineRadio1">Mensal</label>
						</div>
						<div class="form-check form-check-inline">
							<input onclick="setPeriodOption('yearly')" class="form-check-input" type="radio"
								name="inlineRadioOptions" id="inlineRadio2" value="YEARLY">
							<label class="form-check-label text-default" for="inlineRadio2">Anual</label>
						</div>
						<div class="form-check form-check-inline">
							<input onclick="setPeriodOption('once')" class="form-check-input" type="radio"
								name="inlineRadioOptions" id="inlineRadio3" value="ONLY">
							<label class="form-check-label text-default" for="inlineRadio3">Única</label>
						</div>
					</div>
					<div id="donation-monthly-group" class="d-block">
						<div class="d-flex">
							<button type="button" id="button-monthly1" onclick="donationOption(this,'monthly',30,true)"
									class="btn btn-outline-dark button-options">R$ 30
							</button>
							<button type="button" id="button-monthly2" onclick="donationOption(this,'monthly',50,true)"
									class="btn btn-outline-dark button-options option-default-monthly">R$ 50
							</button>
							<button type="button" id="button-monthly3" onclick="donationOption(this,'monthly',100,true)"
									class="btn btn-outline-dark button-options">R$ 100
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-monthly4" onclick="donationOption(this,'monthly',200,true)"
									class="btn btn-outline-dark button-options">R$ 200
							</button>
							<button type="button" id="button-monthly5" onclick="donationOption(this,'monthly',300,true)"
									class="btn btn-outline-dark button-options">R$ 300
							</button>
							<div class="form-floating button-options">
								<input type="text" class="form-control" id="field-other-monthly"
									onfocus="changeLabelOtherOption(this)"
									onblur="donationOtherOption(this,'monthly',true)"
									style="border-color: #000;height: 60px;font-size: 19px;text-align: center;border-radius: 0px;font-family: 'TIActuBeta-ExBold_web', Tahoma, sans-serif;"
									placeholder="Outro">
								<label for="field-other-monthly" class="custom-amount-option-text">OUTRO<BR/>VALOR</label>
							</div>
						</div>
					</div>
					<script>
						function changeLabelOtherOption( ele ) {
							$( ele ).next().html( "OUTRO VALOR" );
						}
					</script>
					<div id="donation-yearly-group" class="d-none">
						<div class="d-flex">
							<button type="button" id="button-yearly1" onclick="donationOption(this,'yearly',120,true)"
									class="btn btn-outline-dark button-options">R$ 120
							</button>
							<button type="button" id="button-yearly2" onclick="donationOption(this,'yearly',240,true)"
									class="btn btn-outline-dark button-options option-default-yearly">R$ 240
							</button>
							<button type="button" id="button-yearly3" onclick="donationOption(this,'yearly',500,true)"
									class="btn btn-outline-dark button-options">R$ 500
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-yearly4" onclick="donationOption(this,'yearly',1000,true)"
									class="btn btn-outline-dark button-options">R$ 1000
							</button>
							<button type="button" id="button-yearly5" onclick="donationOption(this,'yearly',2000,true)"
									class="btn btn-outline-dark button-options">R$ 2000
							</button>
							<div class="form-floating button-options">
								<input type="text" class="form-control" id="field-other-yearly"
									onfocus="changeLabelOtherOption(this)"
									onblur="donationOtherOption(this,'yearly',true)"
									style="border-color: #000;height: 60px;font-size: 19px;text-align: center;border-radius: 0px;    font-family: 'TIActuBeta-ExBold_web', Tahoma, sans-serif;"
									placeholder="Outro">
								<label for="field-other-yearly" class="custom-amount-option-text">OUTRO<BR/>VALOR</label>
							</div>
						</div>
					</div>
					<div id="donation-once-group" class="d-none">
						<div class="d-flex">
							<button type="button" id="button-once1" onclick="donationOption(this,'once',100,true)"
									class="btn btn-outline-dark button-options">R$ 100
							</button>
							<button type="button" id="button-once2" onclick="donationOption(this,'once',200,true)"
									class="btn btn-outline-dark button-options option-default-once">R$ 200
							</button>
							<button type="button" id="button-once3" onclick="donationOption(this,'once',500,true)"
									class="btn btn-outline-dark button-options">R$ 500
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-once4" onclick="donationOption(this,'once',1000,true)"
									class="btn btn-outline-dark button-options">R$ 1000
							</button>
							<button type="button" id="button-once5" onclick="donationOption(this,'once',2000,true)"
									class="btn btn-outline-dark button-options">R$ 2000
							</button>
							<div class="form-floating button-options">
								<input type="text" class="form-control" id="field-other-once"
									onfocus="changeLabelOtherOption(this)" onblur="donationOtherOption(this,'once',true)"
									style="border-color: #000;height: 60px;font-size: 19px;text-align: center;border-radius: 0px;font-family: 'TIActuBeta-ExBold_web', Tahoma, sans-serif;"
									placeholder="Outro">
								<label for="field-other-once" class="custom-amount-option-text">OUTRO<BR/>VALOR</label>
							</div>
						</div>
					</div>

					<div id="div-errors-price" style="display: none"></div>


					<hr/>
					<label class="text-default mb-3">Forma de pagamento</label>
					<div class="form-check">
						<input onclick="setPaymentMethod('credit_card')" class="form-check-input" type="radio"
							checked="checked" name="payment" value="100" id="payment-credit-card">
						<label class="form-check-label payment-button-options" for="payment-credit-card">
							Cartão de Crédito
						</label>
					</div>
					<div class="form-check">
						<input onclick="setPaymentMethod('bank_slip')" class="form-check-input" type="radio"
							name="payment" value="101" id="payment-bank-slip" disabled>
						<label class="form-check-label payment-button-options" for="payment-bank-slip">
							Boleto - <small><i>Apenas para contribuição única</i></small>
						</label>
					</div>
					<div class="form-check">
						<input onclick="setPaymentMethod('Pix')" class="form-check-input" type="radio" name="payment"
							value="102" id="payment-pix" disabled>
						<label class="form-check-label payment-button-options" for="payment-pix">
							PIX - <small><i>Apenas para contribuição única</i></small>
						</label>
					</div>

					<hr/>

					<div class="row">
						<div class="col-md-12 mb-2">
							<div class="form-floating ">
								<input type="email" class="form-control" name="email" id="field-email" placeholder="name@example.com">
								<label for="field-email">Endereço de e-mail</label>
							</div>
						</div>
						<div class="col-md-12 mb-2">
							<div class="form-floating ">
								<input type="phone" class="form-control" name="phone" id="field-phone" placeholder="(00) 98765-4321" maxlength="15">
								<label for="field-phone">Telefone</label>
							</div>
						</div>
						<div class="col-md-6 mb-2">
							<div class="form-floating ">
								<input type="text" class="form-control" name="name" id="field-name" placeholder="Primeiro nome">
								<label for="field-name">Primeiro nome</label>
							</div>
						</div>
						<div class="col-md-6 mb-2">
							<div class="form-floating ">
								<input type="text" class="form-control" name="surname" id="field-surname" placeholder="Sobrenome">
								<label for="field-surname">Sobrenome</label>
							</div>
						</div>
						<div class="col-md-12 mb-2" id="div-cpf-field">
							<div class="form-floating ">
								<input type="text" class="form-control" name="cpfCnpj" id="field-cpf" placeholder="CPF">
								<label for="field-cpf">CPF</label>
							</div>
						</div>

						<div id="bank-slip-fields">
							<div class="row">
								<div class="col-md-12 mb-2">
									<div class="form-floating ">
										<input onblur="getCepData()" type="text" class="form-control" name="postalCode" id="field-zipcode"
											placeholder="CEP endereço">
										<label for="field-zipcode">CEP</label>
									</div>
								</div>
								<div class="col-md-8 mb-2 country-brasil">
									<div class="form-floating ">
										<input type="text" class="form-control" name="address" id="field-street"
											placeholder="Logradouro endereço">
										<label for="field-street">Logradouro</label>
									</div>
								</div>
								<div class="col-md-4 mb-2 country-brasil">
									<div class="form-floating">
										<input type="text" class="form-control text-center" name="addressNumber" id="field-street-number"
											placeholder="Número endereço">
										<label for="field-street-number">Número</label>
									</div>
								</div>
								<div class="col-md-6 mb-2 country-brasil">
									<div class="form-floating ">
										<input type="text" class="form-control" name="province" id="field-district"
											placeholder="Bairro endereço">
										<label for="field-district">Bairro</label>
									</div>
								</div>
								<div class="col-md-6 mb-2 country-brasil">
									<div class="form-floating">
										<input type="text" class="form-control text-left" name="complement" id="field-complement"
											placeholder="Complemento endereço">
										<label for="field-complement">Complemento</label>
									</div>
								</div>
								<div class="col-md-12 mb-2 country-brasil">
									<div class="form-floating">
										<input type="text" class="form-control text-left" name="city" id="field-city"
											placeholder="Cidade endereço">
										<label for="field-city">Cidade</label>
									</div>
								</div>

							</div>
						</div>


						<div id="credit-card-fields">
							<div class="row">
								<div class="col-md-12 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control" name="card-number" id="field-card-number"
											placeholder="Numero cartão">
										<label for="field-card-number">Número do cartão</label>
									</div>
								</div>
								<div class="col-md-12 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control" name="card-name" id="field-card-number"
											placeholder="Numero cartão">
										<label for="field-card-number">Titular do cartão</label>
									</div>
								</div>
								<div class="col-md-8 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control text-center" name="card-expiry" id="field-card-expiration"
											placeholder="Validade">
										<label for="field-card-expiration">Validade</label>
									</div>
								</div>
								<div class="col-md-4 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control text-center" name="card-ccv" id="field-card-cvc"
											placeholder="CVC">
										<label for="field-card-cvc">CVC</label>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="row" id="div-add-on-fee" style="display: none">
						<div class="col-md-12 mb-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="field-add-on-fee"
									onclick="if(lastDonationButtonClicked != null){$(lastDonationButtonClicked).trigger('click').trigger('blur');}">
								<label class="form-check-label" for="field-add-on-fee">
									Adicione + R$ XX para cobrir as tarifas bancárias
								</label>
							</div>
						</div>
					</div>

					<input type="hidden" name="value" id="value">
					<input type="hidden" name="recaptcha_token" id="recaptcha_token">

					<div class="row">
						<div class="col-md-12">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-dark button-confirm-payment">
									Pagar
								</button>
								<div class="progress progress-subscription d-none" role="progressbar" style="height: 50px"
									aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-striped progress-bar-animated progress-active text-dark fw-bold"
										style="width: 100%">Processando requisição...
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6 ms-auto">
			<?php
				// Nome da tabela para a busca
				$tabela = 'tb_imagens';
				
				// Preparando a consulta SQL
				$stmt = $conn->prepare("SELECT * FROM $tabela ORDER BY id DESC");
				
				// Executando a consulta
				$stmt->execute();
				
				// Obtendo os resultados da busca
				$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

				// Consulta SQL para recuperar informações das tabelas
				$sql = "SELECT COUNT(id) FROM $tabela";
				$stmt = $conn->query($sql);
				
				// Obter o número de linhas
				$numLinhas = $stmt->fetchColumn();
				
				// Consulta SQL para selecionar todas as colunas
				$sql = "SELECT * FROM $tabela";
				
				// Preparar e executar a consulta
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				
				// Recuperar os resultados
				$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				// Loop através dos resultados e exibir todas as colunas
				foreach ($resultados as $usuario) {
					echo '
						<div class="row mb-3">
							<div class="col-md-10 mt-3">
								<img src="'. INCLUDE_PATH .'assets/img/' . $usuario['imagem'] . '" alt="Card ' . $usuario['id'] . '" style="width: 500px; height: 159px; object-fit: contain;" />
							</div>
						</div>
					';
				}
			?>
			<p class="col-md-10 text-block" id="text-block-content"><?php echo $descricao; ?></div>
		</div>
	</div>
</main>

<footer>
 <div class="container mt-5">
	<div class="row">
		<div class="col-md-4">
			<span class="h5"><?php echo $nome; ?></span><br />
			<?php echo $rua; ?><?php echo ($numero !== '') ? ', ' . $numero : ''; ?> - <?php echo $bairro; ?><br />
			<?php echo $cidade; ?> - <?php echo $estado; ?>, <?php echo $cep; ?><br />
			Telefone: <a href="callto:<?php echo $telefone; ?>"><?php echo $telefone; ?></a> | E-mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br />
		</div>
		<div class="col-md-8">
			<div class="social-net mt-4 mb-4">
				<a href="<?php echo ($facebook !== '') ? $facebook : '#'; ?>" <?php echo ($facebook == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-facebook p-2"></i></a>
				<a href="<?php echo ($instagram !== '') ? $instagram : '#'; ?>" <?php echo ($instagram == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-instagram p-2"></i></a>
				<a href="<?php echo ($linkedin !== '') ? $linkedin : '#'; ?>" <?php echo ($linkedin == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-linkedin p-2"></i></a>
				<a href="<?php echo ($youtube !== '') ? $youtube : '#'; ?>" <?php echo ($youtube == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-youtube p-2"></i></a>
				<a href="<?php echo ($website !== '') ? $website : '#'; ?>" <?php echo ($website == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-globe-americas p-2"></i></a>
			</div>
			<p class="footer-link ps-1">
				<a href="<?php echo $privacidade; ?>" rel="noopener noreferrer" target="_blank">
					PRIVACIDADE DOS DOADORES
				</a>
				 | 
				<a href="<?php echo $faq; ?>" rel="noopener noreferrer" target="_blank">
					PERGUNTAS FREQUENTES
				</a>
			</p>
		</div>
	</div>
 </div>
</footer>

<style>
	.social-net a {color:#000}
	.bi {font-size:32px}
</style>

<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/1.10.5/font/bootstrap-icons.css">

<script src="<?php echo INCLUDE_PATH; ?>assets/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/ajax/3.6.3/jquery.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/google/jquery/1.12.1/jquery-ui.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/ajax/1.14.16/jquery.mask.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/js/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$recaptcha_key?>"></script>
<script>
	// Captura do evento de submit do formulário
    $('#form-checkout').submit(function(event) {
        event.preventDefault();

        if(!validateFields()) return;

		var dataForm = this;

		// Faz a validação do reCAPTCHA
		grecaptcha.ready(function() {
			// Insira a chave do site do reCAPTCHA no método execute()
			grecaptcha.execute('<?=$recaptcha_key?>', { action: 'submit' }).then(function(token) {
			// Obtém o token do reCAPTCHA

				var typePayment = $('input[name="payment"]:checked').val();
				localStorage.setItem("method", typePayment);
				method = localStorage.getItem("method");

				//Botão carregando
				$(".progress-subscription").addClass('d-flex').removeClass('d-none');
				$(".button-confirm-payment").addClass('d-none').removeClass('d-block');

				//Adicionar valor ao input valor
				document.getElementById('value').value = donationAmount;
				//Adicionar token ao input reCAPTCHA
				document.getElementById('recaptcha_token').value = token;

				// Requisição AJAX para o arquivo de criação do cliente
				$.ajax({
					url: '<?php echo INCLUDE_PATH; ?>back-end/subscription.php',
					method: 'POST',
					data: {method: method, params: btoa($(dataForm).serialize())},
					dataType: 'JSON'
				})
				.done(function(response) {
					if (response.status == 200) {
						//Remove botão carregando
						$(".progress-subscription").addClass('d-none').removeClass('d-flex');
						$(".button-confirm-payment").addClass('d-block').removeClass('d-none');

						var encodedCode = btoa(response.code);
						var customerId = btoa(response.id);

						$.ajax({
							url: '<?php echo INCLUDE_PATH; ?>back-end/sql.php',
							method: 'POST',
							data: {encodedCode: encodedCode},
							dataType: 'JSON'
						})
						.done(function(data) {
							printPaymentData(data);



							$.ajax({
								url: '<?php echo INCLUDE_PATH_ADMIN; ?>back-end/magic-link.php',
								method: 'POST',
								data: {customerId: customerId},
								dataType: 'JSON'
							})
							.done(function(data) {
								console.log(data.msg);
							})
						})
					}
				})
			});
		});
	});
</script>
<script>
	// Seleciona o elemento <html> (ou qualquer outro elemento de nível superior)
	const root = document.documentElement;
	const color = "<?php echo $color; ?>";
	const hover = "<?php echo $hover; ?>";
	const progress = "<?php echo $progress; ?>";

	// Altera o valor da variável --background-color
	root.style.setProperty('--primary-color', color);
	root.style.setProperty('--hover-color', hover);
	root.style.setProperty('--progress-color', progress);
</script>
</body>
</html>

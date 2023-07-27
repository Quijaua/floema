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
?>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title>Colabore com o Projeto Floema</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


	<link href="//fonts.googleapis.com/css?family=Open+Sans:100,300,400,600,700" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		  type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200;0,6..72,300;0,6..72,400;0,6..72,500;1,6..72,200;1,6..72,300;1,6..72,400&display=swap"
		  rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
</head>
<body>


<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 p-3">
				<a href="https://link#fake.com.br/">
					<img src="assets/img/disu.png" class="w-75">
				</a>
			</div>
			<div class="col-md-8 mt-4">
				<h1 class="h2">Colabore com o Projeto Floema</h1>
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
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark fw-bold"
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


			<div class="row mb-3">
				<div class="col-md-6 mt-3">
					<img src="assets/img/cta-1.webp" alt="" title="" />
				</div>
			</div>

			<div>
				<p class="text-block" id="text-block2-content"></div>

		</div>


	</div>
</main>


<footer>
 <div class="container mt-5">
	<div class="row">
		<div class="col-md-4">
			<span class="h5">Projeto Floema</span><br />
			Rua Exemplo Nome da Rua, 999<br />
			Centro, São Paulo - SP<br />
			Telefone: (11) 9999-9999| E-mail: <a href="mailto:suainstitucao@email.org.br">suainstitucao@email.org.br</a><br />
		</div>
		<div class="col-md-8">
			<div class="social-net mt-4 mb-4">
				<a href="#"><i class="bi bi-facebook p-2"></i></a>
				<a href="#"><i class="bi bi-instagram p-2"></i></a>
				<a href="#"><i class="bi bi-linkedin p-2"></i></a>
				<a href="#"><i class="bi bi-youtube p-2"></i></a>
				<a href="#"><i class="bi bi-globe-americas p-2"></i></a>
			</div>
			<p class="footer-link ps-1" id="footer-links">
				<!-- <a href="#" rel="noopener noreferrer">
					PRIVACIDADE DOS DOADORES
				</a>
				<a href="#" rel="noopener noreferrer">
					PERGUNTAS FREQUENTES
				</a> -->
			</p>
		</div>
	</div>
 </div>
</footer>

<style>
	.social-net a {color:#000}
	.bi {font-size:32px}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
		integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/main.js"></script>
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
					url: './back-end/subscription.php',
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

						$.ajax({
							url: './back-end/sql.php',
							method: 'POST',
							data: {encodedCode: encodedCode},
							dataType: 'JSON'
						})
						.done(function(data) {
							printPaymentData(data);
						})
					}
				})
			});
		});
    });
</script>

</body>
</html>

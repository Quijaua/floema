<?php
	// //Parametros
	// //Atualmente esta chamando $config['asaas_api_url'] e $config['asaas_api_key'] pelo param.php
	// //Esta sendo feita uma consulta no banco de dados e puxando com pdo
	// include('./back-end/parameters.php');

	// Caso prefira o .env apenas descomente o codigo e comente o "include('parameters.php');" acima
	// Carrega as variáveis de ambiente do arquivo .env
	require __DIR__.'/vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	// Acessa as variáveis de ambiente
	$hcaptcha = $_ENV['HCAPTCHA_CHAVE_DE_SITE'];

    session_start();
    ob_start();
    include('./config.php');

    // Tabela que sera feita a consulta
    $tabela = "tb_checkout";
	$tabela_2 = "tb_integracoes";
	$tabela_3 = "tb_mensagens";

    // ID que você deseja pesquisar
    $id = 1;

    // Consulta SQL
    $sql = "SELECT * FROM $tabela WHERE id = :id";
	$sql_2 = "SELECT * FROM $tabela_2 WHERE id = :id";
	$sql_3 = "SELECT use_privacy FROM $tabela_3 WHERE id = :id";

    // Preparar a consulta
    $stmt = $conn->prepare($sql);
	$stmt_2 = $conn->prepare($sql_2);
	$stmt_3 = $conn->prepare($sql_3);

    // Vincular o valor do parâmetro
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt_3->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a consulta
    $stmt->execute();
	$stmt_2->execute();
	$stmt_3->execute();

    // Obter o resultado como um array associativo
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
	$resultado_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
	$resultado_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);

    // Verificar se o resultado foi encontrado
    if ($resultado) {
        // Atribuir o valor da coluna à variável, ex.: "nome" = $nome
        $nome = $resultado['nome'];
        $logo = $resultado['logo'];
        $title = $resultado['title'];
        $descricao = $resultado['descricao'];
        $privacidade = $resultado['privacidade'];
        $faq = $resultado['faq'];
		$use_faq = $resultado['use_faq'];
        $facebook = $resultado['facebook'];
        $instagram = $resultado['instagram'];
        $linkedin = $resultado['linkedin'];
        $twitter = $resultado['twitter'];
        $youtube = $resultado['youtube'];
        $website = $resultado['website'];
		$tiktok = $resultado['tiktok'];
		$linktree = $resultado['linktree'];
        $cep = $resultado['cep'];
        $rua = $resultado['rua'];
        $numero = $resultado['numero'];
        $bairro = $resultado['bairro'];
        $cidade = $resultado['cidade'];
        $estado = $resultado['estado'];
        $telefone = $resultado['telefone'];
        $email = $resultado['email'];
        $nav_color = $resultado['nav_color'];
        $nav_background = $resultado['nav_background'];
        $background = $resultado['background'];
        $text_color = $resultado['text_color'];
        $color = $resultado['color'];
        $hover = $resultado['hover'];
        $progress = $resultado['progress'];
		$monthly_1 = $resultado['monthly_1'];
        $monthly_2 = $resultado['monthly_2'];
        $monthly_3 = $resultado['monthly_3'];
        $monthly_4 = $resultado['monthly_4'];
        $monthly_5 = $resultado['monthly_5'];
        $yearly_1 = $resultado['yearly_1'];
        $yearly_2 = $resultado['yearly_2'];
        $yearly_3 = $resultado['yearly_3'];
        $yearly_4 = $resultado['yearly_4'];
        $yearly_5 = $resultado['yearly_5'];
        $once_1 = $resultado['once_1'];
        $once_2 = $resultado['once_2'];
        $once_3 = $resultado['once_3'];
        $once_4 = $resultado['once_4'];
        $once_5 = $resultado['once_5'];
    } else {
        // ID não encontrado ou não existente
        echo "ID não encontrado.";
    }

	// Verificar se o resultado_2 foi encontrado
	if ($resultado_2) {
		// Atribuir o valor da coluna à variável, ex.: "nome" = $nome
		$fb_pixel = $resultado_2['fb_pixel'];
		$gtm = $resultado_2['gtm'];
		$g_analytics = $resultado_2['g_analytics'];
	} else {
		// ID não encontrado ou não existente
		echo "ID não encontrado.";
	}

	// Verificar se o resultado_3 foi encontrado
	if ($resultado_3) {
		// Atribuir o valor da coluna à variável, ex.: "nome" = $nome
		$use_privacy = $resultado_3['use_privacy'];
	} else {
		// ID não encontrado ou não existente
		echo "ID não encontrado.";
	}
?>
<?php
	$donationButtons = array(
		"donationMonthlyButton1" => array("amount" => $monthly_1, "display" => "R$ $monthly_1", "showAddOnFee" => true),
		"donationMonthlyButton2" => array("amount" => $monthly_2, "display" => "R$ $monthly_2", "showAddOnFee" => true),
		"donationMonthlyButton3" => array("amount" => $monthly_3, "display" => "R$ $monthly_3", "showAddOnFee" => true),
		"donationMonthlyButton4" => array("amount" => $monthly_4, "display" => "R$ $monthly_4", "showAddOnFee" => true),
		"donationMonthlyButton5" => array("amount" => $monthly_5, "display" => "R$ $monthly_5", "showAddOnFee" => true),
	
		"donationYearlyButton1" => array("amount" => $yearly_1, "display" => "R$ $yearly_1", "showAddOnFee" => true),
		"donationYearlyButton2" => array("amount" => $yearly_2, "display" => "R$ $yearly_2", "showAddOnFee" => true),
		"donationYearlyButton3" => array("amount" => $yearly_3, "display" => "R$ $yearly_3", "showAddOnFee" => true),
		"donationYearlyButton4" => array("amount" => $yearly_4, "display" => "R$ $yearly_4", "showAddOnFee" => true),
		"donationYearlyButton5" => array("amount" => $yearly_5, "display" => "R$ $yearly_5", "showAddOnFee" => true),
	
		"donationOnceButton1" => array("amount" => $once_1, "display" => "R$ $once_1", "showAddOnFee" => true),
		"donationOnceButton2" => array("amount" => $once_2, "display" => "R$ $once_2", "showAddOnFee" => true),
		"donationOnceButton3" => array("amount" => $once_3, "display" => "R$ $once_3", "showAddOnFee" => true),
		"donationOnceButton4" => array("amount" => $once_4, "display" => "R$ $once_4", "showAddOnFee" => true),
		"donationOnceButton5" => array("amount" => $once_5, "display" => "R$ $once_5", "showAddOnFee" => true),
	);
	
	$addOnFeeValues = array(
		"creditCard" => array("fix" => 0, "percent" => 5),
		"bankSlip" => array("fix" => 3, "percent" => 5),
		"pix" => array("fix" => 0, "percent" => 5),
	);
	
	$minOnceDonation = array(
		"creditCard" => 10,
		"bankSlip" => 10,
		"pix" => 10,
	);
	
	$jsonData = array(
		"donationButtons" => $donationButtons,
		"addOnFeeValues" => $addOnFeeValues,
		"minOnceDonation" => $minOnceDonation,
	);
?>
<!DOCTYPE html><html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<title><?php echo ($title !== '') ? $title : 'Colabore com o Projeto '.$nome; ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="<?php echo INCLUDE_PATH; ?>assets/google/fonts/open-sans" rel="stylesheet" type="text/css">
	<link href="<?php echo INCLUDE_PATH; ?>assets/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
		  type="text/css">


	<link href="<?php echo INCLUDE_PATH; ?>assets/google/fonts/newsreader" rel="stylesheet">

<link rel="icon" href="<?php echo INCLUDE_PATH; ?>assets/img/favicon.png" sizes="32x32" />
<link rel="apple-touch-icon" href="<?php echo INCLUDE_PATH; ?>assets/img/favicon.png" />
<meta name="msapplication-TileImage" content="<?php echo INCLUDE_PATH; ?>assets/img/favicon.png" />

<!-- hCaptcha -->
<script src="https://hcaptcha.com/1/api.js" async defer></script>


<link rel="canonical" href="<?php echo INCLUDE_PATH; ?>" />
<meta property="og:locale" content="pt_BR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:description" name="description" content="<?php echo mb_strimwidth($descricao, 3, 120, '...'); ?>" />
<meta property="og:url" value="<?php echo INCLUDE_PATH; ?>"/>
<meta property="og:site_name" content="<?php echo $nome; ?>" />
<meta property="article:modified_time" content="2022-12-01T18:38:06+00:00" />
<meta property="og:image" content="<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>"/>
<meta property="og:image" value="<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>"/>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@FloemaDoar" />
<meta name="twitter:title" value="<?php echo $title; ?>"/>
<meta name="twitter:url" value="<?php echo INCLUDE_PATH; ?>"/>
<meta name="twitter:image" value="<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>"/>
<meta name="twitter:image" content="<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>"/>
<meta name="twitter:description" value="<?php echo mb_strimwidth($descricao, 3, 120, '...'); ?>"/>


<script type="application/ld+json">{
	"@context": "https://schema.org",
	"@graph": [
		{
			"@type": "WebSite",
			"@id": "<?php echo INCLUDE_PATH; ?>",
			"url": "<?php echo INCLUDE_PATH; ?>",
			"name": "<?php echo $title; ?>",
			"isPartOf": {
				"@id": "<?php echo INCLUDE_PATH; ?>#website"
			},
			"datePublished": "2023-03-02T19:50:30+00:00",
			"dateModified": "2023-03-21T12:51:52+00:00",
			"description": "<?php echo mb_strimwidth($descricao, 3, 120, '...'); ?>",
			"inLanguage": "pt-BR",
			"interactAction": [
				{
					"@type": "SubscribeAction",
					"target": [
						"<?php echo INCLUDE_PATH; ?>"
					]
				}
			]
		},
		{
			"@type": "Organization",
			"@id": "<?php echo INCLUDE_PATH; ?>#organization",
			"name": "<?php echo $nome; ?>",
			"url": "<?php echo INCLUDE_PATH; ?>",
			"logo": {
				"@type": "ImageObject",
				"inLanguage": "pt-BR",
				"@id": "<?php echo INCLUDE_PATH; ?>#/schema/logo/image/",
				"url": "<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>",
				"contentUrl": "<?php echo INCLUDE_PATH; ?>assets/img/<?php echo $logo; ?>",
				"width": 140,
				"height": 64,
				"caption": "<?php echo $nome; ?>"
			},
			"image": {
				"@id": "<?php echo INCLUDE_PATH; ?>#/schema/logo/image/"
			}
		}
	]
}</script>

	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>assets/css/main.css"/>

	<?php echo $fb_pixel; ?>

	<?php echo $gtm; ?>
	
	<?php echo $g_analytics; ?>
</head>
<body>


<nav class="navbar-disable navbar-expand-md navbar-dark" style="background-color: <?php echo $nav_background; ?>; color: <?php echo $nav_color; ?>;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 p-1 text-center">
				<img src="assets/img/<?php echo $logo; ?>">
			</div>
			<div class="col-md-8 mt-4 p-md-3 text-center">
				<h1 class="h1"><?php echo ($title !== '') ? $title : 'Colabore com o Projeto '.$nome; ?></h1>
			</div>
		</div>
	</div>
</nav>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-5 mb-3">

			<h3 class="highlight mb-3 text-center" id="highlight">Faça sua doação</h3>
			<div id="div-container-form">
				<form id="form-checkout" action="submit">
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
							<button type="button" id="button-monthly1" onclick="donationOption(this,'monthly',<?php echo $monthly_1; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $monthly_1; ?>">R$ <?php echo $monthly_1; ?>
							</button>
							<button type="button" id="button-monthly2" onclick="donationOption(this,'monthly',<?php echo $monthly_2; ?>,true)"
									class="btn btn-outline-dark button-options option-default-monthly" data-amount-for-selection="<?php echo $monthly_2; ?>">R$ <?php echo $monthly_2; ?>
							</button>
							<button type="button" id="button-monthly3" onclick="donationOption(this,'monthly',<?php echo $monthly_3; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $monthly_3; ?>">R$ <?php echo $monthly_3; ?>
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-monthly4" onclick="donationOption(this,'monthly',<?php echo $monthly_4; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $monthly_4; ?>">R$ <?php echo $monthly_4; ?>
							</button>
							<button type="button" id="button-monthly5" onclick="donationOption(this,'monthly',<?php echo $monthly_5; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $monthly_5; ?>">R$ <?php echo $monthly_5; ?>
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
							<button type="button" id="button-yearly1" onclick="donationOption(this,'yearly',<?php echo $yearly_1; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $yearly_1; ?>">R$ <?php echo $yearly_1; ?>
							</button>
							<button type="button" id="button-yearly2" onclick="donationOption(this,'yearly',<?php echo $yearly_2; ?>,true)"
									class="btn btn-outline-dark button-options option-default-yearly" data-amount-for-selection="<?php echo $yearly_2; ?>">R$ <?php echo $yearly_2; ?>
							</button>
							<button type="button" id="button-yearly3" onclick="donationOption(this,'yearly',<?php echo $yearly_3; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $yearly_3; ?>">R$ <?php echo $yearly_3; ?>
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-yearly4" onclick="donationOption(this,'yearly',<?php echo $yearly_4; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $yearly_4; ?>">R$ <?php echo $yearly_4; ?>
							</button>
							<button type="button" id="button-yearly5" onclick="donationOption(this,'yearly',<?php echo $yearly_5; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $yearly_5; ?>">R$ <?php echo $yearly_5; ?>
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
							<button type="button" id="button-once1" onclick="donationOption(this,'once',<?php echo $once_1; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $once_1; ?>">R$ <?php echo $once_1; ?>
							</button>
							<button type="button" id="button-once2" onclick="donationOption(this,'once',<?php echo $once_2; ?>,true)"
									class="btn btn-outline-dark button-options option-default-once" data-amount-for-selection="<?php echo $once_2; ?>">R$ <?php echo $once_2; ?>
							</button>
							<button type="button" id="button-once3" onclick="donationOption(this,'once',<?php echo $once_3; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $once_3; ?>">R$ <?php echo $once_3; ?>
							</button>
						</div>
						<div class="d-flex">
							<button type="button" id="button-once4" onclick="donationOption(this,'once',<?php echo $once_4; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $once_4; ?>">R$ <?php echo $once_4; ?>
							</button>
							<button type="button" id="button-once5" onclick="donationOption(this,'once',<?php echo $once_5; ?>,true)"
									class="btn btn-outline-dark button-options" data-amount-for-selection="<?php echo $once_5; ?>">R$ <?php echo $once_5; ?>
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
						<!--<input onclick="setPaymentMethod('bank_slip')" class="form-check-input" type="radio"
							name="payment" value="101" id="payment-bank-slip" disabled>-->
						<input onclick="setPaymentMethod('bank_slip')" class="form-check-input" type="radio"
							name="payment" value="101" id="payment-bank-slip">
						<label class="form-check-label payment-button-options" for="payment-bank-slip">
							Boleto<!-- - <small><i>Apenas para contribuição única</i></small>-->
						</label>
					</div>
					<div class="form-check">
						<!-- <input onclick="setPaymentMethod('Pix')" class="form-check-input" type="radio" name="payment"
							value="102" id="payment-pix" disabled> -->
						<input onclick="setPaymentMethod('Pix')" class="form-check-input" type="radio" name="payment"
							value="102" id="payment-pix">
						<label class="form-check-label payment-button-options" for="payment-pix">
							PIX<!-- - <small><i>Apenas para contribuição única</i></small> -->
						</label>
					</div>

					<hr/>

					<div class="row">
						<div class="col-md-12 mb-2">
							<div class="form-floating ">
								<input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com">
								<label for="email">Endereço de e-mail</label>
							</div>
						</div>
						<div class="col-md-12 mb-2">
							<div class="form-floating ">
								<input type="email" class="form-control" name="eee" id="field-email" placeholder="nome@exemplo.com">
								<label for="field-email">Endereço de e-mail</label>
							</div>
						</div>
						<div class="col-md-12 mb-2">
							<div class="form-floating ">
								<input type="phone" class="form-control" name="phone" id="field-phone" placeholder="(99) 99999-9999" maxlength="15">
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
								<div class="col-md-8 mb-2 country-brasil">
									<div class="form-floating">
										<input type="text" class="form-control text-left" name="city" id="field-city"
											placeholder="Cidade endereço">
										<label for="field-city">Cidade</label>
									</div>
								</div>
								<div class="col-md-4 mb-2 country-brasil">
									<div class="form-floating">
										<input type="text" class="form-control text-left" name="state" id="field-state"
											placeholder="UF">
										<label for="field-state">UF</label>
									</div>
								</div>
							</div>
						</div>


						<div id="credit-card-fields">
							<div class="row">
								<div class="col-md-12 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control" name="card-number" id="field-card-number"
											placeholder="XXXX XXXX XXXX XXXX">
										<label for="field-card-number">Número do cartão</label>
									</div>
								</div>
								<div class="col-md-12 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control" name="card-name" id="field-card-number"
											placeholder="Marcelo h Almeida">
										<label for="field-card-number">Titular do cartão</label>
									</div>
								</div>
								<div class="col-md-8 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control text-center" name="card-expiry" id="field-card-expiration"
											placeholder="MM/AA">
										<label for="field-card-expiration">Validade</label>
									</div>
								</div>
								<div class="col-md-4 mb-2">
									<div class="form-floating">
										<input type="text" class="form-control text-center" name="card-ccv" id="field-card-cvc"
											placeholder="CVC" autocomplete="off" />
										<label for="field-card-cvc">CVC</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 mb-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="private" name="private">
								<label class="form-check-label" for="private">
									Fazer doação anonimamente
								</label>
							</div>
						</div>
						<div class="col-md-12 mb-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="newsletter" name="newsletter">
								<label class="form-check-label" for="newsletter">
									Quero receber divulgações e comunicações por e-mail
								</label>
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

					<div class="h-captcha" data-sitekey="<?php echo $hcaptcha; ?>"></div>

					<input type="hidden" name="value" id="value">

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
		<div class="col-md-6 ms-auto info-site">
            <?php
                // Nome da tabela para a busca
                $tabela = 'tb_transacoes';
                // Preparando as consultas SQL
                $stmt_geral = $conn->prepare("SELECT COUNT(*) AS doadores_geral, SUM(value) AS valor_geral FROM $tabela WHERE status = 'CONFIRMED' OR status = 'RECEIVED'");
                $stmt_recorrencia = $conn->prepare("SELECT COUNT(*) AS doadores_recorrencia, SUM(value) AS valor_recorrencia FROM $tabela WHERE status = 'CONFIRMED' OR status = 'RECEIVED' AND description = 'Plano de assinatura' AND subscription_id LIKE 'sub_%'");
                // Executando as consultas SQL
                $stmt_geral->execute();
                $stmt_recorrencia->execute();
                // Obtendo os resultados das consultas
                $geral = $stmt_geral->fetch();
                $recorrencia = $stmt_recorrencia->fetch();

                $doadores_geral = $geral['doadores_geral'];
                $valor_geral = $geral['valor_geral'];
                $doadores_recorrencia = $recorrencia['doadores_recorrencia'];
                $valor_recorrencia = $recorrencia['valor_recorrencia'];
            ?>
            <div class="row mb-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text mb-2"><span class="h3">R$ <?php echo number_format((int)$valor_geral, 2, ',', '.'); ?></span> <span class="text-muted">é o que arrecadamos até agora</span></div>
                            <!--<div class="progress mb-2" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 15%"></div>
                            </div>-->
                            <!--<div class="card-text mb-2 text-muted">Meta: R$ 30.000,00 por mês (71.2% alcançada)</div>-->
                            <div class="card-text mb-2"><span class="h3">R$ <?php echo number_format((int)$valor_recorrencia, 2, ',', '.'); ?></span> <span class="text-muted">em doações recorrentes</span></div>
                            <!--<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 15%"></div>
                            </div>-->
                            <div class="card-text mb-2"><i class="bi bi-people"></i> <span class="h3"><?php echo $doadores_geral; ?></span> <span class="text-muted">pessoas apoiando</span></div>
                        </div>
                    </div>
                </div>
            </div>
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
								<img src="'. INCLUDE_PATH .'assets/img/' . $usuario['imagem'] . '" alt="Card ' . $usuario['id'] . '" style="width: 500px" />
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
		<div class="col-md-3">
			<span class="h5"><?php echo $nome; ?></span><br />
			<div class="font-weight-light" style="font-size:13px;margin-top:5px">
			<!--<?php echo $rua; ?><?php echo ($numero !== '') ? ', ' . $numero : ''; ?> - <?php echo $bairro; ?>-->
			<?php echo $rua . ', '; ?><?php echo $numero ? $numero :  'S/N'; ?> - <?php echo $bairro; ?>
			<?php echo $cidade; ?> - <?php echo $estado; ?> CEP: <?php echo $cep; ?><br />
			<?php if($telefone): ?> Telefone: <a href="callto:<?php echo $telefone; ?>"> <?php echo $telefone; ?></a><br /> <?php endif; ?>
			E-mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
			</div>
			<div class="social-net mt-2 mb-4">
				<a href="<?php echo ($facebook !== '') ? $facebook : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($facebook == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-facebook p-2"></i></a>
				<a href="<?php echo ($instagram !== '') ? $instagram : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($instagram == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-instagram p-2"></i></a>
				<a href="<?php echo ($linkedin !== '') ? $linkedin : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($linkedin == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-linkedin p-2"></i></a>
				<a href="<?php echo ($twitter !== '') ? $twitter : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($twitter == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-twitter p-2"></i></a>
				<a href="<?php echo ($youtube !== '') ? $youtube : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($youtube == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-youtube p-2"></i></a>
				<a href="<?php echo ($website !== '') ? $website : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($website == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-globe-americas p-2"></i></a>
				<a href="<?php echo ($tiktok !== '') ? $tiktok : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($tiktok == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-tiktok p-2"></i></a>
				<a href="<?php echo ($linktree !== '') ? $linktree : '#'; ?>" target="_blank" rel="noopener noreferer" <?php echo ($linktree == '') ? 'class="d-none"' : ''; ?>><i class="bi bi-share p-2"></i></a>
			</div>

		</div>
		<div class="col-md-6 text-center">
			<div class="social-net mt-2 mb-4">
				<img src="<?php echo INCLUDE_PATH; ?>assets/img/security.webp" alt="ambiente seguro" />
				<a class="p-2" href="https://transparencyreport.google.com/safe-browsing/search?url=<?php echo INCLUDE_PATH; ?>" target="_blank" rel="noreferrer">
					<img src="<?php echo INCLUDE_PATH; ?>assets/img/selo-google.png" width="150" height="42" alt="Safe Browsisng">
				</a>
			</div>
			<p class="footer-link ps-1">
				<?php
					if($use_privacy) {
						echo "<a href='politica-de-privacidade' rel='noopener noreferrer' target='_blank'>";
					} else {
						echo "<a href=" . $privacidade . " rel='noopener noreferrer' target='_blank'>";
					}
				?>
					PRIVACIDADE DOS DOADORES
				</a> | 
				<a href="<?php echo INCLUDE_PATH; ?>login" rel="noopener noreferrer" target="_blank">
					ÁREA DE DOADOR(A)
				</a><br />
				<?php
					if($use_faq) {
						echo "<a href='<?php echo $faq; ?>' rel='noopener noreferrer' target='_blank'>PERGUNTAS FREQUENTES</a>";
					}
				?>
			</p>
		</div>
		<div class="col-md-3">
		<p class="footer-linkd mt-5 footer-floema-doar font-weight-bold">
				<a href="https://floema-doar.org" rel="noopener noreferrer" target="_blank">
					Usamos Floema Doar | Open source
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
<script src="<?php echo INCLUDE_PATH; ?>assets/google/jquery/jquery.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/google/jquery/jquery-ui.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/ajax/1.14.16/jquery.mask.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>assets/js/main.js" defer></script>

<script>
$(document).ready(function () {
    //$('.option-default-monthly').trigger('click');
    $('#field-zipcode').mask('00000-000');
    $('#field-cpf').mask('000.000.000-00');
    $('#field-card-number').mask('0000 0000 0000 0000');
    $('#field-card-expiration').mask('00/00');
    $('#field-card-cvc').mask('0000');

    $('#field-other-monthly').mask("R$ 0#");
    $('#field-other-yearly').mask("R$ 0#");
    $('#field-other-once').mask("R$ 0#");

	config = <?php echo json_encode($jsonData, JSON_PRETTY_PRINT); ?>;

	minOnceDonationCreditCard = config.minOnceDonation.creditCard;
	minOnceDonationBankSlip = config.minOnceDonation.bankSlip;
	minOnceDonationPix = config.minOnceDonation.pix;

	$("#text-block1-title").html(config.textBlock1.title);
	$("#text-block1-content").html(config.textBlock1.content);
	$("#text-block2-title").html(config.textBlock2.title);
	$("#text-block2-content").html(config.textBlock2.content);

	let htmlFooter = "";
	for (let i = 0; i < config.footerLinks.length; i++) {
		htmlFooter += "<a href='" + config.footerLinks[i].link + "' target='" + config.footerLinks[i].target + "' rel='noopener noreferrer'>" + config.footerLinks[i].name + "</a>" + (i + 1 < config.footerLinks.length ? " | " : "");
	}
	$("#footer-links").html(htmlFooter);


	$("#button-monthly1")
		.attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton1.amount + "," + config.donationMonthlyButton1.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationMonthlyButton1.amount)
		.text(config.donationMonthlyButton1.display);
	$("#button-monthly2")
		.attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton2.amount + "," + config.donationMonthlyButton2.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationMonthlyButton2.amount)
		.text(config.donationMonthlyButton2.display);
	$("#button-monthly3")
		.attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton3.amount + "," + config.donationMonthlyButton3.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationMonthlyButton3.amount)
		.text(config.donationMonthlyButton3.display);
	$("#button-monthly4")
		.attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton4.amount + "," + config.donationMonthlyButton4.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationMonthlyButton4.amount)
		.text(config.donationMonthlyButton4.display);
	$("#button-monthly5")
		.attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton5.amount + "," + config.donationMonthlyButton5.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationMonthlyButton5.amount)
		.text(config.donationMonthlyButton5.display);

	$("#button-yearly1")
		.attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton1.amount + "," + config.donationYearlyButton1.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationYearlyButton1.amount)
		.text(config.donationYearlyButton1.display);
	$("#button-yearly2")
		.attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton2.amount + "," + config.donationYearlyButton2.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationYearlyButton2.amount)
		.text(config.donationYearlyButton2.display);
	$("#button-yearly3")
		.attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton3.amount + "," + config.donationYearlyButton3.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationYearlyButton3.amount)
		.text(config.donationYearlyButton3.display);
	$("#button-yearly4")
		.attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton4.amount + "," + config.donationYearlyButton4.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationYearlyButton4.amount)
		.text(config.donationYearlyButton4.display);
	$("#button-yearly5")
		.attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton5.amount + "," + config.donationYearlyButton5.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationYearlyButton5.amount)
		.text(config.donationYearlyButton5.display);

	$("#button-once1")
		.attr("onclick", "donationOption(this,'once'," + config.donationOnceButton1.amount + "," + config.donationOnceButton1.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationOnceButton1.amount)
		.text(config.donationOnceButton1.display);
	$("#button-once2")
		.attr("onclick", "donationOption(this,'once'," + config.donationOnceButton2.amount + "," + config.donationOnceButton2.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationOnceButton2.amount)
		.text(config.donationOnceButton2.display);
	$("#button-once3")
		.attr("onclick", "donationOption(this,'once'," + config.donationOnceButton3.amount + "," + config.donationOnceButton3.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationOnceButton3.amount)
		.text(config.donationOnceButton3.display);
	$("#button-once4")
		.attr("onclick", "donationOption(this,'once'," + config.donationOnceButton4.amount + "," + config.donationOnceButton4.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationOnceButton4.amount)
		.text(config.donationOnceButton4.display);
	$("#button-once5")
		.attr("onclick", "donationOption(this,'once'," + config.donationOnceButton5.amount + "," + config.donationOnceButton5.showAddOnFee + ")")
		.attr("data-amount-for-selection", config.donationOnceButton5.amount)
		.text(config.donationOnceButton5.display);

    $('.option-default-monthly').trigger('click');
});
</script>

<script>
	// Aguarde o carregamento do documento e, em seguida, chame a função
    $(document).ready(function () {
        donationOption('#button-monthly2', 'monthly', <?php echo $monthly_2; ?>, true);
    });
</script>

<script>

    // Captura do evento de submit do formulário
    $('#form-checkout').submit(function(event) {
        event.preventDefault();
		
		//Botão carregando
		$(".progress-subscription").addClass('d-flex').removeClass('d-none');
		$(".button-confirm-payment").addClass('d-none').removeClass('d-block');

        // // Bloquear o submit do formulário
        // $(this).find('button[type="submit"]').prop('disabled', true);

        // if(!validateFields()) {
        //     // Desbloquear o submit do formulário se a validação falhar
        //     $(this).find('button[type="submit"]').prop('disabled', false);
        //     return;
        // }

        var dataForm = this;

		// Chama a função processForm sem passar o token do reCAPTCHA
		processForm(dataForm);
    });

    function processForm(dataForm) {
        var typePayment = $('input[name="payment"]:checked').val();
        localStorage.setItem("method", typePayment);
        method = localStorage.getItem("method");

        // Adicionar valor ao input valor
        document.getElementById('value').value = donationAmount;

        // Criação do objeto de dados para a requisição AJAX
        var ajaxData = {
            method: method,
            params: btoa($(dataForm).serialize())
        };

        // Requisição AJAX para o arquivo de criação do cliente
        $.ajax({
            url: '<?php echo INCLUDE_PATH; ?>back-end/subscription.php',
            method: 'POST',
            data: ajaxData,
            dataType: 'JSON',
            success: function(response) {
                window.respostaGlobal = response.id; // Atribui a resposta à propriedade global do objeto window
                // Outras ações que você queira fazer com a resposta
            }
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
				})

				$.ajax({
					url: '<?php echo INCLUDE_PATH_ADMIN; ?>back-end/magic-link.php',
					method: 'POST',
					data: {customerId: customerId},
					dataType: 'JSON'
				})
				.done(function(data) {
					console.log(data.msg);
				})
			} else if (response.status == 400) {
				$("#div-errors-price").html(response.message).slideDown('fast').effect("shake");
        		$('html, body').animate({scrollTop : 0});

				//Remove botão carregando
				$(".progress-subscription").addClass('d-none').removeClass('d-flex');
				$(".button-confirm-payment").addClass('d-block').removeClass('d-none');
			}
		})
    }
</script>
<script>
	// Seleciona o elemento <html> (ou qualquer outro elemento de nível superior)
	const root = document.documentElement;
	const background = "<?php echo $background; ?>";
	const textColor = "<?php echo $text_color; ?>";
	const color = "<?php echo $color; ?>";
	const hover = "<?php echo $hover; ?>";
	const progress = "<?php echo $progress; ?>";

	// Altera o valor da variável --background-color
	root.style.setProperty('--background', background);
	root.style.setProperty('--text-color', textColor);

	root.style.setProperty('--primary-color', color);
	root.style.setProperty('--hover-color', hover);
	root.style.setProperty('--progress-color', progress);
</script>
<script>
	$(document).ready(function(){
		const header = $("nav")
		const footer = $("footer")

		if ( self !== top ) {
			header.hide()
			footer.hide()
		}
	})
</script>
</body>
</html>

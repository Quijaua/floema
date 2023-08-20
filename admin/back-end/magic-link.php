<?php
include_once('../../config.php');

// Tabela onde sera inserido o codigo
$tabela = "tb_clientes";

//Decodificando base64 e passando para $p
$asaas_id = base64_decode($_POST['customerId']);

// Gera um valor aleatório seguro em hexadecimal
$random_value = bin2hex(random_bytes(16));
$hash = hash('sha256', $asaas_id . $random_value); // Combinação do ID do usuário e valor aleatório
$link_magico = INCLUDE_PATH_USER . 'ativar-conta?token=' . $hash; // URL do link mágico

// Suponha que você já tem uma conexão com o banco de dados
$query = "UPDATE $tabela SET magic_link = :magic_link WHERE asaas_id = :asaas_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':magic_link', $hash, PDO::PARAM_STR);
$stmt->bindParam(':asaas_id', $asaas_id, PDO::PARAM_STR);
$stmt->execute();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';

// Crie uma nova instância do PHPMailer
$mail = new PHPMailer(true);

try {
    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host       = 'smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '8b6afa6cf7c2eb';
    $mail->Password   = '8a525ea217cae2';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 2525;

    // Define o remetente e destinatário
    $mail->setFrom('cauaserpa092@gmail.com', 'Caua Serpa');
    $mail->addAddress('email_do_usuario@dominio.com', 'Nome do Usuário');

    // Configurações do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Link Mágico para Ativar Sua Conta';
    $mail->Body = 'Clique no link a seguir para ativar sua conta: <a href="' . $link_magico . '">Ativar Conta</a>';

    // Envia o e-mail
    $mail->send();
    echo json_encode(["msg"=>"E-mail enviado com sucesso!"]);
} catch (Exception $e) {
    echo json_encode(["msg"=>"Erro ao enviar o e-mail: " . $mail->ErrorInfo]);
}
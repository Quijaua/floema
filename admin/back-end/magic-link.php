<?php
include_once('../../config.php');

//Decodificando base64 e passando para $dataForm
$dataForm = [];
parse_str(base64_decode($_POST['params']), $dataForm);

$user_id = $dataForm['asaas_id']; // Substitua pelo ID real do usuário
$random_value = bin2hex(random_bytes(16)); // Gera um valor aleatório seguro em hexadecimal
$hash = hash('sha256', $user_id . $random_value); // Combinação do ID do usuário e valor aleatório
$link_magico = INCLUDE_PATH_USER . 'ativar-conta?token=' . $hash; // URL do link mágico

// Suponha que você já tem uma conexão com o banco de dados
$query = "INSERT INTO usuarios_links_magicos (user_id, token) VALUES (:user_id, :token)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':token', $hash, PDO::PARAM_STR);
$stmt->execute();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';

// Crie uma nova instância do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP e autenticação
    $mail->isSMTP();
    $mail->Host = 'smtp.seuservidor.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seu_email@dominio.com';
    $mail->Password = 'sua_senha';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Define o remetente e destinatário
    $mail->setFrom('seu_email@dominio.com', 'Seu Nome');
    $mail->addAddress('email_do_usuario@dominio.com', 'Nome do Usuário');

    // Configurações do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Link Mágico para Ativar Sua Conta';
    $mail->Body = 'Clique no link a seguir para ativar sua conta: <a href="' . $link_magico . '">Ativar Conta</a>';

    // Envia o e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
<?php
    require '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();

    // Acessa as variáveis de ambiente
    $config['asaas_api_url'] = $_ENV['ASAAS_API_URL'];
    $config['asaas_api_key'] = $_ENV['ASAAS_API_KEY'];
    $config['groupname'] = $_ENV['GROUPNAME'];

    function getWebhookDataFromAsaas($webhook_id, $config) {
        $url = $config['asaas_api_url']."webhooks/$webhook_id";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: ".$config['asaas_api_key']
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    // Tabela que sera feita a consulta
    $tabela = "tb_webhook";

    // Query SQL para selecionar todos os usuários
    $sql = "SELECT * FROM $tabela LIMIT 1";

    // Prepara a query
    $stmt = $conn->prepare($sql);

    // Executa a query
    $stmt->execute();

    // Obtém todos os resultados como um array associativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $addButton = true;

    // Exibe os resultados
    if ($resultados) {
        foreach ($resultados as $webhook) {
            $webhook_id = $webhook['webhook_id'];
            $enabled = $webhook['enabled'];
            $webhook_name = $webhook['name'];
            $email = $webhook['email'];
            $interrupted = $webhook['interrupted'];
            $send_type = $webhook['send_type'];

            $addButton = false;
        }
    }

    // Verifica os dados do webhook na API da Asaas e atualiza o banco de dados se necessário
    if (isset($webhook_id)) {
        $asaasWebhookData = getWebhookDataFromAsaas($webhook_id, $config);

        if ($asaasWebhookData) {
            $differences = false;

            if ($asaasWebhookData['enabled'] != $webhook['enabled']) {
                $enabled = $asaasWebhookData['enabled'];
                $differences = true;
            }
            if ($asaasWebhookData['name'] != $webhook['name']) {
                $webhook_name = $asaasWebhookData['name'];
                $differences = true;
            }
            if ($asaasWebhookData['email'] != $webhook['email']) {
                $email = $asaasWebhookData['email'];
                $differences = true;
            }
            if ($asaasWebhookData['interrupted'] != $webhook['interrupted']) {
                $interrupted = $asaasWebhookData['interrupted'];
                $differences = true;
            }
            if ($asaasWebhookData['sendType'] != $webhook['send_type']) {
                $send_type = $asaasWebhookData['sendType'];
                $differences = true;
            }

            if ($differences) {
                $sql = "UPDATE $tabela SET enabled = :enabled, name = :name, email = :email, interrupted = :interrupted, send_type = :send_type WHERE webhook_id = :webhook_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':enabled', $enabled);
                $stmt->bindParam(':name', $webhook_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':interrupted', $interrupted);
                $stmt->bindParam(':send_type', $send_type);
                $stmt->bindParam(':webhook_id', $webhook['webhook_id']);
                $stmt->execute();
            }
        }
    }
?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>
                    Webhook
                    <div class="page-title-subheading">Aqui você pode criar um evento webhook para seu projeto.</div>
                </div>
            </div>
            <?php if (isset($webhook_id)) { ?>
            <div class="page-title-actions">
                <button id="reloadWebhook" class="btn btn-info btn-shadow">Recarregar</button>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/webhook.php" method="post">
                        <p class="card-title">Dados do Webhook</p>
                        <div class="position-relative row form-group">
                            <label for="enabled" class="col-sm-2 col-form-label">Este Webhook ficará ativo?</label>
                            <div class="col-sm-10">
                                <select name="enabled" id="enabled" class="form-control">
                                    <option value="1" <?= (isset($enabled) && $enabled == 1) ? "selected" : ""; ?>>Sim</option>
                                    <option value="0" <?= (isset($enabled) && $enabled == 0) ? "selected" : ""; ?>>Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="webhookName" class="col-sm-2 col-form-label">Nome do Webhook</label>
                            <div class="col-sm-10">
                                <input name="webhook_name" id="webhookName"
                                    type="text" class="form-control" value="<?php echo (isset($webhook_name)) ? $webhook_name : "Floema Doar"; ?>" required>
                                <small>No máximo 50 caracteres.</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input name="email" id="email"
                                    type="text" class="form-control" value="<?php echo $email; ?>" required>
                                <small>Você será notificado neste e-mail em caso de falha na sincronia.</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="interrupted" class="col-sm-2 col-form-label">Fila de sincronização ativada?</label>
                            <div class="col-sm-10">
                                <select name="interrupted" id="interrupted" class="form-control">
                                    <option value="0" <?= (isset($interrupted) && $interrupted == 0) ? "selected" : ""; ?>>Sim</option>
                                    <option value="1" <?= (isset($interrupted) && $interrupted == 1) ? "selected" : ""; ?>>Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="sendType" class="col-sm-2 col-form-label">Tipo de envio</label>
                            <div class="col-sm-10">
                                <select name="send_type" id="sendType" class="form-control">
                                    <option value="SEQUENTIALLY" <?= (isset($send_type) && $send_type == "SEQUENTIALLY") ? "selected" : ""; ?>>Sequencial</option>
                                    <option value="NON_SEQUENTIALLY"  <?= (isset($send_type) && $send_type == "NON_SEQUENTIALLY") ? "selected" : ""; ?>>Não sequencial</option>
                                </select>
                            </div>
                        </div>
                        <?php if (isset($webhook_id)) { ?>
                            <input type="hidden" name="webhook_id" value="<?= $webhook_id; ?>">
                        <?php } ?>
                        <?php if ($addButton == true) { ?>
                            <button type="submit" name="btnAddWebhook" class="btn btn-primary">Salvar</button>
                        <?php } else { ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="submit" name="btnUpdWebhook" class="btn btn-primary">Editar</button>
                                <button type="submit" name="btnDltWebhook" class="btn btn-danger">Deletar Webhook</button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($webhook_id)) { ?>
<script>
    $(document).ready(function () {
        $('#reloadWebhook').click(function() {
            location.reload();
        });
    });
</script>
<?php } ?>
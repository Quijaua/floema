<?php
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
            <div class="page-title-actions">
                <!-- <a href="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/logout.php" class="btn btn-info btn-shadow">
                    Sair
                </a> -->
            </div>
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
                                    <option value="SEQUENTIALLY" <?= (isset($enabled) && $enabled == "SEQUENTIALLY") ? "selected" : ""; ?>>Sequencial</option>
                                    <option value="NON_SEQUENTIALLY"  <?= (isset($enabled) && $enabled == "NON_SEQUENTIALLY") ? "selected" : ""; ?>>Não sequencial</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="webhook_id" value="<?= $webhook_id; ?>">
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
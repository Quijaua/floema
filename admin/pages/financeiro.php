<style>
.form-color {
    outline: none;
    background: none;
    width: 38px;
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    margin-right: 10px;
}
  #colorPickerRGB {
    outline: none;
    background: none;
    width: 38px;
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    margin-right: 10px;
  }

  #rgbInputs {
    display: flex;
    align-items: center;
  }

  .rgbInput {
    width: 70px;
    margin-right: 10px;
    text-align: center;
  }

  #colorPreview {
    width: 50px;
    height: 50px;
    margin-top: 10px;
    border: 1px solid #ccc;
  }

  textarea {
      height: 200px !important;
  }
</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>
                    Financeiro
                    <div class="page-title-subheading">Aqui estão os relatórios financeiros do sistema</div>
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
                    <h5 class="card-title">doações</h5>
                    <table class="table" id="doacoes">
                    <thead>
                        <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Transação</th>
                        <th scope="col">Data Criação</th>
                        <th scope="col">Doador</th>
                        <th scope="col">Assinatura</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Valor Líquido</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Método</th>
                        <th scope="col">Data Pagamento</th>
                        <!--<th scope="col">Nº Cartão</th>-->
                        <!--<th scope="col">Bandeira</th>-->
                        <!--<th scope="col">Token Cartão</th>-->
                        <!--<th scope="col">Status</th>-->
                        <th scope="col">Data Crédito</th>
                        <th scope="col">Data Estimada Crédito</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transacoes as $transacao) : ?>
                        <tr>
                            <?php
                                switch ($transacao["event"]) {
                                    case "PAYMENT_CONFIRMED":
                                        $type = "Pago";
                                        $class = "success";
                                        break;
                                    case "PAYMENT_RECEIVED":
                                        $type = "Recebido";
                                        $class = "success";
                                        break;
                                    case "PAYMENT_DELETED":
                                        $type = "Cancelado";
                                        $class = "warning";
                                        break;
                                    case "PAYMENT_OVERDUE":
                                        $type = "Vencido";
                                        $class = "danger";
                                        break;
                                    case "PAYMENT_REFUNDED":
                                        $type = "Estornado";
                                        $class = "info";
                                        break;
                                    case "PAYMENT_CREATED":
                                        $type = "Criado";
                                        $class = "primary";
                                        break;
                                    default:
                                        $type = "Desconhecido";
                                        $class = "dark";
                                        break;
                                };

                                $created_date = date_create($transacao["payment_date_created"]);
                                $payment_date = date_create($transacao["confirmed_date"]);
                                $credit_date = date_create($transacao["credit_date"]);
                                $estimated_date = date_create($transacao["estimated_credit_date"]);
                            ?>
                            <td><span class="badge badge-<?php echo $class; ?>"><?php echo $type; ?></span></td>
                            <td><?php echo $transacao["payment_id"]; ?></td>
                            <td><?php echo date_format($created_date, "d/m/Y"); ?></td>
                            <td><?php echo $transacao["customer_id"]; ?></td>
                            <td><?php echo $transacao["subscription_id"]; ?></td>
                            <td><?php echo $transacao["value"]; ?></td>
                            <td><?php echo $transacao["net_value"]; ?></td>
                            <td><?php echo $transacao["description"]; ?></td>
                            <td><?php echo $transacao["billing_type"]; ?></td>
                            <td><?php echo date_format($payment_date, "d/m/Y"); ?></td>
                            <!--<td><?php echo $transacao["credit_card_number"]; ?></td>-->
                            <!--<td><?php echo $transacao["credit_card_brand"]; ?></td>-->
                            <!--<td><?php echo $transacao["credit_card_token"]; ?></td>-->
                            <!--<td><?php echo $transacao["status"]; ?></td>-->
                            <td><?php echo date_format($credit_date, "d/m/Y"); ?></td>
                            <td><?php echo date_format($estimated_date, "d/m/Y"); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/datatables.net/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
<script>
    $(document).ready(function(){
        $("#doacoes").DataTable( {
            dom: "Bfrtip",
            buttons: [
                "csv" ,"excel", "pdf", "print"
            ]
        } )
    })
</script>

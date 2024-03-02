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
                    <table id="doacoes" class="table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                        <th>Tipo</th>
                        <th>Doador</th>
                        <th>Transação</th>
                        <th>Data Criação</th>
                        <th>Assinatura</th>
                        <th>Valor</th>
                        <th>Valor Líquido</th>
                        <th>Descrição</th>
                        <th>Método</th>
                        <th>Data Crédito</th>
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
                            <td><?php echo $transacao["nome"]; ?></td>
                            <td><?php echo $transacao["payment_id"]; ?></td>
                            <td><?php echo date_format($created_date, "d/m/Y"); ?></td>

                            <td><?php echo $transacao["subscription_id"]; ?></td>
                            <td><?php echo $transacao["value"]; ?></td>
                            <td><?php echo $transacao["net_value"]; ?></td>
                            <td><?php echo $transacao["description"] ? $transacao["description"] : "Doação única"; ?></td>
                            <td><?php echo $transacao["billing_type"]; ?></td>
                            <td><?php echo date_format($credit_date, "d/m/Y"); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap4.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>vendors/datatables.net/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.0.0/js/dataTables.responsive.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap4.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>

<script>
    $(document).ready(function(){
        $("#doacoes").DataTable( {
            responsive: true,
            dom: "Bfrtip",
            buttons: [
                "csv" ,"excel", "pdf", "print"
            ],
	    language: {
	        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
	    }
        } )
    })
</script>

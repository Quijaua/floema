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
                    Doadores
                    <div class="page-title-subheading">Aqui estão os relatórios de doadores do sistema</div>
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
                    <h5 class="card-title">doadores</h5>
                    <table class="table" id="clientes">
                    <thead>
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Asaas ID</th>
                        <th scope="col">Newsletter</th>
                        <th scope="col">Doador Anônimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientes as $cliente) : ?>
                        <tr>
                            <td><?php echo $cliente["nome"] ?></td>
                            <td><?php echo $cliente["email"] ?></td>
                            <td><?php echo $cliente["phone"] ?></td>
                            <td><?php echo $cliente["cpf"] ?></td>
                            <td>
                                <?php
                                    echo $cliente["endereco"] . ", " . $cliente["numero"] . " " . $cliente["municipio"] . "CEP " . $cliente["cep"] . " - " . $cliente["cidade"] . " " . $cliente["uf"]
                                ?>
                            </td>
                            <td><?php echo $cliente["asaas_id"] ?></td>
                            <td><?php echo $cliente["newsletter"] ? "Sim" : "Não"; ?></td>
                            <td><?php echo $cliente["private"] ? "Sim" : "Não"; ?></td>
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
        $("#clientes").DataTable( {
            dom: "Bfrtip",
            buttons: [
                "csv" ,"excel", "pdf", "print"
            ]
        } )
    })
</script>

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
                    Novidades
                    <div class="page-title-subheading">Listagem dos emails em massa enviados pelo sistema</div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?php echo INCLUDE_PATH_ADMIN; ?>email_em_massa" class="btn btn-info btn-shadow">
                    Novo email em massa
                </a>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">

            <?php
                $tabela = 'tb_bulk_emails';
                $sql = "SELECT * FROM $tabela";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach( $resultados as $res ): ?>
            <a href="#" onclick='modalToggle(<?php echo json_encode($res["body"]); ?>)' style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            <b>Título do email</b>: <?php echo $res['title']; ?> - <b>Data de envio</b>: <?php echo date('d/m/Y', strtotime($res['date'])); ?>
                        </p>
                    </div>
                </div>
            </a>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade mt-5" data-backdrop="false" id="emailBodyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title fs-5" id="emailBodyModalLabel">Conteúdo do email</h4>
        </div>
        <div class="modal-body" id="emailBodyModalBody">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#emailBodyModal').modal('toggle')">Fechar</button>
        </div>
        </div>
    </div>
</div>

<script>
    const modalToggle = (content) => {
        $('#emailBodyModalBody').html(content);
        $('#emailBodyModal').modal('toggle');
    }
</script>
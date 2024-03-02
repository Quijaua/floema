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
                    Novo email em massa
                    <div class="page-title-subheading">Área para disparar emails em massa</div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/logout.php" class="btn btn-info btn-shadow">
                    Novo email em massa
                </a>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">

            <form id="bulk_email_form" action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/bulk_email_send.php" method="post">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header">disparar email em massa</div>
                    <div class="card-body">
                        <div class="form-floating mb-4">
                            <label for="bulk_email_title">Título do email</label>
                            <input type="text" class="form-control" placeholder="Insira o título do email aqui" id="bulk_email_title" name="bulk_email_title" required>
                        </div>
                        <div class="form-floating mb-4">
                            <label for="bulk_email_body">Corpo do email</label>
                            <textarea class="form-control" placeholder="Insira o corpo do email aqui" id="bulk_email_body" name="bulk_email_body" style="min-height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="row ml-2 mb-4">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" form="bulk_email_form">Disparar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

<script>
    ClassicEditor
    .create( document.querySelector( '#bulk_email_body' ), {})
    .catch( error => {
        console.error( error );
    })
</script>

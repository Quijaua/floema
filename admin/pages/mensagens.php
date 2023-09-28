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
                    Mensagens
                    <div class="page-title-subheading">Área personalizar as mensagens do sistema</div>
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

            <div id="editor"></div>

            <form id="messages_form" action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="form-floating mb-4">
                            <label for="floatingTextarea">Mensagem do email de boas vindas</label>
                            <textarea class="form-control" placeholder="Insira a mensagem de boas vindas que será enviada no email aqui" id="welcome_email" name="welcome_email" style="min-height: 300px"><?php echo $welcome_email ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" name="btnMessages" class="btn btn-primary mb-5" form="messages_form">Salvar</button>
            </form>

        </div>

    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#welcome_email' ), {})
    .catch( error => {
        console.error( error );
    })
</script>

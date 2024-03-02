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
                    Política de Privacidade
                    <div class="page-title-subheading">Área para personalizar a política de privacidade/termos do sistema</div>
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
                            <label for="privacy">Texto que vai ser exibido na página de privacidade</label>
                            <textarea class="form-control" placeholder="Insira o texto que será exibido aqui" id="privacy_policy" name="privacy_policy" style="min-height: 300px"><?php echo $privacy_policy ?></textarea>
                        </div>
                        <small class="form-text text-muted">
                            <input type="checkbox" name="use_privacy" id="use_privacy" value="1" data-input-id="website" <?php if ($use_privacy) { echo 'checked'; } else { echo '';}; ?> >
                            <label for="use_privacy" class="mb-0">Usar a Política de Privacidade padrão do sistema</label>
                        </small>
                    </div>
                </div>
                <button type="submit" name="btnPrivacy" class="btn btn-primary mb-5" form="messages_form">Salvar</button>
            </form>

        </div>

    </div>
</div>
<script>
    ClassicEditor
    .create( document.querySelector( '#privacy_policy' ), {})
    .catch( error => {
        console.error( error );
    })
</script>

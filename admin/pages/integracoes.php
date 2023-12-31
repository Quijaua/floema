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
                    Integrações
                    <div class="page-title-subheading">Área para inserir os códigos de restreamento/analytics das rede sociais</div>
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

            <form id="integration_form" action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="form-floating mb-4">
                            <label for="floatingTextarea">Facebook Pixel</label>
                            <textarea class="form-control" placeholder="Insira o código completo do Facebook Pixel aqui" id="fb_pixel" name="fb_pixel"><?php echo $fb_pixel ?></textarea>
                        </div>
                        <div class="form-floating mb-4">
                            <label for="floatingTextarea">Google Tag Manager</label>
                            <textarea class="form-control" placeholder="Insira o código completo do Google Tag Manager aqui" id="gtm" name="gtm"><?php echo $gtm; ?></textarea>
                        </div>
                        <div class="form-floating mb-4">
                            <label for="floatingTextarea">Google Analytics</label>
                            <textarea class="form-control" placeholder="Insira o código completo do Google Analytics aqui" id="g_analytics" name="g_analytics"><?php echo $g_analytics; ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" name="btnIntegration" class="btn btn-primary mb-5" form="integration_form">Salvar</button>
            </form>

        </div>

    </div>
</div>

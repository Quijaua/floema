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
</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>
                    Rodapé
                    <div class="page-title-subheading">Altere configurações da parte inferior da página</div>
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
                    
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post">
                        <div class="position-relative row form-group">
                            <label for="privacidade" class="col-sm-2 col-form-label">Privacidade dos Doadores</label>
                            <div class="col-sm-10">
                                <input name="privacidade" id="privacidade"
                                    type="text" class="form-control" value="<?php echo $privacidade; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="faq" class="col-sm-2 col-form-label">Perguntas Frequentes</label>
                            <div class="col-sm-10">
                                <input name="faq" id="faq" type="text" class="form-control" value="<?php echo $faq; ?>">
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="use_faq" id="use_faq" value="1" data-input-id="use_faq" <?php if ($use_faq) { echo 'checked'; } else { echo '';}; ?> >
                                    <label for="use_faq" class="mb-0">Usar FAQ padrão do sistema</label>
                                </small>
                            </div>
                        </div>

                        <p class="card-title">Links</p>
                        <div class="position-relative row form-group">
                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input name="facebook" id="facebook"
                                    type="text" class="form-control" value="<?php echo $facebook; ?>" <?php echo ($facebook == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dFacebook" id="dFacebook" data-input-id="facebook" <?php echo ($facebook == '') ? 'checked' : '';?>>
                                    <label for="dFacebook" class="mb-0">Desabilitar Facebook</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input name="instagram" id="instagram"
                                    type="text" class="form-control" value="<?php echo $instagram; ?>" <?php echo ($instagram == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dInstagram" id="dInstagram" data-input-id="instagram" <?php echo ($instagram == '') ? 'checked' : '';?>>
                                    <label for="dInstagram" class="mb-0">Desabilitar Instagram</label>
                                </small>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="linkedin" class="col-sm-2 col-form-label">LinkedIn</label>
                            <div class="col-sm-10">
                                <input name="linkedin" id="linkedin"
                                    type="text" class="form-control" value="<?php echo $linkedin; ?>" <?php echo ($linkedin == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dLinkedin" id="dLinkedin" data-input-id="linkedin" <?php echo ($linkedin == '') ? 'checked' : '';?>>
                                    <label for="dLinkedin" class="mb-0">Desabilitar LinkedIn</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input name="twitter" id="twitter"
                                    type="text" class="form-control" value="<?php echo $twitter; ?>" <?php echo ($twitter == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dTwitter" id="dTwitter" data-input-id="twitter" <?php echo ($twitter == '') ? 'checked' : '';?>>
                                    <label for="dTwitter" class="mb-0">Desabilitar Twitter</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="youtube" class="col-sm-2 col-form-label">YouTube</label>
                            <div class="col-sm-10">
                                <input name="youtube" id="youtube"
                                    type="text" class="form-control" value="<?php echo $youtube; ?>" <?php echo ($youtube == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dYoutube" id="dYoutube" data-input-id="youtube" <?php echo ($youtube == '') ? 'checked' : '';?>>
                                    <label for="dYoutube" class="mb-0">Desabilitar YouTube</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="website" class="col-sm-2 col-form-label">Website</label>
                            <div class="col-sm-10">
                                <input name="website" id="website"
                                    type="text" class="form-control" value="<?php echo $website; ?>" <?php echo ($website == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dWebsite" id="dWebsite" data-input-id="website" <?php echo ($website == '') ? 'checked' : '';?>>
                                    <label for="dWebsite" class="mb-0">Desabilitar Website</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="tiktok" class="col-sm-2 col-form-label">TikTok</label>
                            <div class="col-sm-10">
                                <input name="tiktok" id="tiktok"
                                    type="text" class="form-control" value="<?php echo $tiktok; ?>" <?php echo ($tiktok == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dtiktok" id="dtiktok" data-input-id="tiktok" <?php echo ($tiktok == '') ? 'checked' : '';?>>
                                    <label for="dtiktok" class="mb-0">Desabilitar TikTok</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="linktree" class="col-sm-2 col-form-label">Linktr.ee</label>
                            <div class="col-sm-10">
                                <input name="linktree" id="linktree"
                                    type="text" class="form-control" value="<?php echo $linktree; ?>" <?php echo ($linktree == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dlinktree" id="dlinktree" data-input-id="linktree" <?php echo ($linktree == '') ? 'checked' : '';?>>
                                    <label for="dlinktree" class="mb-0">Desabilitar Linktr.ee</label>
                                </small>
                            </div>
                        </div>

                        <p class="card-title">Contato</p>
                        <div class="position-relative row form-group">
                            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                                <input name="telefone" id="telefone"
                                    type="text" class="form-control" value="<?php echo $telefone; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input name="email" id="email"
                                    type="text" class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>

                        <p class="card-title">Endereço</p>
                        <div class="position-relative row form-group">
                            <label for="cep" class="col-sm-2 col-form-label">CEP</label>
                            <div class="col-sm-10">
                                <input name="cep" id="cep" onblur="getCepData()"
                                    type="text" class="form-control" value="<?php echo $cep; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="rua" class="col-sm-2 col-form-label">Rua</label>
                            <div class="col-sm-10">
                                <input name="rua" id="rua"
                                    type="text" class="form-control" value="<?php echo $rua; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="numero" class="col-sm-2 col-form-label">Número</label>
                            <div class="col-sm-10">
                                <input name="numero" id="numero"
                                    type="text" class="form-control" value="<?php echo $numero; ?>" <?php echo ($numero == '') ? 'disabled' : '';?>>
                                    
                                <small class="form-text text-muted">
                                    <input type="checkbox" name="dNumero" id="dNumero" data-input-id="numero" <?php echo ($numero == '') ? 'checked' : '';?>>
                                    <label for="dNumero" class="mb-0">Sem Número</label>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="bairro" class="col-sm-2 col-form-label">Bairro</label>
                            <div class="col-sm-10">
                                <input name="bairro" id="bairro"
                                    type="text" class="form-control" value="<?php echo $bairro; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                            <div class="col-sm-10">
                                <input name="cidade" id="cidade"
                                    type="text" class="form-control" value="<?php echo $cidade; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                                <input name="estado" id="estado"
                                    type="text" class="form-control" value="<?php echo $estado; ?>">
                            </div>
                        </div>
                        <button type="submit" name="btnUpdFooter" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const checkboxes = document.querySelectorAll('[name^="d"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const inputId = this.getAttribute('data-input-id');
            const input = document.getElementById(inputId);
            
            if (this.checked) {
                input.disabled = true;
            } else {
                input.disabled = false;
            }
        });
    });
</script>
<script>
    
function getCepData()
{
    let cep = $('#cep').val();
    cep = cep.replace(/\D/g, "");
    if(cep.length<8)
    {
        $("#div-errors-price").html("CEP deve conter no mínimo 8 dígitos").slideDown('fast').effect( "shake" );
        $("#cep").addClass('is-invalid').focus();
        return;
    }
    $("#cep").removeClass('is-invalid');
    $("#div-errors-price").slideUp('fast');


    if(cep != "")
    {
        $("#rua").val("Carregando...");
        $("#bairro").val("Carregando...");
        $("#cidade").val("Carregando...");
        $("#estado").val("...");
        $.getJSON( "https://viacep.com.br/ws/"+cep+"/json/", function( data )
        {
            $("#rua").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $("#cidade").val(data.localidade);
            $("#estado").val(data.uf);
            $("#numero").focus();
        }).fail(function()
        {
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val(" ");
        });
    }
}
</script>
<script>
    const colorPicker = document.getElementById('colorPicker');
    const colorCodeInput = document.getElementById('colorCode');

    colorPicker.addEventListener('input', updateColorPreview);
    colorCodeInput.addEventListener('input', updateColorFromCode);

    function updateColorPreview(event) {
        const selectedColor = event.target.value;
        colorCodeInput.value = selectedColor;
    }

    function updateColorFromCode() {
        const colorCode = colorCodeInput.value;
        if (isValidHexColorCode(colorCode)) {
            colorPicker.value = colorCode;
        }
    }

    function isValidHexColorCode(code) {
        return /^#([0-9A-F]{3}){1,2}$/i.test(code);
    }
</script>
<script>
    const hoverPicker = document.getElementById('hoverPicker');
    const hoverCodeInput = document.getElementById('hoverCode');

    hoverPicker.addEventListener('input', updateHoverPreview);
    hoverCodeInput.addEventListener('input', updateHoverFromCode);

    function updateHoverPreview(event) {
        const selectedHover = event.target.value;
        hoverCodeInput.value = selectedHover;
    }

    function updateHoverFromCode() {
        const hoverCode = hoverCodeInput.value;
        if (isValidHexHoverCode(hoverCode)) {
            hoverPicker.value = hoverCode;
        }
    }

    function isValidHexHoverCode(code) {
        return /^#([0-9A-F]{3}){1,2}$/i.test(code);
    }
</script>
<script>
    const colorPickerRGB = document.getElementById('colorPickerRGB');
    const redInput = document.getElementById('red');
    const greenInput = document.getElementById('green');
    const blueInput = document.getElementById('blue');

    colorPickerRGB.addEventListener('input', updateColorFromPicker);
    redInput.addEventListener('input', updateColorFromRGBInputs);
    greenInput.addEventListener('input', updateColorFromRGBInputs);
    blueInput.addEventListener('input', updateColorFromRGBInputs);

    function updateColorFromPicker(event) {
      const selectedColor = event.target.value;
      const rgbValues = hexToRGB(selectedColor);
      redInput.value = rgbValues.r;
      greenInput.value = rgbValues.g;
      blueInput.value = rgbValues.b;
      updateColorPreview();
    }

    function updateColorFromRGBInputs() {
      const redValue = parseInt(redInput.value);
      const greenValue = parseInt(greenInput.value);
      const blueValue = parseInt(blueInput.value);
      const hexColor = RGBToHex(redValue, greenValue, blueValue);
      colorPickerRGB.value = hexColor;
      updateColorPreview();
    }

    function updateColorPreview() {
      const hexColor = RGBToHex(parseInt(redInput.value), parseInt(greenInput.value), parseInt(blueInput.value));
    }

    function hexToRGB(hex) {
      const bigint = parseInt(hex.slice(1), 16);
      const r = (bigint >> 16) & 255;
      const g = (bigint >> 8) & 255;
      const b = bigint & 255;
      return { r, g, b };
    }

    function RGBToHex(r, g, b) {
      return `#${(1 << 24 | r << 16 | g << 8 | b).toString(16).slice(1)}`;
    }
  </script>

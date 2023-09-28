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
                    Aparência
                    <div class="page-title-subheading">Área para alterar cores na página principal</div>
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
                    <h5 class="card-title">Cores</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post" enctype="multipart/form-data">
                        <div class="position-relative row form-group">
                            <label for="backgroundCode" class="col-sm-2 col-form-label">Cor de fundo *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="backgroundPicker" class="form-color" value="<?php echo $background; ?>">
                                <input type="text" id="backgroundCode" name="background" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $background; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="textColorCode" class="col-sm-2 col-form-label">Cor dos textos *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="textColorPicker" class="form-color" value="<?php echo $text_color; ?>">
                                <input type="text" id="textColorCode" name="text_color" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $text_color; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="colorCode" class="col-sm-2 col-form-label">Cor dos Botões *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="colorPicker" class="form-color" value="<?php echo $color; ?>">
                                <input type="text" id="colorCode" name="color" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $color; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="hoverCode" class="col-sm-2 col-form-label">Hover *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="hoverPicker" class="form-color" value="<?php echo $hover; ?>">
                                <input type="text" id="hoverCode" name="hover" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $hover; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="hoverCode" class="col-sm-2 col-form-label">Cor do botão carregar *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="loadBtnPicker" class="form-color" value="<?php echo $load_btn; ?>">
                                <input type="text" id="loadBtnCode" name="loadBtn" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $load_btn; ?>">
                            </div>
                        </div>
                        <button type="submit" name="btnUpdColor" class="btn btn-primary">Salvar</button>
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
    const backgroundPicker = document.getElementById('backgroundPicker');
    const backgroundCodeInput = document.getElementById('backgroundCode');

    backgroundPicker.addEventListener('input', updateBackgroundPreview);
    backgroundCodeInput.addEventListener('input', updateBackgroundFromCode);

    function updateBackgroundPreview(event) {
        const selectedBackground = event.target.value;
        backgroundCodeInput.value = selectedBackground;
    }

    function updateBackgroundFromCode() {
        const backgroundCode = backgroundCodeInput.value;
        if (isValidHexBackgroundCode(backgroundCode)) {
            backgroundPicker.value = backgroundCode;
        }
    }

    function isValidHexBackgroundCode(code) {
        return /^#([0-9A-F]{3}){1,2}$/i.test(code);
    }
</script>
<script>
    const textColorPicker = document.getElementById('textColorPicker');
    const textColorCodeInput = document.getElementById('textColorCode');

    textColorPicker.addEventListener('input', updateTextColorPreview);
    textColorCodeInput.addEventListener('input', updateTextColorFromCode);

    function updateTextColorPreview(event) {
        const selectedTextColor = event.target.value;
        textColorCodeInput.value = selectedTextColor;
    }

    function updateTextColorFromCode() {
        const textColorCode = textColorCodeInput.value;
        if (isValidHexTextColorCode(textColorCode)) {
            textColorPicker.value = textColorCode;
        }
    }

    function isValidHexTextColorCode(code) {
        return /^#([0-9A-F]{3}){1,2}$/i.test(code);
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
    const loadBtnPicker = document.getElementById('loadBtnPicker');
    const loadBtnCodeInput = document.getElementById('loadBtnCode');

    loadBtnPicker.addEventListener('input', updateLoadBtnPreview);
    loadbtnCodeInput.addEventListener('input', updateLoadBtnFromCode);

    function updateLoadBtnPreview(event) {
        const selectedLoadBtn = event.target.value;
        loadBtnCodeInput.value = selectedLoadBtn;
    }

    function updateLoadBtnFromCode() {
        const loadBtnCode = loadBtnCodeInput.value;
        if (isValidHexHoverCode(loadBtnCode)) {
            loadBtnPicker.value = loadBtnCode;
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

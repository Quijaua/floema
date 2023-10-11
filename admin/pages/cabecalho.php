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
                    Cabeçalho
                    <div class="page-title-subheading">Altere configurações da parte superior da página</div>
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
                            <label for="title" class="col-sm-2 col-form-label">Texto do Título da Página</label>
                            <div class="col-sm-10">
                                <input name="title" id="title"
                                    type="text" class="form-control" value="<?php echo $title; ?>">
                                <small class="form-text text-muted">
                                    Será mostrado na aba do seu navegador e na página do Google.
                                </small>
                            </div>
                        </div>
                        <button type="submit" name="btnUpdAbout" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Logo</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post" enctype="multipart/form-data">
                        <div class="position-relative row form-group">
                            <label for="input0" class="col-sm-2 col-form-label">Logo da sua Instituição *</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="input0" class="imagemInput"
                                    accept=".jpg, .jpeg, .png" value="<?php echo $logo; ?>">
                                    
                                <small class="form-text text-muted">
                                    Essa será a logo mostrada no cabeçalho do checkout. Tamanho ideal é 148 x 148 px.
                                </small>
                                
                                <label for="input0" id="card-img" style="max-width: 300px; margin-top: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                    <img id="imagemPreview0" src="<?php echo INCLUDE_PATH . 'assets/img/' . $logo; ?>" alt="Miniatura da Imagem" style="width: 100%;">
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="btnUpdLogo" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Cores</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post" enctype="multipart/form-data">
                        <div class="position-relative row form-group">
                            <label for="navColorCode" class="col-sm-2 col-form-label">Cor dos textos *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="navColorPicker" class="form-color" value="<?php echo $nav_color; ?>">
                                <input type="text" id="navColorCode" name="nav_color" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $nav_color; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="navBackgroundCode" class="col-sm-2 col-form-label">Cor de fundo *</label>
                            <div class="col-sm-10 d-flex">
                                <input type="color" id="navBackgroundPicker" class="form-color" value="<?php echo $nav_background; ?>">
                                <input type="text" id="navBackgroundCode" name="nav_background" class="form-control" placeholder="Digite o código hexadecimal da cor" value="<?php echo $nav_background; ?>">
                            </div>
                        </div>
                        <button type="submit" name="btnUpdNavColor" class="btn btn-primary">Salvar</button>
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
    const navColorPicker = document.getElementById('navColorPicker');
    const navColorCodeInput = document.getElementById('navColorCode');

    navColorPicker.addEventListener('input', updateNavColorPreview);
    navColorCodeInput.addEventListener('input', updateNavColorFromCode);

    function updateNavColorPreview(event) {
        const selectedNavColor = event.target.value;
        navColorCodeInput.value = selectedNavColor;
    }

    function updateNavColorFromCode() {
        const navColorCode = navColorCodeInput.value;
        if (isValidHexNavColorCode(navColorCode)) {
            navColorPicker.value = navColorCode;
        }
    }

    function isValidHexNavColorCode(code) {
        return /^#([0-9A-F]{3}){1,2}$/i.test(code);
    }
</script>
<script>
    const navBackgroundPicker = document.getElementById('navBackgroundPicker');
    const navBackgroundCodeInput = document.getElementById('navBackgroundCode');

    navBackgroundPicker.addEventListener('input', updateNavBackgroundPreview);
    navBackgroundCodeInput.addEventListener('input', updateNavBackgroundFromCode);

    function updateNavBackgroundPreview(event) {
        const selectedNavBackground = event.target.value;
        navBackgroundCodeInput.value = selectedNavBackground;
    }

    function updateNavBackgroundFromCode() {
        const navBackgroundCode = navBackgroundCodeInput.value;
        if (isValidHexNavBackgroundCode(navBackgroundCode)) {
            navBackgroundPicker.value = navBackgroundCode;
        }
    }

    function isValidHexNavBackgroundCode(code) {
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

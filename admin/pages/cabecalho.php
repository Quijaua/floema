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
                    <h5 class="card-title">Sobre a Instituição</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post">
                        <div class="position-relative row form-group">
                            <label for="nome" class="col-sm-2 col-form-label">Nome da sua Instituição *</label>
                            <div class="col-sm-10">
                                <input name="nome" id="nome"
                                    type="text" class="form-control" value="<?php echo $nome; ?>">
                            </div>
                        </div>
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
                        <div class="position-relative row form-group">
                            <label for="descricao" class="col-sm-2 col-form-label">Descrição da Instituição</label>
                            <div class="col-sm-10">
                                <textarea name="descricao" id="descricao" class="form-control"><?php echo $descricao; ?></textarea>
                                <small class="form-text text-muted">
                                    Preencha o campo com uma breve descrição sobre sua instituição. Esta informação ficará disponível no canto inferior direito do checkout.
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
                                    Essa será a logo mostrada no header do checkout.
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
                                    <?php
                                        $numbersArray = explode(", ", $progress);

                                        if (count($numbersArray) === 3) {
                                            list($red, $green, $blue) = $numbersArray;
                                        }

                                        // Função para converter um valor decimal em hexadecimal
                                        function decimalToHex($decimalValue) {
                                            // Converte o valor decimal para hexadecimal e adiciona um zero à esquerda se necessário
                                            return str_pad(dechex($decimalValue), 2, '0', STR_PAD_LEFT);
                                        }

                                        // Converte os valores RGB em códigos hexadecimais
                                        $hexRed = decimalToHex($red);
                                        $hexGreen = decimalToHex($green);
                                        $hexBlue = decimalToHex($blue);

                                        // Combina os códigos hexadecimais e adiciona o prefixo '#'
                                        $hexColorCode = "#" . $hexRed . $hexGreen . $hexBlue;
                                    ?>
                                <input type="color" id="colorPickerRGB" value="<?php echo $hexColorCode; ?>">
                                <div id="rgbInputs">
                                    <input type="number" name="red" class="form-control rgbInput" id="red" min="0" max="255" value="<?php echo $red; ?>">
                                    <input type="number" name="green" class="form-control rgbInput" id="green" min="0" max="255" value="<?php echo $green; ?>">
                                    <input type="number" name="blue" class="form-control rgbInput" id="blue" min="0" max="255" value="<?php echo $blue; ?>">
                                </div>
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

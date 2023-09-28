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
                    Sobre a sua Instituição
                    <div class="page-title-subheading">Altere as informações da sua instituição aqui!</div>
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
                    <h5 class="card-title">Adicionar Imagem</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/imagens.php" method="post" enctype="multipart/form-data">
                        <?php 
                            if(isset($_SESSION['msgaddcad'])){
                                echo $_SESSION['msgaddcad'];
                                unset($_SESSION['msgaddcad']);
                            }
                        ?>
                        <?php
                            // Nome da tabela para a busca
                            $tabela = 'tb_imagens';
                            
                            // Preparando a consulta SQL
                            $stmt = $conn->prepare("SELECT * FROM $tabela ORDER BY id DESC");
                            
                            // Executando a consulta
                            $stmt->execute();
                            
                            // Obtendo os resultados da busca
                            $imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Consulta SQL para recuperar informações das tabelas
                            $sql = "SELECT COUNT(id) FROM $tabela";
                            $stmt = $conn->query($sql);
                            
                            // Obter o número de linhas
                            $numLinhas = $stmt->fetchColumn();
                            $novaLinha = $numLinhas + 1;
                            
                            // Loop através dos resultados e exibir todas as colunas
                            if ($numLinhas < 4) {
                                echo '
                                    <div class="position-relative row form-group">
                                        <label for="input' . $novaLinha . '" class="col-sm-2 col-form-label">Imagem *</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="imagem" id="input' . $novaLinha . '" class="imagemInput"
                                                accept=".jpg, .jpeg, .png">
                                                
                                            <small class="form-text text-muted">
                                                Essa imagem será mostrada no checkout.
                                            </small>
                                            <small class="form-text text-muted">
                                                Imagem em .jpg com 500px x 160px.
                                            </small>
                                            
                                            <label for="input' . $novaLinha . '" id="card-img" style="max-width: 300px; margin-top: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                                <img id="imagemPreview' . $novaLinha . '" alt="Miniatura da Imagem" style="width: 100%;">
                                            </label>
                                        </div>
                                    </div>
                                ';
                            } else {
                                echo 'Só é possível adicionar até 4 imagens!';
                            }
                        ?>
                        <div class="divider"></div>
                        <button type="<?php echo ($numLinhas < 4) ? 'submit' : 'button'; ?>" name="btnAddCard" class="btn <?php echo ($numLinhas < 4) ? 'btn-primary' : 'btn-secondary'; ?>">Adicionar</button>
                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Imagens existentes</h5>
                        <?php 
                            if(isset($_SESSION['msgupdcad'])){
                                echo $_SESSION['msgupdcad'];
                                unset($_SESSION['msgupdcad']);
                            }
                        ?>
                        <?php
                            // Nome da tabela para a busca
                            $tabela = 'tb_imagens';
                            
                            // Consulta SQL para recuperar informações das tabelas
                            $sql = "SELECT COUNT(id) FROM $tabela";
                            $stmt = $conn->query($sql);
                            
                            // Obter o número de linhas
                            $numLinhas = $stmt->fetchColumn();
                            
                            // Consulta SQL para selecionar todas as colunas
                            $sql = "SELECT * FROM $tabela ORDER BY id DESC";
                            
                            // Preparar e executar a consulta
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            
                            // Recuperar os resultados
                            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            // Loop através dos resultados e exibir todas as colunas
                            foreach ($resultados as $usuario) {
                                echo '
                                    <form action="' . INCLUDE_PATH_ADMIN . 'back-end/imagens.php" method="post" enctype="multipart/form-data">
                                        <div class="position-relative row form-group">

                                            <label for="input' . $usuario['id'] . '" class="col-sm-2 col-form-label">Imagem *</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="imagem" id="input' . $usuario['id'] . '" class="imagemInput"
                                                    accept=".jpg, .jpeg, .png" value="' . $usuario['imagem'] . '">
                                                    
                                                <small class="form-text text-muted">
                                                    Imagem em .jpg com 500px x 160px.
                                                </small>
                                                
                                                <label for="input' . $usuario['id'] . '" id="card-img" style="max-width: 300px; margin-top: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                                    <img id="imagemPreview' . $usuario['id'] . '" src="' . INCLUDE_PATH . 'assets/img/' . $usuario['imagem'] . '" alt="Miniatura da Imagem" style="width: 100%;">
                                                </label>
                                            </div>

                                            <div class="col-sm-12 float-right">
                                                <input type="hidden" name="ids[]" value="' . $usuario['id'] . '">
                                                <button type="submit" name="btnUpdCard" class="btn btn-primary">Editar</button>
                                                <a href="' . INCLUDE_PATH_ADMIN . 'back-end/apagar-imagem.php?id=' . $usuario['id'] . '" class="btn btn-outline-danger">Deletar</a>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </form>
                                ';
                            }
                        ?>
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">valores das doações</h5>
                    <div class="mb-3">
                        <small class="text-muted">Insira 5 opçoes de valores para cada modalidade, uma em cada box</small>
                    </div>
                    <form id="donations_form" action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update.php" method="post">
                        <div class="position-relative row form-group">
                            <label for="estado" class="col-sm-2 col-form-label">Valores mensais</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <input name="monthly_1" id="monthly_1" type="number" class="form-control" value="<?php echo $monthly_1; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="monthly_2" id="monthly_2" type="number" class="form-control" value="<?php echo $monthly_2; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="monthly_3" id="monthly_3" type="number" class="form-control" value="<?php echo $monthly_3; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="monthly_4" id="monthly_4" type="number" class="form-control" value="<?php echo $monthly_4; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="monthly_5" id="monthly_5" type="number" class="form-control" value="<?php echo $monthly_5; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="estado" class="col-sm-2 col-form-label">Valores anuais</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <input name="yearly_1" id="yearly_1" type="number" class="form-control" value="<?php echo $yearly_1; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="yearly_2" id="yearly_2" type="number" class="form-control" value="<?php echo $yearly_2; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="yearly_3" id="yearly_3" type="number" class="form-control" value="<?php echo $yearly_3; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="yearly_4" id="yearly_4" type="number" class="form-control" value="<?php echo $yearly_4; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="yearly_5" id="yearly_5" type="number" class="form-control" value="<?php echo $yearly_5; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="estado" class="col-sm-2 col-form-label">Valores únicos</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <input name="once_1" id="once_1" type="number" class="form-control" value="<?php echo $once_1; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="once_2" id="once_2" type="number" class="form-control" value="<?php echo $once_2; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="once_3" id="once_3" type="number" class="form-control" value="<?php echo $once_3; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="once_4" id="once_4" type="number" class="form-control" value="<?php echo $once_4; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                    <div class="col">
                                        <input name="once_5" id="once_5" type="number" class="form-control" value="<?php echo $once_5; ?>" onkeydown="if(event.key==='.' || event.key===','){event.preventDefault();}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btnUpdDonations" class="btn btn-primary" form="donations_form">Salvar</button>
                    </form>
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">incorporar em um site</h5>
                    <p class="card-text">
                    <div class="alert alert-dark" role="alert">
                        <textarea id="embed_wrapper" class="m-0 p-0" disabled style="border: none; overflow: hidden; resize: none; width: 100%; background: transparent; text-align: left">
                            <iframe id="embed" src="<?php echo INCLUDE_PATH; ?>" frameborder="0" width="100%" height="1400"></iframe>
                        </textarea>
                    </div>
                    </p>
                    <button id="btnIframe" class="btn btn-primary">Copiar código</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#descricao' ), {})
    .catch( error => {
        console.error( error );
    })
</script>
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
  <script>
    $(document).ready(function() {
        $('#btnIframe').on('click', function() {
            let iframe = $('textarea#embed_wrapper').val()
            iframe = $.trim(iframe)

            if ( typeof navigator.clipboard !== 'undefined' ) {
                navigator.clipboard.writeText(iframe)
                $('#btnIframe').removeClass('btn-primary').addClass('btn-success').prop('disabled', true).html('Copiado!')
            } else if ( typeof navigator.clipboard === 'undefined' ) {
                let iframeText = $("#embed_wrapper")
                iframeText.focus()
                iframeText.select()
                document.execCommand('copy')
                $('#btnIframe').removeClass('btn-primary').addClass('btn-success').prop('disabled', true).html('Copiado!')
            } else {
                $('#btnIframe').removeClass('btn-primary').addClass('btn-danger').prop('disabled', true).html('Não foi possivel copiar o código!')
            }
        });
    })
  </script>

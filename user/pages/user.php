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
                    <i class="pe-7s-tools text-success"></i>
                </div>
                <div>
                    Bem vindo <?php echo $nome; ?>
                    <div class="page-title-subheading">Dados pessoais</div>
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
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Conta</h5>
                <form class="">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nome" class="">Nome *</label>
                                <input name="nome" id="nome" type="text" class="form-control" value="<?php echo $nome; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email" class="">E-mail *</label>
                                <input name="email" id="email" type="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="phone" class="">Telefone *</label>
                                <input name="phone" id="phone" type="phone" class="form-control" value="<?php echo $phone; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="cpf" class="">E-mail *</label>
                                <input name="cpf" id="cpf" type="text" class="form-control" value="<?php echo $cpf; ?>">
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title">Endereço</h5>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="cep" class="">CEP *</label>
                                <input name="cep" id="cep" type="text" class="form-control" value="<?php echo $cep; ?>" onblur="getCepData()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="endereco" class="">Endereço *</label>
                                <input name="endereco" id="endereco" type="text" class="form-control" value="<?php echo $endereco; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group mb-0">
                                <label for="numero" class="">Número *</label>
                                <input name="numero" id="numero" type="text" class="form-control" value="<?php echo $numero; ?>">
                                <div class="position-relative form-check">
                                    <input name="dNumero" id="dNumero" type="checkbox" class="form-check-input" data-input-id="numero" <?php echo ($numero == '') ? 'checked' : '';?>>
                                    <label for="dNumero" class="form-check-label">Sem número</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="cidade" class="">Cidade *</label>
                                <input name="cidade" id="cidade" type="text" class="form-control" value="<?php echo $cidade; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="uf" class="">Estado *</label>
                                <input name="uf" id="uf" type="text" class="form-control" value="<?php echo $uf; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="mt-2 btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Cobranças</h5>
            
            <?php
                // Nome da tabela para a busca
                $tabela = 'tb_doacoes';

                // Consulta SQL para selecionar todas as colunas com base no ID
                $sql = "SELECT * FROM $tabela WHERE customer_id = :asaas_id ORDER BY id DESC";

                // Preparar e executar a consulta
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':asaas_id', $asaas_id);
                $stmt->execute();

                // Recuperar os resultados
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Else para o foreach
                $encontrouPagamento = false; // Variável de controle

                // Loop através dos resultados e exibir todas as colunas
                foreach ($resultados as $usuario) {
                    if ($usuario['cycle'] == '') {
                        $null = ($usuario['forma_pagamento'] === '') ? 'selected' : '';
                        $boleto = ($usuario['forma_pagamento'] === 'BOLETO') ? 'selected' : '';
                        $pix = ($usuario['forma_pagamento'] === 'PIX') ? 'selected' : '';

                        $status = ($usuario['status'] === 'PENDING') ? 'Pendente' : '';

                        $link_pagamento = ($usuario['forma_pagamento'] === 'PIX') ? $usuario['link_pagamento'] : $usuario['link_boleto'];

                        $data_criacao = date("d/m/Y", strtotime($usuario['data_criacao']));

                        $vencimento_pix = date("d/m/Y", strtotime($usuario['pix_expirationDate']));
                        $vencimento_boleto = date("d/m/Y", strtotime($usuario['data_vencimento']));

                        $data_vencimento = ($usuario['forma_pagamento'] === 'PIX') ? $vencimento_pix : $vencimento_boleto;

                        echo '
                            <form action="' . INCLUDE_PATH . 'back-end/editar-cobranca.php" method="post">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <p class="mb-0">Status:</p>
                                            <p class="font-weight-bold">' . $status . '</p>
                                        </div>
                                        <div class="position-relative form-group">
                                            <p class="mb-0">Criado em:</p>
                                            <p class="font-weight-bold">' . $data_criacao . '</p>
                                        </div>
                                        <div class="position-relative form-group">
                                            <p class="mb-0">Vencimento:</p>
                                            <p class="font-weight-bold">' . $data_vencimento . '</p>
                                        </div>
                                        <div class="position-relative form-group">
                                            <p class="mb-0">Pagar:</p>
                                            <a href="' . $link_pagamento . '" target="_blank">Link pagamento</a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="position-relative form-group">
                                            <label for="valor" class="">Valor *</label>
                                            <input name="valor" id="valor" type="text" class="form-control" value="' . $usuario['valor'] . '" disabled>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="data_vencimento" class="">Vencimento *</label>
                                            <input name="data_vencimento" id="data_vencimento" type="date" class="form-control" value="' . $usuario['data_vencimento'] . '" disabled>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="forma_pagamento" class="">Forma de pagamento *</label>
                                            <select name="forma_pagamento" id="forma_pagamento" class="form-control" disabled>
                                                <option value="" disabled ' . $null . '>-- Selecione uma forma de pagamento --</option>
                                                <option value="BOLETO" ' . $boleto . '>Boleto</option>
                                                <option value="PIX" ' . $pix . '>Pix</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="payment_ids[]" value="' . $usuario['payment_id'] . '">
                                <div class="d-flex justify-content-between">
                                    <a href="' . INCLUDE_PATH . 'back-end/cancelar_pagamento.php?payment_id=' . $usuario['payment_id'] . '" class="mt-2 btn btn-outline-danger">Cancelar Pagamento</a>
                                </div>
                            </form>
                        ';
                        
                        $encontrouPagamento = true;
                    }
                }

                if (!$encontrouPagamento) {
                    echo 'Você não possui nenhuma cobrança ativa!';
                }
            ?>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Assinaturas</h5>
            
                <?php
                    // Nome da tabela para a busca
                    $tabela = 'tb_doacoes';

                    // Consulta SQL para selecionar todas as colunas com base no ID
                    $sql = "SELECT * FROM $tabela WHERE customer_id = :asaas_id ORDER BY id DESC";

                    // Preparar e executar a consulta
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':asaas_id', $asaas_id);
                    $stmt->execute();

                    // Recuperar os resultados
                    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Else para o foreach
                    $encontrouAssinatura = false; // Variável de controle
                    
                    // Loop através dos resultados e exibir todas as colunas
                    foreach ($resultados as $usuario) {
                        if ($usuario['cycle'] == 'MONTHLY' || $usuario['cycle'] == 'YEARLY') {
                            $status = ($usuario['status'] === 'ACTIVE') ? 'Ativo' : '';

                            $monthly = ($usuario['cycle'] === 'MONTHLY') ? 'selected' : '';
                            $yearly = ($usuario['cycle'] === 'YEARLY') ? 'selected' : '';

                            $data_criacao = date("d/m/Y", strtotime($usuario['data_criacao']));
                            
                            echo '
                                <form action="' . INCLUDE_PATH . 'back-end/editar-cobranca.php" method="post">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <p class="mb-0">Status:</p>
                                                <p class="font-weight-bold">' . $status . '</p>
                                            </div>
                                            <div class="position-relative form-group">
                                                <p class="mb-0">Criada em:</p>
                                                <p class="font-weight-bold">' . $data_criacao . '</p>
                                            </div>
                                            <div class="position-relative form-group">
                                                <p class="mb-0">Bandeira do cartão:</p>
                                                <p class="font-weight-bold">' . $usuario['cartao_bandeira'] . '</p>
                                            </div>
                                            <div class="position-relative form-group">
                                                <p class="mb-0">Final:</p>
                                                <p class="font-weight-bold">' . $usuario['cartao_numero'] . '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="position-relative form-group">
                                                <label for="valor" class="">Valor *</label>
                                                <input name="valor" id="valor" type="text" class="form-control" value="' . $usuario['valor'] . '" disabled>
                                            </div>
                                            <div class="position-relative form-group">
                                                <label for="cycle" class="">Ciclo *</label>
                                                <select name="cycle" id="cycle" class="form-control" disabled>
                                                    <option value="" disabled>-- Selecione o ciclo do pagamento --</option>
                                                    <option value="MONTHLY" ' . $monthly . '>Mensal</option>
                                                    <option value="YEARLY" ' . $yearly . '>Anual</option>
                                                </select>
                                            </div>
                                            <div class="position-relative form-group">
                                                <label for="forma_pagamento" class="">Forma de pagamento *</label>
                                                <select name="forma_pagamento" id="forma_pagamento" class="form-control" disabled>
                                                    <option value="" disabled>-- Selecione uma forma de pagamento --</option>
                                                    <option value="CREDIT_CARD" selected>Cartão de Crédito</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="payment_ids[]" value="' . $usuario['payment_id'] . '">
                                    <div class="d-flex justify-content-between">
                                        <a href="' . INCLUDE_PATH . 'back-end/cancelar_assinatura.php?payment_id=' . $usuario['payment_id'] . '" class="mt-2 btn btn-outline-danger">Cancelar Assinatura</a>
                                    </div>
                                    <div class="divider"></div>
                                </form>
                            ';
                        
                            $encontrouAssinatura = true;
                        }
                    }

                    if (!$encontrouAssinatura) {
                        echo 'Você não possui nenhuma assinatura ativa!';
                    }
                ?>
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
        $("#endereco").val("Carregando...");
        $("#municipio").val("Carregando...");
        $("#cidade").val("Carregando...");
        $("#uf").val("...");
        $.getJSON( "https://viacep.com.br/ws/"+cep+"/json/", function( data )
        {
            $("#endereco").val(data.logradouro);
            $("#municipio").val(data.bairro);
            $("#cidade").val(data.localidade);
            $("#uf").val(data.uf);
            $("#numero").focus();
        }).fail(function()
        {
            $("#endereco").val("");
            $("#municipio").val("");
            $("#cidade").val("");
            $("#uf").val(" ");
        });
    }
}
</script>
<!-- Mascara de Inputs -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#phone').on('input', function() {
            let inputValue = $(this).val().replace(/\D/g, ''); // Remove todos os não dígitos
            if (inputValue.length > 0) {
                inputValue = '(' + inputValue;
                if (inputValue.length > 3) {
                    inputValue = [inputValue.slice(0, 3), ') ', inputValue.slice(3)].join('');
                }
                if (inputValue.length > 10) {
                    inputValue = [inputValue.slice(0, 10), '-', inputValue.slice(10)].join('');
                }
                if (inputValue.length > 15) {
                    inputValue = inputValue.substr(0, 15);
                }
            }
            $(this).val(inputValue);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#cpf').on('input', function() {
            let inputValue = $(this).val().replace(/\D/g, ''); // Remove todos os não dígitos
            if (inputValue.length > 0) {
                inputValue = [inputValue.slice(0, 3), '.', inputValue.slice(3)].join('');
                if (inputValue.length > 7) {
                    inputValue = [inputValue.slice(0, 7), '.', inputValue.slice(7)].join('');
                }
                if (inputValue.length > 11) {
                    inputValue = [inputValue.slice(0, 11), '-', inputValue.slice(11)].join('');
                }
                if (inputValue.length > 14) {
                    inputValue = inputValue.substr(0, 14);
                }
            }
            $(this).val(inputValue);
        });
    });
</script>

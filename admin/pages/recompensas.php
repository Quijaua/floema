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
                <button type="button" data-toggle="tooltip" title="Example Tooltip"
                    data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-business-time fa-w-20"></i>
                        </span>
                        Buttons
                    </button>
                    <div tabindex="-1"  role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span> Inbox</span>
                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span> Book</span>
                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span> Picture</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a disabled class="nav-link disabled">
                                    <i class="nav-link-icon lnr-file-empty"></i>
                                    <span> File Disabled</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Recompensas</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/cards.php" method="post" enctype="multipart/form-data">
                        <?php 
                            if(isset($_SESSION['msgaddcad'])){
                                echo $_SESSION['msgaddcad'];
                                unset($_SESSION['msgaddcad']);
                            }
                        ?>
                        <?php
                            // Nome da tabela para a busca
                            $tabela = 'tb_cards';
                            
                            // Preparando a consulta SQL
                            $stmt = $conn->prepare("SELECT * FROM $tabela ORDER BY id DESC");
                            
                            // Executando a consulta
                            $stmt->execute();
                            
                            // Obtendo os resultados da busca
                            $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                                        <div class="col-sm-4 text-center">
                                            <label for="input' . $novaLinha . '" class="col-form-label d-block">Ícone</label>
                                            
                                            <label for="input' . $novaLinha . '" id="card-img" style="max-width: 300px; margin-bottom: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                                <img id="imagemPreview' . $novaLinha . '" alt="Miniatura da Imagem" style="width: 100%;">
                                            </label>

                                            <input type="file" name="icone" id="input' . $novaLinha . '" class="imagemInput"
                                                accept=".jpg, .jpeg, .png">
                                            <small class="form-text text-muted">
                                                Imagem em .jpg com 150px x 150px.
                                            </small>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="titulo" class="col-form-label">Título</label>
                                                <input name="titulo" id="titulo"
                                                    type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="descricao" class="col-form-label">Descrição</label>
                                                <textarea name="descricao" id="descricao" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            } else {
                                echo 'Só é possível adicionar até 4 cards!';
                            }
                        ?>
                        <div class="divider"></div>
                        <button type="<?php echo ($numLinhas < 4) ? 'submit' : 'button'; ?>" name="btnAddCard" class="btn <?php echo ($numLinhas < 4) ? 'btn-primary' : 'btn-secondary'; ?>">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Recompensas já existentes</h5>
                        <?php 
                            if(isset($_SESSION['msgupdcad'])){
                                echo $_SESSION['msgupdcad'];
                                unset($_SESSION['msgupdcad']);
                            }
                        ?>
                        <?php
                            // Nome da tabela para a busca
                            $tabela = 'tb_cards';
                            
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
                                    <form action="' . INCLUDE_PATH_ADMIN . 'back-end/cards.php" method="post" enctype="multipart/form-data">
                                        <div class="position-relative row form-group">
                                            <div class="col-sm-4 text-center">
                                                <label for="input' . $usuario['id'] . '" class="col-form-label d-block">Ícone</label>
                                                
                                                <label for="input' . $usuario['id'] . '" id="card-img" style="max-width: 300px; margin-bottom: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                                    <img id="imagemPreview' . $usuario['id'] . '" src="' . INCLUDE_PATH . 'assets/img/' . $usuario['icone'] . '" alt="Miniatura da Imagem" style="width: 100%;">
                                                </label>

                                                <input type="file" name="icone" id="input' . $usuario['id'] . '" class="imagemInput"
                                                    accept=".jpg, .jpeg, .png" value="' . $usuario['icone'] . '">
                                                <small class="form-text text-muted">
                                                    Imagem em .jpg com 500px x 160px.
                                                </small>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="titulo" class="col-form-label">Título</label>
                                                    <input name="titulo[]" id="titulo"
                                                        type="text" class="form-control" value="' . $usuario['titulo'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <label for="descricao" class="col-form-label">Descrição</label>
                                                    <textarea name="descricao[]" id="descricao" class="form-control">' . $usuario['descricao'] . '</textarea>
                                                </div>
                                                <div class="float-right">
                                                    <input type="hidden" name="ids[]" value="' . $usuario['id'] . '">
                                                    <a href="' . INCLUDE_PATH_ADMIN . 'back-end/apagar-card.php?id=' . $usuario['id'] . '" class="btn btn-outline-danger">Deletar</a>
                                                <button type="submit" name="btnUpdCard" class="btn btn-primary">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </form>
                                ';
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
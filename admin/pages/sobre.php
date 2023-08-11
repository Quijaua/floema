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
                    <h5 class="card-title">Sobre a Instituição</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update-about.php" method="post">
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
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update-about.php" method="post" enctype="multipart/form-data">
                        <div class="position-relative row form-group">
                            <label for="input1" class="col-sm-2 col-form-label">Logo da sua Instituição *</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="input1" class="imagemInput"
                                    accept=".jpg, .jpeg, .png" value="<?php echo $logo; ?>">
                                    
                                <small class="form-text text-muted">
                                    Essa será a logo mostrada no header do checkout.
                                </small>
                                
                                <label for="input1" id="card-img" style="max-width: 300px; margin-top: 1rem; padding: 1.5rem; border: 1px dashed #afb2d2; border-radius: .5rem; background: #dfdfdf;">
                                    <img id="imagemPreview1" src="<?php echo INCLUDE_PATH . 'assets/img/' . $logo; ?>" alt="Miniatura da Imagem" style="width: 100%;">
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="btnUpdLogo" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Cabeçalho</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update-about.php" method="post">
                        <div class="position-relative row form-group">
                            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input name="titulo" id="titulo"
                                    type="text" class="form-control" value="<?php echo $titulo; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="conteudo" class="col-sm-2 col-form-label">Conteúdo</label>
                            <div class="col-sm-10">
                                <input name="conteudo" id="conteudo"
                                    type="text" class="form-control" value="<?php echo $conteudo; ?>">
                            </div>
                        </div>
                        <button type="submit" name="btnUpdHeader" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Rodapé</h5>
                    <form action="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/update-about.php" method="post">
                        <div class="position-relative row form-group">
                            <label for="razao_social" class="col-sm-2 col-form-label">Razão Social</label>
                            <div class="col-sm-10">
                                <input name="razao_social" id="razao_social"
                                    type="text" class="form-control" value="<?php echo $razao_social; ?>">
                            </div>
                        </div>
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
                                <input name="faq" id="faq"
                                    type="text" class="form-control" value="<?php echo $faq; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="contato" class="col-sm-2 col-form-label">Contato</label>
                            <div class="col-sm-10">
                                <input name="contato" id="contato"
                                    type="text" class="form-control" value="<?php echo $contato; ?>">
                            </div>
                        </div>
                        <button type="submit" name="btnUpdFooter" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>
                    Sobre a sua Conta
                    <div class="page-title-subheading">Altere as informações da sua conta aqui!</div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?php echo INCLUDE_PATH_ADMIN; ?>back-end/logout.php" class="btn btn-info btn-shadow">
                    Sair
                </a>
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
                        <h5 class="card-title">Redefinir senha</h5>
                        <div class="position-relative row form-group">
                            <p class="col-sm-12 col-form-label">Enviar E-mail para redefinir senha! <a href="<?php echo INCLUDE_PATH ?>login/recuperar-senha.php">Clique aqui</a></p>
                        </div>
                        <button type="submit" name="btnUpdAbout" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
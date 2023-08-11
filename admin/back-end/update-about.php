<?php
session_start();
ob_start();

if (isset($_POST['btnUpdAbout'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        //Id da tabela
        $id = '1';

        //Informacoes coletadas pelo metodo POST
        $nome = $_POST['nome'];
        $title = $_POST['title'];
        $descricao = $_POST['descricao'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET nome = :nome, title = :title, descricao = :descricao WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();

            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'As informações sobre sua instituição foram atualizadas com sucesso!';

            //Voltar para a pagina do formulario
            header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
        } catch (PDOException $e) {
            echo "Erro na atualização: " . $e->getMessage();
        }
    }
}

if (isset($_POST['btnUpdLogo'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se um arquivo foi enviado
    if (isset($_FILES['logo'])) {
        $imagemNome = $_FILES['logo']['name'];
        $imagemTemp = $_FILES['logo']['tmp_name'];

        //Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        //Id da tabela
        $id = '1';

        // Preparando a consulta SQL
        $sqlSelect = $conn->prepare("SELECT (logo) FROM $tabela WHERE id=:id");
            
        // Substituindo os parâmetros na consulta
        $sqlSelect->bindParam(':id', $id);

        // Executando a consulta
        $sqlSelect->execute();
        
        // Obtendo os resultados da busca
        $logo = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
        
        // Iterando sobre os resultados
        foreach ($logo as $data) {
            // Acessando os valores dos campos do resultado
            $logo = $data['logo'];
        }

        // Salve o nome da imagem no banco de dados
        $sql = "UPDATE $tabela SET logo = :logo WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':logo', $imagemNome);
        $stmt->bindParam(':id', $id);
        
        try {
            $stmt->execute();
        
            // Mova o arquivo para o servidor
            $caminhoDestino = "../../assets/img/" . $imagemNome;


            if(unlink("../../assets/img/" . $logo)){
                if (move_uploaded_file($imagemTemp, $caminhoDestino)) {
                    // Exibir a modal após salvar as informações
                    $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
                    $_SESSION['msg'] = 'A logo foi salva com sucesso com sucesso!';

                    //Voltar para a pagina do formulario
                    header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
                } else {
                    echo "Erro ao enviar o arquivo para o servidor.";
                }
            }

        } catch (PDOException $e) {
            echo "Erro ao salvar o nome da logo no banco de dados: " . $e->getMessage();
        }
    }

    if(isset($_POST['btnUpdatePersonalize']))
    {
        // Nome da tabela para a busca
        $tabela = 'tb_checkout';

        // Dados para o update
        $id = '1'; // ID do registro a ser atualizado
        $cores_cabecalho = $_POST['cores_cabecalho']; // Novo valor para atualizar
        $cores_elementos = $_POST['cores_elementos']; // Novo valor para atualizar
        $logo_position = $_POST['logo_position']; // Novo valor para atualizar
        $privacidade = $_POST['privacidade']; // Novo valor para atualizar
        $faq = $_POST['faq']; // Novo valor para atualizar
        $contato = $_POST['contato']; // Novo valor para atualizar
        $title = $_POST['title']; // Novo valor para atualizar
        $text = $_POST['text']; // Novo valor para atualizar

        // Preparando a consulta SQL
        $sqlSelect = $conn->prepare("SELECT (logo) FROM $tabela WHERE id=:id");
        
        // Substituindo os parâmetros na consulta
        $sqlSelect->bindParam(':id', $id);

        // Executando a consulta
        $sqlSelect->execute();
        
        // Obtendo os resultados da busca
        $logo = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
        
        // Iterando sobre os resultados
        foreach ($logo as $data) {
            // Acessando os valores dos campos do resultado
            $logo = $data['logo'];
        }

        $updImage = true;
    
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $arquivo = $_FILES['logo']['name'];
        
        //Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = INCLUDE_PATH . 'assets/img/';
        
        //Tamanho máximo do arquivo em Bytes
        $_UP['tamanho'] = 1024*1024*2; //2mb
        
        //Array com a extensões permitidas
        $_UP['extensoes'] = array('png', 'jpg', 'jpeg');
        
        //Renomeiar
        $_UP['renomeia'] = true;
        
        //Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        
        //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
        //Primeiro verifica se deve trocar o nome do arquivo
        if($_UP['renomeia'] == true){
            //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = time().'.png';
        }else{
            //mantem o nome original do arquivo
            $nome_final = $_FILES['logo']['name'];
        }
        if ($_FILES['logo']['name'] == '')
        {
            $updImage = false;
        }

        //Faz a verificação da extensao do arquivo
        $tmp = explode('.', $_FILES['logo']['name']);
        $extensao = strtolower(end($tmp));

        if ($updImage == false) {
            // Preparando a consulta SQL
            $stmt = $conn->prepare("UPDATE $tabela SET 
                cores_cabecalho=:cores_cabecalho,
                cores_elementos=:cores_elementos,
                logo_position=:logo_position,
                privacidade=:privacidade,
                faq=:faq,
                contato=:contato,
                title=:title,
                text=:text
            WHERE id=:id");

            // Substituindo os parâmetros na consulta
            $stmt->bindParam(':cores_cabecalho', $cores_cabecalho);
            $stmt->bindParam(':cores_elementos', $cores_elementos);
            $stmt->bindParam(':logo_position', $logo_position);
            $stmt->bindParam(':privacidade', $privacidade);
            $stmt->bindParam(':faq', $faq);
            $stmt->bindParam(':contato', $contato);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':id', $id);

            // Executando o update
            $stmt->execute();

            // Mensagem de sucesso
            $_SESSION['msgcad'] = 'As informações de segurança foram atualizadas com sucesso!';
            header("Location: ".INCLUDE_PATH_CHECKOUT."personalizar");
        }

        else if(array_search($extensao, $_UP['extensoes']) === false){
            // Mensagem de falha
            $_SESSION['msgcad'] = 'A extensão da imagem é inválida.';
        }
        
        //Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['logo']['size']){
            // Mensagem de falha
            $_SESSION['msgcad'] = 'Arquivo muito grande.';
        }

        else if ($updImage == true){
            //Verificar se é possivel mover o arquivo para a pasta escolhida
            if(unlink("../assets/img/".$logo)){
                if(move_uploaded_file($_FILES['logo']['tmp_name'], $_UP['pasta']. $nome_final)){
                    // Preparando a consulta SQL
                    $stmt = $conn->prepare("UPDATE $tabela SET 
                        cores_cabecalho=:cores_cabecalho,
                        cores_elementos=:cores_elementos,
                        logo=:logo,
                        logo_position=:logo_position,
                        privacidade=:privacidade,
                        faq=:faq,
                        contato=:contato,
                        title=:title,
                        text=:text
                    WHERE id=:id");
    
                    // Substituindo os parâmetros na consulta
                    $stmt->bindParam(':cores_cabecalho', $cores_cabecalho);
                    $stmt->bindParam(':cores_elementos', $cores_elementos);
                    $stmt->bindParam(':logo', $nome_final);
                    $stmt->bindParam(':logo_position', $logo_position);
                    $stmt->bindParam(':privacidade', $privacidade);
                    $stmt->bindParam(':faq', $faq);
                    $stmt->bindParam(':contato', $contato);
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':text', $text);
                    $stmt->bindParam(':id', $id);
    
                    // Executando o update
                    $stmt->execute();

                    // Mensagem de sucesso
                    $_SESSION['msgcad'] = 'As informações de segurança foram atualizadas com sucesso!';
                    header("Location: ".INCLUDE_PATH_CHECKOUT."personalizar");
                }else{
                    //Upload não efetuado com sucesso, exibe a mensagem
                    $_SESSION['msgcad'] = 'Erro ao atualizar.';
                }
            }
        }
    }
}

if (isset($_POST['btnUpdHeader'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        //Id da tabela
        $id = '1';

        //Informacoes coletadas pelo metodo POST
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET titulo = :titulo, conteudo = :conteudo WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();

            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'As informações do cabeçalho foram atualizadas com sucesso!';

            //Voltar para a pagina do formulario
            header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
        } catch (PDOException $e) {
            echo "Erro na atualização: " . $e->getMessage();
        }
    }
}

if (isset($_POST['btnUpdFooter'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        //Id da tabela
        $id = '1';

        //Informacoes coletadas pelo metodo POST
        $razao_social = $_POST['razao_social'];
        $privacidade = $_POST['privacidade'];
        $faq = $_POST['faq'];
        $contato = $_POST['contato'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET razao_social = :razao_social, privacidade = :privacidade, faq = :faq, contato = :contato WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':razao_social', $razao_social);
        $stmt->bindParam(':privacidade', $privacidade);
        $stmt->bindParam(':faq', $faq);
        $stmt->bindParam(':contato', $contato);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();

            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'As informações do rodapé foram atualizadas com sucesso!';

            //Voltar para a pagina do formulario
            header('Location: ' . INCLUDE_PATH_ADMIN . 'sobre');
        } catch (PDOException $e) {
            echo "Erro na atualização: " . $e->getMessage();
        }
    }
}
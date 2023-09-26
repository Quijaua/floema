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

if (isset($_POST['btnUpdColor'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        //Id da tabela
        $id = '1';

        //Informacoes coletadas pelo metodo POST
        $color = $_POST['color'];
        $hover = $_POST['hover'];
        $load_btn = $_POST['loadBtn'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET color = :color, hover = :hover, load_btn = :loadBtn WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':hover', $hover);
        $stmt->bindParam(':loadBtn', $load_btn);
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
        $privacidade = $_POST['privacidade'];
        $faq = $_POST['faq'];

        if (!isset($_POST["dFacebook"])) {
            $facebook = $_POST['facebook'];
        }
        if (!isset($_POST["dInstagram"])) {
            $instagram = $_POST['instagram'];
        }
        if (!isset($_POST["dLinkedin"])) {
            $linkedin = $_POST['linkedin'];
        }
        if (!isset($_POST["dYoutube"])) {
            $youtube = $_POST['youtube'];
        }
        if (!isset($_POST["dWebsite"])) {
            $website = $_POST['website'];
        }

        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        if (!isset($_POST["dNumero"])) {
            $numero = $_POST['numero'];
        }
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET privacidade = :privacidade, faq = :faq, facebook = :facebook, instagram = :instagram, linkedin = :linkedin, youtube = :youtube, website = :website, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, telefone = :telefone, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':privacidade', $privacidade);
        $stmt->bindParam(':faq', $faq);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':instagram', $instagram);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':youtube', $youtube);
        $stmt->bindParam(':website', $website);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
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

if (isset($_POST['btnUpdDonations'])) {
    //Inclui o arquivo 'config.php'
    include('../../config.php');

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Tabela onde sera feita a alteracao
        $tabela = 'tb_checkout';

        // Id da tabela
        $id = '1';

        // Informacoes coletadas pelo metodo POST
        $monthly_1 = $_POST['monthly_1'];
        $monthly_2 = $_POST['monthly_2'];
        $monthly_3 = $_POST['monthly_3'];
        $monthly_4 = $_POST['monthly_4'];
        $monthly_5 = $_POST['monthly_5'];
        $yearly_1 = $_POST['yearly_1'];
        $yearly_2 = $_POST['yearly_2'];
        $yearly_3 = $_POST['yearly_3'];
        $yearly_4 = $_POST['yearly_4'];
        $yearly_5 = $_POST['yearly_5'];
        $once_1 = $_POST['once_1'];
        $once_2 = $_POST['once_2'];
        $once_3 = $_POST['once_3'];
        $once_4 = $_POST['once_4'];
        $once_5 = $_POST['once_5'];

        // Atualize o item no banco de dados
        $sql = "UPDATE $tabela SET monthly_1 = :monthly_1, monthly_2 = :monthly_2, monthly_3 = :monthly_3, monthly_4 = :monthly_4, monthly_5 = :monthly_5, yearly_1 = :yearly_1, yearly_2 = :yearly_2, yearly_3 = :yearly_3, yearly_4 = :yearly_4, yearly_5 = :yearly_5, once_1 = :once_1, once_2 = :once_2, once_3 = :once_3, once_4 = :once_4, once_5 = :once_5 WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':monthly_1', $monthly_1);
        $stmt->bindParam(':monthly_2', $monthly_2);
        $stmt->bindParam(':monthly_3', $monthly_3);
        $stmt->bindParam(':monthly_4', $monthly_4);
        $stmt->bindParam(':monthly_5', $monthly_5);
        $stmt->bindParam(':yearly_1', $yearly_1);
        $stmt->bindParam(':yearly_2', $yearly_2);
        $stmt->bindParam(':yearly_3', $yearly_3);
        $stmt->bindParam(':yearly_4', $yearly_4);
        $stmt->bindParam(':yearly_5', $yearly_5);
        $stmt->bindParam(':once_1', $once_1);
        $stmt->bindParam(':once_2', $once_2);
        $stmt->bindParam(':once_3', $once_3);
        $stmt->bindParam(':once_4', $once_4);
        $stmt->bindParam(':once_5', $once_5);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();

            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'As informações dos valores foram atualizadas com sucesso!';

            //Voltar para a pagina do formulario
            header('Location: ' . INCLUDE_PATH_ADMIN);
        } catch (PDOException $e) {
            echo "Erro na atualização: " . $e->getMessage();
        }   
    }
}
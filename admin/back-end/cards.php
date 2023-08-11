<?php
    session_start();
    ob_start();

    include_once('../../config.php');

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Criar Card
    if (isset($_POST['btnAddCard'])) {

        // Nome da tabela para a busca
        $tabela = 'tb_cards';

        // Dados para a criação
        $titulo = $_POST['titulo']; // Novo valor para atualizar
        $descricao = $_POST['descricao']; // Novo valor para atualizar

        $updImage = true;
        
        $arquivo = $_FILES['icone']['name'];
        
        //Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = '../../assets/img/';
        
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
            $nome_final = $_FILES['icone']['name'];
        }
        if ($_FILES['icone']['name'] == '')
        {
            $updImage = false;
        }

        //Faz a verificação da extensao do arquivo
        $tmp = explode('.', $_FILES['icone']['name']);
        $extensao = strtolower(end($tmp));

        if(array_search($extensao, $_UP['extensoes']) === false){
            // Mensagem de falha
            $_SESSION['msgaddcad'] = 'A extensão da imagem é inválida';
        }
        
        //Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['icone']['size']){
            // Mensagem de falha
            $_SESSION['msgaddcad'] = 'Arquivo muito grande.';
        }

        //Verificar se é possivel mover o arquivo para a pasta escolhida
        if(move_uploaded_file($_FILES['icone']['tmp_name'], $_UP['pasta'] . $nome_final)){
            // Consulta SQL para inserir uma nova linha
            $stmt = $conn->prepare("INSERT INTO $tabela (titulo, descricao, icone) 
            VALUES (:titulo, :descricao, :icone)");
            
            // Bind dos parâmetros
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':icone', $nome_final, PDO::PARAM_STR);

            // Executando o update
            $stmt->execute();

            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'O card foi salvo com sucesso com sucesso!';

            header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
        }
        else
        {
            // Mensagem de falha
            $_SESSION['msgaddcad'] = 'Erro ao criar card.';
            header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
        }
    }

    if (isset($_POST['btnUpdCard'])) {
        // Nome da tabela para a busca
        $tabela = 'tb_cards';

        // Dados para o update
        $ids = $_POST['ids']; // ID do registro a ser atualizado
        $titulo = $_POST['titulo']; // Novo valor para atualizar
        $descricao = $_POST['descricao']; // Novo valor para atualizar

        // Atualizar os registros no banco de dados
        for ($i = 0; $i < count($titulo); $i++) {
            $id = $ids[$i];
            $titulo = $titulo[$i];
            $descricao = $descricao[$i];

            // Preparando a consulta SQL
            $sqlSelect = $conn->prepare("SELECT (icone) FROM $tabela WHERE id=:id");
            
            // Substituindo os parâmetros na consulta
            $sqlSelect->bindParam(':id', $id);

            // Executando a consulta
            $sqlSelect->execute();
            
            // Obtendo os resultados da busca
            $icone = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
            
            // Iterando sobre os resultados
            foreach ($icone as $data) {
                // Acessando os valores dos campos do resultado
                $icone = $data['icone'];
            }

            $updImage = true;
        
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            $arquivo = $_FILES['icone']['name'];
            
            //Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../../assets/img/';
            
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
                $nome_final = $_FILES['icone']['name'];
            }
            if ($_FILES['icone']['name'] == '')
            {
                $updImage = false;
            }

            //Faz a verificação da extensao do arquivo
            $tmp = explode('.', $_FILES['icone']['name']);
            $extensao = strtolower(end($tmp));

            if ($updImage == false) {
                $sql = "UPDATE $tabela SET titulo = :titulo, descricao = :descricao WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Exibir a modal após salvar as informações
                $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
                $_SESSION['msg'] = 'As informações dos cards foram atualizadas com sucesso!';
                header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
            }

            else if(array_search($extensao, $_UP['extensoes']) === false){
                // Mensagem de falha
                $_SESSION['msgupdcad'] = 'A extensão da imagem é inválida.';
                header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
            }
            
            //Faz a verificação do tamanho do arquivo
            else if ($_UP['tamanho'] < $_FILES['icone']['size']){
                // Mensagem de falha
                $_SESSION['msgupdcad'] = 'Arquivo muito grande.';
                header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
            }

            else if ($updImage == true){
                //Verificar se é possivel mover o arquivo para a pasta escolhida
                if(unlink("../../assets/img/" . $icone)){
                    if(move_uploaded_file($_FILES['icone']['tmp_name'], $_UP['pasta']. $nome_final)){
                        // Preparando a consulta SQL
                        $stmt = $conn->prepare("UPDATE $tabela SET 
                            titulo=:titulo,
                            descricao=:descricao,
                            icone=:icone
                        WHERE id=:id");
        
                        // Substituindo os parâmetros na consulta
                        $stmt->bindParam(':titulo', $titulo);
                        $stmt->bindParam(':descricao', $descricao);
                        $stmt->bindParam(':icone', $nome_final);
                        $stmt->bindParam(':id', $id);
        
                        // Executando o update
                        $stmt->execute();

                        // Exibir a modal após salvar as informações
                        $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
                        $_SESSION['msg'] = 'As informações dos cards foram atualizadas com sucesso!';
                        header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
                    }else{
                        //Upload não efetuado com sucesso, exibe a mensagem
                        $_SESSION['msgupdcad'] = 'Erro ao atualizar.';
                        header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
                    }
                }
            }
        }
    } else {
        // Mensagem de falha
        $_SESSION['msgupdcad'] = 'Erro ao editar card.';
        header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
    }
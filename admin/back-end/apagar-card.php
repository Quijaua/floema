<?php
    session_start();
    ob_start();

    include_once('../../config.php');

    //Apagar Card
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){
        // Nome da tabela para a busca
        $tabela = 'tb_cards';

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
        if(unlink(INCLUDE_PATH . "assets/img/" . $icone)){
            // Consulta SQL para excluir a linha
            $stmt = $conn->prepare("DELETE FROM $tabela WHERE id = :id");
            
            // Bind dos parâmetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Executar a consulta
            $stmt->execute();
            
            // Exibir a modal após salvar as informações
            $_SESSION['show_modal'] = "<script>$('#staticBackdrop').modal('toggle');</script>";
            $_SESSION['msg'] = 'O card foi deletado com sucesso com sucesso!';

            header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
        }else{
            // Mensagem de falha
            $_SESSION['msgcad'] = 'Não foi possível deletar o card!';
            header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
        }
    }else{
        // Mensagem de falha
        $_SESSION['msgcad'] = 'É necessário selecionar um card!';
        header("Location: " . INCLUDE_PATH_ADMIN . "recompensas");
    }
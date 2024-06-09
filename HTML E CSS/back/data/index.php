<?php
header("Access-Control-Allow-Origin: *");


require("data/db_context.php");


$tipo = 0;

if (isset($_GET['tipo'])) {
    $tipo = intval($_GET['tipo']);
} 
else {
    $error = array('error' => 'Parametro TIPO não indicado na requisicao');
    echo json_encode($error);
    
}

$db_context = new DbContext();

$db_context->conectar();

//Inicia a conexão com o banco de dados
$jogos = new Jogos($conexao);

if ($tipo ==1) {

        // Adicionar um jogo
        if (isset($_POST['nome']) && isset($_POST['descricao'])) {

            $nomeDoJogo = $_POST['nome'];
            $descricaoDoJogo = $_POST['descricao'];

            if ($jogos->adicionar($nomeDoJogo, $descricaoDoJogo)) {
                echo json_encode(array('message' => 'Jogo adicionado com sucesso'));
            } else {
                echo json_encode(array('error' => 'Falha ao adicionar jogo'));
            }
        } else {
            echo json_encode(array('error' => 'Dados insuficientes para adicionar jogo'));
        }
        break;

    case 2:
        // Consultar jogos
        $resultado = $jogos->consultar();
        $jogosArray = array();
        while ($row = $resultado->fetch_assoc()) {
            $jogosArray[] = $row;
        }
        echo json_encode($jogosArray);
        break;

    case 3:
        // Atualizar um jogo
        if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['descricao'])) {
            $id = intval($_POST['id']);
            $nomeDoJogo = $_POST['nome'];
            $descricaoDoJogo = $_POST['descricao'];
            if ($jogos->atualizar($id, $nomeDoJogo, $descricaoDoJogo)) {
                echo json_encode(array('message' => 'Jogo atualizado com sucesso'));
            } else {
                echo json_encode(array('error' => 'Falha ao atualizar jogo'));
            }
        } else {
            echo json_encode(array('error' => 'Dados insuficientes para atualizar jogo'));
        }
        break;

    case 4:
        // Deletar um jogo
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            if ($jogos->deletar($id)) {
                echo json_encode(array('message' => 'Jogo deletado com sucesso'));
            } else {
                echo json_encode(array('error' => 'Falha ao deletar jogo'));
            }
        } else {
            echo json_encode(array('error' => 'ID não fornecido para deletar jogo'));
        }
        break;

    default:
        echo json_encode(array('error' => 'Tipo de operação inválido'));
        break;
}
//Fechar conexão de banco de dados
$db_context ->desconectar();
?>
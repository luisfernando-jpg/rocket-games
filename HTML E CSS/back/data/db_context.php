<?php
require_once("config.php");

class DbContext {
    private $host;
    private $porta;
    private $dbname;
    private $usuario;
    private $senha;
    private $conexao;

    public function __construct() {
        $this->host = MYSQL_DB_HOST;
        $this->porta = MYSQL_DB_PORT;
        $this->dbname = MYSQL_DB_DATABASE;
        $this->usuario = MYSQL_DB_USERNAME;
        $this->senha = MYSQL_DB_PASSWORD;
    }

    public function conectar() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->dbname, $this->porta);

        if ($this->conexao->connect_error) {
            die("Conexão falhou: " . $this->conexao->connect_error);
        }
    }

    public function desconectar() {
        $this->conexao->close();
    }

    private function executar_query_sql($query) {
        $resultado = $this->conexao->query($query);
        if (!$resultado) {
            $error = array('error' => $this->conexao->error);
            return json_encode($error);
        }

        if ($resultado->num_rows > 0) {
            $linhas = array();
            while ($linha = $resultado->fetch_assoc()) {
                $linhas[] = $linha;
            }
            return json_encode($linhas);
        }

        return json_encode($resultado);
    }
}

class Jogos {
    private $conexao;

    // Construtor para inicializar a conexão com o banco de dados
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para adicionar um nome do jogo ao banco de dados
    public function adicionar($nomeDoJogo, $descricaoDoJogo) {
        // Sanitização dos inputs para evitar SQL Injection
        $nomeDoJogo = $this->conexao->real_escape_string($nomeDoJogo);
        $descricaoDoJogo = $this->conexao->real_escape_string($descricaoDoJogo);

        // Criação da query de inserção
        $query = "INSERT INTO jogos (nome, descricao) VALUES ('$nomeDoJogo', '$descricaoDoJogo')";

        // Execução da query
        return $this->executar_query_sql($query);
    }

    // Método para consultar todos os jogos do banco de dados
    public function consultar() {
        // Criação da query de seleção
        $query = "SELECT * FROM jogos ORDER BY id";

        // Execução da query
        return $this->executar_query_sql($query);
    }

    // Método genérico para executar queries SQL
    private function executar_query_sql($query) {
        return $this->conexao->query($query);
    }
}
public function atualizar($id, $nomeDoJogo, $descricaoDoJogo) {
    // Sanitização dos inputs para evitar SQL Injection
    $nomeDoJogo = $this->conexao->real_escape_string($nomeDoJogo);
    $descricaoDoJogo = $this->conexao->real_escape_string($descricaoDoJogo);

    // Criação da query de atualização
    $query = "UPDATE jogos SET nome = '$nomeDoJogo', descricao = '$descricaoDoJogo' WHERE id = $id";

    // Execução da query
    return $this->executar_query_sql($query);
}

// Método para deletar um jogo
public function deletar($id) {
    // Criação da query de deleção
    $query = "DELETE FROM jogos WHERE id = $id";

    // Execução da query
    return $this->executar_query_sql($query);
}

?>


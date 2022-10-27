<?php

require_once("../init.php");
class Banco
{

    protected $mysqli;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    /**
     * Função para incluir pessoa no banco
     *
     * @param [text] $nome
     * @param [text] $cpf
     * @param [text] $rg
     * @param [date] $data_nascimento
     * @param [int] $endereco_id
     * @return [bool]
     */
    public function setPessoas($nome, $cpf, $rg, $data_nascimento, $data_cadastro, $endereco_id, $usuario_id)
    {
        $stmt = $this->mysqli->prepare(
            "INSERT INTO pessoas (`nome`, `cpf`, `rg`, `data_nascimento`, `data_cadastro`, `endereco_id`, `usuario_id`)
             VALUES (?,?,?,?,?,?,?)"
        );

        $stmt->bind_param("sssssss", $nome, $cpf, $rg, $data_nascimento, $data_cadastro, $endereco_id, $usuario_id);

        if ($stmt->execute() == TRUE) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    /**
     * Função para cadastrar os números de telefone
     *
     * @param [int] $pessoa_id
     * @param [text] $telefone
     * @return void
     */
    public function setTelefones($pessoa_id, $telefone)
    {
        $stmt = $this->mysqli->prepare(
            "INSERT INTO telefones (`pessoa_id`, `telefone`) VALUES (?,?)"
        );

        $stmt->bind_param("ss", $pessoa_id, $telefone);

        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Função que cadastra o endereço
     *
     * @param [text] $cep
     * @param [text] $endereco
     * @param [text] $numero
     * @param [int] $estado_id
     * @return [bool]
     */
    public function setEndereco($cep, $endereco, $numero, $estado_id)
    {
        $stmt = $this->mysqli->prepare(
            "INSERT INTO enderecos (`cep`, `endereco`, `numero`, `estado_id`) VALUES (?,?,?,?)"
        );

        $stmt->bind_param("ssss", $cep, $endereco, $numero, $estado_id);

        if ($stmt->execute() == TRUE) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    /**
     * Função para cadastrar o usuário
     *
     * @param [text] $email
     * @param [text] $senha
     * @return [bool]
     */
    public function setUsuario($email, $senha)
    {

        $result = $this->mysqli->query("SELECT * FROM usuarios  WHERE `email` = '" . $email . "';");

        if (!$result->fetch_array(MYSQLI_ASSOC)) {

            $stmt = $this->mysqli->prepare(
                "INSERT INTO usuarios (`email`, `senha`) VALUES (?,?)"
            );

            $stmt->bind_param("ss", $email, $senha);

            if ($stmt->execute() == TRUE) {
                return $stmt->insert_id;
            } else {
                return false;
            }
        } else {
            return [];
        }
    }

    /**
     * Função para pegar as pessoas do banco
     *
     * @return [array]
     */
    public function getPessoas()
    {
        try {

            $result = $this->mysqli->query("SELECT p.nome, p.cpf, p.rg, p.data_nascimento,
                p.data_cadastro, p.data_atualizacao, ende.cep, ende.endereco, ende.numero, 
                est.uf AS estado, u.email, p.id
                FROM pessoas p
                INNER JOIN enderecos ende ON ende.id = p.endereco_id
                INNER JOIN estados est ON est.id = ende.estado_id
                INNER JOIN telefones t ON t.pessoa_id = p.id
                INNER JOIN usuarios u ON u.id = p.usuario_id
                WHERE p.data_exclusao IS null 
            ");

            $array  = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $row;
            }
            return $array;
        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Função para pegar os estados do banco
     *
     * @return [array]
     */
    public function getEstados()
    {
        try {
            $result = $this->mysqli->query("SELECT * FROM estados");
            $array  = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $row;
            }
            return $array;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function deletePessoa($id)
    {
        $data_exclusao = date('Y-m-d H:i:s');

        if ($this->mysqli->query("UPDATE `pessoas` SET `data_exclusao` = '$data_exclusao' WHERE `id` = '" . $id . "';") == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePessoas($nome, $cpf, $rg, $data_nascimento, $data_atualizacao, $id)
    {
        $stmt = $this->mysqli->prepare(
            "UPDATE `pessoas` SET `nome` = ?, `cpf` = ?, `data_nascimento` = ?, `data_atualizacao` = ? WHERE `id` = $id"
        );

        $stmt->bind_param("ssss", $nome, $cpf, $rg, $data_nascimento, $data_atualizacao);
        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

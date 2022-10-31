<?php
require_once("../model/cadastroModel.php");
require_once("../helps/Niv_Functions.php");

class ControllerEditar
{

    private $cadastro;

    public function __construct()
    {
        $this->cadastro = new Cadastro();
        $this->updateCadastro();
    }

    public function getPessoa($id)
    {
        return $this->cadastro->getPessoa($id);
    }

    public function updateCadastro()
    {

        if (!empty($_POST)) {

            if (!isset($_POST['telefone']) || empty($_POST['telefone']) || strlen($_POST['telefone']) != 15) {
                echo "<script>alert('Telefone no formato errado!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['endereco']) || empty($_POST['endereco'])) {
                echo "<script>alert('Endereço inválido!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['numero']) || empty($_POST['numero'])) {
                echo "<script>alert('Número vazio!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['estado_id']) || empty($_POST['estado_id']) || !is_numeric($_POST['estado_id']) || $_POST['estado_id'] <= 0 || $_POST['estado_id'] >= 28) {
                echo "<script>alert('Estado vazio ou incorreto!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['nome']) || empty($_POST['nome'])) {
                echo "<script>alert('Nome vazio!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['rg']) || empty($_POST['rg'])) {
                echo "<script>alert('RG vazio!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['data_nascimento']) || !Niv_Functions::validateDate($_POST['data_nascimento']) || empty($_POST['data_nascimento'])) {
                echo "<script>alert('Formato de data inválido!');history.back()</script>";
                exit();
            }

            if (!isset($_POST['data_nascimento']) || empty($_POST['data_nascimento']) || $_POST['data_nascimento'] > date("Y-m-d") || $_POST['data_nascimento'] < date('Y-m-d', strtotime('- 100 year'))) {
                echo "<script>alert('Data de nascimento vazia ou inválida!');history.back()</script>";
                exit();
            }

            $banco = new Cadastro();

            $banco->setTelefone($_POST['telefone']);

            $banco->setEnderecos($_POST['endereco']);
            $banco->setCep($_POST['cep']);
            $banco->setNumero($_POST['numero']);
            $banco->setEstado($_POST['estado_id']);

            $banco->setNome($_POST['nome']);
            $banco->setCpf($_POST['cpf']);
            $banco->setRg($_POST['rg']);
            $banco->setDatanascimento($_POST['data_nascimento']);
            $banco->setDataatualizacao(date('Y-m-d H:i:s'));
            $banco->setUser($_POST['id']);

            // Niv_Functions::_investiga(
            //     $banco
            // );

            $result = $banco->atualizar();

            if ($result == 1) {
                echo "<script>alert('Registro alterado com sucesso!');document.location='../view/index.php'</script>";
            } else if ($result == 0) {
                echo "<script>alert('Erro ao alterar registro, verifique as informações.');history.back()</script>";
            } else {
                echo "<script>alert('CPF já foi utilizado, tente outro por favor!');history.back()</script>";
            }
        }
    }
}

new ControllerEditar();

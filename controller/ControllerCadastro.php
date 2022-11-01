<?php
require_once("../model/cadastroModel.php");
require_once("../helps/Niv_Functions.php");

class ControllerCadastro
{

    private $cadastro;

    public function __construct()
    {
        $this->cadastro = new Cadastro();
        $this->incluir();
    }

    private function incluir()
    {

        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('E-mail está no formato incorreto!');history.back()</script>";
            exit();
        }

        if (!isset($_POST['senha']) || empty($_POST['senha'])) {
            echo "<script>alert('Senha não pode ser vazia!');history.back()</script>";
            exit();
        }

        if (!isset($_POST['telefone']) || empty($_POST['telefone']) || strlen($_POST['telefone']) != 15) {
            echo "<script>alert('Telefone no formato errado!');history.back()</script>";
            exit();
        }

        if (!isset($_POST['endereco']) || empty($_POST['endereco'])) {
            echo "<script>alert('Endereço inválido!');history.back()</script>";
            exit();
        }

        // if (!isset($_POST['cep']) || strlen($_POST['cep']) != 8 || empty($_POST['cep']) || !Niv_Functions::cpfValidate($_POST['cep'])) {
        //     echo "<script>alert('CEP é inválido. Favor confirmar!');history.back()</script>";
        //     exit();
        // }

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

        if (!isset($_POST['cpf']) || !Niv_Functions::cpfValidate($_POST['cpf']) || empty($_POST['cpf'])) {
            echo "<script>alert('CPF inválido!');history.back()</script>";
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

        $this->cadastro->setEmail($_POST['email']);
        $this->cadastro->setSenha($_POST['senha']);
        $this->cadastro->setTelefone($_POST['telefone']);

        $this->cadastro->setEnderecos($_POST['endereco']);
        $this->cadastro->setCep($_POST['cep']);
        $this->cadastro->setNumero($_POST['numero']);
        $this->cadastro->setEstado($_POST['estado_id']);

        $this->cadastro->setNome($_POST['nome']);
        $this->cadastro->setCpf($_POST['cpf']);
        $this->cadastro->setRg($_POST['rg']);
        $this->cadastro->setDatanascimento($_POST['data_nascimento']);
        $this->cadastro->setDatacadastro(date('Y-m-d H:i:s'));

        // Niv_Functions::_investiga(
        //     $this->cadastro
        // );

        $result = $this->cadastro->incluir();

        if ($result == 1) {
            echo "<script>alert('Registro incluído com sucesso!');document.location='../view/index.php'</script>";
        } else if ($result == 0) {
            echo "<script>alert('Erro ao gravar registro, verifique as informações.');history.back()</script>";
        }
    }
}
new ControllerCadastro();

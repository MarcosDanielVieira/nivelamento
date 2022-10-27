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

        if (Niv_Functions::cpfValidate($_POST['cpf'])) {

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
            $this->cadastro->setDatacadastro(date('Y-m-d H:m:s'));

            // Niv_Functions::_investiga(
            //     $this->cadastro
            // );

            $result = $this->cadastro->incluir();

            if ($result == 1) {
                echo "<script>alert('Registro incluído com sucesso!');document.location='../view/cadastro.php'</script>";
            } else if ($result == 0) {
                echo "<script>alert('Erro ao gravar registro, verifique as informações.');history.back()</script>";
            } else {
                echo "<script>alert('Este e-mail já foi utilizado, tente outro por favor!');history.back()</script>";
            }
        } else {
            echo "<script>alert('CPF inválido');history.back()</script>";
        }
    }
}
new ControllerCadastro();

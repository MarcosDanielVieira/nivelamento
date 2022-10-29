<?php
require_once("../model/cadastroModel.php");

class LoginController
{

    private $cadastro;

    public function __construct()
    {
        $this->cadastro = new Cadastro();
        $this->login();
    }

    private function login()
    {
        if (!empty($_POST) & isset($_POST['email'])) {

            $this->cadastro->setEmail($_POST['email']);
            $this->cadastro->setSenha($_POST['senha']);

            if ($this->cadastro->loginUsuario()) {
                // session_start inicia a sessão
                session_start();
                $_SESSION['login'] = $this->cadastro->getEmail();
                $_SESSION['senha'] = $this->cadastro->getSenha();
                echo "<script>alert('Seja bem-vindo(a)!');document.location='../view/index.php'</script>";
            } else {
                echo "<script>alert('E-mail ou senha não conferem, verifique por favor!');history.back()</script>";
            }
        }
    }
}

new LoginController();

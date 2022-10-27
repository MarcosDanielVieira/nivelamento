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

            if (Niv_Functions::cpfValidate($_POST['cpf'])) {

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
                }
            } else {
                echo "<script>alert('CPF inválido');history.back()</script>";
            }
        }
    }
}

new ControllerEditar();

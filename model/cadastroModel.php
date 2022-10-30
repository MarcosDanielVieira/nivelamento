<?php
require_once("banco.php");

class Cadastro extends Banco
{
    private $endereco;
    private $nome;
    private $cpf;
    private $rg;
    private $data_nascimento;
    private $data_cadastro;
    private $data_atualizacao;
    private $data_exclusao;
    private $email;
    private $senha;
    private $estado_id;
    private $telefone;
    private $cep;
    private $numero;
    private $usuario_id;

    //Metodos Set
    public function setNome($string)
    {
        $this->nome = $string;
    }

    public function setCpf($string)
    {
        $this->cpf = $string;
    }

    public function setRg($string)
    {
        $this->rg = $string;
    }

    public function setDatanascimento($string)
    {
        $this->data_nascimento = $string;
    }

    public function setDatacadastro($datetime)
    {
        $this->data_cadastro = $datetime;
    }

    public function setDataatualizacao($string)
    {
        $this->data_atualizacao = $string;
    }

    public function setEnderecos($int)
    {
        $this->endereco = $int;
    }

    public function setDataexclusao($datetime)
    {
        $this->data_exclusao = $datetime;
    }

    public function setEmail($string)
    {
        $this->email = $string;
    }

    public function setSenha($string)
    {
        $this->senha = sha1(sha1($string));
    }

    public function setTelefone($string)
    {
        $this->telefone = $string;
    }

    public function setCep($string)
    {
        $this->cep = $string;
    }

    public function setNumero($string)
    {
        $this->numero = $string;
    }

    public function setEstado($int)
    {
        $this->estado_id = $int;
    }

    public function setUser($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    //Metodos Get
    public function getNome()
    {
        return $this->nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getDatanascimento()
    {
        return $this->data_nascimento;
    }

    public function getDatacadastro()
    {
        return $this->data_cadastro;
    }

    public function getDataatualizacao()
    {
        return $this->data_atualizacao;
    }

    public function getEnderecos()
    {
        return $this->endereco;
    }

    public function getDataexclusao()
    {
        return  $this->data_exclusao;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getEstado()
    {
        return $this->estado_id;
    }

    public function getUser()
    {
        return $this->usuario_id;
    }

    public function incluir()
    {

        if ($this->checkCPF($this->getCpf())) {
            return 4;
        } else {

            $usuario = $this->setUsuario(
                $this->getEmail(),
                $this->getSenha()
            );

            if (empty($usuario)) {
                return 3;
            }

            $endereco = $this->setEndereco(
                $this->getCep(),
                $this->getEnderecos(),
                $this->getNumero(),
                $this->getEstado()
            );

            $pessoas    = 0;
            $telefone   = 0;

            if ($endereco) {

                $pessoas = $this->setPessoas(
                    $this->getNome(),
                    $this->getCpf(),
                    $this->getRg(),
                    $this->getDatanascimento(),
                    $this->getDatacadastro(),
                    $endereco,
                    $usuario
                );

                if ($pessoas) {
                    $telefone = $this->setTelefones(
                        $pessoas,
                        $this->getTelefone()
                    );
                }
            }

            if ($endereco && $pessoas && $telefone) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function atualizar()
    {
        if ($this->checkCPF($this->getCpf())) {
            return 4;
        } else {

            $endereco = $this->updateEndereco(
                $this->getCep(),
                $this->getEnderecos(),
                $this->getNumero(),
                $this->getEstado(),
                $this->getUser()
            );

            $pessoas    = 0;
            $telefone   = 0;

            if ($endereco) {

                $pessoas = $this->updatePessoa(
                    $this->getNome(),
                    $this->getCpf(),
                    $this->getRg(),
                    $this->getDatanascimento(),
                    $this->getDataatualizacao(),
                    $this->getUser()
                );

                if ($pessoas) {
                    $telefone = $this->updateTelefone(
                        $this->getUser(),
                        $this->getTelefone()
                    );
                }
            }

            if ($endereco && $pessoas && $telefone) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function loginUsuario()
    {
        return $this->checklogin(
            $this->getEmail(),
            $this->getSenha()
        );
    }
}

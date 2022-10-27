<?php
require_once("../model/banco.php");
class ControllerDeletar
{
    private $deleta;

    public function __construct($id)
    {
        $this->deleta = new Banco();

        if ($this->deleta->deletePessoa($id) == TRUE) {
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/index.php'</script>";
        } else {
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }
}
new ControllerDeletar($_GET['id']);

<?php require_once("../model/banco.php");

class EstadoController
{
    public static function listaEstados()
    {
        $lista = new Banco();
        return $lista->getEstados();
    }
}

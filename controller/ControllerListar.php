<?php
require_once("../model/banco.php");
require_once("../helps/Niv_Functions.php");

class ListarController
{

    public static function pessoas()
    {
        $lista = new Banco();

        return $lista->getPessoas();
    }
}

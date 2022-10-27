<?php
require_once("../model/banco.php");
require_once("../helps/Niv_Functions.php");

class ControllerListar
{

    public static function pessoas()
    {
        $lista = new Banco();

        return $lista->getPessoas();
    }
}

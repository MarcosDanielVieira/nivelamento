<?php
require_once("../model/banco.php");

class ControllerListar
{

    public static function pessoas()
    {
        $lista = new Banco();

        return $lista->getPessoas();
    }
}

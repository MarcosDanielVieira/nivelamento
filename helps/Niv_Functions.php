<?php

/**
 * Classe para usar em mais de um lugar 
 */
class Niv_Functions
{

    /**
     * Função para validar CPF
     *
     * @param [text] $cpf
     * @return [bool]
     */
    public static function cpfValidate($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * Função para investigar código
     *
     * @param [array, text, int, etc] $info
     * @return [array, text, int, etc]
     */
    public static function _investiga($info)
    {
        echo '<pre>';
        print_r($info);
        die();
    }

    /**
     * Função para validar data
     *
     * @param [date] $date
     * @param [string] $format
     * @return [bool]
     */
    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Função para consulta em API
     *
     * @param [text] $url
     * @param [method] $post
     * @return [curl]
     */
    public static function OpenURL($url, $post = array())
    {
        $headers[]  = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0.1';
        $headers[]  = 'Accept: application/json, text/javascript, */*; q=0.01';
        $headers[]  = 'Accept-Language: ar,en;q=0.5';
        $headers[]  = 'Connection: keep-alive';
        $ch         = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4500);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");

        if (count($post) > 0) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        $data = curl_exec($ch);
        return ($data);
    }

    /**
     * Funmção para validar cep via API
     *
     * @return [array]
     */
    public function validateCEP()
    {
        $cep = self::OpenURL('http://viacep.com.br/ws/' . $_POST['cep'] . '/json/');

        if (isset($cep['erro']))
            return false;
        else
            return true;
    }
}

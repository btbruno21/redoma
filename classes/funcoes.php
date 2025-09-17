<?php
class Funcoes
{
    function formatarCNPJ($cnpj)
    {
        // deixa só os números
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) !== 14) {
            return false; // ou retorna o próprio valor se quiser
        }

        return preg_replace(
            "/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/",
            "$1.$2.$3/$4-$5",
            $cnpj
        );
    }
}

<?php
class Funcoes
{
    public function formatarCNPJ($cnpj)
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

    public function formatarTelefone($telefone)
    {
        $apenasNumeros = preg_replace('/\D/', '', $telefone);
        if (substr($apenasNumeros, 0, 2) === '55') {
            if (preg_match('/^55(\d{2})(\d{8,9})$/', $apenasNumeros, $matches)) {
                $ddd = $matches[1];
                $numero = $matches[2];
                if (strlen($numero) == 9) {
                    $numeroFormatado = substr($numero, 0, 5) . '-' . substr($numero, 5);
                } else {
                    $numeroFormatado = substr($numero, 0, 4) . '-' . substr($numero, 4);
                }
                return "55 ($ddd) $numeroFormatado";
            }
        }
        return $telefone;
    }
}

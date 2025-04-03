<?php

use App\Models\Configuracao;

if (!function_exists('limparMoeda')) {
    function limparMoeda($valor)
    {
        $valor = str_replace(['R$', '.', ' '], '', $valor);
        $valor = str_replace(',', '.', $valor);
        return floatval($valor);
    }
}

if (!function_exists('formatarMoeda')) {
    function formatarMoeda($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}

if (!function_exists('limparCpfCnpj')) {
    function limparCpfCnpj($valor)
    {
        return preg_replace('/\D/', '', $valor);
    }
}

if (!function_exists('formatarCpf')) {
    function formatarCpf($cpf)
    {
        $cpf = limparCpfCnpj($cpf);
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
    }
}

if (!function_exists('formatarCnpj')) {
    function formatarCnpj($cnpj)
    {
        $cnpj = limparCpfCnpj($cnpj);
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $cnpj);
    }
}

if (!function_exists('formatarTelefone')) {
    function formatarTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);
        return strlen($telefone) == 11
            ? preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone)
            : preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
    }
}

if (!function_exists('config_sistema')) {
    function config_sistema($chave, $padrao = null)
    {
        return Configuracao::where('chave', $chave)->value('valor') ?? $padrao;
    }
}

<?php

namespace App\Common;

class Environment
{

    /**
     * Método responsável por carregar as variáveis de ambiente
     *
     * @param string $dir Caminho absoluto da pasta onde se encontra o arquivo .env
     * @return boolean
     */
    public static function load($dir = ''): bool
    {
        // Verifica se o arquivo .env não existe
        if (!file_exists($dir . "/.env")) {
            return false;
        }

        // Busca as variáveis de ambiente
        $lines = file($dir . "/.env");
        foreach ($lines as $line) {
            putenv(trim($line));
        }
        return true;
    }
}

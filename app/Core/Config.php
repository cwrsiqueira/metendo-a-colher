<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Classe Abstrata Config
 * Define as constantes de configuração do sistema
 */
abstract class Config
{
    /**
     * Construtor da classe
     */
    private function __construct()
    {
        $this->config();
        $this->conexao();
    }

    /**
     * Funcão Config
     * Define as constantes de configuração do sistema
     *
     * @return void
     */
    protected function config(): void
    {
        // URL do sistema
        if (ENV['APP_ENVIRONMENT'] == 'local') {
            define('URL', ENV['APP_URL_DEVELOPMENT']);
        } else {
            define('URL', ENV['APP_URL_PRODUCTION']);
        }

        // Controllers padrão
        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        // Credenciais Banco de Dados
        define('HOST', ENV['DB_HOST']);
        define('USER', ENV['DB_USER']);
        define('PASS', ENV['DB_PASS']);
        define('DBNAME', ENV['DB_NAME']);
        define('PORT', ENV['DB_PORT']);

        // Contatos
        define('EMAILSUPORTE', ENV['EMAIL_SUPORTE']);
    }

    /**
     * Undocumented function
     *
     * @return object|null
     */
    protected function conexao(): void
    {
        global $db;
        try {
            $db = new PDO("mysql:dbname=" . DBNAME . ";host=" . HOST, USER, PASS);
            echo 'Conexão ao banco de dados efetuada com sucesso.';
        } catch (PDOException $e) {
            echo "ERRO: " . $e->getMessage();
            exit;
        }
    }
}

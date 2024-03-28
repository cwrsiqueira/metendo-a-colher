<?php

namespace App\Controllers;

if (!defined('ACCESS_ALLOWED')) {
    die('Acesso direto não permitido');
}


use App\Core\Controller;

class Erro extends Controller
{
    private ?array $data = ['pagina' => 'Erro'];

    public function index(): void
    {
        $this->loadTemplate("erro", $this->data);
    }
}

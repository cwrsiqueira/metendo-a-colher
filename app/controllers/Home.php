<?php

namespace App\Controllers;

if (!defined('ACCESS_ALLOWED')) {
    die('Acesso direto não permitido');
}

use App\Core\Controller;

class Home extends Controller
{
    private ?array $data = ['pagina' => 'Home'];

    public function index(): void
    {
        $action = filter_input(INPUT_POST, 'action', FILTER_DEFAULT);
        if ($action && $action === 'consultar') {
            // Set your API key and the endpoint URL
            $apiKey = ENV['GPT_API_KEY'];
            $endpoint = 'https://api.openai.com/v1/chat/completions';

            $dados = filter_input_array(INPUT_POST);

            // Answered by user
            $spouse1Name = $dados['yourname'];
            $spouse1Age = $dados['yourage'];
            $spouse1Job = $dados['yourjob'];

            $spouse2Name = $dados['spousername'];
            $spouse2Age = $dados['spouserage'];
            $spouse2Job = $dados['spouserjob'];

            $ageMarried = $dados['agemarried'];

            $problem = $dados['mainproblem'];

            $obs = $dados['obs'];

            $focus = $dados['focus'];

            $allProblemsInOne = $dados['one'];

            // Set the headers
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            );

            // Set the data payload
            $data = array(
                "model" => "gpt-4o",
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "You are the best couples therapist specializing in couples therapies."
                    ],
                    [
                        "role" => "user",
                        "content" => "O paciente chegou com o seguinte problema, e eu gostaria que você desse um diagnóstico profissional, não oriente a procurar um profissional, pois ele vai procurar baseado nas suas informações:
            Olá terapeuta, meu nome é $spouse1Name, tenho $spouse1Age anos e sou $spouse1Job, minha esposa se chama $spouse2Name, tem $spouse2Age e trabalha com $spouse2Job. Nós estamos passando pelo seguinte problema: $problem, somos casados há $ageMarried anos. Nosso foco em resolver o problema é $focus, e se fosse pra resumir todos os nossos problemas, os mais sérios seriam $allProblemsInOne. Mais algumas informações pertinentes: $obs.
            Diante de todas as informações, me dê um diagnóstico desse relacionamento, e suas sugestões para podermos melhorar o relacionamento, vivermos mais felizes e tranquilos com relação um ao outro.
            Não sugira procurar uma terapia, pois isso será feito baseado neste resultado e nas suas respostas.
            Depois do diagnóstico e das sugestões escreva uma carta, informal, baseada no diálogo de um relacionamento de $ageMarried anos, para o $spouse1Name enviar para o $spouse2Name com a intenção de melhorar o relacionamento e sugerindo melhoras baseado nas suas observações.
            Estilize o texto com CSS, utilizando divs e classes para uma melhor apresentação. O diagnóstico deve ser formatado em seções distintas e a carta deve ser apresentada de forma que possa ser copiada e colada diretamente. Utilize as classes CSS: .diagnosis-section, .diagnosis-section h2, .suggestion-section h2, .letter-section h2, .diagnosis-section p, .sugestion-section p, .letter-section p, .letter-section,  para formatar o texto.
            Importante: Atente para que esse texto será visto pelo usuário, então não emita nenhuma observação, ou qualquer outro texto ou caractere que atrapalhe a experiência do usuário. O texto deve ter somente as seções, divs e classes solicitadas. Não utilize outras tags como <HTML></HTML>, por exemplo, pois o texto será inserido dentro de uma página HTML que já possui todas as tags necessárias.
            "
                    ]
                ]
            );

            // Convert the data to JSON
            $jsonData = json_encode($data);

            // Initialize cURL session
            $ch = curl_init();

            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the request
            $response = curl_exec($ch);

            // Close the cURL session
            curl_close($ch);

            // Parse the response JSON
            $result = json_decode($response, true);

            // Access the generated message
            $reply = $result['choices'][0]['message']['content'];

            // Output the reply
            if ($reply) {
                $this->data['success'] = $reply;
            } else {
                $this->data['error'] = "Algo deu errado. Tente novamente!";
            }
        }

        $this->loadTemplate('home', $this->data);
    }
}
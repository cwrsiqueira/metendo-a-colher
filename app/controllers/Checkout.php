<?php

namespace App\Controllers;

if (!defined('ACCESS_ALLOWED')) {
    die('Acesso direto não permitido');
}

use App\Core\Controller;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class Checkout extends Controller
{
    private ?array $data = ['pagina' => 'Checkout'];

    public function index()
    {
        $dados = filter_input_array(INPUT_POST);
        $_SESSION['dados'] = $dados;

        // Getting the access token from .env file (create your own function)
        $mpAccessToken = ENV['MERCADOPAGO_TEST_ACCESS_TOKEN'];
        // Set the token the SDK's config
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        // (Optional) Set the runtime enviroment to LOCAL if you want to test on localhost
        // Default value is set to SERVER
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        // Crie a preferência de pagamento
        $client = new PreferenceClient();
        $items = [
            [
                "id" => "1234567890",
                "title" => "Metendo a Colher",
                "description" => "Conselhos matrimoniais por IA",
                "currency_id" => "BRL",
                "quantity" => 1,
                "unit_price" => 0.99
            ]
        ];
        $payer = [
            "name" => "Carlos",
            "surname" => "Siqueira",
            "email" => "test_user_86624484@testuser.com",
        ];

        $request = $this->createPreferenceRequest($items, $payer);

        try {
            // Send the request that will create the new preference for user's checkout flow
            $preference = $client->create($request);

            $this->data['preference'] = $preference;

            $this->loadTemplate('checkout', $this->data);
        } catch (MPApiException $error) {
            // Here you might return whatever your app needs.
            // We are returning null here as an example.
            return $error;
        }
    }

    // Function that will return a request object to be sent to Mercado Pago API
    private function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [];

        $backUrls = array(
            'success' => URL . "checkout/success",
            'failure' => URL . "checkout/failure",
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "MAC-IA",
            "external_reference" => "MACIACM1UND",
            "expires" => false,
            "auto_return" => 'approved',
        ];

        return $request;
    }

    public function success()
    {
        // Set your API key and the endpoint URL
        $apiKey = ENV['GPT_API_KEY'];
        $endpoint = 'https://api.openai.com/v1/chat/completions';

        $dados = $_SESSION['dados'];

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
                    "content" => "Você é o melhor terapeuta de casais especializado em problemas conjugais."
                ],
                [
                    "role" => "user",
                    "content" => "O paciente chegou com o seguinte problema, e eu gostaria que você desse um diagnóstico profissional, não oriente a procurar um profissional, pois ele vai procurar baseado nas suas informações:
        Olá terapeuta, meu nome é $spouse1Name, tenho $spouse1Age anos e sou $spouse1Job, minha esposa se chama $spouse2Name, tem $spouse2Age e trabalha com $spouse2Job. Nós estamos passando pelo seguinte problema: $problem, somos casados há $ageMarried anos. Nosso foco em resolver o problema é $focus, e se fosse pra resumir todos os nossos problemas, os mais sérios seriam $allProblemsInOne. Mais algumas informações pertinentes: $obs.
        Diante de todas as informações, me dê um diagnóstico desse relacionamento, e suas sugestões para podermos melhorar o relacionamento, vivermos mais felizes e tranquilos com relação um ao outro.
        Não sugira procurar uma terapia, pois isso será feito baseado neste resultado e nas suas respostas.
        Depois do diagnóstico e das sugestões escreva uma carta, informal, baseada no diálogo de um relacionamento de $ageMarried anos, para o $spouse1Name enviar para o $spouse2Name com a intenção de melhorar o relacionamento e sugerindo melhorias baseadas nas suas observações.
        Retorne o texto utilizando divs e classes para uma melhor apresentação, estilizado com bootstrap css 5. O diagnóstico deve ser formatado em seções distintas e a carta deve ser apresentada de forma que possa ser copiada e colada diretamente. Utilize as classes CSS: .diagnosis-section, .diagnosis-section h2, .suggestion-section h2, .letter-section h2, .diagnosis-section p, .sugestion-section p, .letter-section p, .letter-section,  para formatar o texto.
        Importante: Atente para que esse texto será visto pelo usuário, então não emita nenhuma observação, ou qualquer outro texto ou caractere que atrapalhe a experiência do usuário. O texto deve ter somente as seções, divs e classes solicitadas. Não utilize outras tags como <HTML></HTML>, nem marcações ou texto como ```html  ``` ou ```css  ```, por exemplo, pois o texto será inserido dentro de uma página HTML que já possui todas as tags necessárias.
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
            $this->data['error'] = "Erro no processamento! Por favor, entre em contato com o " . ENV['EMAIL_SUPORTE'] . ".";
        }

        $this->data['pagina'] = 'Home';
        $this->loadTemplate('home', $this->data);
    }

    public function failure()
    {
        $_SESSION['mensagem'] = "<p class='alert alert-danger'>Erro! Falha no pagamento.</p>";
        header("Location: " . URL);
    }
}

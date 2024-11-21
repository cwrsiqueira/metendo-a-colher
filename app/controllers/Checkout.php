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
        echo '<pre>';
        var_dump('entrou aqui');
        echo '</pre>';
        exit;
        // Getting the access token from .env file (create your own function)
        $mpAccessToken = ENV['MERCADOPAGO_ACCESS_TOKEN'];
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
            "name" => "Comprador",
            "surname" => "Teste",
            "email" => "teste@email.com",
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
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

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
        $dados = $_GET;
        $this->loadTemplate('sucesso', ['pagina' => 'Sucesso', 'dados' => $dados]);
    }

    public function failure()
    {
        $dados = $_GET;
        $this->loadTemplate('falha', ['pagina' => 'Falha', 'dados' => $dados]);
    }
}

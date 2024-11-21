<h2>Pagamento do Serviço de Análise</h2>
<p>Confirme o pagamento para continuar</p>

<!-- Botão de pagamento do Mercado Pago -->
<!-- <div id="mercado-pago-button"></div> -->

<div id="wallet_container"></div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("<?= ENV['MERCADOPAGO_TEST_PUBLIC_KEY'] ?>");
    const bricksBuilder = mp.bricks();

    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?= $preference->id ?>",
        },
        customization: {
            texts: {
                valueProp: 'smart_option',
            },
        },
    });
</script>
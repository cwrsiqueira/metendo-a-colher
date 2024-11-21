<div class="container mt-3">
    <h4>Pagamento do Serviço de Inteligência Artifical</h4>
    <h5>R$ 1.99</h5>
    <p>Confirme o pagamento para continuar</p>

    <div id="wallet_container" class="btn btn-sm"></div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("<?= ENV['MERCADOPAGO_PUBLIC_KEY'] ?>");
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
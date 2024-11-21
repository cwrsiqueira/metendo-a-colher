<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tabs de SEO -->
    <link rel="author" href="https://carlosdev.com.br" />
    <meta name="description" content="<?= ENV['APP_DESCRIPTION'] ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Carlos Wagner webdev" />
    <meta name="keywords" content="relacionamento, casamento, matrimonio, conjugal, conselhos matrimoniais, conselhos conjugais, conselhos amorosos, conselhos para o relacionamento, inteligencia artifical, IA, metendo a colher, carta de amor, amor, romance, vida a dois, vida conjugal, conselho, vida, mantrimonial, relationship, marriage, conjugal, marriage advice, marital advice, love advice, relationship advice, artificial intelligence, AI, spooning, love letter, love, romance, life as a couple, marital life, advice, life, matrimonial" />
    <meta name="og:title" property="og:title" content="<?= ENV['APP_NAME'] ?> | <?= $viewData['pagina'] ?? 'MVC' ?>">
    <meta property="og:description" content="<?= ENV['APP_DESCRIPTION'] ?>" />
    <meta property="og:url" content="https://metendoacolher.com/" />
    <meta property="og:image" content="<?= URL; ?>public/assets/img/logo.webp" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= ENV['APP_NAME'] ?> | <?= $viewData['pagina'] ?? 'MVC' ?>" />
    <meta name="twitter:description" content="<?= ENV['APP_DESCRIPTION'] ?>" />
    <meta name="twitter:image" content="<?= URL; ?>public/assets/img/logo.webp" />
    <!--  -->

    <link rel="stylesheet" href="<?= URL; ?>public/assets/css/style.css">
    <link rel="shortcut icon" href="<?= URL; ?>public/assets/img/favicon.ico" type="image/x-icon">
    <title><?= ENV['APP_NAME'] ?> | <?= $viewData['pagina'] ?? 'MVC' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        label {
            font-weight: bold;
        }

        label small {
            font-weight: lighter;
        }
    </style>
</head>

<body>

    <?php $this->loadViewInTemplate($viewName, $viewData);  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="<?= URL; ?>public/assets/js/script.js"></script>
</body>

</html>
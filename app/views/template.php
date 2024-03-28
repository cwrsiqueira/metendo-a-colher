<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URL; ?>public/assets/css/style.css">
    <link rel="shortcut icon" href="<?= URL; ?>public/assets/img/favicon.ico" type="image/x-icon">
    <title><?= ENV['APP_NAME'] ?> | <?= $viewData['pagina'] ?? 'MVC' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= URL; ?>public/assets/js/script.js"></script>
</body>

</html>
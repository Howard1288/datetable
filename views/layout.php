<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= asset('build/js/app.js') ?>"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>Data tables y Estadisticas</title>
</head>
<body class="bg-image bg-opacity-50">
    <div class="bg-light bg-opacity-10 w-100" style="height: 100vh;">

        <div class="container-fluid pt-5 mb-4 ">
            
            <?php echo $contenido; ?>
        </div>
    </div>
</body>
</html>
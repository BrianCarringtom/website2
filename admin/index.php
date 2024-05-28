<?php include("templates/header.php");?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos al administrador</title>
    <style>
        body {
            background-image: url('xlogin/fondo.png'); /* Reemplaza 'ruta/a/la/imagen.jpg' con la ruta de tu imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Esto asegura que la imagen de fondo permanezca fija al hacer scroll */
        }

        .rounded-custom {
            border-radius: 80px 20px 80px 20px;
        }

    </style>
</head>

<br/>
<body>
    <div class="p-5 mb-4 bg-light rounded-custom">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenidos al administrador</h1>
            <p class="col-md-8 fs-4">
                En este administrador usted podra cambiar todo el contenido del sitio web
            </p>
        </div>
    </div>
</body>
</html>



<?php include("templates/footer.php");?>
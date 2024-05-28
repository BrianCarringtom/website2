<?php
include("admin/bd.php");

//seleccionar registros de nosotros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_nosotros`");
$sentencia->execute();
$lista_nosotros=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionar registros de servicios
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios2`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionar registros de equipo
$sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo2`");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionar registros de testimonios
$sentencia=$conexion->prepare("SELECT * FROM `tbl_testimonios2`");
$sentencia->execute();
$lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionar registros de configuraciones
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones2`");
$sentencia->execute();
$lista_configuracion=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Pigga landing page.">
    <meta name="author" content="Devcrud">
    <title>RESTAURANTE ONE PIECE</title>
    <!-- Bootstrap + Pigga main styles -->
	<link rel="stylesheet" href="assets/css/pigga.css">

    <style>
        .header {
            position: relative;
            height: 100vh;
            background: url('assets/img/fondo1.jpg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5); /* Ajusta el color y la opacidad según sea necesario */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .overlay .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .overlay .subtitle,
        .overlay .title,
        .overlay .btn {
            margin: 10px 0;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    <!-- First Navigation -->
    <nav class="navbar nav-first navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/icon-onepiece.png" alt="...">
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#home">CALL US : <span class="pl-2 text-muted"><?php echo $lista_configuracion[12]['valor'];?></span></a>
                </li>                   
            </ul>
        </div>
    </nav>
    <!-- End of First Navigation --> 
    <!-- Second Navigation -->
    <nav class="nav-second navbar custom-navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <div class="container">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"> 
                    <li class="nav-item">
                        <a class="nav-link" href="#about">NOSOTROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">SERVICIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">EQUIPO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testmonial">TESTIMONIOS</a>
                    </li>
                </ul> 
            </div>
        </div>
    </nav>
    <!-- End Of Second Navigation --> 
    <!-- Page Header -->
    <header class="header">
        <div class="overlay">
            <img src="assets/img/bienvenida.jpg" alt="Logo" class="logo">
            <h1 class="subtitle"><?php echo $lista_configuracion[1]['valor'];?></h1>
            <h1 class="title"><?php echo $lista_configuracion[0]['valor'];?></h1> 
            <a class="btn btn-primary mt-3" href="#about"><?php echo $lista_configuracion[2]['valor'];?></a> 
        </div>      
    </header>
    <script src="path/to/bootstrap.bundle.min.js"></script> <!-- Asegúrate de tener el enlace correcto al archivo JS de Bootstrap -->
    <!-- End Of Page Header --> 

    <!-- About Section -->
    <section id="about">
    <div class="container">
        <h6 class="section-subtitle text-center"><?php echo $lista_configuracion[4]['valor'];?></h6>
        <h3 class="section-title mb-6 pb-3 text-center"><?php echo $lista_configuracion[5]['valor'];?></h3>
        <div class="row align-items-center">
            <?php 
            $counter = 0;
            foreach($lista_nosotros as $registros ) { 
                // Determinar la disposición basada en el contador
                $is_even = $counter % 2 == 0;
            ?>
            <div class="row justify-content-center my-4">
                <?php if ($is_even) { ?>
                    <div class="col-md-5 text-right">
                        <h6 class="section-subtitle"><?php echo $registros["subtitulo"];?></h6>
                        <h3 class="section-title"><?php echo $registros["titulo"];?></h3>
                        <p><?php echo $registros["descripcion"];?></p>
                        <p class="mb-1 font-weight-bold">Monday - Thursday : <span class="font-weight-normal pl-2 text-muted"><?php echo $registros["hora"];?></span></p>
                    </div>
                    <div class="col-md-5 text-left">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img alt="..." src="assets/img/<?php echo $registros["imagen"];?>" class="w-100 rounded shadow">
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-5 text-right">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img alt="..." src="assets/img/<?php echo $registros["imagen"];?>" class="w-100 rounded shadow">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-left">
                        <h6 class="section-subtitle"><?php echo $registros["subtitulo"];?></h6>
                        <h3 class="section-title"><?php echo $registros["titulo"];?></h3>
                        <p><?php echo $registros["descripcion"];?></p>
                        <p class="mb-1 font-weight-bold">Monday - Thursday : <span class="font-weight-normal pl-2 text-muted"><?php echo $registros["hora"];?></span></p>
                    </div>
                <?php } ?>
            </div>
            <?php 
                $counter++;
            } 
            ?>
        </div>
    </div>
</section>

<!-- Service Section -->
<section id="service" class="pattern-style-4 has-overlay">
    <div class="container raise-2">
        <h6 class="section-subtitle text-center"><?php echo $lista_configuracion[6]['valor'];?></h6>
        <h3 class="section-title mb-6 pb-3 text-center"><?php echo $lista_configuracion[7]['valor'];?></h3>
        <div class="row">
            <?php foreach($lista_servicios as $registros ) { ?>
            <div class="col-md-6 mb-4">
                <a href="javascript:void(0)" class="custom-list">
                    <div class="img-holder">
                        <img src="assets/img/<?php echo $registros["imagen"];?>" alt="...">
                    </div>
                    <div class="info">
                        <div class="head clearfix">
                            <h5 class="title float-left"><?php echo $registros["nombrecomida"];?></h5>
                            <p class="float-right text-primary">$<?php echo $registros["precio"];?></p>
                        </div>
                        <div class="body">
                            <p><?php echo $registros["descripcion"];?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>                  
    </div>
</section>

    <!-- End of Featured Food Section -->


    <!-- Team Section -->
    <section id="team">
        <div class="container">
            <h6 class="section-subtitle text-center"><?php echo $lista_configuracion[8]['valor'];?></h6>
            <h3 class="section-title mb-5 text-center"><?php echo $lista_configuracion[9]['valor'];?></h3>
            <div class="row">

            <?php foreach($lista_equipo as $registros ) { ?>
            <div class="col-md-4 my-3">
                    <div class="team-wrapper text-center">
                        <img src="assets/img/<?php echo $registros["imagen"];?>" class="circle-120 rounded-circle mb-3 shadow" alt="...">
                        <h5 class="my-3"><?php echo $registros["nombrecompleto"];?></h5>
                        <p><?php echo $registros["descripcion"];?></p>
                        <h6 class="socials mt-3">
                            <a href="<?php echo $registros["facebook"];?>" class="px-2"><i class="ti-facebook"></i></a>
                            <a href="<?php echo $registros["twitter"];?>" class="px-2"><i class="ti-twitter"></i></a>
                            <a href="<?php echo $registros["instagram"];?>" class="px-2"><i class="ti-instagram"></i></a>
                            <a href="<?php echo $registros["google"];?>" class="px-2"><i class="ti-google"></i></a>
                        </h6>
                    </div>
            </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!-- End of Team Section -->

    <!-- Testmonial Section -->
    <section id="testmonial" class="pattern-style-3">
        <div class="container">
            <h6 class="section-subtitle text-center"><?php echo $lista_configuracion[10]['valor'];?></h6>
            <h3 class="section-title mb-5 text-center"><?php echo $lista_configuracion[11]['valor'];?></h3>
            <div class="row">

            <?php foreach($lista_testimonios as $registros ) { ?>
                <div class="col-md-4 my-3 my-md-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="assets/img/<?php echo $registros["imagen"];?>" alt="...">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0"><?php echo $registros["nombre"];?></h6>
                                    <small class="text-muted mb-0"><?php echo $registros["area"];?></small>     
                                </div>
                            </div>
                            <p class="mb-0"><?php echo $registros["comentario"];?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- End of Testmonial Section -->


    <!-- Prefooter Section  -->
    <div class="py-4 border border-lighter border-bottom-0 border-left-0 border-right-0 bg-dark">
        <div class="container">
            <div class="row justify-content-between align-items-center text-center">
                <div class="col-md-3 text-md-left mb-3 mb-md-0">
                    <img src="assets/img/abajo.png" width="100" alt="..." class="mb-0">
                </div>
                <div class="col-md-9 text-md-right">
                    <a href="#" class="px-3"><small class="font-weight-bold">Our Company</small></a>
                    <a href="#" class="px-3"><small class="font-weight-bold">Our Location</small></a>
                    <a href="#" class="px-3"><small class="font-weight-bold">Help Center</small></a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PreFooter Section -->

    <!-- Page Footer -->
    <footer class="border border-dark border-left-0 border-right-0 border-bottom-0 p-4 bg-dark">
        <div class="container">
            <div class="row align-items-center text-center text-md-left">
                <div class="col">
                    <p class="mb-0 small">&copy; <script>document.write(new Date().getFullYear())</script>, <a href="https://www.devcrud.com" target="_blank">DevCrud</a>  All rights reserved </p> 
                </div>
                <div class="d-none d-md-block">
                    <h6 class="small mb-0">
                        <a href="<?php echo $lista_configuracion[13]['valor'];?>" class="px-2"><i class="ti-facebook"></i></a>
                        <a href="<?php echo $lista_configuracion[14]['valor'];?>" class="px-2"><i class="ti-twitter"></i></a>
                        <a href="<?php echo $lista_configuracion[15]['valor'];?>" class="px-2"><i class="ti-instagram"></i></a>
                        <a href="<?php echo $lista_configuracion[16]['valor'];?>" class="px-2"><i class="ti-google"></i></a>
                    </h6>
                </div>
            </div>
        </div>
        
    </footer>
    <!-- End of Page Footer -->

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Pigga js -->
    <script src="assets/js/pigga.js"></script>

</body>
</html>

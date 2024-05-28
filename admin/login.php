<?php 

session_start();

if($_POST){
    include("./bd.php");

    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";

    //seleccionar registros
    $sentencia=$conexion->prepare("SELECT *, count(*) as n_usuario FROM `tbl_usuarios2` WHERE usuario=:usuario AND password=:password");
   
   
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);

    $sentencia->execute();
    $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);

    if($lista_usuarios['n_usuario']>0){
       
        $_SESSION['usuario']=$lista_usuarios['usuario'];
        $_SESSION['logueado']=true;
        header("Location:index.php");
    }else{
       $mensaje="Error: El usuario o contraseña son incorrectos";
    }

    

}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <script src="https://kit.fontawesome.com/a2dd6045c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="xlogin/styles.css">
</head>
<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
            <?php if(isset($mensaje)){ ?>
    <style>
        .alert {
            width: 300px; /* Ajusta el ancho de la alerta */
            padding: 10px;
            color: black;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 14px;
            word-wrap: break-word; /* Permite que el texto se divida en varias filas */
            position: relative; /* Asegura que los hijos posicionados sean relativos al contenedor */
            overflow: hidden; /* Asegura que el contenido no se desborde */
        }
        .alert::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5); /* Fondo blanco con transparencia */
            z-index: 1; /* Asegura que el fondo esté detrás del texto */
        }
        .alert strong {
            position: relative;
            z-index: 2; /* Asegura que el texto esté por encima del fondo */
        }
        .closebtn {
            margin-left: 10px;
            color: black;
            font-weight: bold;
            float: right;
            font-size: 18px;
            line-height: 14px;
            cursor: pointer;
            transition: 0.3s;
            position: absolute; /* Posiciona el botón de cerrar de forma absoluta */
            top: 10px; /* Ajusta la posición del botón de cerrar */
            right: 10px; /* Ajusta la posición del botón de cerrar */
            z-index: 2; /* Asegura que el botón de cerrar esté por encima del fondo */
        }
        .closebtn:hover {
            color: black;
        }
    </style>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong><?php echo $mensaje; ?></strong>
    </div>
        <?php } ?>


                <form action="" method="post">
                    <h2>Iniciar Sesión</h2>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" class="form-control" name="usuario" id="usuario" required autocomplete="off">
                        <label for="usuario">Usuario</label>
                    </div>


                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <label for="password">Contraseña</label>
                    </div>

                    <div class="olvidar">
                        <label>
                            <input type="checkbox"> Recordar
                        </label>
                        <a href="#">Olvidé la contraseña</a>
                    </div>

                    <button type="submit">Acceder</button>

                    <div class="registrar">
                        <p>No tengo cuenta <a href="#">Crear una</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>

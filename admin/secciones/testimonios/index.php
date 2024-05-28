<?php 


include("../../bd.php");

if(isset($_GET['txtID'])){
     //Recuperar los datos del ID correspondiente (seleccionado)

    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:""; 

    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_testimonios2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/".$registro_imagen["imagen"]);

        }
    }

    $sentencia=$conexion->prepare("DELETE FROM tbl_testimonios2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute(); 

}



//seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_testimonios2`");
$sentencia->execute();
$lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Área</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_testimonios as $registros) { ?>
                            <tr class="">
                                <td><?php echo $registros['ID']; ?></td>
                                <td><img width="50" src="../../../assets/img/<?php echo $registros['imagen']; ?>" /></td>
                                <td><?php echo $registros['nombre']; ?></td>
                                <td><?php echo $registros['area']; ?></td>
                                <td><?php echo $registros['comentario']; ?></td>
                                <td>
                                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</body>
</html>



<?php include("../../templates/footer.php");?>
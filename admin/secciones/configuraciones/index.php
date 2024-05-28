<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //borrar dicho registro con el ID correspondiente

    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_configuraciones2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();   
}

//seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones2`");
$sentencia->execute();
$lista_configuracion=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a> -->
            Configuración
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre de la configuración</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_configuracion as $registros ) { ?>
                            <tr class="">
                                <td scope="row"><?php echo $registros['ID']; ?></td>
                                <td><?php echo $registros['nombreconfiguracion']; ?></td>
                                <td><?php echo $registros['valor']; ?></td>
                                <td>
                                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                    |
                                    <!-- <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a> -->
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
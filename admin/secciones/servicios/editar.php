<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:""; 
    
    $sentencia=$conexion->prepare("SELECT * FROM tbl_servicios2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute(); 
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $imagen=$registro['imagen'];
    $nombrecomida=$registro['nombrecomida'];
    $precio=$registro['precio'];
    $descripcion=$registro['descripcion'];


}

if($_POST){

            $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
            $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
            $nombrecomida=(isset($_POST['nombrecomida']))?$_POST['nombrecomida']:"";
            $precio=(isset($_POST['precio']))?$_POST['precio']:"";
            $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";

            $sentencia=$conexion->prepare("UPDATE tbl_servicios2  SET nombrecomida=:nombrecomida, precio=:precio, descripcion=:descripcion WHERE id=:id ");

            $sentencia->bindParam(":nombrecomida", $nombrecomida);
            $sentencia->bindParam(":precio", $precio);
            $sentencia->bindParam(":descripcion",$descripcion);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();

            if($_FILES["imagen"]["tmp_name"]!=""){

                $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
                $fecha_imagen=new DateTime();
                $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";
            
                $tmp_imagen=$_FILES["imagen"]["tmp_name"];
            
                move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
            
                //Borrado del archivo anterior
                $sentencia=$conexion->prepare("SELECT imagen FROM tbl_servicios2 WHERE id=:id ");
                $sentencia->bindParam(":id",$txtID);
                $sentencia->execute();
                $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
            
                if(isset($registro_imagen["imagen"])){
                    if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
                        
                        unlink("../../../assets/img/".$registro_imagen["imagen"]);
            
                    }
                }
            
                $sentencia=$conexion->prepare("UPDATE tbl_servicios2 SET imagen=:imagen WHERE id=:id ");
                $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
                $sentencia->bindParam(":id",$txtID);
                $sentencia->execute();
                $imagen=$nombre_archivo_imagen;
            
                }

                $mensaje="Registro modificado con éxito.";
                    header("Location:index.php?mensaje=".$mensaje);

}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Entradas</div>
    <div class="card-body">

    <form action="" enctype="multipart/form-data" method="post">

    <div class="mb-3">
        <label for="" class="form-label">ID:</label>
        <input
            type="text"
            class="form-control"
            readonly
            name="txtID"
            id="txtID"
            value="<?php echo $txtID;?>"
            aria-describedby="helpId"
            placeholder=""
        />
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        <img width="50" src="../../../assets/img/<?php echo $imagen;?>" />
        <input 
            type="file"
            class="form-control"
            name="imagen"
            id="imagen"
            placeholder="Imagen"
            aria-describedby="fileHelpId"
        />
    </div>

    <div class="mb-3">
        <label for="nombrecomida" class="form-label">Nombre de la Comida:</label>
        <input value="<?php echo $nombrecomida;?>"
            type="text"
            class="form-control"
            name="nombrecomida"
            id="nombrecomida"
            aria-describedby="helpId"
            placeholder="Nombrecomida"
        />
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio:</label>
        <input value="<?php echo $precio;?>"
            type="number"
            class="form-control"
            name="precio"
            id="precio"
            aria-describedby="helpId"
            placeholder="Precio"
        />
    </div>
    
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion:</label>
        <input value="<?php echo $descripcion;?>"
            type="text"
            class="form-control"
            name="descripcion"
            id="descripcion"
            aria-describedby="helpId"
            placeholder="Descripcion"
        />
    </div>
    
    <button
        type="submit"
        class="btn btn-success">
        Actualizar
    </button>
    
    <a
        name=""
        id=""
        class="btn btn-primary"
        href="index.php"
        role="button"
        >Cancelar</a
    >
    
    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>
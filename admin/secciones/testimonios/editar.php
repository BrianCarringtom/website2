<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:""; 
        
        $sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios2 WHERE id=:id ");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute(); 
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        $imagen=$registro['imagen'];
        $nombre=$registro['nombre'];
        $area=$registro['area'];
        $comentario=$registro['comentario'];
}

if($_POST){

     //Recepcionamos los valores del fomulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $area=(isset($_POST['area']))?$_POST['area']:"";
    $comentario=(isset($_POST['comentario']))?$_POST['comentario']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_testimonios2 SET nombre=:nombre, area=:area, comentario=:comentario WHERE id=:id ");

     $sentencia->bindParam(":nombre",$nombre);
     $sentencia->bindParam(":area", $area);
     $sentencia->bindParam(":comentario", $comentario);
     $sentencia->bindParam(":id",$txtID);
     $sentencia->execute();

    if($_FILES["imagen"]["tmp_name"]!=""){

    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];

    move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);

    //Borrado del archivo anterior
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_testimonios2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/".$registro_imagen["imagen"]);

        }
    }

    $sentencia=$conexion->prepare("UPDATE tbl_testimonios2 SET imagen=:imagen WHERE id=:id ");
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();

    }

    $mensaje="Registro modificado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);
    
}

include("../../templates/header.php");

?>


<div class="card">
    <div class="card-header">Testimoios de los clientes</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
    <label for="" class="form-label">ID</label>
    <input
        type="text"
        class="form-control"
        readonly
        name="txtID"
        id="txtID"
        value="<?php echo $txtID; ?>"
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
    <label for="nombre" class="form-label">Nombre:</label>
    <input value="<?php echo $nombre;?>"
        type="text"
        class="form-control"
        name="nombre"
        id="nombre"
        aria-describedby="helpId"
        placeholder="Nombre"
    />
</div>

<div class="mb-3">
    <label for="area" class="form-label">Area:</label>
    <input value="<?php echo $area;?>"
        type="text"
        class="form-control"
        name="area"
        id="area"
        aria-describedby="helpId"
        placeholder="Area"
    />
</div>

<div class="mb-3">
    <label for="comentario" class="form-label">Comentario:</label>
    <input value="<?php echo $comentario;?>"
        type="text"
        class="form-control"
        name="comentario"
        id="comentario"
        aria-describedby="helpId"
        placeholder="Comentario"
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
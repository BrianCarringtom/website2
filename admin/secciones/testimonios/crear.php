<?php 
include("../../bd.php");
if($_POST){

    //Recepcionamos los valores del fomulario
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $area=(isset($_POST['area']))?$_POST['area']:"";
    $comentario=(isset($_POST['comentario']))?$_POST['comentario']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
    }



    $sentencia=$conexion->prepare("INSERT INTO `tbl_testimonios2` (`ID`,`imagen`, `nombre`, `area`, `comentario`) VALUES (NULL, :imagen, :nombre, :area, :comentario); ");
    
    $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":area", $area);
    $sentencia->bindParam(":comentario",$comentario);
    $sentencia->execute();

    $mensaje="Registro agregado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">Testimoios de los clientes</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
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
    <input
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
    <input
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
    <input
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
        Agregar
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
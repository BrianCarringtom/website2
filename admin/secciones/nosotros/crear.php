<?php 
include("../../bd.php");
if($_POST){

    //Recepcionamos los valores del fomulario
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $hora=(isset($_POST['hora']))?$_POST['hora']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
    }



    $sentencia=$conexion->prepare("INSERT INTO `tbl_nosotros` (`ID`, `imagen`, `titulo`, `subtitulo`, `descripcion`, `hora`) VALUES (NULL, :imagen, :titulo, :subtitulo, :descripcion, :hora ); ");
    
    $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":hora",$hora);
    $sentencia->execute();

    $mensaje="Registro agregado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">Quienes somos</div>
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
    <label for="titulo" class="form-label">Titulo:</label>
    <input
        type="text"
        class="form-control"
        name="titulo"
        id="titulo"
        aria-describedby="helpId"
        placeholder="Titulo"
    />
</div>

<div class="mb-3">
    <label for="subtitulo" class="form-label">Subtitulo:</label>
    <input
        type="text"
        class="form-control"
        name="subtitulo"
        id="subtitulo"
        aria-describedby="helpId"
        placeholder="Subtitulo"
    />
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion:</label>
    <input
        type="text"
        class="form-control"
        name="descripcion"
        id="descripcion"
        aria-describedby="helpId"
        placeholder="Descripcion"
    />
</div>

<div class="mb-3">
    <label for="hora" class="form-label">Hora:</label>
    <input
        type="text"
        class="form-control"
        name="hora"
        id="hora"
        aria-describedby="helpId"
        placeholder="Hora"
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
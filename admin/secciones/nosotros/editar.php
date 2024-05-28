<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:""; 
        
        $sentencia=$conexion->prepare("SELECT * FROM tbl_nosotros WHERE id=:id ");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute(); 
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        $imagen=$registro['imagen'];
        $titulo=$registro['titulo'];
        $subtitulo=$registro['subtitulo'];
        $descripcion=$registro['descripcion'];
        $hora=$registro['hora'];
}

if($_POST){

     //Recepcionamos los valores del fomulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $hora=(isset($_POST['hora']))?$_POST['hora']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_nosotros SET titulo=:titulo, subtitulo=:subtitulo, descripcion=:descripcion, hora=:hora WHERE id=:id ");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":hora",$hora);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if($_FILES["imagen"]["tmp_name"]!=""){

    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];

    move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);

    //Borrado del archivo anterior
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_nosotros WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/".$registro_imagen["imagen"]);

        }
    }

    $sentencia=$conexion->prepare("UPDATE tbl_nosotros SET imagen=:imagen WHERE id=:id ");
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
    <div class="card-header">Quienes somos</div>
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
    <label for="titulo" class="form-label">Titulo:</label>
    <input value="<?php echo $titulo;?>"
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
    <input value="<?php echo $subtitulo;?>"
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
    <input value="<?php echo $descripcion;?>"
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
    <input value="<?php echo $hora;?>"
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
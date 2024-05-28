<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:""; 
    
    $sentencia=$conexion->prepare("SELECT * FROM tbl_equipo2 WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute(); 
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $imagen=$registro['imagen'];
    $nombrecompleto=$registro['nombrecompleto'];
    $descripcion=$registro['descripcion'];
    $facebook=$registro['facebook'];
    $twitter=$registro['twitter'];
    $instagram=$registro['instagram'];
    $google=$registro['google'];

}

if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
    $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
    $instagram=(isset($_POST['instagram']))?$_POST['instagram']:"";
    $google=(isset($_POST['google']))?$_POST['google']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_equipo2  SET nombrecompleto=:nombrecompleto ,descripcion=:descripcion, facebook=:facebook, twitter=:twitter ,instagram=:instagram, google=:google WHERE id=:id ");

    $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":twitter", $twitter);
    $sentencia->bindParam(":instagram", $instagram);
    $sentencia->bindParam(":google", $google);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if($_FILES["imagen"]["tmp_name"]!=""){

        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";
    
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    
        move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
    
        //Borrado del archivo anterior
        $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo2 WHERE id=:id ");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    
        if(isset($registro_imagen["imagen"])){
            if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
                
                unlink("../../../assets/img/".$registro_imagen["imagen"]);
    
            }
        }
    
        $sentencia=$conexion->prepare("UPDATE tbl_equipo2 SET imagen=:imagen WHERE id=:id ");
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
    <div class="card-header">Datos de la persona</div>
    <div class="card-body">

<form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
    <label for="" class="form-label">ID:</label>
    <input value="<?php echo $txtID;?>"
        type="text"
        readonly
        class="form-control"
        name="txtID"
        id="txtID"
        aria-describedby="helpId"
        placeholder="ID"
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
            aria-describedby="helpId"
            placeholder="Imagen"
        />
    </div>

    <div class="mb-3">
        <label for="nombrecompleto" class="form-label">Nombre completo:</label>
        <input value="<?php echo $nombrecompleto;?>"
            type="text"
            class="form-control"
            name="nombrecompleto"
            id="nombrecompleto"
            aria-describedby="helpId"
            placeholder="Nombre"
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
        <label for="facebook" class="form-label">Facebook:</label>
        <input value="<?php echo $facebook;?>"
            type="text"
            class="form-control"
            name="facebook"
            id="facebook"
            aria-describedby="helpId"
            placeholder="Facebook"
        />
    </div>

    <div class="mb-3">
        <label for="twitter" class="form-label">Twitter:</label>
        <input value="<?php echo $twitter;?>"
            type="text"
            class="form-control"
            name="twitter"
            id="twitter"
            aria-describedby="helpId"
            placeholder="Twitter"
        />
    </div>
    
    <div class="mb-3">
        <label for="instagram" class="form-label">Instagram:</label>
        <input value="<?php echo $instagram;?>"
            type="text"
            class="form-control"
            name="instagram"
            id="instagram"
            aria-describedby="helpId"
            placeholder="Instagram"
        />
    </div>

    <div class="mb-3">
        <label for="google" class="form-label">Google:</label>
        <input value="<?php echo $google;?>"
            type="text"
            class="form-control"
            name="google"
            id="google"
            aria-describedby="helpId"
            placeholder="Google"
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
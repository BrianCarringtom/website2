<?php 
include("../../bd.php");


if($_POST){
        //Recepcionamos los valores del fomulario
        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
        $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
        $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
        $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
        $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
        $instagram=(isset($_POST['instagram']))?$_POST['instagram']:"";
        $google=(isset($_POST['google']))?$_POST['google']:"";

        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";

        $tmp_imagen=$_FILES["imagen"]["tmp_name"];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
        }

        $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo2` (`ID`,  `imagen`, `nombrecompleto` , `descripcion`, `facebook`, `twitter`, `instagram`, `google`) VALUES (NULL, :imagen, :nombrecompleto, :descripcion, :facebook, :twitter, :instagram, :google ); ");
            
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->bindParam(":facebook", $facebook);
        $sentencia->bindParam(":twitter", $twitter);
        $sentencia->bindParam(":instagram", $instagram);
        $sentencia->bindParam(":google", $google);
        $sentencia->execute();

        $mensaje="Registro agregado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);


}




include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Datos de la persona</div>
    <div class="card-body">

<form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
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
        <input
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
        <label for="facebook" class="form-label">Facebook:</label>
        <input
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
        <input
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
        <input
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
        <input
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
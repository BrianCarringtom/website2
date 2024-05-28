<?php 
include("../../bd.php");

if($_POST){

        //Recepcionamos los valores del fomulario
        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
        $nombrecomida=(isset($_POST['nombrecomida']))?$_POST['nombrecomida']:"";
        $precio=(isset($_POST['precio']))?$_POST['precio']:"";
        $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";


        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")? $fecha_imagen-> getTimestamp()."_".$imagen:"";
    
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
        }

        $sentencia=$conexion->prepare("INSERT INTO `tbl_servicios2` (`ID`, `imagen`, `nombrecomida`, `precio`,  `descripcion`) VALUES (NULL,  :imagen, :nombrecomida, :precio, :descripcion ); ");
    
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":nombrecomida", $nombrecomida);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->execute();

        $mensaje="Registro agregado con éxito.";
            header("Location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Servicios</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
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
        <input
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
        <input
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
        <input
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
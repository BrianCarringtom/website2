<?php

$servidor="localhost";
$baseDeDatos="website2";
$usuario="root";
$contrasenia="";

try{

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);

}catch(Exception $error){
    echo $error->getMessage();
}

?>
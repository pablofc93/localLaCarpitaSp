<?php
$servidor="localhost";
$baseDatos="restaurante";
$usuario="root";
$password="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
    //echo "conexión exitosa";
}catch(Exception $error){
    echo $error->getMessage();
}
?>
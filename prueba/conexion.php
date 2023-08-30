<?php

function conectar(){
    $host="localhost";
    $user="tony";
    $pass="t0n1h4ll4n1472";
    $db="tutorias";
    try{
        $conexion=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        echo "Conectando...";
        $sentencia=$conexion->prepare("SELECT * FROM login");
        $sentencia->execute();
        $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        print_r($registros);
    }
    catch(Exception $error){
        echo $error->getMessage();
    }

    return $con;
}
?>
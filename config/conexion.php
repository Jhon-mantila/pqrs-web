<?php
    $conexion=new PDO ('mysql:host=localhost; dbname=pqrs', 'root', '');
    
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion->exec("SET CHARACTER SET UTF8");
 

?>

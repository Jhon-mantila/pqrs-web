<?php ob_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title></title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="recursos/icons-1.4.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    </head>
    <body>
<?php

if (isset($_POST["enviare"])){
    include 'config/conexion.php';
    
                $loginCedula=htmlentities(addslashes($_POST["login"]));
                $pass=htmlentities(addslashes($_POST["pass"]));
                $id_usu=$_POST['id_u'];
                
                $contador=0;
                $sql="SELECT ID_USU, CC, NOMBRE, CORREO, CLAVE, ID_EMPRESA, ID_ROL FROM usuarios WHERE CC= :login AND ACTIVO_U=1";                
                $resultado=$conexion->prepare($sql);
                $resultado->bindColumn('ID_ROL', $perfil);
                $resultado->bindColumn('ID_USU', $id_usu);
                $resultado->bindColumn('ID_EMPRESA', $id_empresa);
                $resultado->execute(array(":login"=>$loginCedula));

                while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)) {
                
                 if(password_verify($pass, $fila['CLAVE']) || $pass==$fila['CLAVE']){
                  //DEVUELVE TRUE SI LAS DOS SON IGUALES
                   //FALSE SI NO SON IGUALES
                    $contador++;
                      }
            
                   }

           if($contador>0){
                    
                    session_start();
                    $_SESSION["usuario"]=$_POST["login"];
                    $_SESSION["ID_ROL"]=$perfil;
                    $_SESSION["ID_EMPRESA"]=$id_empresa;
                    $_SESSION["id_usuario"]=$id_usu;
                     //header( "Location:admin/index.php");
                                             
                     } else{
                     echo "<div class='container1'>"; 
                     echo"<div class='d-flex justify-content-center h-100'>";
                     echo "<div class='card1'>";  
                     echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                     echo "Usuario. o contraseña incorrectos";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
       
                    
                    }
}//CIERRO IF del Boton

?>
<?php       
       if(!isset($_SESSION["usuario"])){
       //inluyo formulario
       
       include 'admin/login.php';
       
       }else{
           
           if ($perfil==1) {
                
           echo 'USUARIO: ' . $_SESSION["usuario"];
           //echo 'Perfil:'. $datos;
           //include'usuario/menu_usuarios.php';
           header('Location:admin/index.php');
           }else if ($perfil==2){
           
               header('Location:gerente/index.php');
               
           }else if ($perfil==4){
           
               header('Location:cliente/index.php');
               
           }else if ($perfil==3){
           
               header('Location:operario/index.php');
               
           }
           
       }
?>
    </body>
</html>
<?php ob_end_flush(); ?>
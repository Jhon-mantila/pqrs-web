<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <title>ERROR</title>
</head>
<?php
session_start();
include '../../config/conexion.php';
include '../../config/conexion1.php';

if (isset($_POST['enviando'])){

   
      $cedulaU= $_POST['cc'];
      $nomU = $_POST['nom'];
      $apeU = $_POST['correo'];
      $per = $_POST['perfil'];
      $clave = $_POST['clave'];
      $empU = $_POST['empresa'];
      $acti = $_POST['activo'];
      
  
        $contra_cifrada=  password_hash($clave, PASSWORD_DEFAULT, array("cost"=>13));
        
$resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE id_empresa = $empU AND id_rol = $per");
        
        mysqli_close($con);
        
        $fila = mysqli_num_rows($resultado);
            
            if ($fila==0){
 try{   
   
  
            
            
     
    $consulta="INSERT INTO usuarios (CC, NOMBRE, CORREO, ID_ROL, CLAVE, ID_EMPRESA, ACTIVO_U) VALUES (:cc, :nom, :correo, :rol, :clave, :emp, :estado)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":cc"=>$cedulaU, ":nom"=>$nomU, ":correo"=>$apeU, ":rol"=>$per, ":clave"=>$contra_cifrada, ":emp"=>$empU, ":estado"=>$acti));      
        

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "Ingreso Pasajero Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
   
header("Location: ../ingresarUsuarios.php");
        
  $resultado->closeCursor();
} catch (Exception $ex) {
?>
   <body>
       <div class="container">
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Error al ingresar</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
            <?php
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> ";
                echo "Duplicado Registro".$ex->getMessage() ;
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                 //header("Location: ../ingresarBote.php");  
            }
            } else {

                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> ";
                echo "Ya existe un gerente para esta empresa";
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
            }//if de ingreso
            ?>
           <a href="../ingresarUsuarios.php" class="btn btn-warning">Regresar</a>
           
       </div>
       <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
       <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
   </body>
</html>


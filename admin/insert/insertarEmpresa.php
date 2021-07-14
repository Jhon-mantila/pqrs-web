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
if (isset($_POST['enviando'])){

      $nit= $_POST['nit'];
      $emp= $_POST['emp'];
      $cel = $_POST['activo'];
      $id_usuario = $_SESSION['id_usuario'];
  
 try{   
   
    $consulta="INSERT INTO empresa (NIT, NOM_EMPRESA, ACTIVO) VALUES (:nit, :emp, :cel)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":nit"=>$nit, ":emp"=>$emp, ":cel"=>$cel));    
  

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "Ingreso Empresa Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
                     
                     header("Location: ../ingresarEmpresa.php");
   

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
                echo "Duplicado Registro" ;
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                 //header("Location: ../ingresarBote.php");  
            } 
            }//if de ingreso
            ?>
           <a href="../ingresarEmpresa.php" class="btn btn-warning">Regresar</a>
           
       </div>
       <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
       <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
   </body>
</html>
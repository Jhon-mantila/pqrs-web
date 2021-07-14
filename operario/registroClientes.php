<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator">
   
    <title>PQRS</title>
    
 
    <link href="../css/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Favicons -->
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet" type="text/css"/>
   
    <link href="../recursos/fontawesome-free-5.15.3-web/css/fontawesome.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/brands.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/solid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
      <?php
if(isset($_POST['enviando'])){
    include '../config/conexion.php';
    
      $cedulaU= $_POST['cc'];
      $nomU = $_POST['nom'];
      $apeU = $_POST['correo'];
      $per = $_POST['perfil'];
      $clave = $_POST['clave'];
      $empU = $_POST['empresa'];
      
      
  
        $contra_cifrada=  password_hash($clave, PASSWORD_DEFAULT, array("cost"=>13));
    
   try{ 
    
    $consulta="INSERT INTO usuarios (CC, NOMBRE, CORREO, ID_ROL, CLAVE, ID_EMPRESA, ACTIVO_U) VALUES (:cc, :nom, :correo, :rol, :clave, :emp, :estado)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":cc"=>$cedulaU, ":nom"=>$nomU, ":correo"=>$apeU, ":rol"=>$per, ":clave"=>$contra_cifrada, ":emp"=>$empU, ":estado"=>1));      
        

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "<p></p>";
                     echo "Ingreso Cliente Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
   
//header("Location: ../ingresarUsuarios.php");
                     } catch (Exception $ex) {
                         
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> ";
                echo "Duplicado Registro".$ex->getMessage() ;
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                     }
                     
    
}

?>
      
      <div class="container">
          <center>
              <p></p>
          <h1>Registrar Cliente</h1>
          </center>
          
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="formUsuario">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Cédula:</label>
                        <input type="number" class="form-control" id="cc" name="cc" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Número de Identificación del Usuario.</div>
                    </div>  
                    <div class="col-sm">
                         <label for="exampleFormControlInput1" class="form-label">Nombre del Usuario:</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="">
                        <div id="" class="form-text">Ingrese Nombre de Usuario.</div>
                    </div>
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">CORREO:</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="">
                        <div id="" class="form-text">Ingrese Correo del Usuario.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">ROL:</label>
                           <select name="perfil" class="form-select" id="perfil">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID_R, ROL FROM ROL WHERE ID_R=4");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                        <div id="" class="form-text">Ingrese rol del Usuario.</div>
                    </div>
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">CONTRASEÑA:</label>
                        <input type="password" class="form-control" id="clave1" name="clave" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Contraseña.</div>
                    </div>
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">EMPRESA:</label>
                                                <select name="empresa" class="form-select" id="empresa">
	                    <?php 
	                      include ('../config/conexion1.php');
                             
	                      $consulta = mysqli_query($con, "SELECT ID_EMP,NOM_EMPRESA FROM empresa");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                        
                    </div>
                 
                </div><!-- cierre row -->  
                
                
                    <input class="btn btn-success" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-success" type="reset" name="enviando" value="Borrar">
                    
                   
                </form>  
          
      </div>     
      
      
      
   
      
      
      
      
<script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script>
 $(document).ready(function(){
     $("#leftside-navigation .sub-menu > a").click(function(e) {
  $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
  e.stopPropagation()
})
                   
                   $("#formUsuario").validate({
                       
                       rules:{

                           confirmarClave:{
                             equalTo:"#clave1"
                           
                            },

                           
                       },//cierre llave de las reglas
                       
                       messages:{
                           nit:{
                               required:"El campo nit es requerido."
                               },
                            contrasena:{
                               required:"El campo contraseña es requerido.",
                               rangelength:"Por favor, ingrese un valor entre 8 y 16 caracteres"
                            },
                            empresa:{
                                
                                required:"El campo empresa es requerido"
                            }
                           
                           
                       }//cierre mensajes
                       
                   });//cierre llave de la funcion validate
                   
                    
                });//cierre llave de la funcion ready
        
        </script>
</body>
</html>
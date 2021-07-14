<?php 
include 'header.php';
include 'nabvar-menu.php';
?>  

<!--*******************************************************SideBar***************************************************************-->
<div class="container-fluid">
  <div class="row">
      
<?php 
include 'sidebar.php';
?> 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!///////////////////////////////////////////////Modal ACTUALIZAR///////////////////////////////////////////////////><!-- comment -->
  
        <!--/////////////////////////ENCABEZADO//////////////////////////////////-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    <h2 class="h2">CONSULTAR PETICIÓN</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
     
      </div>
      
        <!-- FIN ENCABEZADO ////////////////////////////////////////////////// -->  
        	<div class="container">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">        
                        
                        <label for="colFormLabel" class="col-sm-4 col-form-label"><h3>Seleccione:</h3></label>
                        
                        <div class="col-12">   
                             <div class="input-group">
                                 <div class="input-group-text"><i class="fas fa-search"></i></div>
                               <select name="peticion" class="form-select" id="peticion">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID_PET, NOM_PETICION FROM peticion");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                                   
                             </div>
                        </div>
                        <div class="col-12">
                        <input type="submit" name="btn_peticion" value="Buscar" class="btn btn-success">
                        </div>

                    </form> 
<div id="" class="form-text">Buscar por: Peticiones.</div>     
<?php
 
if (isset($_POST['btn_peticion'])){

$buscar = $_POST['peticion'];

if(empty($_POST['peticion'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
} else {
include ('../config/conexion.php');

$id_usuarioP = $_SESSION['id_usuario'];
$empr = $_SESSION['ID_EMPRESA'];

      
/*INICIO CONUSLTA PARA EL CRUD PARA PETICION*/

$consulta = "SELECT id_so, id_usurio, operador.nombre AS operador, cliente.nombre AS cliente, cliente.correo, id_peticion, peticion.nom_peticion,titulo_peticion,descripcion,tiempo, id_cliente, respuesta, id_empre 
FROM solicitud
INNER JOIN peticion ON peticion.id_pet= solicitud.id_peticion
INNER JOIN usuarios AS operador ON operador.id_usu=solicitud.id_usurio
INNER JOIN usuarios AS cliente ON cliente.id_usu=solicitud.id_cliente
INNER JOIN empresa ON empresa.id_emp=solicitud.id_empre
WHERE id_peticion=:buscar AND respuesta='' AND id_empre=$empr";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>$buscar));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
      <table class="table table-striped table-hover">
          <thead>
               <tr>
                  <th><p>Solicitudes Pendientes Por responder: <?php echo $cuenta;?></p></th>
              </tr>
              <tr>
                <th>Operador</th>
                <th>Cliente</th>
                <th>Correo</th>                      
                <th>Petición</th> 
                <th>Título</th> 
                <th>Descripción</th> 
                <th>Respuestas</th> 
  
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="row<?php echo $fila['ID_C']?>">
                  <td class="celTipo"><?php echo $fila['operador']?></td>
                  <td class="celcc"><?php echo $fila['cliente']?></td>
                  <td class="celNom"><?php echo $fila['correo']?></td>                                                              
                  <td class="celApe"><?php echo $fila['nom_peticion']?></td> 
                  <td class="celCel"><?php echo $fila['titulo_peticion']?></td>
                  <td class="celGen"><?php echo $fila['descripcion']?></td> 
                  <td class="celRh"><?php echo $fila['respuesta']?></td> 

              </tr>
              <?php } ?>
          </tbody>    
      </table>                    
<?php
} else {/////////////////////////CIERRE DEL IF CUENTA////////////////////////////
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo 'No se encontro solicitud Sin Responder';  
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';    
}////////////////////////////////// CIERRE DEL ELSE///////////////////////////////
}
}////////////////////////CIERRE DEL PRIMER IF/////////////////////////////////////
?>     
<!-- ///////////////////////////////////////INICIO SEGUNDA CONSULTA////////////////////////////////////// -->
<?php
 
if (isset($_POST['btn_peticion'])){

$buscar = $_POST['peticion'];

if(empty($_POST['peticion'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
} else {
include ('../config/conexion.php');

$id_usuarioP = $_SESSION['id_usuario'];
$empr = $_SESSION['ID_EMPRESA'];

      
/*INICIO CONUSLTA PARA EL CRUD PARA PETICION*/

$consulta = "SELECT id_so, id_usurio, operador.nombre AS operador, cliente.nombre AS cliente, cliente.correo, id_peticion, peticion.nom_peticion,titulo_peticion,descripcion,tiempo, id_cliente, respuesta, id_empre 
FROM solicitud
INNER JOIN peticion ON peticion.id_pet= solicitud.id_peticion
INNER JOIN usuarios AS operador ON operador.id_usu=solicitud.id_usurio
INNER JOIN usuarios AS cliente ON cliente.id_usu=solicitud.id_cliente
INNER JOIN empresa ON empresa.id_emp=solicitud.id_empre
WHERE id_peticion=:buscar AND respuesta!='' AND id_empre=$empr";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>$buscar));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
      <table class="table table-striped table-hover">
          <thead>
               <tr>
                  <th><p>Solicitudes Respondidas: <?php echo $cuenta;?></p></th>
              </tr>
              <tr>
                <th>Operador</th>
                <th>Cliente</th>
                <th>Correo</th>                      
                <th>Petición</th> 
                <th>Título</th> 
                <th>Descripción</th> 
                <th>Respuestas</th> 
  
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="row<?php echo $fila['ID_C']?>">
                  <td class="celTipo"><?php echo $fila['operador']?></td>
                  <td class="celcc"><?php echo $fila['cliente']?></td>
                  <td class="celNom"><?php echo $fila['correo']?></td>                                                              
                  <td class="celApe"><?php echo $fila['nom_peticion']?></td> 
                  <td class="celCel"><?php echo $fila['titulo_peticion']?></td>
                  <td class="celGen"><?php echo $fila['descripcion']?></td> 
                  <td class="celRh"><?php echo $fila['respuesta']?></td> 

              </tr>
              <?php } ?>
          </tbody>    
      </table>                    
<?php
} else {/////////////////////////CIERRE DEL IF CUENTA////////////////////////////
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo 'No se encontro solicitud Respondidas';  
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';    
}////////////////////////////////// CIERRE DEL ELSE///////////////////////////////
}
}////////////////////////CIERRE DEL PRIMER IF/////////////////////////////////////
?>
<!-- ///////////////////////////////////////INICIO TERCERA CONSULTA CONSULTA////////////////////////////////////// -->
<?php
 
if (isset($_POST['btn_peticion'])){

$buscar = $_POST['peticion'];

if(empty($_POST['peticion'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
} else {
include ('../config/conexion.php');

$id_usuarioP = $_SESSION['id_usuario'];
$empr = $_SESSION['ID_EMPRESA'];

      
/*INICIO CONUSLTA PARA EL CRUD PARA PETICION*/

$consulta = "SELECT id_so, id_usurio, operador.nombre AS operador, cliente.nombre AS cliente, cliente.correo, id_peticion, peticion.nom_peticion,titulo_peticion,descripcion,tiempo, id_cliente, respuesta, id_empre, TIEMPO, NOW() AS HOY 
FROM solicitud
INNER JOIN peticion ON peticion.id_pet= solicitud.id_peticion
INNER JOIN usuarios AS operador ON operador.id_usu=solicitud.id_usurio
INNER JOIN usuarios AS cliente ON cliente.id_usu=solicitud.id_cliente
INNER JOIN empresa ON empresa.id_emp=solicitud.id_empre

WHERE id_peticion=:buscar AND respuesta='' AND id_empre=$empr";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>$buscar));

$cuenta = $registro->rowCount();

                                    function calculaFecha($fechaIncio, $fechaFin){
    
                                        //3 horas
                                        //4 minutos
                                    $datetime1 = date_create($fechaIncio);
                                    $datetime2 = date_create($fechaFin);
                                    $interval = date_diff($datetime1, $datetime2);

                                    $tiempo= array();

                                    foreach ($interval as $valor){
                                        $tiempo[]=$valor;
                                    }

                                    return $tiempo;
                                    }

if($cuenta>0){
           while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
                  
                  $datos=calculaFecha($fila['TIEMPO'], $fila['HOY']);
                  if ($datos[3]==0 && $datos[4]<=59){
?>
      <table class="table table-striped table-hover">
          <thead>
               <tr>
                  <th><p>Solicitudes Pendientes por Tiempo:</p></th>
              </tr>
              <tr>
                <th>Operador</th>
                <th>Cliente</th>
                <th>Correo</th>                      
                <th>Petición</th> 
                <th>Título</th> 
                <th>Descripción</th> 
                <th>Respuestas</th> 
  
              </tr>
          </thead> 
          <tbody>
              <?php 
       
              ?>
              <tr class="row<?php echo $fila['ID_C']?>">
                  <td class="celTipo"><?php echo $fila['operador']?></td>
                  <td class="celcc"><?php echo $fila['cliente']?></td>
                  <td class="celNom"><?php echo $fila['correo']?></td>                                                              
                  <td class="celApe"><?php echo $fila['nom_peticion']?></td> 
                  <td class="celCel"><?php echo $fila['titulo_peticion']?></td>
                  <td class="celGen"><?php echo $fila['descripcion']?></td> 
                  <td class="celRh"><?php echo $fila['respuesta']?></td> 

              </tr>
                  <?php }//if
                  
                  }//while ?>
          </tbody>    
      </table>                    
<?php
} else {/////////////////////////CIERRE DEL IF CUENTA////////////////////////////
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo 'No se encontro solicitud Sin Responder por tiempo';  
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';    
}////////////////////////////////// CIERRE DEL ELSE///////////////////////////////
}
}////////////////////////CIERRE DEL PRIMER IF/////////////////////////////////////
?>
                </div>
    </main>
  </div>
</div>
<?php include 'footer.php'?>
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
<?php
include ('../config/conexion.php');
$id_usuario = $_SESSION['id_usuario'];
   
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT id_so, id_usurio, operador.nombre AS operador, cliente.nombre AS cliente, cliente.correo, id_peticion, peticion.nom_peticion,titulo_peticion,descripcion,tiempo, id_cliente , respuesta 
FROM solicitud
INNER JOIN peticion ON peticion.id_pet= solicitud.id_peticion
INNER JOIN usuarios AS operador ON operador.id_usu=solicitud.id_usurio
INNER JOIN usuarios AS cliente ON cliente.id_usu=solicitud.id_cliente
WHERE  id_usurio = $id_usuario")->fetchAll(PDO::FETCH_OBJ);
    
?>
<!*************************************************************Modal ACTUALIZAR*********************************************************><!-- comment -->
      
<!--************************************************************************Encabezado***************************************************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Registrar Respuesta a Solicitud</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertarRespuesta.php" method="post" id="formUsuario">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Solicitud:</label>
                         <select name="solicitud" class="form-select" id="solicitud">
	                    <?php 
	                      include ('../config/conexion1.php');
                              $id_usuario = $_SESSION['id_usuario'];
                              

                                    $consulta1 = mysqli_query($con, "SELECT ID_SO,TITULO_PETICION, TIEMPO, NOW() AS HOY FROM solicitud WHERE ID_USURIO=$id_usuario");
                                    while ($valores = mysqli_fetch_assoc($consulta1)){  
                                     $datos=calculaFecha($valores['TIEMPO'], $valores['HOY']);
                                     if ($datos[3]==0 && $datos[4]<=59){
                                         
                                     
                                    echo '<option  value="'.$valores['ID_SO'].'" >'.$valores['TITULO_PETICION'].'</option>';
                                        }
                                    }
                                    
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

	                      ?>
                         </select>
                        <div id="" class="form-text">Seleccione Petición.</div>
                    </div>  
                </div><!-- cierre row -->
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Respuesta:</label>
                        
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="resp" name="resp"></textarea>
                            <label for="floatingTextarea">Comments</label>
                        </div>
                        <div id="" class="form-text">Respuesta Solicitud.</div>
                    </div> 
                </div><!--cierre del row-->
                
                
                    <input class="btn btn-success" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-success" type="reset" name="enviando" value="Borrar">
                   
                </form>           
          
        </div><!<!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Lista de Respuestas</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
      <div class="row">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
               
                <th>Petición</th>        
                <th>Nombre Cliente</th> 
                <th>Correo</th> 
                <th>Título_peticion</th> 
                <th>Descripcion</th> 
                <th>Respuesta</th>
 
              </tr>
          </thead> 
          <tbody>
              <?php 
              
              
//echo $entrada[$claves_aleatorias[1]] . "\n";

              foreach ($registro as $data):

              ?>
              <tr class="row<?php echo $data->id_so ?>">
                  
                  <td class="celNom"><?php echo $data->nom_peticion ?></td>  
                  <td class="celApe"><?php echo $data->cliente ?></td> 
                  <td class="celApe"><?php echo $data->correo ?></td> 
                  <td class="celApe"><?php echo $data->titulo_peticion ?></td> 
                  <td class="celCel"><?php echo $data->descripcion ?></td>
                  <td class="celEmp"><?php echo $data->respuesta ?></td> 

              </tr>
              <?php endforeach; ?>
          </tbody>    
      </table>
       </div><!-- cierre row -->
 </div><!<!-- Cierre container -->
                
    </main>
  </div>
</div>
<?php include 'footer.php'?>

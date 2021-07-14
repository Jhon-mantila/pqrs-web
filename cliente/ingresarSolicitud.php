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
    $registro=$conexion->query("SELECT id_so, id_usurio, operador.nombre AS operador, cliente.nombre AS cliente, cliente.correo, id_peticion, peticion.nom_peticion,titulo_peticion,descripcion,tiempo, id_cliente, respuesta 
FROM solicitud
INNER JOIN peticion ON peticion.id_pet= solicitud.id_peticion
INNER JOIN usuarios AS operador ON operador.id_usu=solicitud.id_usurio
INNER JOIN usuarios AS cliente ON cliente.id_usu=solicitud.id_cliente
WHERE id_cliente=$id_usuario ORDER BY id_so DESC")->fetchAll(PDO::FETCH_OBJ);
    
?>
<!*************************************************************Modal ACTUALIZAR*********************************************************><!-- comment -->
  <div class="modal Modal">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <div class="bodyModal ">
             
                <form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataUsuarios();">
                 <h3>ACTUALIZAR OPERARIO</h3><br>
                 
                 <div class="row">
                  <div class="col-sm">   
                        <label for="exampleFormControlInput1" class="form-label">CEDULA:</label>
                        <input type="number" name="cedula" id="cedula" class="form-control" placeholder=""/><br> 
                  </div>
                 </div><!<!-- row cierre -->  
                 
                 <div class="row">
                 <div class="col-sm">    
                 <label for="exampleFormControlInput1" class="form-label">NOMBRE:</label>
                 <input type="text" name="nom" id="nom" class="form-control" placeholder=""/><br> 
                 </div>
 
                </div><!<!-- row cierre --> 
                
                
                <div class="row">
                 <div class="col-sm"> 
                 <label for="exampleFormControlInput1" class="form-label">CORREO:</label>
                 <input type="email" name="correo" id="correo" class="form-control" placeholder=""/><br> 
                </div>
                
                </div><!-- cieere row -->

                <div class="row">
                        <label for="exampleFormControlInput1" class="form-label">EMPRESA:</label>
                       
                        <select name="empresa" class="form-select" id="empresa">
	                    <?php 
	                      include ('../config/conexion1.php');
                             $empresa= $_SESSION["ID_EMPRESA"];
	                      $consulta = mysqli_query($con, "SELECT ID_EMP,NOM_EMPRESA FROM empresa WHERE ID_EMP=$empresa");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                 </div><!-- cieere row -->   
                 
                  
                  <div class="row">
                        <label for="exampleFormControlInput1" class="form-label">ESTADO:</label>
                         <select name="activo" class="form-select" id="activo">
                             <option value="0">BLOQUEADO</option>
                             <option value="1">ACTIVO</option>
                         </select>
   
                 </div><!-- cieere row -->
                 <input type="hidden" name="id_u" id="id_u" />
                 <input type="hidden" name="action" value="actUsuarios"/>
                 <div class="alertAddProduct"></div>
                 <br>
                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                 <button type="submit" class="btn btn-outline-success">Actualizar</button>
                 <a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();">Cerrar</a>
                 </div>
               </form>
  
            </div>
          </div>
       </div>
    </div>
  </div>       
<!--************************************************************************Encabezado***************************************************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Registrar Solicitud</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertarSolicitud.php" method="post" id="formUsuario">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Petición:</label>
                         <select name="peticion" class="form-select" id="peticion">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID_PET, NOM_PETICION FROM peticion");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                        <div id="" class="form-text">Seleccione Petición.</div>
                    </div>  
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col-sm">
                         <label for="exampleFormControlInput1" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="">
                        <div id="" class="form-text">Título de la Petición.</div>
                    </div>
                 
                </div><!-- cierre row -->  
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Descripción:</label>
                        
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"></textarea>
  <label for="floatingTextarea">Comments</label>
</div>
                        <div id="" class="form-text">Descripción.</div>
                    </div> 
                </div><!--cierre del row-->
                
                
                    <input class="btn btn-success" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-success" type="reset" name="enviando" value="Borrar">
                   
                </form>           
          
        </div><!<!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Lista de Operarios</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
      <div class="row table-responsive">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Operador</th>
                <th>Nombre Cliente</th>
                <th>Correo</th>
                <th>Petición</th>                      
                <th>Título_peticion</th> 
                <th>Descripcion</th> 
                <th>Hora</th>
                <th>Respuesta</th>
              </tr>
          </thead> 
          <tbody>
              <?php 
              
              
//echo $entrada[$claves_aleatorias[1]] . "\n";

              foreach ($registro as $data):

              ?>
              <tr class="row<?php echo $data->id_so ?>">
                  <td class="celcc"><?php echo $data->operador ?></td>
                  <td class="celNom"><?php echo $data->cliente ?></td> 
                  <td class="celNom"><?php echo $data->correo ?></td> 
                  <td class="celNom"><?php echo $data->nom_peticion ?></td>                                                              
                  <td class="celApe"><?php echo $data->titulo_peticion ?></td> 
                  <td class="celCel"><?php echo $data->descripcion ?></td>
                  <td class="celEmp"><?php echo $data->tiempo ?></td> 
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

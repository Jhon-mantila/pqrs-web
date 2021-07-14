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
$empresa = $_SESSION["ID_EMPRESA"];
   
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT id_usu, cc, nombre, correo, clave, id_empresa, empresa.nom_empresa, id_rol, rol.rol, activo_u
FROM usuarios 
INNER JOIN empresa ON empresa.id_emp=usuarios.id_empresa
INNER JOIN rol ON rol.id_r=usuarios.id_rol
WHERE id_rol=3 AND id_empresa = $empresa; 
                                ORDER BY id_usu DESC")->fetchAll(PDO::FETCH_OBJ);
    
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
        
        <h1 class="h2">Registrar Operario</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertarUsuarios.php" method="post" id="formUsuario">
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
	                      $consulta = mysqli_query($con, "SELECT ID_R, ROL FROM ROL WHERE ID_R=3");
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
                              $empresa= $_SESSION["ID_EMPRESA"];
	                      $consulta = mysqli_query($con, "SELECT ID_EMP,NOM_EMPRESA FROM empresa WHERE ID_EMP= $empresa");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                         </select>
                        
                    </div>
                 
                </div><!-- cierre row -->  
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Estado:</label>
                         <select name="activo" class="form-select" id="activo">
                             <option value="0">BLOQUEADO</option>
                             <option value="1">ACTIVO</option>
                         </select>
                        <div id="" class="form-text">Estado del Usuario.</div>
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
      <div class="row">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Cédula</th>
                <th>Nombres</th>                      
                <th>Correo</th> 
                <th>Empresa</th> 
                <th>Rol</th>
                <th>ESTADO</th>
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              
              
//echo $entrada[$claves_aleatorias[1]] . "\n";

              foreach ($registro as $data):
                  if($data->activo_u==0){
                      $n_estado="BLOQUEADO";
                  } else {
                      $n_estado="ACTIVO";
                  }
              ?>
              <tr class="row<?php echo $data->id_usu ?>">
                  <td class="celcc"><?php echo $data->cc ?></td>
                  <td class="celNom"><?php echo $data->nombre ?></td>                                                              
                  <td class="celApe"><?php echo $data->correo ?></td> 
                  <td class="celCel"><?php echo $data->nom_empresa ?></td>
                  <td class="celEmp"><?php echo $data->rol ?></td> 
                  <td class="celEstado"><?php echo $n_estado ?></td>
                    <td>
                        <a class="add_usuarios btn btn-outline-success" product="<?php echo $data->id_usu ?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_usuarios btn btn-outline-danger" product="<?php echo $data->id_usu ?>" href="#">
                        <i class="fas fa-trash-alt"></i></a>
                    </td>
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


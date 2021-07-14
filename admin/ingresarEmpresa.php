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

   
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT ID_EMP, NIT, NOM_EMPRESA, ACTIVO FROM empresa ORDER BY ID_EMP DESC LIMIT 30")->fetchAll(PDO::FETCH_OBJ);
    
?>
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Registrar Empresa</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertarEmpresa.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Número de Identificación Tributaria (Nit):</label>
                        <input type="number" class="form-control" id="nit" name="nit" placeholder="Ingrese Solo Número" required="">
                        <div id="" class="form-text">Ingrese Nit de la Empresa.</div>
                    </div>  
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nombre de la Empresa:</label>
                        <input type="text" class="form-control" id="emp" name="emp" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Nombre de la Empresa.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-lg-6">
                        <label for="exampleFormControlInput1" class="form-label">Estado:</label>
                             <select name="activo" class="form-select" id="activo">
                                                    <option value="0">BLOQUEADO</option>
                                                    <option value="1">ACTIVO</option>
                              </select>
                        <div id="" class="form-text">Ingrese contato de la empresa.</div>
                    </div>
                </div><!-- cierre row -->   
                
                    <input class="btn btn-success" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-success" type="reset" name="enviando" value="Borrar">
                
                </form>           
          
        </div><!<!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Lista de Empresas</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
      <div class="row">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Número de Identificación Tributaria (Nit):</th>
                <th>Nombre de la Empresa</th>
                <th>Estado</th>
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $personas):
              ?>
              <tr class="row<?php echo $personas->ID_EMP?>">
                  <td class="celNit"><?php echo $personas->NIT?></td>
                  <td class="celEmp"><?php echo $personas->NOM_EMPRESA ?></td>
                  <td class="celCel"><?php echo $personas->ACTIVO ?></td>                                                              
                <td>
                   <a class="add_empresa btn btn-outline-success" product="<?php echo $personas->ID_EMP?>" href="#">
                   <i class="fas fa-edit"></i></a>
                 </td>
                 <td>
                   <a class="del_empresa btn btn-outline-danger" product="<?php echo $personas->ID_EMP?>" href="#">
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


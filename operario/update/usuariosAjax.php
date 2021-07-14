<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoProducto'){
       //echo 'consultar';
        $usuarios_id = $_POST['producto'];
        
        $resultado = mysqli_query($con, "SELECT ID_USU, CC, NOMBRE, CORREO, CLAVE, ID_EMPRESA, empresa.NOM_EMPRESA, ID_ROL, rol.ROL, ACTIVO_U
FROM usuarios 
INNER JOIN empresa ON empresa.ID_EMP=usuarios.ID_EMPRESA
INNER JOIN rol ON rol.ID_R=usuarios.ID_ROL
WHERE ID_USU=$usuarios_id");
        
        mysqli_close($con);
        
        $fila = mysqli_num_rows($resultado);
        
        if ($fila > 0){
            $data = mysqli_fetch_assoc($resultado);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        }
        
        exit();
    }
    //Actualizar
    
 if($_POST['action'] == 'actUsuarios'){
                
    if (!empty($_POST['id_u']) || !empty($_POST['cedula']) || !empty($_POST['empresa']) )
    {  
      
      $id_u = $_POST['id_u'] ; 
      $cedula= $_POST['cedula'];      
      $nom= $_POST['nom']; 
      $cel= $_POST['correo'];
      $empresaU= $_POST['empresa'];
      $activoU= $_POST['activo'];
      


            $sql = mysqli_query($con, "UPDATE usuarios SET CC=$cedula, NOMBRE='$nom', CORREO='$cel', ID_EMPRESA=$empresaU,ACTIVO_U=$activoU WHERE ID_USU = $id_u");

           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_USU, CC, NOMBRE, CORREO, CLAVE, ID_EMPRESA, empresa.NOM_EMPRESA, ID_ROL, rol.ROL, ACTIVO_U
FROM usuarios 
INNER JOIN empresa ON empresa.ID_EMP=usuarios.ID_EMPRESA
INNER JOIN rol ON rol.ID_R=usuarios.ID_ROL
WHERE ID_USU=$id_u");
                    $fila = mysqli_num_rows($resultado);
        
                if ($fila > 0)
                        {
                    $data = mysqli_fetch_assoc($resultado);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    exit();
                        }
                    } else {
                        echo 'error';    
                    }
                    mysqli_close($con);
            
        } else {
            
        echo 'error';
    }        

           
    }//if de la accion
    
    // Eliminar producto
        if($_POST['action']=='delUsuario'){
       //echo 'consultar';
            if(empty($_POST['id_u']) || !is_numeric($_POST['id_u']) ){
                echo 'error';
            } else {
                $id_u = $_POST['id_u'];
                
                
             
                
                $sql_del = mysqli_query($con, "DELETE FROM usuarios WHERE ID_USU = $id_u");
                mysqli_close($con);
                
                if($sql_del){
                   echo 'Ok';
                }else{
                   //echo 'error';
                }
            }
            echo 'error';
    }

    exit();
}//post
// primer if
//print_r($_POST);
exit();
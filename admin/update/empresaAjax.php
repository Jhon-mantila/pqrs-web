<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoProducto'){
       //echo 'consultar';
        $empresa_id = $_POST['producto'];
        
        $resultado = mysqli_query($con, "SELECT ID_EMP, NIT, NOM_EMPRESA, ACTIVO FROM empresa WHERE ID_EMP =$empresa_id");
        
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
 if($_POST['action'] == 'addProduct'){
                
    if (!empty($_POST['idE']) || !empty($_POST['nit']) || !empty($_POST['emp'])|| !empty($_POST['activo']))
    {  
      
            $idEmpresa = $_POST['idE'];
            $nit= $_POST['nit'];
            $emp =    $_POST['emp'];
            $cel = $_POST['activo'];
          
            
            $sql = mysqli_query($con, "UPDATE empresa SET NIT=$nit, NOM_EMPRESA='$emp', ACTIVO=$cel WHERE ID_EMP=$idEmpresa");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_EMP, NIT, NOM_EMPRESA, ACTIVO FROM empresa WHERE ID_EMP=$idEmpresa");
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
        if($_POST['action']=='delProduct'){
       //echo 'consultar';
            if(empty($_POST['id_e']) || !is_numeric($_POST['id_e']) ){
                echo 'error';
            } else {
                $idEmpresa = $_POST['id_e'];
                
                
                
                
                $sql_del = mysqli_query($con, "DELETE FROM empresa WHERE ID_EMP = $idEmpresa");
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
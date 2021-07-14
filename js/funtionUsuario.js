$(document).ready(function(){
    
$('.add_usuarios').click(function(e){
         e.preventDefault();
         
         var producto = $(this).attr('product');
         var action = 'infoProducto'   ;
   
         //alert(producto);
         
         $.ajax({
            url:'update/usuariosAjax.php',
            type:'POST',
            async: true,
            data:{action: action, producto: producto},
  
            success: function(response) {
                
                //console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    //console.log(info);
                    
                    $('#id_u').val(info.ID_USU);
                    $('#cedula').val(info.CC);
                    $('#nom').val(info.NOMBRE);
                    $('#rol').val(info.ID_ROL);
                    $('#correo').val(info.CORREO);
             
                    $('#empresa').val(info.ID_EMPRESA);
                    

                    $('#activo').val(info.ACTIVO_U);
                    

                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });
     
      $('.del_usuarios').click(function(e){
         e.preventDefault();
         
         var producto = $(this).attr('product');
         var action = 'infoProducto'   ;
   
         //alert(producto);
         
         $.ajax({
            url:'update/usuariosAjax.php',
            type:'POST',
            async: true,
            data:{action: action, producto: producto},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);

                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delUsuarios();">'+
                                                '<h2>Eliminar Usuarios</h2>'+
                                                '<p>¿Está seguro de Eliminar el Siguiente Usuario?</p>'+
                                                '<h2>'+info.NOMBRE+'</h2>'+
                                          
                                                '<input type="hidden" name="id_u" id="id_u" value="'+info.ID_USU+'"/>'+
                                                '<input type="hidden" name="action" value="delUsuario"/>'+
                                                '<div class="alertAddProduct"></div>'+
                                                
                                                '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                                '<button type="submit" class="btn-del btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Eliminar</button>'+
                                                '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal1();"><i class="fas fa-times-circle"></i>Cancelar</a>'+
                                                '</div>'+
                                          '</form>');
                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });
     
     
});//fin funcion inicia

function sendDataUsuarios(){
    
     $.ajax({
            url:'update/usuariosAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);
                     
                     $('.row' + info.ID_USU + ' .celcc').html(info.CC);
                     $('.row' + info.ID_USU + ' .celNom').html(info.NOMBRE);
                     $('.row' + info.ID_USU + ' .celApe').html(info.CORREO);
                     $('.row' + info.ID_USU + ' .celCel').html(info.CEL);
                     $('.row' + info.ID_USU + ' .celEmp').html(info.NOM_EMPRESA);
              
                     $('.row' + info.ID_USU + ' .celEstado').html(info.ACTIVO_U);
                     
                    //location.reload();
                  
                       $('.alertAddProduct').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Actualizado Correctamente</div>');
                }

            },
            
            error: function(error){
                console.log(error);
            }
         });
    
    $('.alertAddProduct').html('');
        
}

function delUsuarios(){
    var pr = $('#id_u').val();
     $.ajax({
            url:'update/usuariosAjax.php',
            type:'POST',
            async: true,
            data: $('#form_del_product').serialize(),
  
            success: function(response) {
                    console.log(response);
               if(response == 'error'){
                    $('.alertAddProduct').html('<div class="alert alert-danger" alert-dismissible fade show" role="alert">No Se puede Eliminar esta Relacinado<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }else{
                      
                      $('.row' + pr).remove();
                      $('#form_del_product .btn-del').remove();
                
                    //location.reload();
                   
                       $('.alertAddProduct').html('<div class="alert alert-success" alert-dismissible fade show" role="alert">Usuario Eliminado<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }

            },
            
            error: function(error){
                console.log(error);
            }
         });   
    $('.alertAddProduct').html('');
 
}
function closeModal(){
    $('.alertAddProduct').html('');
    //Limpiar Formulario Limpiar
    //$('#planilla').val('');
    $('#empresa').val(4);
    
    $('.Modal').fadeOut();
    //location.reload();
}

function closeModal1(){
    $('.alertAddProduct').html('');
    $('.Modal').fadeOut();
    location.reload();
}
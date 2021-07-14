$(document).ready(function(){
    
$('.add_empresa').click(function(e){
         e.preventDefault();
         
         var producto = $(this).attr('product');
         var action = 'infoProducto'   ;
   
         //alert(producto);
         
         $.ajax({
            url:'update/empresaAjax.php',
            type:'POST',
            async: true,
            data:{action: action, producto: producto},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                     if(info.ACTIVO==1){
                        activo='Activo';                        
                    }else{
                        activo='Bloqueado';
                    }
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataEmpresa();">'+
                                                '<div class="iconoAct text-success"><i class="fas fa-edit"></i></div>'+
                                                '<h3>ACTUALIZAR REGISTRO DE EMPRESA</h3><br>'+
                                                '<label for="exampleFormControlInput1" class="form-label">NÚMERO DE IDENTIFICACIÓN TRIBUTARIA (NIT):</label>'+
                                                '<input type="number" name="nit" id="txtRegistro" class="form-control" value="'+info.NIT+'" placeholder="Nit Empresa"/><br> '+
                                                '<label for="exampleFormControlInput1" class="form-label">NOMBRE DE LA EMPRESA:</label>'+
                                                '<input type="text" name="emp" id="txtnBote" class="form-control" value="'+info.NOM_EMPRESA+'" placeholder="Nombre Empresa"/><br> '+
                                                '<label for="exampleFormControlInput1" class="form-label">ESTADO:</label>'+  
                                                '<select class="form-select" aria-label="Default select example" name="activo" id="activo">'+
                                                '<option value="'+info.ACTIVO+'">'+activo+'</option>'+
                                                '<option value="1">Activo</option>'+
                                                '<option value="0">Bloqueado</option>'+
                                                '</select>'+
                                                '<input type="hidden" name="idE" id="idE" value="'+info.ID_EMP+'"/>'+
                                                '<input type="hidden" name="action" value="addProduct"/>'+
                                                '<div class="alertAddProduct"></div>'+
                                                '<div class="d-grid gap-2 d-md-flex justify-content-md-end">'+
                                                '<button type="submit" class="btn btn-outline-success">Actualizar</button>'+
                                                '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();">Cerrar</a>'+
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

     
 $('.del_empresa').click(function(e){
         e.preventDefault();
         
         var producto = $(this).attr('product');
         var action = 'infoProducto'   ;
   
         //alert(producto);
         
         $.ajax({
            url:'update/empresaAjax.php',
            type:'POST',
            async: true,
            data:{action: action, producto: producto},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delEmpresa();">'+
                                                '<h2>Eliminar Empresa</h2>'+
                                                '<p>¿Está seguro de Eliminar la Siguiente Empresa?</p>'+
                                                '<h2>'+info.NOM_EMPRESA+'</h2>'+
                                          
                                                '<input type="hidden" name="id_e" id="id_e" value="'+info.ID_EMP+'"/>'+
                                                '<input type="hidden" name="action" value="delProduct"/>'+
                                                '<div class="alertAddProduct"></div>'+
                                                
                                                '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                                '<button type="submit" class="btn-del btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Eliminar</button>'+
                                                '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();"><i class="fas fa-times-circle"></i>Cancelar</a>'+
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

function sendDataEmpresa(){
    
     $.ajax({
            url:'update/empresaAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);
                      $('.row' + info.ID_EMP + ' .celNit').html(info.NIT);
                      $('.row' + info.ID_EMP + ' .celEmp').html(info.NOM_EMPRESA);
                      $('.row' + info.ID_EMP + ' .celCel').html(info.ACTIVO);
                       
                
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

function delEmpresa(){
    var pr = $('#id_e').val();
     $.ajax({
            url:'update/empresaAjax.php',
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
                   
                       $('.alertAddProduct').html('<div class="alert alert-success" alert-dismissible fade show" role="alert">Empresa Eliminada<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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
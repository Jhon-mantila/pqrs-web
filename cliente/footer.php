


<script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="../js/funtionUsuario.js" type="text/javascript"></script>

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


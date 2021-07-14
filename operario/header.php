<?php
 session_start();
   if(!isset($_SESSION["usuario"]) || !isset($_SESSION["id_usuario"])){
   header("location:../index.php");
   }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator">
   

    
    <title>PQRS</title>
    
    
    <link href="../css/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Favicons -->
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet" type="text/css"/>
   
    <link href="../recursos/fontawesome-free-5.15.3-web/css/fontawesome.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/brands.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/solid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
  </head>
  <!--cambiar la siguiente linea a <div class="modal Modal"> -->
  <div class="modal Modal">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <div class="bodyModal ">    

   
  
            </div>
          </div>
       </div>
    </div>
  </div>
  <body>
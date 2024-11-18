<?php 
include "seguridad/config.php"

?>


<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon.png">
    <title>Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
$active="home";
include "componentes/header.php"
?>
<style>
  .imgestilos{
    background-color:#dedede;
  }
  .imgestilos img{
    max-height:400px;
    margin:auto;
  }
</style>

<div class="container mt-3">
    <div class="row mb-4">
        <header class="col-12">
            <h1 class="p-3 bg-primary-subtle border-opacity-10 rounded shadow-sm  text-secondary text-center" >Productos agregados </h1>
        </header>
    </div>
    <div class="row mt-5" id="contenido">
   
      </div>
      
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/shadow.js"></script>
    </body>
</html>
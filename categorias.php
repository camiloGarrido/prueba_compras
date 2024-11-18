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
$active="categorias";
include "componentes/header.php"
?>

<div class="container mt-3">
    <div class="row mb-4">
        <header class="col-12">
            <h1 class="p-3 bg-primary-subtle border-opacity-10
             rounded shadow-sm  text-secondary text-center" >
             Categorias 
            </h1>
        </header>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 " >
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre categoria</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Titulo Categoria">
                    </div>
                    <div class="">
                    <div id="liveAlertPlaceholder"></div>
                        <button onclick="save();" class="w-100 btn-lg btn btn-outline-success" type="submit">GUARDAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12" >
          <h2 class="p-3 bg-secondary-subtle border-opacity-10 rounded shadow-sm  text-secondary text-center" >
            Listado 
          </h2>
          <div id="liveAlertPlaceholder2" class="pb-3"></div>
        </div>
        <div class="col-12 mt-4 mb-4">

            <div class="card">
                <div class="card-body">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="contenidoTabla">
                          
                    
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar tarea</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <input type="hidden" class="form-control" id="Uid">
      <div class="mb-3">
        <label for="UNombre" class="form-label">Actualizar nombre</label>
        <input type="text" class="form-control" id="UNombre" >
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="update()">Actualizar</button>
      </div>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/categorias.js"></script>
    </body>
</html>
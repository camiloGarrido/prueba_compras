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
$active="productos";
include "componentes/header.php"
?>

<div class="container mt-3">
    <div class="row mb-4">
        <header class="col-12">
            <h1 class="p-3 bg-primary-subtle border-opacity-10 rounded shadow-sm  text-secondary text-center" >Productos </h1>
        </header>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 " >
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre producto</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Titulo Producto">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="numbers" class="form-control" id="precio" placeholder="9000">
                    </div>
                    
                   
                    <div class="mb-3">
                      <select id="categorias" class="form-select" aria-label="Categoria">
                        <option value="0" selected>Seleccione una opcion</option>
                      </select>
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
                            <th scope="col">Categoria</th>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <input type="hidden" class="form-control" id="Uid">
        <div class="mb-3">
          <label for="UNombre" class="form-label">Actualizar nombre</label>
          <input type="text" class="form-control" id="UNombre" >
        </div>
        <div class="mb-3">
            <label for="UPrecio" class="form-label">Precio</label>
            <input type="numbers" class="form-control" id="UPrecio" placeholder="9000">
        </div>
        
        
        <div class="mb-3">
          <select id="UidCategoria" class="form-select" aria-label="Categoria">
            <option value="0" selected>Seleccione una opcion</option>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="update()">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal2Label">Actualizar Imagenes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <input type="hidden" class="form-control" id="idImg">
        <h2>Agregar una nueva imagen</h2>
        <div class="mb-3">
          <input class="form-control" id="url_foto" placeholder="URL de la imagen" />
        </div>
        <div class="mb-3">
          <button onclick="guardarImg()" class="btn btn-success w-100" > Agregar</button>
        </div>
        <div id="liveAlertPlaceholder3"></div>
        <div id="listadoImagenes">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/productos.js"></script>
    </body>
</html>
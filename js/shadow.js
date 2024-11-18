const url = "logica/homeService.php";
function obtenerInformacion() {
  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json(); // Convertir la respuesta a JSON
    })
    .then((data) => {
      if (data.length > 0) {
        completarTabla(data);
      } else {
        document.getElementById("contenidoTabla").innerHTML = `  <tr>
                                <td colspan="5" class="text-center table-warning" >Sin contenido</td>
                            </tr>`;
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });
}

function completarTabla(data) {
  let string = "";
  for (let i = 0; i < data.length; i++) {
    const item = data[i];
    let listaImagenes = "";
    for (let f = 0; f < item.imagenes.length; f++) {
      const url = item.imagenes[f].url;
      listaImagenes += ` <div class="carousel-item imgestilos ${
        f == 0 ? "active" : ""
      }">
                        <img src="${url}" class="img-thumbnail d-block " alt="url" />
                      </div> `;
    }
    string += `<div class="col-12 mb-4">  
          <h2 class="">
          Titulo producto:  <strong>${item.nombre}</strong>
          </h2>
            <h3 class="">
           Precio  $<strong>${item.precio}</strong>
          </h3>
                      <h3 class="">
           Categoria:  <strong>${item.nombreCategoria}</strong>
          </h3>
          <div>
                  <div id="carouselExample${item.idproductos}" class="carousel slide">
                    <div class="carousel-inner">
                      ${listaImagenes}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample${item.idproductos}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample${item.idproductos}" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
          </div>
          <hr/>
        </div>`;
  }
  document.getElementById("contenido").innerHTML = string;
}

obtenerInformacion();

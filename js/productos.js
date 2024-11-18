const myModal = new bootstrap.Modal("#exampleModal", {});
const modalImagenes = new bootstrap.Modal("#modal2", {});
const alertPlaceholder = document.getElementById("liveAlertPlaceholder");
const alertPlaceholder2 = document.getElementById("liveAlertPlaceholder2");
const modalImagenesAlert = document.getElementById("liveAlertPlaceholder3");

const url = "logica/productoService.php";

const appendAlert = (message, type) => {
  const wrapper = document.createElement("div");
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    "</div>",
  ].join("");

  alertPlaceholder.append(wrapper);
};
const appendAlert2 = (message, type) => {
  const wrapper = document.createElement("div");
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    "</div>",
  ].join("");

  alertPlaceholder2.append(wrapper);
};
const appendAlert3 = (message, type) => {
  const wrapper = document.createElement("div");
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    "</div>",
  ].join("");

  modalImagenesAlert.append(wrapper);
};

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
function obtenerCategorias() {
  fetch("logica/categoriaService.php?view=1")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json(); // Convertir la respuesta a JSON
    })
    .then((data) => {
      if (data.length > 0) {
        let concat =
          " <option value='0' selected>Seleccione una opcion</option>";
        for (let i = 0; i < data.length; i++) {
          const item = data[i];
          concat += `<option value="${data[i].idcategorias}" >${data[i].nombre} </option>`;
        }

        document.getElementById("categorias").innerHTML = concat;
        document.getElementById("UidCategoria").innerHTML = concat;
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });
}

function save() {
  let nombre = document.getElementById("nombre").value;
  let precio = document.getElementById("precio").value;

  let categorias = document.getElementById("categorias").value;
  var data = { nombre, precio, idCategoria: categorias, save: 1 };

  fetch(url, {
    method: "POST", // or 'PUT'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => {
      if (response.message == 200) {
        appendAlert("Se guardo el producto", "success");
        obtenerInformacion();
      } else {
        appendAlert("Campos vacios para guardar", "danger");
      }
    });
}

function completarTabla(data) {
  let string = "";
  for (let i = 0; i < data.length; i++) {
    const item = data[i];
    let estado =
      item.estado == "1"
        ? { nombre: "Activo", class: "bg-info-subtle" }
        : item.estado == "2"
        ? { nombre: "Terminado", class: "bg-success-subtle" }
        : { nombre: "Eliminado", class: "bg-danger-subtle" };
    let btnDelete =
      item.estado != 0
        ? ` <button type="button" class="btn btn-danger" onclick="updateEstado(${item.idproductos},-1)" >Eliminar</button>`
        : "";
    string += `<tr>
        <th scope="row">${item.idproductos}</th>
          <td>${item.nombre}</td>
        <td>${item.nombreCategoria}</td>
        <td>
            <div class="${estado.class} text-secondary text-center p-1 border-opacity-10 rounded">
            ${estado.nombre}
            </div>
        </td>
        <td class="text-center" >
            <div class="btn-group" role="group" >
               <button type="button" class="btn btn-secondary" onclick="listarImagenes(${item.idproductos})" >
                Imagenes
               </button>
                <button type="button" class="btn btn-warning" 
                onclick="editData('${item.nombre}',${item.precio},
                '${item.idCategoria}',${item.idproductos}) " >
                  Editar
                </button>
                ${btnDelete}
            </div>    
        </td>
    </tr>`;
  }
  document.getElementById("contenidoTabla").innerHTML = string;
}

function editData(nombre, valorPrecio, idCategoria, id) {
  document.getElementById("Uid").value = id;
  document.getElementById("UNombre").value = nombre;
  document.getElementById("UPrecio").value = valorPrecio;
  document.getElementById("UidCategoria").value = idCategoria;

  myModal.show();
}

function update() {
  let id = document.getElementById("Uid").value;
  let nombre = document.getElementById("UNombre").value;
  let precio = document.getElementById("UPrecio").value;
  let idCategoria = document.getElementById("UidCategoria").value;
  let data = { id, precio, nombre, idCategoria, update: 1 };

  fetch(url, {
    method: "POST", // or 'PUT'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => {
      if (response.message == 200) {
        appendAlert2("Se actualizo la tarea", "success");
        myModal.hide();
        obtenerInformacion();
      } else {
        appendAlert2("No se actualizo la tarea", "error");
      }
    });
}

function updateEstado(id, estado) {
  let data = { id, update: estado };

  fetch(url, {
    method: "POST", // or 'PUT'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => {
      if (response.message == 200) {
        if (estado == 2) {
          appendAlert2("Se Completo la tarea", "info");
        } else {
          appendAlert2("Se Elimino la tarea", "danger");
        }

        myModal.hide();
        obtenerInformacion();
      } else {
        appendAlert2("No se actualizo la tarea", "error");
      }
    });
}

function listarImagenes(id) {
  document.getElementById("idImg").value = id;
  console.log(id);
  fetch("logica/imagenService.php?id=" + id)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json(); // Convertir la respuesta a JSON
    })
    .then((data) => {
      if (data.length > 0) {
        let concat = "";
        for (let i = 0; i < data.length; i++) {
          const item = data[i];
          concat += `
            <img src="${item.url}" alt="Imagen de prueba" class="img-thumbnail" />
          <button class="btn btn-danger" onclick="eliminarImg(${item.idImagenes})">Eliminar</button>
            <hr />
          `;
        }
        document.getElementById("listadoImagenes").innerHTML = concat;
      } else {
        document.getElementById("listadoImagenes").innerHTML =
          "<p class='text-center p-2 rounded bg-info'>Sin imagenes actualmente</p>";
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });

  modalImagenes.show();
  //modalImagenes.hide();
}

function guardarImg() {
  const id = document.getElementById("idImg").value;
  const url_foto = document.getElementById("url_foto").value;
  let data = { id, nombre: url_foto, save: 1 };

  fetch("logica/imagenService.php", {
    method: "POST", // or 'PUT'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json(); // Convertir la respuesta a JSON
    })
    .then((data) => {
      if (data.message == 200) {
        appendAlert3("Se guardo imagen correctamente", "success");
        listarImagenes(id);
      } else {
        document.getElementById("listadoImagenes").innerHTML =
          "<p class='text-center p-2 rounded bg-info'>Sin imagenes actualmente</p>";
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });
}
function eliminarImg(id) {
  let data = { id, update: -1 };

  fetch("logica/imagenService.php", {
    method: "POST", // or 'PUT'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json(); // Convertir la respuesta a JSON
    })
    .then((data) => {
      if (data.message == 200) {
        appendAlert3("Se elimino imagen correctamente", "success");
        let id2 = document.getElementById("idImg").value;
        listarImagenes(id2);
      } else {
        appendAlert3("No se elimino la imagen seleccionada", "danger");
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });
}

obtenerInformacion();
obtenerCategorias();

const myModal = new bootstrap.Modal("#exampleModal", {});
const alertPlaceholder = document.getElementById("liveAlertPlaceholder");
const alertPlaceholder2 = document.getElementById("liveAlertPlaceholder2");
const url = "logica/categoriaService.php";

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
                                <td colspan="4" class="text-center table-warning" >Sin contenido</td>
                            </tr>`;
      }
    })
    .catch((error) => {
      console.error("Hubo un problema con la solicitud Fetch:", error);
    });
}

function save() {
  let nombre = document.getElementById("nombre").value;
  var data = { nombre, save: 1 };

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
        appendAlert("Se guardo la Categoria", "success");
        obtenerInformacion();
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
        ? ` <button type="button" class="btn btn-danger" onclick="updateEstado(${item.idcategorias},-1)" >Eliminar</button>`
        : "";
    string += `<tr>
        <th scope="row">${item.idcategorias}</th>
        <td>${item.nombre}</td>
        <td>
            <div class="${estado.class} text-secondary text-center p-1 border-opacity-10 rounded">
            ${estado.nombre}
            </div>
        </td>
        <td class="text-center" >
            <div class="btn-group" role="group" >
                <button type="button" class="btn btn-warning" 
                onclick="editData('${item.nombre}',${item.idcategorias}) " >Editar</button>
               ${btnDelete}
            </div>    
        </td>
    </tr>`;
  }
  document.getElementById("contenidoTabla").innerHTML = string;
}

function editData(nombre, id) {
  document.getElementById("Uid").value = id;
  document.getElementById("UNombre").value = nombre;
  myModal.show();
}
function update() {
  const id = document.getElementById("Uid").value;
  const nombre = document.getElementById("UNombre").value;
  let data = { id, nombre, update: 1 };

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
        appendAlert2("No se actualizo la categoria ", "warning");
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
        appendAlert2(
          "No se elimino la tarea ya que tiene productos habilitados",
          "danger"
        );
      }
    });
}

obtenerInformacion();

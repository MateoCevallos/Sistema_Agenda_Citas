let modalPerro; // instancia global del modal

const ruta = "../../controllers/perros.controllers.php?op=";
const rutaDuenos = "../../controllers/duenos.controllers.php?op=";

function init() {
  console.log("init perro.js");

  // crear instancia del modal de Bootstrap 5
  const modalEl = document.getElementById("ModalPerros");
  if (typeof bootstrap !== "undefined") {
    modalPerro = new bootstrap.Modal(modalEl);
  } else {
    console.error("Bootstrap no está definido en perro.js");
  }

  // click en "Nuevo Perro"
  $("#btnNuevoPerro").on("click", () => {
    console.log("click en Nuevo Perro");
    LimpiarCajas();
    cargarDuenos().then(() => {
      if (modalPerro) modalPerro.show();
    });
  });

  // submit del formulario
  $("#form_perro").on("submit", (e) => {
    GuardarEditar(e);
  });

  // cargar lista inicial
  CargaLista();
}

// ======================= LISTA =======================

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (perros) => {
    perros = JSON.parse(perros);

    $.each(perros, (index, p) => {
      // Si luego haces join con dueños puedes mostrar p.nombre_dueno
      html += `<tr>
        <td>${index + 1}</td>
        <td>${p.id_dueno}</td>
        <td>${p.nombre}</td>
        <td>${p.raza ? p.raza : ""}</td>
        <td>${p.fecha_nacimiento ? p.fecha_nacimiento : ""}</td>
        <td>${p.peso_kg ? p.peso_kg : ""}</td>
        <td>${p.notas ? p.notas : ""}</td>
        <td>
          <button class='btn btn-primary btn-sm' onclick='editar(${p.id})'>Editar</button>
          <button class='btn btn-warning btn-sm' onclick='eliminar(${p.id})'>Eliminar</button>
        </td>
      </tr>`;
    });

    $("#ListaPerros").html(html);
  });
};

// ======================= CARGAR DUEÑOS =======================

var cargarDuenos = () => {
  return new Promise((resolve, reject) => {
    let html = `<option value="">Seleccione un dueño</option>`;
    $.get(rutaDuenos + "todos", (data) => {
      let duenos = JSON.parse(data);
      $.each(duenos, (index, d) => {
        const nombreCompleto = `${d.nombre} ${d.apellido}`;
        html += `<option value="${d.id}">${nombreCompleto}</option>`;
      });
      $("#id_dueno").html(html);
      resolve();
    }).fail((err) => {
      console.error("Error cargando dueños", err);
      reject(err);
    });
  });
};

// ======================= GUARDAR / EDITAR =======================

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_perro")[0]);
  var accion = "";
  var id_perro = document.getElementById("id_perro").value;

  if (parseInt(id_perro) > 0) {
    accion = ruta + "actualizar";
    formData.append("id_perro", id_perro);
  } else {
    accion = ruta + "insertar";
  }

  $.ajax({
    url: accion,
    type: "post",
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log("respuesta guardar/editar perro:", respuesta);
      respuesta = JSON.parse(respuesta); // true/false o "ok"

      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
        if (modalPerro) modalPerro.hide();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

// ======================= EDITAR =======================

var editar = (id_perro) => {
  $.post(ruta + "uno", { id_perro: id_perro }, (perro) => {
    console.log("uno perro:", perro);
    perro = JSON.parse(perro);

    document.getElementById("id_perro").value = perro.id;
    document.getElementById("nombre").value = perro.nombre;
    document.getElementById("raza").value = perro.raza || "";
    document.getElementById("fecha_nacimiento").value =
      perro.fecha_nacimiento || "";
    document.getElementById("peso_kg").value = perro.peso_kg || "";
    document.getElementById("notas").value = perro.notas || "";

    // cargar dueños y seleccionar el actual
    cargarDuenos().then(() => {
      document.getElementById("id_dueno").value = perro.id_dueno;
      if (modalPerro) modalPerro.show();
    });
  });
};

// ======================= ELIMINAR =======================

var eliminar = (id_perro) => {
  Swal.fire({
    title: "Perros",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_perro: id_perro }, (resp) => {
        console.log("eliminar perro:", resp);
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Perros",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Perros",
            text: "No se pudo eliminar el registro",
            icon: "error",
          });
        }
      });
    }
  });
};

// ======================= LIMPIAR =======================

var LimpiarCajas = () => {
  document.getElementById("id_perro").value = "";
  document.getElementById("id_dueno").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("raza").value = "";
  document.getElementById("fecha_nacimiento").value = "";
  document.getElementById("peso_kg").value = "";
  document.getElementById("notas").value = "";
};

// Esperar a que el DOM esté listo
$(document).ready(function () {
  console.log("document ready perro, llamando init()");
  init();
});

let modalDueno; // instancia global del modal

const ruta = "../../controllers/duenos.controllers.php?op=";

function init() {
  console.log("init dueno.js");

  // crear instancia del modal de Bootstrap 5
  const modalEl = document.getElementById("ModalDuenos");
  if (typeof bootstrap !== "undefined") {
    modalDueno = new bootstrap.Modal(modalEl);
  } else {
    console.error("Bootstrap no está definido en dueno.js");
  }

  // click en "Nuevo Dueño"
  $("#btnNuevoDueno").on("click", () => {
    console.log("click en Nuevo Dueño");
    LimpiarCajas();
    if (modalDueno) modalDueno.show();
  });

  // submit del formulario
  $("#form_dueno").on("submit", (e) => {
    GuardarEditar(e);
  });

  // cargar lista inicial
  CargaLista();
}

// ======================= LISTA =======================

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (duenos) => {
    try {
      duenos = JSON.parse(duenos);
    } catch (e) {
      console.error("Error parseando lista de dueños:", e, duenos);
      return;
    }

    $.each(duenos, (index, d) => {
      html += `<tr>
        <td>${index + 1}</td>
        <td>${d.nombre || ""}</td>
        <td>${d.apellido || ""}</td>
        <td>${d.telefono || ""}</td>
        <td>${d.email || ""}</td>
        <td>${d.direccion || ""}</td>
        <td>
          <button class='btn btn-primary btn-sm' onclick='editar(${d.id})'>Editar</button>
          <button class='btn btn-warning btn-sm' onclick='eliminar(${d.id})'>Eliminar</button>
        </td>
      </tr>`;
    });

    $("#ListaDuenos").html(html);
  });
};

// ======================= GUARDAR / EDITAR =======================

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_dueno")[0]);
  var accion = "";
  var id = document.getElementById("id").value; // hidden del form

  if (parseInt(id) > 0) {
    accion = ruta + "actualizar";
    formData.append("id", id); // el controlador espera "id"
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
      console.log("respuesta guardar/editar dueño:", respuesta);

      try {
        respuesta = JSON.parse(respuesta); // true/false o "ok"
      } catch (e) {
        console.error("Error parseando respuesta guardar/editar:", e, respuesta);
        alert("Error inesperado en el servidor");
        return;
      }

      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
        if (modalDueno) modalDueno.hide();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

// ======================= EDITAR =======================

var editar = (id) => {
  // el backend espera "id"
  $.post(ruta + "uno", { id: id }, (dueno) => {
    console.log("uno dueno:", dueno);

    try {
      dueno = JSON.parse(dueno);
    } catch (e) {
      console.error("Error parseando dueño (uno):", e, dueno);
      alert("Error al obtener los datos del dueño");
      return;
    }

    if (dueno.error) {
      alert("Error al obtener el dueño: " + dueno.error);
      return;
    }

    if (!dueno || Object.keys(dueno).length === 0) {
      alert("No se encontró el dueño");
      return;
    }

    document.getElementById("id").value         = dueno.id;
    document.getElementById("nombre").value     = dueno.nombre   || "";
    document.getElementById("apellido").value   = dueno.apellido || "";
    document.getElementById("telefono").value   = dueno.telefono || "";
    document.getElementById("email").value      = dueno.email    || "";
    document.getElementById("direccion").value  = dueno.direccion|| "";

    if (modalDueno) modalDueno.show();
  });
};

// ======================= ELIMINAR =======================

var eliminar = (id) => {
  Swal.fire({
    title: "Dueños",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      // el backend espera "id"
      $.post(ruta + "eliminar", { id: id }, (resp) => {
        console.log("eliminar dueno:", resp);

        try {
          resp = JSON.parse(resp);
        } catch (e) {
          console.error("Error parseando respuesta eliminar:", e, resp);
          Swal.fire({
            title: "Dueños",
            text: "Error inesperado al eliminar",
            icon: "error",
          });
          return;
        }

        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Dueños",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Dueños",
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
  document.getElementById("id").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("apellido").value = "";
  document.getElementById("telefono").value = "";
  document.getElementById("email").value = "";
  document.getElementById("direccion").value = "";
};

// Esperar a que el DOM esté listo
$(document).ready(function () {
  console.log("document ready dueno, llamando init()");
  init();
});

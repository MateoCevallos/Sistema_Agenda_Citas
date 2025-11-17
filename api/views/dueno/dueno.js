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
    duenos = JSON.parse(duenos);

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
  var id = document.getElementById("id_dueno").value; // leemos el hidden

  if (parseInt(id) > 0) {
    accion = ruta + "actualizar";
    // el controlador espera "id", no "id_dueno"
    formData.append("id", id);
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
      respuesta = JSON.parse(respuesta); // true/false o "ok"

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
  // el controlador 'uno' espera "id"
  $.post(ruta + "uno", { id: id }, (dueno) => {
    console.log("uno dueno:", dueno);
    dueno = JSON.parse(dueno);

    document.getElementById("id_dueno").value   = dueno.id;
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
      // el controlador 'eliminar' también espera "id"
      $.post(ruta + "eliminar", { id: id }, (resp) => {
        console.log("eliminar dueno:", resp);
        resp = JSON.parse(resp);
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

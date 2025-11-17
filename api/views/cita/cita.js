let modalCita; // instancia global del modal

const ruta = "../../controllers/citas.controllers.php?op=";
const rutaPerros = "../../controllers/perros.controllers.php?op=";

function init() {
  console.log("init cita.js");

  // crear instancia del modal de Bootstrap 5
  const modalEl = document.getElementById("ModalCitas");
  if (typeof bootstrap !== "undefined") {
    modalCita = new bootstrap.Modal(modalEl);
  } else {
    console.error("Bootstrap no está definido en cita.js");
  }

  // click en "Nueva Cita"
  $("#btnNuevaCita").on("click", () => {
    console.log("click en Nueva Cita");
    LimpiarCajas();
    cargarPerros().then(() => {
      // por defecto estado pendiente
      $("#estado").val("pendiente");
      if (modalCita) modalCita.show();
    });
  });

  // submit del formulario
  $("#form_cita").on("submit", (e) => {
    GuardarEditar(e);
  });

  // cargar lista inicial
  CargaLista();
}

// ======================= LISTA =======================

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (citas) => {
    citas = JSON.parse(citas);

    $.each(citas, (index, cit) => {
      // Si luego haces join con perros, puedes mostrar cit.nombre_perro
      html += `<tr>
        <td>${index + 1}</td>
        <td>${cit.id_perro}</td>
        <td>${cit.fecha_hora}</td>
        <td>${cit.servicio}</td>
        <td>${cit.estado}</td>
        <td>${cit.notas ? cit.notas : ""}</td>
        <td>
          <button class='btn btn-primary btn-sm' onclick='editar(${cit.id})'>Editar</button>
          <button class='btn btn-warning btn-sm' onclick='eliminar(${cit.id})'>Eliminar</button>
        </td>
      </tr>`;
    });

    $("#ListaCitas").html(html);
  });
};

// ======================= CARGAR PERROS =======================

var cargarPerros = () => {
  return new Promise((resolve, reject) => {
    let html = `<option value="">Seleccione un perro</option>`;
    $.get(rutaPerros + "todos", (data) => {
      let perros = JSON.parse(data);
      $.each(perros, (index, perro) => {
        html += `<option value="${perro.id}">${perro.nombre}</option>`;
      });
      $("#id_perro").html(html);
      resolve();
    }).fail((err) => {
      console.error("Error cargando perros", err);
      reject(err);
    });
  });
};

// ======================= GUARDAR / EDITAR =======================

// convierte "YYYY-MM-DDTHH:MM" -> "YYYY-MM-DD HH:MM:SS"
var formatearFechaHoraBD = (fechaInput) => {
  if (!fechaInput) return "";
  return fechaInput.replace("T", " ") + ":00";
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_cita")[0]);
  var accion = "";
  var id_cita = document.getElementById("id_cita").value;

  // ajustar formato fecha_hora antes de enviar
  var fechaInput = $("#fecha_hora").val();
  var fechaBD = formatearFechaHoraBD(fechaInput);
  formData.set("fecha_hora", fechaBD);

  if (parseInt(id_cita) > 0) {
    accion = ruta + "actualizar";
    formData.append("id_cita", id_cita);
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
      console.log("respuesta guardar/editar cita:", respuesta);
      respuesta = JSON.parse(respuesta); // true/false o "ok"

      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
        if (modalCita) modalCita.hide();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

// ======================= EDITAR =======================

// convierte "YYYY-MM-DD HH:MM:SS" -> "YYYY-MM-DDTHH:MM"
var formatearFechaHoraInput = (fechaBD) => {
  if (!fechaBD) return "";
  return fechaBD.replace(" ", "T").slice(0, 16);
};

var editar = (id_cita) => {
  $.post(ruta + "uno", { id_cita: id_cita }, (cita) => {
    console.log("uno cita:", cita);
    cita = JSON.parse(cita);

    document.getElementById("id_cita").value = cita.id;
    document.getElementById("servicio").value = cita.servicio;
    document.getElementById("estado").value = cita.estado;
    document.getElementById("notas").value = cita.notas || "";

    // fecha_hora para el input datetime-local
    document.getElementById("fecha_hora").value = formatearFechaHoraInput(
      cita.fecha_hora
    );

    // cargar perros y seleccionar el actual
    cargarPerros().then(() => {
      document.getElementById("id_perro").value = cita.id_perro;
      if (modalCita) modalCita.show();
    });
  });
};

// ======================= ELIMINAR =======================

var eliminar = (id_cita) => {
  Swal.fire({
    title: "Citas",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_cita: id_cita }, (resp) => {
        console.log("eliminar cita:", resp);
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Citas",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Citas",
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
  document.getElementById("id_cita").value = "";
  document.getElementById("id_perro").value = "";
  document.getElementById("fecha_hora").value = "";
  document.getElementById("servicio").value = "";
  document.getElementById("estado").value = "pendiente";
  document.getElementById("notas").value = "";
};

// Esperar a que el DOM esté listo
$(document).ready(function () {
  console.log("document ready cita, llamando init()");
  init();
});

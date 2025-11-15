let modalActividad; // instancia global del modal

function init() {
  console.log("init actividad.js");

  // crear instancia del modal de Bootstrap 5
  const modalEl = document.getElementById("ModalActividades");
  if (typeof bootstrap !== "undefined") {
    modalActividad = new bootstrap.Modal(modalEl);
  } else {
    console.error("Bootstrap no está definido en actividad.js");
  }

  // click en "Nueva Actividad"
  $("#btnNuevaActividad").on("click", () => {
    console.log("click en Nueva Actividad");
    LimpiarCajas();
    cargarOrganizadores().then(() => {
      if (modalActividad) modalActividad.show();
    });
  });

  // submit del formulario
  $("#form_actividad").on("submit", (e) => {
    GuardarEditar(e);
  });

  // cargar lista inicial
  CargaLista();
}

const ruta = "../../controllers/actividades.controllers.php?op=";
const rutaOrganizadores = "../../controllers/organizadores.controllers.php?op=";

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (actividades) => {
    actividades = JSON.parse(actividades);
    $.each(actividades, (index, act) => {
      // si tu consulta trae nombre del organizador, cambia act.id_organizador por act.nombre_organizador
      html += `<tr>
        <td>${index + 1}</td>
        <td>${act.nombre_actividad}</td>
        <td>${act.tipo_actividad}</td>
        <td>${act.fecha_actividad}</td>
        <td>${act.id_organizador}</td>
        <td>
          <button class='btn btn-primary' onclick='editar(${act.id_actividad})'>Editar</button>
          <button class='btn btn-warning' onclick='eliminar(${act.id_actividad})'>Eliminar</button>
        </td>
      </tr>`;
    });
    $("#ListaActividades").html(html);
  });
};

var cargarOrganizadores = () => {
  return new Promise((resolve, reject) => {
    let html = `<option value="">Seleccione un organizador</option>`;
    $.get(rutaOrganizadores + "todos", (data) => {
      let organizadores = JSON.parse(data);
      $.each(organizadores, (index, org) => {
        html += `<option value="${org.id_organizador}">${org.nombre}</option>`;
      });
      $("#id_organizador").html(html);
      resolve();
    }).fail((err) => {
      console.error("Error cargando organizadores", err);
      reject(err);
    });
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_actividad")[0]);
  var accion = "";
  var id_actividad = document.getElementById("id_actividad").value;

  if (parseInt(id_actividad) > 0) {
    accion = ruta + "actualizar";
    formData.append("id_actividad", id_actividad);
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
      console.log("respuesta guardar/editar actividad:", respuesta);
      respuesta = JSON.parse(respuesta); // true/false o "ok"

      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
        if (modalActividad) modalActividad.hide();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

var editar = (id_actividad) => {
  $.post(ruta + "uno", { id_actividad: id_actividad }, (actividad) => {
    console.log("uno actividad:", actividad);
    actividad = JSON.parse(actividad);

    document.getElementById("id_actividad").value = actividad.id_actividad;
    document.getElementById("nombre_actividad").value = actividad.nombre_actividad;
    document.getElementById("tipo_actividad").value = actividad.tipo_actividad;
    document.getElementById("fecha_actividad").value = actividad.fecha_actividad;

    // cargar organizadores y seleccionar el actual
    cargarOrganizadores().then(() => {
      document.getElementById("id_organizador").value = actividad.id_organizador;
      if (modalActividad) modalActividad.show();
    });
  });
};

var eliminar = (id_actividad) => {
  Swal.fire({
    title: "Actividades",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_actividad: id_actividad }, (resp) => {
        console.log("eliminar actividad:", resp);
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Actividades",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Actividades",
            text: "No se pudo eliminar el registro",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id_actividad").value = "";
  document.getElementById("nombre_actividad").value = "";
  document.getElementById("tipo_actividad").value = "";
  document.getElementById("fecha_actividad").value = "";
  document.getElementById("id_organizador").value = "";
};

// Esperar a que el DOM esté listo
$(document).ready(function () {
  console.log("document ready actividad, llamando init()");
  init();
});
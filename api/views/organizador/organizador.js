let modalOrganizador; // instancia global del modal

function init() {
  // Crear instancia del modal de Bootstrap 5
  const modalEl = document.getElementById("ModalOrganizadores");
  modalOrganizador = new bootstrap.Modal(modalEl);

  // Click en "Nuevo Organizador"
  $("#btnNuevoOrganizador").on("click", () => {
    LimpiarCajas();
    modalOrganizador.show();
  });

  // Envío del formulario
  $("#form_organizador").on("submit", (e) => {
    GuardarEditar(e);
  });

  // Cargar la lista al entrar
  CargaLista();
}

// ruta al controlador
const ruta = "../../controllers/organizadores.controllers.php?op=";

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (organizadores) => {
    organizadores = JSON.parse(organizadores);
    $.each(organizadores, (index, org) => {
      html += `<tr>
        <td>${index + 1}</td>
        <td>${org.nombre}</td>
        <td>${org.correo}</td>
        <td>${org.telefono}</td>
        <td>
          <button class='btn btn-primary' onclick='editar(${org.id_organizador})'>Editar</button>
          <button class='btn btn-warning' onclick='eliminar(${org.id_organizador})'>Eliminar</button>
        </td>
      </tr>`;
    });
    $("#ListaOrganizadores").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_organizador")[0]);
  var accion = "";
  var id_organizador = document.getElementById("id_organizador").value;

  if (parseInt(id_organizador) > 0) {
    accion = ruta + "actualizar";
    formData.append("id_organizador", id_organizador);
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
      console.log(respuesta);
      respuesta = JSON.parse(respuesta); // true / false desde PHP

      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
        modalOrganizador.hide();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

// abrir modal en modo edición
var editar = (id_organizador) => {
  $.post(ruta + "uno", { id_organizador: id_organizador }, (organizador) => {
    console.log(organizador);
    organizador = JSON.parse(organizador);

    document.getElementById("id_organizador").value = organizador.id_organizador;
    document.getElementById("nombre").value = organizador.nombre;
    document.getElementById("correo").value = organizador.correo;
    document.getElementById("telefono").value = organizador.telefono;

    modalOrganizador.show();
  });
};

var eliminar = (id_organizador) => {
  Swal.fire({
    title: "Organizadores",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_organizador: id_organizador }, (resp) => {
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Organizadores",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Organizadores",
            text: "No se pudo eliminar el registro",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id_organizador").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("correo").value = "";
  document.getElementById("telefono").value = "";
};

init();

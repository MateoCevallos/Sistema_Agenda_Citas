function init() {
  $("#form_participante").on("submit", (e) => {
    GuardarEditar(e);
  });

  CargaLista();
}

// ruta desde api/views/participante/ hacia api/controllers/
const ruta = "../../controllers/participantes.controllers.php?op=";

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (participantes) => {
    participantes = JSON.parse(participantes);
    $.each(participantes, (index, p) => {
      html += `<tr>
        <td>${index + 1}</td>
        <td>${p.nombre}</td>
        <td>${p.correo}</td>
        <td>${p.telefono}</td>
        <td>
          <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalParticipantes" onclick='uno(${p.id_participante})'>Editar</button>
          <button class='btn btn-warning' onclick='eliminar(${p.id_participante})'>Eliminar</button>
        </td>
      </tr>`;
    });
    $("#ListaParticipantes").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_participante")[0]);
  var accion = "";
  var id_participante = document.getElementById("id_participante").value;

  if (parseInt(id_participante) > 0) {
    accion = ruta + "actualizar";
    formData.append("id_participante", id_participante);
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
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok" || respuesta === true) {
        alert("Se guardó con éxito");
        CargaLista();
        LimpiarCajas();
      } else {
        alert("Ocurrió un error al guardar");
      }
    },
  });
};

var uno = (id_participante) => {
  $.post(ruta + "uno", { id_participante: id_participante }, (participante) => {
    console.log(participante);
    participante = JSON.parse(participante);
    document.getElementById("id_participante").value = participante.id_participante;
    document.getElementById("nombre").value = participante.nombre;
    document.getElementById("correo").value = participante.correo;
    document.getElementById("telefono").value = participante.telefono;
  });
};

var eliminar = (id_participante) => {
  Swal.fire({
    title: "Participantes",
    text: "¿Está seguro que desea eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_participante: id_participante }, (resp) => {
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Participantes",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Participantes",
            text: "No se pudo eliminar el registro",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id_participante").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("correo").value = "";
  document.getElementById("telefono").value = "";

  $("#ModalParticipantes").modal("hide");
};

init();

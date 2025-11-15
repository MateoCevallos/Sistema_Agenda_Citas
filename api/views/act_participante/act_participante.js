function init() {
  $("#form_act_participante").on("submit", (e) => {
    GuardarEditar(e);
  });

  CargaLista();
}

// desde api/views/act_participante/ hacia api/controllers/
const ruta = "../../controllers/acts_participantes.controllers.php?op=";

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (relaciones) => {
    relaciones = JSON.parse(relaciones);
    $.each(relaciones, (index, rel) => {
      html += `<tr>
        <td>${index + 1}</td>
        <td>${rel.id_actividad}</td>
        <td>${rel.id_participante}</td>
        <td>
          <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalActParticipantes" onclick='uno(${rel.id})'>Editar</button>
          <button class='btn btn-warning' onclick='eliminar(${rel.id})'>Eliminar</button>
        </td>
      </tr>`;
    });
    $("#ListaActParticipantes").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#form_act_participante")[0]);
  var accion = "";
  var id = document.getElementById("id").value;

  if (parseInt(id) > 0) {
    accion = ruta + "actualizar";
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

var uno = async (id) => {
  await actividades();
  await participantes();

  $.post(ruta + "uno", { id: id }, (rel) => {
    console.log(rel);
    rel = JSON.parse(rel);

    document.getElementById("id").value = rel.id;
    document.getElementById("id_actividad").value = rel.id_actividad;
    document.getElementById("id_participante").value = rel.id_participante;
  });
};

// llena el select de actividades
var actividades = () => {
  return new Promise((resolve, reject) => {
    var html = `<option value="0">Seleccione una actividad</option>`;
    $.get(
      "../../controllers/actividades.controllers.php?op=todos",
      (lista) => {
        lista = JSON.parse(lista);
        $.each(lista, (index, act) => {
          html += `<option value="${act.id_actividad}">${act.nombre_actividad}</option>`;
        });
        $("#id_actividad").html(html);
        resolve();
      }
    ).fail((error) => {
      reject(error);
    });
  });
};

// llena el select de participantes
var participantes = () => {
  return new Promise((resolve, reject) => {
    var html = `<option value="0">Seleccione un participante</option>`;
    $.get(
      "../../controllers/participantes.controllers.php?op=todos",
      (lista) => {
        lista = JSON.parse(lista);
        $.each(lista, (index, p) => {
          html += `<option value="${p.id_participante}">${p.nombre}</option>`;
        });
        $("#id_participante").html(html);
        resolve();
      }
    ).fail((error) => {
      reject(error);
    });
  });
};

var eliminar = (id) => {
  Swal.fire({
    title: "Actividades - Participantes",
    text: "¿Está seguro que desea eliminar la relación?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id: id }, (resp) => {
        resp = JSON.parse(resp);
        if (resp == "ok" || resp === true) {
          Swal.fire({
            title: "Actividades - Participantes",
            text: "Se eliminó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Actividades - Participantes",
            text: "No se pudo eliminar el registro",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id").value = "";
  $("#id_actividad").val("0");
  $("#id_participante").val("0");

  $("#ModalActParticipantes").modal("hide");
};

init();

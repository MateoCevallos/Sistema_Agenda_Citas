<?php 
require_once('../html/head2.php');
// require_once('../../config/sesiones.php');
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Cultural /</span> Actividades
</h4>

<!-- Tabla de Actividades -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        id="btnNuevaActividad">
        Nueva Actividad
    </button>

    <h5 class="card-header">Lista de Actividades</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Actividad</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Organizador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaActividades">
                <!-- Se llena con actividad.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Actividades -->
<div class="modal" tabindex="-1" id="ModalActividades">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_actividad" method="post">
                <input type="hidden" name="id_actividad" id="id_actividad">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="nombre_actividad">Nombre de la Actividad</label>
                        <input type="text" name="nombre_actividad" id="nombre_actividad" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="tipo_actividad">Tipo de Actividad</label>
                        <input type="text" name="tipo_actividad" id="tipo_actividad" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="fecha_actividad">Fecha</label>
                        <input type="date" name="fecha_actividad" id="fecha_actividad" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="id_organizador">Organizador</label>
                        <select name="id_organizador" id="id_organizador" class="form-control" required>
                            <option value="">Seleccione un organizador</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/scripts2.php'); ?>

<script src="./actividad.js"></script>

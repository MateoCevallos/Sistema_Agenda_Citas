<?php 
require_once('../html/head2.php');
//require_once('../../config/sesiones.php');  
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Cultural /</span> Actividad - Participante
</h4>

<!-- Tabla Actividad-Participante -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        onclick="LimpiarCajas(); actividades(); participantes();" 
        data-bs-toggle="modal" 
        data-bs-target="#ModalActParticipantes">
        Nueva relación
    </button>

    <h5 class="card-header">Relaciones entre actividades y participantes</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID Actividad</th>
                    <th>ID Participante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaActParticipantes">
                <!-- Se llena con act_participante.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Actividad-Participante -->
<div class="modal" tabindex="-1" id="ModalActParticipantes">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Actividad - Participante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_act_participante" method="post">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="id_actividad">Actividad</label>
                        <select name="id_actividad" id="id_actividad" class="form-control">
                            <option value="0">Seleccione una actividad</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id_participante">Participante</label>
                        <select name="id_participante" id="id_participante" class="form-control">
                            <option value="0">Seleccione un participante</option>
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

<script src="./act_participante.js"></script>

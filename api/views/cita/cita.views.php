<?php 
require_once('../html/head2.php');
// require_once('../../config/sesiones.php');
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Peluquería /</span> Citas
</h4>

<!-- Tabla de Citas -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        id="btnNuevaCita">
        Nueva Cita
    </button>

    <h5 class="card-header">Lista de Citas</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Perro</th>
                    <th>Fecha y Hora</th>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaCitas">
                <!-- Se llena con cita.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Citas -->
<div class="modal" tabindex="-1" id="ModalCitas">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_cita" method="post">
                <input type="hidden" name="id_cita" id="id_cita">
                <div class="modal-body">
                    
                    <div class="form-group mb-2">
                        <label for="id_perro">Perro</label>
                        <select name="id_perro" id="id_perro" class="form-control" required>
                            <option value="">Seleccione un perro</option>
                            <!-- Se llena con cita.js (desde perros) -->
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="fecha_hora">Fecha y Hora</label>
                        <input 
                            type="datetime-local" 
                            name="fecha_hora" 
                            id="fecha_hora" 
                            class="form-control" 
                            required
                        >
                        <!-- En cita.js puedes convertir de 'YYYY-MM-DDTHH:MM' a 'YYYY-MM-DD HH:MM:SS' antes de enviar -->
                    </div>

                    <div class="form-group mb-2">
                        <label for="servicio">Servicio</label>
                        <input 
                            type="text" 
                            name="servicio" 
                            id="servicio" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="notas">Notas</label>
                        <textarea 
                            name="notas" 
                            id="notas" 
                            class="form-control" 
                            rows="3"
                        ></textarea>
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

<script src="./cita.js"></script>

<?php 
require_once('../html/head2.php');
//require_once('../../config/sesiones.php');  
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Cultural /</span> Participantes
</h4>

<!-- Tabla de Participantes -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        onclick="LimpiarCajas()" 
        data-bs-toggle="modal" 
        data-bs-target="#ModalParticipantes">
        Nuevo Participante
    </button>

    <h5 class="card-header">Lista de Participantes</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaParticipantes">
                <!-- Se llena con participante.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Participantes -->
<div class="modal" tabindex="-1" id="ModalParticipantes">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Participante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_participante" method="post">
                <input type="hidden" name="id_participante" id="id_participante">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del participante" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono de contacto" required>
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

<script src="./participante.js"></script>

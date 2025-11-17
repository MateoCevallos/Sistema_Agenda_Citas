<?php 
require_once('../html/head2.php');
// require_once('../../config/sesiones.php');
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Peluquería /</span> Dueños
</h4>

<!-- Tabla de Dueños -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        id="btnNuevoDueno">
        Nuevo Dueño
    </button>

    <h5 class="card-header">Lista de Dueños</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaDuenos">
                <!-- Se llena con dueno.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Dueños -->
<div class="modal" tabindex="-1" id="ModalDuenos">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Dueño</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_dueno" method="post">
                <input type="hidden" name="id_dueno" id="id_dueno">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="nombre">Nombre</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            id="nombre" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="apellido">Apellido</label>
                        <input 
                            type="text" 
                            name="apellido" 
                            id="apellido" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="telefono">Teléfono</label>
                        <input 
                            type="text" 
                            name="telefono" 
                            id="telefono" 
                            class="form-control"
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control"
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="direccion">Dirección</label>
                        <input 
                            type="text" 
                            name="direccion" 
                            id="direccion" 
                            class="form-control"
                        >
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

<script src="./dueno.js"></script>

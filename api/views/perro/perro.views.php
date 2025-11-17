<?php 
require_once('../html/head2.php');
// require_once('../../config/sesiones.php');
?>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistema Peluquería /</span> Perros
</h4>

<!-- Tabla de Perros -->
<div class="card">
    <button 
        type="button" 
        class="btn btn-outline-secondary" 
        id="btnNuevoPerro">
        Nuevo Perro
    </button>

    <h5 class="card-header">Lista de Perros</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dueño</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Fecha Nacimiento</th>
                    <th>Peso (kg)</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaPerros">
                <!-- Se llena con perro.js -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Perros -->
<div class="modal" tabindex="-1" id="ModalPerros">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Perro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_perro" method="post">
                <input type="hidden" name="id_perro" id="id_perro">
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label for="id_dueno">Dueño</label>
                        <select name="id_dueno" id="id_dueno" class="form-control" required>
                            <option value="">Seleccione un dueño</option>
                            <!-- Se llena con perro.js (desde duenos.controllers.php) -->
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nombre">Nombre del Perro</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            id="nombre" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="raza">Raza</label>
                        <input 
                            type="text" 
                            name="raza" 
                            id="raza" 
                            class="form-control"
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input 
                            type="date" 
                            name="fecha_nacimiento" 
                            id="fecha_nacimiento" 
                            class="form-control"
                        >
                    </div>

                    <div class="form-group mb-2">
                        <label for="peso_kg">Peso (kg)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="peso_kg" 
                            id="peso_kg" 
                            class="form-control"
                        >
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

<script src="./perro.js"></script>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update-departamento-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="departamento_id" value="">

                    <!-- Nombre del Departamento -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>

                    <!-- Alerts -->
                    <div class="alert alert-danger" style="display: none;"></div>
                    <div class="alert alert-success" id="success-message" style="display: none;"></div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Actualizar Departamento</button>
                </form>
            </div>
        </div>
    </div>
</div>

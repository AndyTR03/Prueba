<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="update-alerta-form" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="alerta_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <input type="text" class="form-control" name="mensaje" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_creacion">Fecha de Creación</label>
                        <input type="date" class="form-control" name="fecha_creacion" required>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div class="alert alert-success" id="success-message" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Alerta</button>
                </div>
            </form>
        </div>
    </div>
</div>

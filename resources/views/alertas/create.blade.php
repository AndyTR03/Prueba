<!-- Modal para crear alerta -->
<div class="modal fade" id="crearAlertaModal" tabindex="-1" role="dialog" aria-labelledby="crearAlertaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearAlertaModalLabel">Crear Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="create-alerta-form" action="{{ route('alertas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mensaje">Mensaje de la Alerta</label>
                        <input type="text" class="form-control" name="mensaje" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_creacion">Fecha de Creación</label>
                        <input type="date" class="form-control" name="fecha_creacion" required>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Alerta</button>
                </div>
            </form>
        </div>
    </div>
</div>

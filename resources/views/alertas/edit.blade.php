<!-- Modal para Editar Alerta -->
<div class="modal fade" id="editModalAlerta" tabindex="-1" role="dialog" aria-labelledby="editModalAlertaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalAlertaLabel">Editar Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update-alert-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="alerta_id" class="alerta_id">
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <input type="text" name="mensaje" class="form-control mensaje" required>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div id="success-message" class="alert alert-success" style="display:none;"></div>
                    <button type="submit" class="btn btn-primary">Actualizar Alerta</button>
                </form>
            </div>
        </div>
    </div>
</div>

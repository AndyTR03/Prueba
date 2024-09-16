<!-- Modal para crear departamento -->
<div class="modal fade" id="crearDepartamentoModal" tabindex="-1" role="dialog" aria-labelledby="crearDepartamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearDepartamentoModalLabel">Crear Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="create-departamento-form" action="{{ route('departamentos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre del Departamento</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Departamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

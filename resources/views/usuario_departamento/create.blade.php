<!-- Modal para crear usuario_departamento -->
<div class="modal fade" id="crearUsuarioDepartamentoModal" tabindex="-1" role="dialog" aria-labelledby="crearUsuarioDepartamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioDepartamentoModalLabel">Crear Usuario por Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="create-usuario-departamento-form" action="{{ route('usuarios_departamento.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario_id">Usuario</label>
                        <select name="usuario_id" id="usuario_id" class="form-control" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="form-control" required>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Alertas de error para mensajes de validación -->
                    <div class="alert alert-danger" style="display: none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Usuario por Departamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

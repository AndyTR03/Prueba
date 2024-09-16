<!-- Modal para editar UsuarioDepartamento -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="update-usuario-departamento-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Usuario por Departamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario_id">Usuario</label>
                        <select name="usuario_id" class="form-control" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == $usuarioDepartamento->usuario_id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }} {{ $usuario->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" class="form-control" required>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}" {{ $departamento->id == $usuarioDepartamento->departamento_id ? 'selected' : '' }}>
                                    {{ $departamento->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

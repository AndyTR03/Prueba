<!-- Modal para crear login -->
<div class="modal fade" id="crearLoginModal" tabindex="-1" role="dialog" aria-labelledby="crearLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearLoginModalLabel">Crear Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="create-login-form" action="{{ route('logins.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario_id">ID de Usuario</label>
                        <input type="number" class="form-control" name="usuario_id" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

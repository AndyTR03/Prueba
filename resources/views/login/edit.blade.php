<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update-login-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="login_id" value="">

                    <!-- Usuario ID -->
                    <div class="form-group">
                        <label for="usuario_id">ID de Usuario</label>
                        <input type="number" class="form-control" name="usuario_id" required>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <!-- Alerts -->
                    <div class="alert alert-danger" style="display: none;"></div>
                    <div class="alert alert-success" id="success-message" style="display: none;"></div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Actualizar Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

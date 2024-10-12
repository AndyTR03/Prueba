<!-- Modal para crear usuario -->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="create-user-form" action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group">
                            <select name="codigo_pais" id="codigo_pais" class="form-control" required style="width: 120px;">
                                <option value="" disabled selected>Cod. País</option>
                                <option value="54">Argentina (+54)</option>
                                <option value="55">Brasil (+55)</option>
                                <option value="56">Chile (+56)</option>
                                <option value="57">Colombia (+57)</option>
                                <option value="506">Costa Rica (+506)</option>
                                <option value="52">México (+52)</option>
                                <option value="598">Uruguay (+598)</option>
                                <option value="58">Venezuela (+58)</option>
                                <option value="51">Perú (+51)</option>
                                <option value="53">Cuba (+53)</option>
                                <option value="591">Bolivia (+591)</option>
                                <option value="502">Guatemala (+502)</option>
                                <option value="503">El Salvador (+503)</option>
                                <option value="504">Honduras (+504)</option>
                                <option value="505">Nicaragua (+505)</option>
                                <option value="593">Ecuador (+593)</option>
                                <option value="595">Paraguay (+595)</option>
                                <option value="1">República Dominicana (+1)</option>
                            </select>
                            <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Número de teléfono" required>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Crear Alerta -->
<div class="modal fade" id="crearAlertaModal" tabindex="-1" role="dialog" aria-labelledby="crearAlertaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearAlertaModalLabel">Crear Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="create-alert-form" action="{{ route('alertas.store') }}" method="POST" enctype="multipart/form-data"> <!-- Agregamos enctype -->
                    @csrf
                    <div class="form-group">
                        <label for="mensaje">Mensaje <span class="text-danger">*</span></label>
                        <input type="text" name="mensaje" class="form-control" placeholder="Escribe el mensaje aquí..." required>
                    </div>
                    
                    <div class="form-group">
                        <label for="destinatario_tipo">Tipo de Destinatario <span class="text-danger">*</span></label>
                        <select name="destinatario_tipo" class="form-control" required>
                            <option value="" disabled selected>Selecciona un tipo</option>
                            <option value="usuario">Usuario</option>
                            <option value="departamento">Departamento</option>
                        </select>
                    </div>
                    
                    <!-- Contenedor para la selección de usuarios -->
                    <div class="form-group" id="usuariosContainer" style="display:none;">
                        <label for="usuarios">Selecciona Usuarios</label>
                        <div id="usuariosSelect" class="checkbox-list">
                            @foreach($usuarios as $usuario)
                                <div class="form-check" onclick="toggleCheckbox(this)">
                                    <input class="form-check-input" type="checkbox" value="{{ $usuario->id }}" name="usuarios[]" style="display: none;">
                                    <label class="form-check-label">{{ $usuario->nombre }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Contenedor para la selección de departamentos -->
                    <div class="form-group" id="departamentosContainer" style="display:none;">
                        <label for="departamentos">Selecciona Departamentos</label>
                        <div id="departamentosSelect" class="checkbox-list">
                            @foreach($departamentos as $departamento)
                                <div class="form-check" onclick="toggleCheckbox(this)">
                                    <input class="form-check-input" type="checkbox" value="{{ $departamento->id }}" name="departamentos[]" style="display: none;">
                                    <label class="form-check-label">{{ $departamento->nombre }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Campo para seleccionar la fecha de envío -->
                    <div class="form-group">
                        <label for="fecha_creacion">Fecha de Envío</label>
                        <input type="datetime-local" name="fecha_creacion" class="form-control" id="fecha_creacion">
                        <small class="form-text text-muted">Deja este campo en blanco para enviar el mensaje ahora.</small>
                    </div>
                    
                    <!-- Campo para cargar archivos -->
                    <div class="form-group">
                        <label for="archivo">Cargar Archivo</label>
                        <input type="file" name="archivo" class="form-control" id="archivo">
                        <small class="form-text text-muted">Selecciona un archivo PDF para adjuntar.</small>
                    </div>
                    
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div id="success-message" class="alert alert-success" style="display:none;"></div>
                    <button type="submit" class="btn btn-primary">Crear Alerta</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Muestra el contenedor de usuarios o departamentos basado en el tipo seleccionado
        $('select[name="destinatario_tipo"]').change(function() {
            const tipoSeleccionado = $(this).val();
            if (tipoSeleccionado === 'usuario') {
                $('#usuariosContainer').show();
                $('#departamentosContainer').hide();
            } else if (tipoSeleccionado === 'departamento') {
                $('#departamentosContainer').show();
                $('#usuariosContainer').hide();
            } else {
                $('#usuariosContainer, #departamentosContainer').hide();
            }
        });

        // Opcional: Establecer la fecha y hora actual como valor predeterminado
        const now = new Date();
        const timezoneOffset = now.getTimezoneOffset() * 60000;
        const localISOTime = (new Date(now - timezoneOffset)).toISOString().slice(0, -1);
        $('#fecha_creacion').val(localISOTime.substring(0, 16)); // Formato YYYY-MM-DDTHH:MM para datetime-local
    });

    // Función para alternar la selección de checkboxes
    function toggleCheckbox(element) {
        const checkbox = element.querySelector('.form-check-input');
        checkbox.checked = !checkbox.checked; // Alterna el estado de la casilla
        element.classList.toggle('selected', checkbox.checked); // Agrega o quita la clase 'selected'
    }
</script>

<!-- CSS -->
<style>
    /* Mejoras para los checkboxes */
    .checkbox-list {
        max-height: 200px; /* Limitar la altura */
        overflow-y: auto;  /* Habilitar scroll */
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 10px;
    }

    .form-check {
        margin-bottom: 10px;
        cursor: pointer; /* Cambia el cursor al pasar sobre la fila */
    }

    /* Ocultar el checkbox pero mantener su funcionalidad */
    .form-check-input {
        display: none; /* Ocultar el checkbox */
    }

    /* Cambiar el color de toda la línea al seleccionar */
    .form-check.selected {
        background-color: #e7f1ff; /* Color de fondo cuando está seleccionado */
        color: #007bff; /* Color del texto cuando está seleccionado */
    }

    /* Hacer que la etiqueta cambie el color */
    .form-check-label {
        display: block; /* Asegúrate de que la etiqueta cubra toda la línea */
        padding: 10px; /* Espaciado interno para un mejor diseño */
    }

    /* Opcional: Cambiar el color de la etiqueta al hacer hover */
    .form-check:hover {
        background-color: #f1f1f1; /* Color de fondo al pasar el mouse */
    }
</style>

$(document).ready(function() {
    function showErrorMessages(errors, modalId) {
        let errorList = '';
        $.each(errors, function(key, value) {
            errorList += '<li>' + value[0] + '</li>';
        });
        $('#' + modalId + ' .alert-danger').html('<ul>' + errorList + '</ul>').show();
    }

    // Evento para cerrar el modal
    $(document).on('click', '.close', function() {
        $(this).closest('.modal').modal('hide');
    });

    // Evento para manejar el formulario de creación de alerta
    $('.create-alert-form').on('submit', function(e) {
        e.preventDefault();

        // Crear un FormData para manejar tanto archivos como datos de texto
        let form = $(this)[0]; // Obtener el formulario como un elemento DOM
        let formData = new FormData(form); // Crear un FormData con el formulario completo

        let actionUrl = $(this).attr('action');
        let modalId = $(this).closest('.modal').attr('id');

        // Limpia y oculta mensajes de error y éxito
        $('#' + modalId + ' .alert-danger').hide();
        $('#success-message').hide();

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            processData: false, // Impedir que jQuery procese los datos
            contentType: false, // Impedir que jQuery establezca el tipo de contenido (dejar que el navegador lo haga)
            success: function(response) {
                $('#' + modalId).modal('hide');

                // Actualizar la tabla con los nuevos datos
                updateAlertTable(response); // Actualiza la tabla

                // Verificar si la respuesta tiene información sobre los envíos
                if (response.resultadosEnvio) {
                    let mensaje = 'Alerta creada exitosamente.<br>Envíos: <ul>';
                    
                    response.resultadosEnvio.forEach(function(envio) {
                        if (envio.resultado.error) {
                            mensaje += `<li>${envio.telefono}: <strong>Error</strong> (${envio.resultado.error})</li>`;
                        } else {
                            mensaje += `<li>${envio.telefono}: <strong>Enviado correctamente</strong></li>`;
                        }
                    });
                    
                    mensaje += '</ul>';
                    $('#success-message').html(mensaje).show();
                } else {
                    $('#success-message').html('Alerta creada exitosamente').show();
                }

                // Restablecer el formulario a su estado inicial
                form.reset();
                // ... restablecer selectores, ocultar contenedores, etc.
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    showErrorMessages(errors, modalId);
                } else {
                    $('#' + modalId + ' .alert-danger').html('<ul><li>Error desconocido. Intente de nuevo.</li></ul>').show();
                }
                $('#success-message').hide();
            }
        });
    });

    // Evento para manejar el formulario de actualización de alerta
    $(document).on('submit', '.update-alert-form', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let form = $(this);
        let modalId = form.closest('.modal').attr('id');

        // Limpia y oculta mensajes de error y éxito
        $('#' + modalId + ' .alert-danger').hide();
        $('#success-message').hide();

        $.ajax({
            url: form.attr('action'),
            method: 'PUT',
            data: formData,
            success: function(response) {
                $('#' + modalId).modal('hide');
                updateAlertTable(response);
                $('#success-message').html('Alerta actualizada exitosamente').show();
                form[0].reset();
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    showErrorMessages(errors, modalId);
                } else {
                    $('#' + modalId + ' .alert-danger').html('<ul><li>Error desconocido. Intente de nuevo.</li></ul>').show();
                }
                $('#success-message').hide();
            }
        });
    });

    // Función para actualizar la tabla de alertas
    function updateAlertTable(data) {
        let row = $('tr[data-id="' + data.id + '"]');
        if (row.length) {
            // Si existe, actualiza la fila
            row.find('td:nth-child(2)').text(data.mensaje);
            row.find('td:nth-child(3)').text(data.fecha_creacion);
        } else {
            // Si no existe, agrega una nueva fila a la tabla
            let newRow = `
                <tr data-id="${data.id}">
                    <td>${data.id}</td>
                    <td>${data.mensaje}</td>
                    <td>${data.fecha_creacion}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalAlerta" data-id="${data.id}">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteAlerta(${data.id})">
                            Eliminar
                        </button>
                    </td>
                </tr>`;
            $('#alertasTableBody').append(newRow);
        }
    }

    // Delegar el evento para los botones de edición
    $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
        let alertId = $(this).data('id');
        let row = $('tr[data-id="' + alertId + '"]');

        if (row.length) {
            let mensaje = row.find('td:nth-child(2)').text();
            
            // Establecer los valores en el modal
            $('#editModalAlerta .alerta_id').val(alertId); // Establecer el ID de la alerta
            $('#editModalAlerta .mensaje').val(mensaje); // Establecer el mensaje
            
            // Cambiar la acción del formulario para que apunte a la URL correcta
            $('#editModalAlerta .update-alert-form').attr('action', '/alertas/' + alertId); 

            // Mostrar el modal
            $('#editModalAlerta').modal('show');
        }
    });

    // Función para eliminar la alerta
    window.deleteAlerta = function(id) {
        $('#confirmDeleteModal').modal('show'); // Mostrar el modal de confirmación
        
        $('#confirmDeleteButton').off('click').on('click', function() {
            $.ajax({
                url: '/alertas/' + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('tr[data-id="' + id + '"]').remove(); // Eliminar la fila de la tabla
                    $('#confirmDeleteModal').modal('hide'); // Cerrar el modal
                },
                error: function(xhr) {
                    alert('Error al eliminar la alerta: ' + xhr.responseText);
                }
            });
        });
    };
});

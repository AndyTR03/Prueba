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

    // Evento para manejar el formulario de creación de usuario
    $('.create-usuario-departamento-form').on('submit', function(e) {
        e.preventDefault(); // Evita la recarga de la página

        let formData = $(this).serialize(); // Obtén los datos del formulario
        let form = $(this);
        let actionUrl = form.attr('action'); // La URL para crear usuario
        let modalId = form.closest('.modal').attr('id'); // El ID del modal

        // Limpia y oculta mensajes de error y éxito al intentar enviar el formulario
        $('#' + modalId + ' .alert-danger').hide(); // Oculta el mensaje de error
        $('#success-message').hide(); // Oculta el mensaje de éxito si existe

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {
                // Si la creación fue exitosa, oculta el modal y muestra el mensaje de éxito
                $('#' + modalId).modal('hide');
                updateUsuarioDepartamentoTable(response.data); // Actualiza la tabla con la respuesta
                $('#success-message').html('UsuarioDepartamento creado exitosamente').show(); // Muestra el mensaje de éxito
                
                // Limpia el formulario después de un envío exitoso
                form[0].reset(); // Limpia el formulario
            },
            error: function(xhr) {
                // Comprueba si la respuesta contiene errores
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    showErrorMessages(errors, modalId); // Muestra los errores
                } else {
                    // En caso de otros tipos de errores
                    $('#' + modalId + ' .alert-danger').html('<ul><li>Error desconocido. Intente de nuevo.</li></ul>').show();
                }
                $('#success-message').hide(); // Oculta el mensaje de éxito si existe
            }
        });
    });

    // Evento para limpiar el modal al abrirlo
    $('.modal').on('show.bs.modal', function() {
        // Limpia y oculta mensajes de error al abrir el modal
        $(this).find('.alert-danger').hide(); // Oculta el mensaje de error
        $('#success-message').hide(); // Oculta el mensaje de éxito si existe

        // Si es el modal de creación, limpia el formulario
        if ($(this).is('#createModal')) { // Asegúrate de que el ID del modal de creación sea 'createModal'
            $(this).find('form')[0].reset(); // Limpia el formulario de creación
        }
    });

    // Delegar el evento para los botones de edición
    $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
        // Obtener el ID del usuario del data-id del elemento padre (la fila de la tabla)
        let usuariodepartamentoId = $(this).closest('tr').data('id');
        
        // Seleccionar la fila correspondiente usando el ID
        let row = $('tr[data-id="' + usuariodepartamentoId + '"]');
        
        if (row.length) {
            // Obtener los datos del usuario desde la fila
            let usuario_id = row.find('td:nth-child(2)').text();
            let departamentoId = row.find('td:nth-child(3)').text();
            
            // Establecer los valores en el modal
            $('#editModal input[name="usuario_id"]').val(usuario_id); // Establecer el ID del usuario
            $('#editModal input[name="departamentoId"]').val(departamentoId);
            
            // Cambiar la acción del formulario para que apunte a la URL correcta
            $('#editModal .update-usuario-departamento-form').attr('action', '/usuarios_departamento/' + usuariodepartamentoId); 
            
            // Mostrar el modal
            $('#editModal').modal('show');
        }
    });

    // Evento para manejar el formulario de actualización de usuario
    $('.update-usuario-departamento-form').on('submit', function(e) {
        e.preventDefault(); // Evita la recarga de la página

        let formData = $(this).serialize(); // Obtén los datos del formulario
        let form = $(this);
        let modalId = form.closest('.modal').attr('id'); // El ID del modal

        // Limpia y oculta mensajes de error y éxito al intentar enviar el formulario
        $('#' + modalId + ' .alert-danger').hide(); // Oculta el mensaje de error
        $('#success-message').hide(); // Oculta el mensaje de éxito si existe

        $.ajax({
            url: form.attr('action'), // URL para actualizar el usuario
            method: 'PUT', // Método debe ser 'PUT'
            data: formData, // Los datos del formulario
            success: function(response) {
                // Si la actualización fue exitosa, oculta el modal y muestra el mensaje de éxito
                $('#' + modalId).modal('hide');
                updateUsuarioDepartamentoTable(response.data); // Actualiza la tabla con la respuesta
                $('#success-message').html('UsuarioDepartamento actualizado exitosamente').show(); // Muestra el mensaje de éxito
                
                // Limpia el formulario después de un envío exitoso
                form[0].reset(); // Limpia el formulario
                $('#' + modalId + ' .alert-danger').hide(); // Oculta mensajes de error si están visibles
            },
            error: function(xhr) {
                // Comprueba si la respuesta contiene errores
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    showErrorMessages(errors, modalId); // Muestra los errores
                } else {
                    // En caso de otros tipos de errores
                    $('#' + modalId + ' .alert-danger').html('<ul><li>Error desconocido. Intente de nuevo.</li></ul>').show();
                }
                $('#success-message').hide(); // Oculta el mensaje de éxito si existe
            }
        });
    });

    function updateUsuarioDepartamentoTable(data) {
        let row = $('tr[data-id="' + data.id + '"]');
        if (row.length) {
            // Actualiza la fila existente
            row.find('td:nth-child(2)').text(data.usuario.nombre + ' ' + data.usuario.apellido);
            row.find('td:nth-child(3)').text(data.departamento.nombre); // Asegúrate de que estos nombres coincidan con tu respuesta
        } else {
            // Agrega una nueva fila a la tabla
            let newRow = `
                <tr data-id="${data.id}">
                    <td>${data.id}</td>
                    <td>${data.usuario.nombre} ${data.usuario.apellido}</td>
                    <td>${data.departamento.nombre}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteUsuarioDepartamento(${data.id})">
                            Eliminar
                        </button>
                    </td>
                </tr>`;
            $('.table tbody').append(newRow);
        }
    }

    window.deleteUsuarioDepartamento = function(id) {
        $('#confirmDeleteModal').modal('show'); // Mostrar el modal de confirmación
        
        $('#confirmDeleteButton').off('click').on('click', function() {
            $.ajax({
                url: '/usuarios_departamento/' + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('tr[data-id="' + id + '"]').remove();
                    $('#confirmDeleteModal').modal('hide');
                },
                error: function(xhr) {
                    alert('Error al eliminar el usuario: ' + xhr.responseText);
                }
            });
        });
    };

    // Evento para manejar la búsqueda
    $('#search-form').on('submit', function(e) {
        e.preventDefault(); // Evita la recarga de la página
        loadTable(); // Cargar la tabla con los datos de búsqueda
    });

    // Evento para manejar la paginación
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault(); // Evita la recarga de la página
        loadTable($(this).attr('href')); // Cargar la tabla en la página seleccionada
    });

    function loadTable(url = "{{ route('usuarios_departamento.index') }}") {
        $.ajax({
            url: url,
            method: 'GET',
            data: $('#search-form').serialize(), // Enviar los parámetros de búsqueda
            success: function(response) {
                // Limpiar la tabla
                $('#usuariosTable tbody').empty();

                // Rellenar la tabla con los nuevos datos
                $.each(response.data, function(index, usuarioDepartamento) {
                    $('#usuariosTable tbody').append(`
                        <tr data-id="${usuarioDepartamento.id}">
                            <td>${usuarioDepartamento.id}</td>
                            <td>${usuarioDepartamento.usuario.nombre} ${usuarioDepartamento.usuario.apellido}</td>
                            <td>${usuarioDepartamento.departamento.nombre}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-id="${usuarioDepartamento.id}">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger" onclick="deleteUsuarioDepartamento(${usuarioDepartamento.id})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `);
                });

                // Actualizar los enlaces de paginación
                $('#paginationLinks').html(response.links);
            },
            error: function(xhr) {
                alert('Error al cargar la tabla: ' + xhr.responseText);
            }
        });
    }
});

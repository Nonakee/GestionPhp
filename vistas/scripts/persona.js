$(document).ready(function () {
    $('#tablaPersonas').DataTable({
        ajax: {
            url: '../ajax/ListarPersona.php',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { title: "Opciones" },
            { title: "Nombre" },
            { title: "Apellido" },
            { title: "Teléfono" },
            { title: "Email" }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    // Aquí puedes agregar eventos para agregar, editar y eliminar
    // Por ejemplo:
    $('#btnAgregar').click(function () {
    window.location.href = 'FormularioPersona.php';
    });

    // Evento click editar
$('#tablaPersonas').on('click', '.editar', function () {
    const id = $(this).data('id');
    window.location.href = `EditarPersona.php?id=${id}`;
});

    // Evento click eliminar
$('#tablaPersonas').on('click', '.eliminar', function () {
    const id = $(this).data('id');

    if (confirm('¿Estás seguro de que deseas eliminar esta persona?')) {
        $.post('../ajax/EliminarPersona.php', { id: id }, function (res) {
            const resultado = JSON.parse(res);
            if (resultado.success) {
                $('#tablaPersonas').DataTable().ajax.reload();
            } else {
                alert('Error al eliminar');
            }
        });
    }
});
});

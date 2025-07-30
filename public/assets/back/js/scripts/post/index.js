$(document).ready(function () {
    // Proceso Mostrar Registro
    $("#data-table").on("click", ".mostrar-registro", function (e) {
        e.preventDefault();
        const data = {
            _token: $('input[name="_token"]').val(),
        };
        // console.log(data);
        ajaxRequest($(this).attr("href"), data, "mostrar");
    });

    $("#data-table").DataTable({
        columnDefs: [
            {
                orderable: false,
                targets: "no-sort",
            },
            {
                searchable: false,
                targets: "no-search",
            },
        ],
        order: [],
    });

    function ajaxRequest(url, data, accion, form) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (respuesta) {
                console.log(respuesta);
                if (accion == 'mostrar') {
                    $('#show-post .modal-body').html(respuesta);
                    $('#show-post').modal('show');
                }
            }
        });
    }
});

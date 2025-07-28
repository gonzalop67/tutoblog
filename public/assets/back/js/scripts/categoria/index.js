$(document).ready(function () {
    var tabla = $("#data-table").DataTable();
    // Proceso nuevo Registro
    $("#nuevo-registro").on('click', function (e) {
        e.preventDefault();
        const data = {
            _token: $('input[name="_token"]').val(),
        };
        ajaxRequest($(this).attr("href"), data, "crear");
    });

    // Proceso Editar Registro
    $("#data-table").on("click", ".editar-registro", function (e) {
        e.preventDefault();
        const data = {
            _method: "PUT",
            _token: $('input[name="_token"]').val(),
        };
        ajaxRequest($(this).attr("href"), data, "editar");
    });

    // Proceso Eliminar Registro
    $("#data-table").on("submit", ".eliminar-registro", function (e) {
        e.preventDefault();
        const form = $(this);
        swal.fire({
            title: "¿ Seguro que desea eliminar este registro ?",
            text: "Confirmar acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                ajaxRequest(
                    form.attr("action"),
                    form.serialize(),
                    "eliminar",
                    form
                );
            }
        });
    });

    // Proceso Guardar o Actualizar
    $("#accion-categoria").on("submit", "#form-general", function (e) {
        e.preventDefault();
        const form = $(this);
        ajaxRequest(form.attr("action"), form.serialize(), "guardar");
    });

    function ajaxRequest(url, data, accion, form) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (respuesta) {
                if (accion == "crear" || accion == "editar") {
                    $("#accion-categoria .modal-body").html(respuesta);
                    APP.validacionGeneral("form-general");
                    $("#accion-categoria").modal("show");
                } else if (accion == "guardar" || accion == "actualizar") {
                    APP.notificacion(
                        "Categoría creada/actualizada correctamente",
                        "TutoBlog",
                        "success"
                    );
                    tablaData(respuesta);
                } else if (accion == "eliminar") {
                    if (respuesta.mensaje == "ok") {
                        tabla.row(form.parents("tr")).remove().draw(false);
                        APP.notificacion(
                            "El registro se eliminó correctamente",
                            "TutoBlog",
                            "success"
                        );
                    } else {
                        APP.notificacion(
                            "El registro no pudo ser eliminado, lo más seguro es que esté siendo usado en otra tabla",
                            "TutoBlog",
                            "error"
                        );
                    }
                }
            },
            error: function (jqXHR, error, errorThrown) {
                var errors = jqXHR.responseJSON.errors;
                if (errors) {
                    var errorMessage = "";
                    $.each(errors, function (key, value) {
                        errorMessage += value[0] + "<br>";
                    });
                    APP.notificacion(
                        errorMessage,
                        "TutoBlog",
                        "error"
                    );
                } else {
                    APP.notificacion(
                        "Ocurrió un error inesperado. Por favor, inténtelo de nuevo.",
                        "TutoBlog",
                        "error"
                    );
                }
            },
        });
    }

    function tablaData(respuesta) {
        tabla.destroy();
        $("#data-table tbody").html(respuesta);
        tabla = $("#data-table").DataTable();
        $("#accion-categoria").modal("hide");
    }
});

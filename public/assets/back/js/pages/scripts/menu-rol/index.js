$(document).ready(function () {
    $('.menu_rol').on('change', function () {
        var data = {
            menu_id: $(this).data('menu'),
            rol_id: $(this).val(),
            _token: $('input[name=_token]').val()
        };
        if ($(this).is(':checked')) {
            data.estado = 1
        } else {
            data.estado = 0
        }
        const url = $(this).data('url');
        ajaxRequest(url, data);
     });

     function ajaxRequest(url, data) {
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                console.log(response.respuesta);
            }
        });
     }
});
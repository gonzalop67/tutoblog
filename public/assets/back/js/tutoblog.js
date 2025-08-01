var APP = function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $('#' + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: 'div', //default input error message container
                errorClass: 'invalid-feedback', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                highlight: function (element, errorClass, validClass) { // highlight error inputs
                    $(element).addClass('is-invalid'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by highlight
                    $(element).removeClass('is-invalid'); // set error class to the control group
                },
                success: function (element) {
                    element.removeClass('is-invalid'); // set success class to the control group
                },
                errorPlacement: function (error, element) {
                    if (element.closest('.bootstrap-select').length > 0) { //Bootstrap select
                        element.closest('.bootstrap-select').find('.bs-placeholder').after(error);
                    } else if ($(element).is('select') && element.hasClass('select2-hidden-accesible')) {
                        element.next().after(error);
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                },
                invalidHandler: function (event, validator) { // display error alert on form submit

                },
                submitHandler: function(form) {
                    return true;
                }
            });
        },
        notificacion: function (mensaje, titulo, tipo) {
            switch (tipo) {
                case 'error':
                    toastr.error(mensaje, titulo);
                    break;
                case 'success':
                    toastr.success(mensaje, titulo);
                    break;
                case 'info':
                    toastr.info(mensaje, titulo);
                    break;
                case 'warning':
                    toastr.warning(mensaje, titulo);
                    break;
                default:
                    break;
            }
        },
    }
}();

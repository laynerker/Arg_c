
$(function () {

    var tabla = 'perfiles';
    var campo = 'id_perfil';
    var id_estatus = 'estatus';

    /*
     * emerjente te de ventana modal para el formulario de creacion de usuario
     */


    $("#crear").click(function () {
        $('.modal-footer .btn-primary').text('Crear');
        $('.modal-footer .btn-primary').attr('id', 'crearuser');
        $('.modal-content form').attr('name', base_url + 'Cperfiles/registroPerfil');
        $('input').val('');
        //$('#formSolicitud').reset();
        $('#myModal').modal('show');
    });






    $('#formTipos').formValidation({
        message: 'This value is not valid',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                message: 'El Nombre no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El Nombre debe ser mayor de 3 y menos de 30 caracteres de longitud'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z áéíóúñÁÉÍÓÚÑ]+$/,
                        message: 'El Nombre sólo puede consistir en letras'
                    },
                    remote: {
                        url: base_url + 'Cgeneral/validacionGeneral/perfiles/perfil',
                        type: 'POST',
                        message: 'El nombre ya se encuantra registrado'
                    }
                }
            }

        }
    }).on('success.form.fv', function (e) {

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the FormValidation instance
        var bv = $form.data('formValidation');

        // Use Ajax to submit form data
        var confimacion;
        if ($('.modal-content form').attr('name') == base_url + 'Cperfiles/ModificarPerfil') {
            confimacion = confirm('¿Realmente desea Modificar?');
        } else if ($('.modal-content form').attr('name') == base_url + 'Cperfiles/registroPerfil') {
            confimacion = true;
        }
        if (confimacion) {
            $.post($form.attr('name'), $form.serialize(), function (result) {
                /*console.log(result);
                 alert();*/
                if (result != 'false') {
                    alert('Registro Exitoso');
                    location.href = '';
                } else if (result == 'false') {
                    alert('El solicitante posee una solicitud reciente');
                    location.href = '';
                }
            }, 'json');
        }
    });
    /*
     * funcion para mostrar el formulario para modificar
     */
    $("tbody").delegate("#edit", "click", function () {
        $('.modal-footer .btn-primary').text('Modificar');
        $('.modal-footer .btn-primary').attr('id', 'modifi');
        $('.modal-content form').attr('name', base_url + 'Cperfiles/ModificarPerfil');
        var td = $(this).parent();
        var estatus_actual = td.find('#elimi').attr('name');
        if (estatus_actual == '2') {
            $.ajax({
                type: "post",
                dataType: "json",
                url: base_url + "Cperfiles/Data",
                cache: false,
                data: {id: $(this).find('i').attr('id')},
                success: function (data) {
                    $("#id_perfil").val(data[0].id_perfil);
                    $("#nombre").val(data[0].perfil);
                }
            });
            $('#myModal').modal('show');
        } else if (estatus_actual == '1') {
            alert('Para editar este producto es necesario desactivar su publicacion');
            if (confirm('Desea usted desactivar esta publicación?')) {
                var estatus = '2';
                CambioEstatus($(this).find('i').attr('id'), estatus_actual, tabla, campo, id_estatus,$(this).parent().find('#reactivar'));
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: base_url + "Cperfiles/Data",
                    cache: false,
                    data: {id: $(this).find('i').attr('id')},
                    success: function (data) {
                        $("#id_perfil").val(data[0].id_perfil);
                        $("#nombre").val(data[0].perfil);
                    }
                });
                $('#myModal').modal('show');
            }
        }

    });
    /*
     * eliminar user del sistema
     */
    $("tbody").delegate("#elimi", "click", function () {
        CambioEstatus($(this).find('i').attr('id'), $(this).attr('name'), tabla, campo, id_estatus,$(this).parent().find('#reactivar'));
        $(this).attr('name','2');
    });

    $("tbody").delegate("#reactivar", "click", function () {
        CambioEstatus($(this).find('i').attr('id'), $(this).attr('name'), tabla, campo, id_estatus,$(this));
    });

});

$(function () {
    /*
     * emerjente te de ventana modal para el formulario de creacion de usuario
     */

    $("#crear").click(function () {
        //$(".ocultar1").html('<th class="ocultar">Usuario</th><th class="ocultar"><input type="text" name="user" id="user"></th><th class="ocultar">Clave</th><th class="ocultar"><input type="password" name="clave" id="clave"></th><th class="ocultar"></th><th class="ocultar"></th>');
        //$(".ocultar2").html('Correo');
        //$(".ocultar3").html('<input size="15" type="text" name="correo" id="correo">');
        $('.modal-footer .btn-primary').text('Crear');
        $('.modal-footer .btn-primary').attr('id', 'crearuser');
        $('.modal-content form').attr('name', base_url + 'Login/registroUsuario');
        $('input').val('');
        $("#perfil").html('<option value="">...</option>');
        $.ajax({
            type: "post",
            url: base_url+"Cgeneral/funcionLista/1",
            //data: {},
            success: function (data) {
                $("#perfil").append(data);

            }
        });
        $('#myModal').modal('show');
    });
    $( "#user" ).focus(function() {
        if($('#nombre').val() != '' && $('#apellido').val() != ''){
            var nombre = $('#nombre').val(); 
            var apellido = $('#apellido').val(); 
            var letra = nombre.substr(0, 1);
            $('#user').val(letra+apellido);
        }
      });
    
    $('#formCrear').formValidation({
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
                        regexp: /^[a-zA-Z0-9 _\.-áéíóúñÁÉÍÓÚÑ]+$/,
                        message: 'El Nombre sólo puede consistir en letras'
                    }
                }
            },
            apellido: {
                message: 'El Apellido no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El Apellido debe ser mayor de 3 y menos de 30 caracteres de longitud'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 _\.-áéíóúñÁÉÍÓÚÑ]+$/,
                        message: 'El Apellido sólo puede consistir en letras'
                    }
                }
            },
            nac: {
                message: 'La nacionalidad no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    }
                }
            },
            ci: {
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'La Cedula debe ser mayor de 5 y menos de 10 caracteres de longitud'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'La Cedula debe ser solo numerica'
                    },
                    remote: {
                        url: base_url + 'Cgeneral/validacionGeneral/personas/ci',
                        type: 'POST',
                        message: 'El numero de célula ya se encuantra registrado'
                    }
                }
            },
            tlf: {
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    regexp: {
                        regexp: /^[0-9]{4}\-\d{7}$/,
                        message: 'formato incorrecto, ejemplo: 0123-1234567'
                    }
                }
            },
            correo: {
                validators: {
                    emailAddress: {
                        message: 'El correo no es valido'
                    },
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    }
                }
            },
            perfil: {
                message: 'El perfil no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    }
                }
            },
            user: {
                message: 'La usuario no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    remote: {
                        url: base_url + 'Cgeneral/validacionGeneral/accesos/usuario',
                        type: 'POST',
                        message: 'El usuario ya se encuantra registrado'
                    }
                }
            },
            passwd: {
                message: 'La Contraseña no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    }
                }
            },
            passwd2: {
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    identical: {
                        field: 'passwd',
                        message: 'La contraseña y su confirmación no son las mismas'
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
        if ($('.modal-content form').attr('name') == base_url + 'Login/ModificarUser') {
            confimacion = confirm('¿Realmente desea Modificar?');
        } else if ($('.modal-content form').attr('name') == base_url + 'Login/registroUsuario') {
            confimacion = true;
        }
        if (confimacion) {
            $.post($form.attr('name'), $form.serialize(), function (result) {
                if (result != 'false') {
                    alert('Registro Exitoso');
                    location.href = '';
                } else if (result == 'false') {
                    alert('El Registro ya existe');
                    location.href = '';
                }
            }, 'json');
        }
    });

    /*
     * funcion para mostrar el formulario para modificar
     */
    $("tbody").delegate("#edit", "click", function () {
        $('.modal-content form').attr('name', base_url + 'Login/ModificarUser');
        $('.modal-footer .btn-primary').text('Modificar');
        $('.modal-footer .btn-primary').attr('id', 'modifi');
        
        
        $.ajax({
            type: "post",
            url: base_url +"Cgeneral/funcionLista/1",
            success: function (data) {
                $("#perfil").html('<option value="">...</option>')
                $('#perfil').append(data)
            }
        });
        $.ajax({
            type: "post",
            async: false,
            dataType: "json",
            url: base_url +"Cgeneral/funcionLista/6",
            cache: false,
            data: {id: $(this).find('i').attr('id')},
            success: function (data) {
                //console.log(data[0]);
                $("#id_acceso").val(data[0].id_acceso);
                $("#id_persona").val(data[0].id_persona);
                $("#nombre").val(data[0].nombre);
                $("#apellido").val(data[0].apellido);
                $("#correo").val(data[0].correo);
                $("#tlf").val(data[0].telefono);
                $("#ci").val(data[0].ci);
                $("#user").val(data[0].usuario);
            }
        });
        $('#formCrear').formValidation('removeField', 'passwd');
        $('#formCrear').formValidation('removeField', 'passwd2');
        $('#formCrear').formValidation('removeField', 'ci');
        $('#formCrear').formValidation('removeField', 'user');
        $('#formCrear').formValidation('addField', 'ci', {
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'La Cedula debe ser mayor de 5 y menos de 10 caracteres de longitud'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'La Cedula debe ser solo numerica'
                    },
                    remote: {
                        url: base_url + 'Cgeneral/validacionGeneral/personas/ci/id_persona/'+$('#id_persona').val(),
                        type: 'POST',
                        message: 'El numero de célula ya se encuantra registrado'
                    }
                }
            });
            $('#formCrear').formValidation('addField', 'user', {
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    },
                    remote: {
                        url: base_url + 'Cgeneral/validacionGeneral/accesos/usuario/id_acceso/'+$('#id_acceso').val(),
                        type: 'POST',
                        message: 'El usuario ya se encuantra registrado'
                    }
                }
            });
            $('#myModal').modal('show');
    });
    /*
     * eliminar user del sistema
     */
    $("tbody").delegate("#elimi", "click", function () {
        var corfimacion;
        if ($(this).attr('name') == 2) {
            corfimacion = confirm('Realmente quiere eliminar este usuarios');
        } else {
            corfimacion = true;
        }
        if (corfimacion) {
            $.ajax({
                type: "post",
                url: base_url + "Login/EliminarUser",
                data: {id_user: $(this).find('i').attr('id'), estatus: $(this).attr('name')},
                success: function (data) {
                    alert('Eliminacion de usuario exitosa');
                    location = '';
                }
            });
        }
    });

    $("tbody").delegate("#reactivar", "click", function () {
        $.ajax({
            type: "post",
            url: base_url + "Panel/EliminarUser",
            data: {id_user: $(this).find('i').attr('id'), estatus: $(this).attr('name')},
            success: function (data) {
                alert('Activacion de usuario exitosa');
                location = '';
            }
        });

    });

});
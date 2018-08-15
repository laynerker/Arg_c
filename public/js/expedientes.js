
$(function () {

    var tabla = 'expedientes';
    var campo = 'id_expediente';
    var id_estatus = 'estatus_exp';

    /*
     * emerjente te de ventana modal para el formulario de creacion de usuario
     */


    $("#crear").click(function () {
        $('.modal-footer .btn-primary').text('Crear');
        $('.modal-footer .btn-primary').attr('id', 'crearuser');
        $('.modal-content form').attr('name', base_url + 'Cexpedientes/registroExpediente');
        $('input').val('');
        $("#name_e,#rif_m").html('');
        $("#name_empre,#tipo_empre,#equipos").html('<option value="">...</option>');
        //$('#formSolicitud').reset();
        $.ajax({
            type: "post",
            async: false,
            url: base_url + "Cgeneral/dataTiposEmpresas",
            dataType: "json",
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    $("#tipo_empre").append('<option value="' + data[i].id_tipo_empr + '">' + data[i].nombre + '</option>');
                }
            }
        });
        $(".selectpicker").selectpicker("refresh");
        $('#myModal').modal('show');
    });

    $('.selectpicker').selectpicker();

    $('#tipo_empre').on('change', function () {
        $("#name_e,#rif_m").html('');
        $("#name_empre,#equipos,#equipos_consu,#tip_consu,#consu").html('<option value="">...</option>');
        $("#name_empre").html('<option value="">...</option>');
        //$("#tasig tbody tr").remove();
        if ($(this).val() == '1') {
            $.ajax({
                type: "post",
                async: false,
                url: base_url + "Cempresas/DataLibre",
                dataType: "json",
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#name_empre").append('<option value="' + data[i].id_empresa + '">' + data[i].r_social + ' -> ' + data[i].rif + '</option>');
                    }
                }
            });
        } else {

            $.ajax({
                type: "post",
                async: false,
                url: base_url + "Csucursales/DataLibre",
                dataType: "json",
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#name_empre").append('<option value="' + data[i].id_sucursal + '">' + data[i].nombre_suc + '</option>');
                    }
                }
            });
        }
        $("#name_empre,#equipos,#equipos_consu,#tip_consu,#consu").selectpicker("refresh");
    });
    $("#name_empre").on('change', function () {
        var name = $("#name_empre option[value='" + $(this).val() + "']").html();
        if (name.indexOf("-&gt;") > -1) {
            var array = name.split('-&gt;');
            $("#name_e").html(array[0]);
            $("#rif_m").html(array[1]);
        } else {
            $("#name_e").html(name);
        }
        $.ajax({
            type: "post",
            async: false,
            url: base_url + "Cequipo/DataLibre",
            dataType: "json",
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    $("#equipos").append('<option value="' + data[i].id_equipo + '">' + data[i].serial + '</option>');
                }
            }
        });
        $("#equipos").selectpicker("refresh");
    });

    $("#add").click(function () {
        var id = $("#equipos").val();
        $("#tasig tbody #" + id).remove();
        var name = $("#equipos option[value='" + id + "']").html();
        var conta = $("#contador_eq").val();
        var nFilas = $("#tasig tbody tr").length; 
        if (nFilas == 0) {
            $.ajax({
                type: "post",
                async: false,
                url: base_url + "Ctiposconsumibles/Data",
                dataType: "json",
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#tip_consu").append('<option value="' + data[i].id_tipo_consu + '">' + data[i].nombre + '</option>');
                    }
                }
            });
        }
        $("#tasig tbody").append('<tr id="' + id + '"><td>' + name + '</td><td><input type="hidden" name="cont_eq[]" class="tiposasigs" value="' + conta + '">' + conta + '</td><td><button  class="btn btn-danger" id="elimi_t" type="button" name="elimi_t"> <input type="hidden" name="equipo[]" class="tiposasigs" value="' + id + '"> <i class="fa fa-trash-o"></i></button></td></tr>');
        $("#equipos_consu").append('<option value="' + id + '">' + name + '</option>');
        $("#equipos_consu,#consu,#tip_consu").selectpicker("refresh");
        $("#contador_eq").val('');
    });

    $("#tasig tbody").delegate("#elimi_t", "click", function () {
        var idEli = $(this).find('.tiposasigs').val();
        $("#tasig tbody #" + idEli).remove();
        $("#equipos_consu option[value='" + idEli + "']").remove();
        $("#equipos_consu").selectpicker("refresh");
    });
    
    
    
    $("#tip_consu").on('change', function () {
        $("#consu").html('<option value="">...</option>');
        $.ajax({
                type: "post",
                async: false,
                url: base_url + "Cconsumibles/DataLibre",
                dataType: "json",
                data:{idclass :$(this).val()},
                success: function (data) {
                     
                    for (var i = 0; i < data.length; i++) {
                        var tip_consu = $("#tip_consu").val();
                        var num_consu = $("#tconsu tbody .tdconsut input[value='"+data[i].id_consumible+"']").length;
                        var num_tip_consu = $("#tconsu tbody .tdtipoconsu input[value='"+tip_consu+"']").length; 
                        if(num_consu == 0 && num_tip_consu == 0){ 
                        $("#consu").append('<option value="' + data[i].id_consumible + '">' + data[i].serial + '</option>');
                        }
                    }
                }
            });
            $("#consu").selectpicker("refresh");
    });
    
    

    $("#add_consu").click(function () {
        var id = $("#consu").val();
        var equipos_consu = $("#equipos_consu").val();
        var tip_consu = $("#tip_consu").val();
        $("#tconsu tbody #" + equipos_consu+tip_consu).remove();
        var num_consu = $("#tconsu tbody .tdconsut input[value='"+id+"']").length;
        var num_tip_consu = $("#tconsu tbody .tdtipoconsu input[value='"+tip_consu+"']").length;        
        
        var name = $("#consu option[value='" + id + "']").html();
        var eqSerial = $("#equipos_consu option[value='" + equipos_consu + "']").html();
        var nametipoconsu = $("#tip_consu option[value='" + tip_consu + "']").html();
        var contador_consu = $("#contador_consu").val();
        var numpag = $("#num_p").val();
        $("#tconsu tbody").append('<tr id="' + equipos_consu+tip_consu + '"><td>' + eqSerial + '<input type="hidden" name="eqidconsu[]" class="tiposasigs" value="' + equipos_consu + '"></td><td class="tdtipoconsu">' + nametipoconsu + '<input type="hidden" name="tipconsu[]" class="tiposasigs" value="' + tip_consu + '"></td><td class="tdconsut">' + name + '<input type="hidden" name="idconsut[]" class="tiposasigs" value="' + id + '"></td><td><input type="hidden" name="contat[]" class="tiposasigs" value="' + contador_consu + '">' + contador_consu + '</td><td><input type="hidden" name="numpagt[]" class="tiposasigs" value="' + numpag + '">' + numpag + '</td><td><button  class="btn btn-danger" id="elimi_t" type="button" name="elimi_t"> <input type="hidden" name="consutipot[]" class="tiposasigs" value="' + equipos_consu+tip_consu + '"> <i class="fa fa-trash-o"></i></button></td></tr>');
        $("#consu option[value='" + id + "']").remove();
        $("#consu").selectpicker("refresh");
    });

    $("#tconsu tbody").delegate("#elimi_t", "click", function () {
        var idEli = $(this).find('.tiposasigs').val();
        $("#tconsu tbody #" + idEli).remove();
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
            tipo_empre: {
                message: 'El Nombre no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
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
        if ($('.modal-content form').attr('name') == base_url + 'Cexpedientes/ModificarPerfil') {
            confimacion = confirm('¿Realmente desea Modificar?');
        } else if ($('.modal-content form').attr('name') == base_url + 'Cexpedientes/registroExpediente') {
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
        $('.modal-content form').attr('name', base_url + 'Cexpedientes/ModificarPerfil');
        var td = $(this).parent();
        var estatus_actual = td.find('#elimi').attr('name');
        if (estatus_actual == '2') {
            $.ajax({
                type: "post",
                dataType: "json",
                url: base_url + "Cexpedientes/Data",
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
                CambioEstatus($(this).find('i').attr('id'), estatus_actual, tabla, campo, id_estatus, $(this).parent().find('#reactivar'));
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: base_url + "Cexpedientes/Data",
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
        CambioEstatus($(this).find('i').attr('id'), $(this).attr('name'), tabla, campo, id_estatus, $(this).parent().find('#reactivar'));
        $(this).attr('name', '2');
    });

    $("tbody").delegate("#imgs", "click", function () {
        location = base_url + 'Panel/bandeja/admin_img/' + $(this).find('i').attr('id');

    });
    $("tbody").delegate("#solicitud", "click", function () {
        location = base_url + 'routing/bandeja/solicitudes/' + $(this).find('i').attr('id')+'-'+$(this).attr('name');

    });

    $("tbody").delegate("#reactivar", "click", function () {
        CambioEstatus($(this).find('i').attr('id'), $(this).attr('name'), tabla, campo, id_estatus, $(this));
    });

});



$(function() {
    
});
/*
 * Creacion de variable para hacer validaciones
 */
var vali = new Array(); // validadiones en general
var valir = new Array();
var valinc = new Array();
var valimodif = new Array(); // para el moficicar usuario en accesos

/*
 * funcion base para cambiar estatus
 */

function CambioEstatus(id, estatus, tabla, campo, id_estatus,object) {
        if(estatus == '2'){
            estatus ='0';
        }else if(estatus == '1'){
            estatus ='2';
        }else if(estatus == '0'){
            estatus ='1';
        }
        $.ajax({
            type: "post",
            url: base_url + "Cgeneral/CambioEstatus/" + tabla + "/" + campo + "/" + id_estatus + "/",
            data: {id: id, estatus: estatus},
            success: function (data) {
                if (estatus == '2') {
                    object.css('display','block');
                    alert('El Producto a cambiado su estado con exito');
                } else if (estatus == '1') {
                    alert('Activacion de Producto exitosa');
                    object.css('display','none');
                    object.parent().find('#elimi').attr('name','1');
                } else if (estatus == '0') {
                    alert('El Producto a sido eliminado con Exito');
                    location="";
                }
            }
        });
    }


/*
 * funcion base para ejecutar la validacion de forma ordenada
 */
function validador(vali) {
    for (var i = 0; i < vali.length; i++) {
        var valid = Validar(vali[i][0], vali[i][1], vali[i][2]);
        if (valid == false) {
            return valid;
            break;
        }
    }
    return true
}

/*
 * funcion base para ejecutar los tipos de validacion
 */
function Validar(campo, mensaje, tipo) {
    switch (tipo) {
        case 'texto':
            if ($(campo).val() == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'num':
            if ($(campo).val() == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            if (/^([0-9])*$/.test($(campo).val()) == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'radio':
            if ($("input:radio[name=" + campo + "]:checked").is(':checked') == false) {
                alert(mensaje);
                $("input:radio[name=" + campo + "]:checked").focus();
                return false;
            }
            break;
        case 'correo':
            if ($(campo).val() == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            if (/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*.(.[a-z0-9-]+)$/.test($(campo).val()) == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'tlf':
            if ($(campo).val() == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            if (/^\d{4}\-\d{7}$/.test($(campo).val()) == false) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_empresa':
            if ($("input:radio[name=tipo_per]:checked").val() == 'J' || $("input:radio[name=tipo_per]:checked").val() == 'G') {
                if ($(campo).val() == false) {
                    alert(mensaje);
                    $(campo).focus();
                    $("#empresa").removeAttr('disabled');
                    $("#rif").removeAttr('disabled');
                    return false;
                }
            }
            break;
        case 'esp_rif':
            if ($("input:radio[name=tipo_per]:checked").val() == 'J' || $("input:radio[name=tipo_per]:checked").val() == 'G') {
                if ($(campo).val() == false) {
                    alert(mensaje);
                    $(campo).focus();
                    $("#empresa").removeAttr('disabled');
                    $("#rif").removeAttr('disabled');
                    return false;
                }
                if (/^([0-9])*$/.test($(campo).val()) == false) {
                    alert(mensaje);
                    $(campo).focus();
                    $("#empresa").removeAttr('disabled');
                    $("#rif").removeAttr('disabled');
                    return false;
                }
            }
            break;
        case 'esp_repeclave':
            if ($(campo).val() != $('#clave').val()) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_base':
            if ($(campo).val() == '' && $('#nivel').val() > 1) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_sub-catego':
            if ($(campo).val() == '' && $('.sub').attr('style') == 'display: block;') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_form_fecha':
            if (/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/.test($(campo).val()) == false && $('#for_pago').val() != 'Pago en tienda') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_envio':
            if ($(campo).val() == false && $("input:radio[name=shiptobilling]:checked").val() == '1') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_envio_num':
            if ($(campo).val() == false && $("input:radio[name=shiptobilling]:checked").val() == '1') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            if (/^([0-9])*$/.test($(campo).val()) == false && $("input:radio[name=shiptobilling]:checked").val() == '1') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_file':
            var val = $(campo).val();
            if (!val.match(/(?:pdf)$/)) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_confir':
            if ($(campo).val() != $("#password2").val()) {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
        case 'esp_num_tran':
            if ($(campo).val() == false && $('#for_pago').val() != 'Pago en tienda') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            if (/^([0-9])*$/.test($(campo).val()) == false && $('#for_pago').val() != 'Pago en tienda') {
                alert(mensaje);
                $(campo).focus();
                return false;
            }
            break;
    }
}


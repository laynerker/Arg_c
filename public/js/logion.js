/*
 * @type Array 
 * Lista de Campos a Validar
 */
vali[0] = new Array('#username', 'Debe de colocar algun usuario', 'texto');
vali[1] = new Array('#password', 'Debe de colocar alguna contaseña', 'texto');
vali[2] = new Array('#defaultReal', 'Debe de colocar el capchan', 'texto');
valir[0] = new Array('#userr', 'Debe de colocar algun email', 'correo');
valinc[0] = new Array('#password', 'Debe de colocar alguna contaseña', 'texto');
valinc[1] = new Array('#password2', 'Debe de colocar alguna la confirmacion', 'texto');
valinc[2] = new Array('#password', 'La contraseña de confirmacion no es la misma', 'esp_confir');

$(function() {
    
    
    $(document).keypress(function(e) {
        if (e.which == 13) {
            if($('#id_acceso').length == '0'){
            var val = validador(vali);
            if (val) {
                $.ajax({
                type: "post",
                url: base_url + "Login/acceso",
                data: $("#login").serialize(),
                success: function(data) {
                    if (data != false) {
                        //console.log(data);
                        location = data;
                    } else {
                        alert('Usuario y clave invalido');
                        location = "";
                    }
                }
            });
            }
            }else{
               actualizar(); 
            }
        }
    });
    
    /*
     * funcijon para setiar el campo de la cantidad de productos
     */
    
    $("#enviologin").click(function() {
        var val = validador(vali);
        if (val) {
            $.ajax({
                type: "post",
                url: base_url + "Login/acceso",
                data: $("#login").serialize(),
                success: function(data) {
                    if (data != false) {
                        //console.log(data);
                        location = data;
                    } else {
                        alert('Usuario y clave invalido');
                        location = "";
                    }
                }
            });
        }
    });
    
    function actualizar(){
        var val = validador(valinc);
        if (val) {
            $.ajax({
                type: "post",
                url: base_url + "Login/actualizar",
                data: $("#login").serialize(),
                success: function(data) {
                    if (data != false) {
                        //console.log(data);
                        alert('Su clave ha sido actualizado con éxito');
                        location = data;
                    } else {
                        alert('Error');
                        location = "";
                    }
                }
            });
        }
    }
    
    $("#envioactuli").click(function() {
        actualizar();
    });
    /*
     * funcion para recuperar contraseña
     */
    $("#enviorecup").click(function() {
        var val = validador(valir);
        if (val) {
            $.ajax({
                type: "post",
                url: "controlador/recupera.php",
                data: $("#recup").serialize(),
                success: function(date) {
                    if (date != false) {
                        $('#mensaje').html('<h2>El correo a sido enviado</h2>');
                    } else {
                        $('#mensaje').html('<h3 style="color: red" >El correo no existe</h3>' + date);
                    }
                }
            });
        }
    });
    /*
     * funcion para Guardar nueva contraseña
     */
    $("#clave_nueva").click(function() {
        var val = validador(valinc);
        if (val && racv != false) {
            $.ajax({
                type: "post",
                url: "controlador/recupera.php",
                data: {pass: $('#password').val(), racv: racv},
                success: function(date) {
                    if (date != false) {
                        alert('Su nueva contraseña a sido guardada con exito');
                        location = "login.html";
                    }
                }
            });
        }
    });

});

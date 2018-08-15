
$(function () {


    /*
     * emerjente te de ventana modal para el formulario de creacion de usuario
     */


    $("#clear").click(function () {
        location.href = base_url+'routing/bandeja/cusa/';
    });
    
    $("#fechaen").datepicker({
            dateFormat: "yy-mm-dd",maxDate: "-0D",minDate: 1, changeMonth: true , changeYear: true
        });
    $("#fechain").datepicker({
        dateFormat: "yy-mm-dd",maxDate: "-0D", changeMonth: true , changeYear: true,
        onClose: function (selectedDate) {
            $("#fechaen").datepicker("option", "minDate", selectedDate);
            $('#fechaen').focus();
        }
    });





    $('#formSearch').formValidation({
        message: 'This value is not valid',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fechain: {
                message: 'El Nombre no es valido',
                validators: {
                    notEmpty: {
                        message: 'El Campo no puede estar en blanco'
                    }
                }
            },            
            fechaen: {
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
        //e.preventDefault();
        var $form = $(e.target);
        $form.attr('action',base_url+'routing/bandeja/cusa/'+$('#fechain').val()+'_'+$('#fechaen').val());
    });
    

});
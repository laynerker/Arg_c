        </div>
        <!-- /#wrapper -->
        <script> var base_url = '<?php echo base_url(); ?>';</script>
        <!-- jQuery Version 1.11.0 -->
        <script src="<?php echo base_url(); ?>public/js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/sb-admin-2.js"></script>
        
        <!-- Archivo personalisado JavaScript -->        
        <script src="<?php echo base_url(); ?>public/js/general.js"></script>
        
        <?php switch ($tronco) {
            case 'inicio':
                ?>
                <!-- Morris Charts JavaScript -->
                <script src="<?php echo base_url(); ?>public/js/plugins/morris/raphael.min.js"></script>
                <script src="<?php echo base_url(); ?>public/js/plugins/morris/morris.min.js"></script>
                <script src="<?php echo base_url(); ?>public/js/plugins/morris/morris-data.js"></script>
                <?php
                break;
            case 'admin_img':
                ?>
                <!-- Ventana modal de Bootstrap JavaScript -->
                <script src="<?php echo base_url(); ?>public/js/modal.js"></script>               
                <?php
                break;
            case 'accesos':
            case 'perfiles':            
            case 'trabajos':
            case 'bmusa':
            case 'cusa':
            case 'cofiusa':
            case 'uva':            
                ?>
                <!-- DataTables JavaScript -->
                  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.bootstrap.js"></script>  
                <!-- Page-Level Demo Scripts - Tables - Use for reference -->                
                <script>
                    $(document).ready(function () {
                        $('#dataTables-example').dataTable();
                    });
                </script>
                
                <!-- Validador Bootstrap JavaScript -->
                <script type="text/javascript" src="<?php echo base_url(); ?>public/jqueryvalidate/dist/js/formValidation.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>public/jqueryvalidate/dist/js/framework/bootstrap.js"></script>
                <!-- Archivo personalisado JavaScript -->
                <!-- Latest compiled and minified JavaScript -->
                <script src="<?php echo base_url(); ?>public/js/bootstrap-select.js"></script>
                <?php
                break;
            default:
                break;
        }  
        /* aspectos especificos de estos modulos */
        ?>
                 <script src="<?php echo base_url(); ?>public/js/<?php echo $tronco; ?>.js"></script>
                <?php
        switch ($tronco) {
            
            case 'productos':
                ?>
                <script src="<?php echo base_url(); ?>public/js/productos.js"></script>
                           
                <?php
                break;
            case 'tipo':
                ?>
                <script src="<?php echo base_url(); ?>public/js/tipos.js"></script>                           
                <?php
                break;
            
            
            
            

            default:
                break;
        }  
        ?>
        
    </body>

</html>




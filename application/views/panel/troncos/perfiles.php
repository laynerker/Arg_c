
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Perfiles</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-lg-12">
                        <button id="crear" class="btn btn-success" type="button">Agregar</button>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>                                    
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php //var_dump($data);
                                if($data){
                                foreach ($data as $value) { 
                                    if ($value['id_perfil'] != 1) {
                                        $acceso = "block";
                                    }else{
                                        $acceso = "none";
                                    }
                                    if ($value['estatus'] == 2) {
                                        $accesoE = "block";
                                    }else{
                                        $accesoE = "none";
                                    }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value['id_perfil']; ?></td>
                                        <td><?php echo $value['perfil']; ?></td>
                                        
                                        <td id="<?php echo $value['id_perfil']; ?>">
    <button  class="btn btn-primary" title="Modificar" id="edit" type="button" style="padding: 1px 2px 0px 5px; margin-right: 3px; float: left; display: <?php echo $acceso; ?>;"> <i class="fa fa-edit" id="<?php echo $value['id_perfil'] ?>" ></i></button>
    <button  class="btn btn-success" id="reactivar" name="0" type="button" style="padding: 1px 3px 0px 4px; margin-right: 3px; float: left; display: <?php echo $accesoE; ?>;"> <i class="fa fa-check" id="<?php echo $value['id_perfil'] ?>" ></i></button>
    <button  class="btn btn-danger" id="elimi" type="button" name="<?php echo $value['estatus'] ?>" style="padding: 1px 4px 0px 5px; display: <?php echo $acceso; ?>;"> <i class="fa fa-trash-o" id="<?php echo $value['id_perfil'] ?>"></i></button>
                                        </td>

                                    </tr>
                                <?php }}else{ false; }  ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- /# myModal -->
                    <div id="myModal" class="modal fade">
            <div class="modal-dialog" style="width: 1000px;">

                <div class="modal-content">
                    <form method="post" action="" id="formTipos" name="">
                        <input type="hidden" name="id_perfil" id="id_perfil">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="titulos">Crear Nuevo perfil</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" maxlength="100" name="nombre" id="nombre" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id=""  class="btn btn-primary"></button>
                        </div>
                    </form> 
                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->
        </div>
                    <!-- /# myModal -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
            




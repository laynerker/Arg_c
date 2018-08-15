

<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-12">
            <button id="crear" class="btn btn-success" type="button">Crear Nuevo Usuario</button>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Nombre y apellido</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $value) {
                    if ($value['estatus'] == 1 or $value['estatus'] == 4) {
                        $clase = 'fa fa-power-off';
                        $title = 'Desactivar';
                    }
                    ?>
                    <tr>
                        <td><?php echo $value['nombre'] . ' ' . $value['apellido'] ?></td>
                        <td><?php echo $value['usuario'] ?></td>
                        <td><?php echo $value['correo'] ?></td>
                        <td><?php echo $value['perfil'] ?></td>
                        <td>
                            <button class="btn btn-primary" title="Modificar" id="edit" type="button" style="padding: 1px 2px 0px 5px;"> <i class="fa fa-edit" id="<?php echo $value['id_acceso'] ?>" ></i></button>
                            <?php
                            if ($value['estatus'] == 2) {
                                $clase = 'fa fa-trash-o';
                                $title = 'Eliminar';
                                ?>
                                <button class="btn btn-success" id="reactivar" title="Reactivas" name="3" type="button" style="padding: 1px 3px 0px 4px;"> <i class="fa fa-check" id="<?php echo $value['id_acceso'] ?>" ></i></button>
                    <?php } ?>
                            <button class="btn btn-danger" id="elimi" title="<?php echo $title; ?>" type="button" name="<?php echo @$value['estatus'] ?>" style="padding: 1px 4px 0px 5px;"> <i class="<?php echo $clase; ?>" id="<?php echo $value['id_acceso'] ?>"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- /# myModal -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <form method="post" action="" id="formCrear" name="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="titulos">Crear Nuevo Usuario</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_acceso" id="id_acceso">
                    <input type="hidden" name="id_persona" id="id_persona">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" maxlength="100" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Apellido</label>
                                <input type="text" maxlength="100" name="apellido" id="apellido" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label>Nac.</label>
                                <select id="nac" name="nac" class="form-control">
                                    <option value="">...</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cedula</label>
                                <input type="text" maxlength="100" name="ci" id="ci" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" maxlength="100" name="tlf" id="tlf" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" maxlength="100" name="correo" id="correo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Perfil</label>
                                <select id="perfil" name="perfil" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" maxlength="100" name="user" id="user" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" maxlength="100" name="passwd" id="passwd" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Repitir Contraseña</label>
                                <input type="password" maxlength="100" name="passwd2" id="passwd2" class="form-control">
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





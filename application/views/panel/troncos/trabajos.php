
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Base Monetaria</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <form id="formSearch" action="" method="post">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-lg-4">
                            <div class="form-group">
                                <label>Fecha Desde</label>
                                <input type="text" maxlength="100" value="<?php echo empty($data['intervalos'])?'':$data['intervalos'][0]; ?>" name="fechain" id="fechain" class="form-control">
                            </div>
                        </div>
                    <div class="col-lg-4">
                            <div class="form-group">
                                <label>Fecha Hasta</label>
                                <input type="text" maxlength="100" value="<?php echo empty($data['intervalos'])?'':$data['intervalos'][1]; ?>" name="fechaen" id="fechaen" class="form-control">
                            </div>
                        </div>
                    <div class="col-lg-4">
                        <button type="submit"  style="margin-top: 26px;" id="search" class="btn btn-primary" type="button">Buscar</button>
                        <button  style="margin-top: 26px;" id="clear" class="btn btn-primary" type="button">Limpiar</button>                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                </form>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($data['datos']){
                                foreach ($data['datos'] as $value) {                                     
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->d; ?></td>
                                        <td><?php echo $value->v; ?></td>                                        
                                    </tr>
                                <?php }}else{ false; }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
            




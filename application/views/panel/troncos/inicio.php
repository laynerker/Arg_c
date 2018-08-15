
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bienvenido <?php  echo $data["userdata"]['nombre'] . ' ' . $data["userdata"]['apellido']; ?> </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 col-md-8">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['basemonetaria']['dato']; ?> </div>
                                        <div>Base Monetaria para la fecha del <?php echo $data['basemonetaria']['date']; ?> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('routing/bandeja/trabajos'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-8">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['basemonetariausa']['dato']; ?> </div>
                                        <div>base monetaria en USD para la fecha del <?php echo $data['basemonetariausa']['date']; ?> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('routing/bandeja/bmusa'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['cotizacionUSD']['dato']; ?> </div>
                                        <div>Cotización del USD para la fecha del <?php echo $data['cotizacionUSD']['date']; ?> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('routing/bandeja/cusa'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 col-md-8">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['usd_of']['dato']; ?> </div>
                                        <div>Cotización del USD Oficial para la fecha del <?php echo $data['usd_of']['date']; ?> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('routing/bandeja/cofiusa'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-8">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['uva']['dato']; ?> </div>
                                        <div>UVA para la fecha del <?php echo $data['uva']['date']; ?> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('routing/bandeja/uva'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->


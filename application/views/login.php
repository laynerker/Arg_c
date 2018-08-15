<?php header("Access-Control-Allow-Origin: *"); ?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/logo_panel.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> <?php echo title; ?> </title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url(); ?>public/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>public/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>public/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            @import "<?php echo base_url("public/css/jquery.realperson.css"); ?>";
            label { display: inline-block; width: 20%; }
            .realperson-challenge { display: inline-block }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading" style="text-align: center;">
                            <h4 >Argentina</h4>
                        </div>
                        <div class="panel-body">
                            <form role="form" name="login" id="login" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Usuario" id="username" name="username" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" value="">
                                    </div>
                                    <div class="form-group">
                                    <input type="text" id="defaultReal" class="form-control" name="defaultReal">
                                    </div>

                                    <!-- Change this to a button or input when using this as a form -->
                                    <a  class="btn btn-lg btn-success btn-block" id="enviologin">Ingresar</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery Version 1.11.0 -->
        <script src="<?php echo base_url(); ?>public/js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>public/js/sb-admin-2.js"></script>

        <!-- Personalisado JavaScript -->
        <script> var base_url = '<?php echo base_url(); ?>';</script>
        <script src="<?php echo base_url(); ?>public/js/general.js"></script>
        <script src="<?php echo base_url(); ?>public/js/logion.js"></script>
        <script type="text/javascript" src="<?php echo base_url("public/js/jquery.realperson.js"); ?>"></script>
        <script type="text/javascript">
            $(function () {
                $('#defaultReal').realperson();
            });
        </script>

    </body>

</html>

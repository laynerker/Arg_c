<?php
$user = $this->session->userdata('userinfo');
$arra_url = explode('/', $_SERVER['REQUEST_URI']);
$inacc='collapse'; $autacc= '0px';
$inempre='collapse'; $autempre= '0px';
switch ($arra_url[4]) {
    case 'inicio':
        $inicio = 'active';
        break;
    case 'accesos':
        $accesos = 'active';
        $inacc = 'in';
        $autacc = 'auto';
        break;
    case 'perfiles':
        $perfiles = 'active';
        $inacc = 'in';
        $autacc = 'auto';
        break;
    case 'trabajos':
        $trabajos = 'active';
        break;
    case 'bmusa':
        $bmusa = 'active';
        break;
    case 'cusa':
        $cusa = 'active';
        break;
    case 'cofiusa':
        $cofiusa = 'active';
        break;
    case 'uva':
        $uva = 'active';
        break;
    default:
        break;
}
?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('routing/bandeja/inicio'); ?>"><?php echo title; ?></a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages" style="width:auto">
                <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></a>
                </li>
                
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>login/salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <?php
    ?>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="<?php echo @$inicio; ?>"  href="<?php echo base_url(); ?>routing/bandeja/inicio"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                </li>
                <?php if ($user['id_perfil'] == 1) { ?>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Acceso<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level <?php echo $inacc; ?>" style="height: <?php echo $autacc; ?>;">
                                <li>
                                    <a class="<?php echo @$accesos; ?>" href="<?php echo base_url(); ?>routing/bandeja/accesos"><i class="fa fa-lock fa-fw"></i> Usuarios</a>
                                </li>                                
                                <li>
                                    <a class="<?php echo @$perfiles; ?>" href="<?php echo base_url(); ?>routing/bandeja/perfiles"><i class="fa fa-group"></i> Perfiles</a>
                                </li>
                        </ul>
                    </li>
                    <?php }
                if ($user['id_perfil'] != 1 or $user['id_perfil'] == 1) {
                    ?>
                    <li>
                        <a class="<?php echo @$trabajos; ?>" href="<?php echo base_url(); ?>routing/bandeja/trabajos"><i class="fa fa-gear fa-fw"></i> Base Monetaria</a>
                    </li>
                    <li>
                        <a class="<?php echo @$bmusa; ?>" href="<?php echo base_url(); ?>routing/bandeja/bmusa"><i class="fa fa-gear fa-fw"></i> Base Monetaria en USA</a>
                    </li>
                    <li>
                        <a class="<?php echo @$cusa; ?>" href="<?php echo base_url(); ?>routing/bandeja/cusa"><i class="fa fa-gear fa-fw"></i> Cotización del USD</a>
                    </li>
                    <li>
                        <a class="<?php echo @$cofiusa; ?>" href="<?php echo base_url(); ?>routing/bandeja/cofiusa"><i class="fa fa-gear fa-fw"></i> Cotización USD Oficial</a>
                    </li>
                    <li>
                        <a class="<?php echo @$uva; ?>" href="<?php echo base_url(); ?>routing/bandeja/uva"><i class="fa fa-gear fa-fw"></i> UVA</a>
                    </li>
                    
                    <?php
                }
                ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
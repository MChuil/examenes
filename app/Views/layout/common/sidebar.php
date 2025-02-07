<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-question-circle"></i> <span><?= env("TITLE") ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= base_url("images/img.jpg") ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= base_url('/')  ?>"><i class="fa fa-home"></i>Inicio</a></li>    
                    <li><a href="javascript:void(0)"><i class="fa fa-question-circle"></i>Examenes</a></li>    
                    <li><a href="<?= base_url('/usuarios')  ?>"><i class="fa fa-users"></i>Usuarios</a></li>    
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a href="<?= base_url('/')  ?>" data-toggle="tooltip" data-placement="top" title="Inicio">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Examenes">
                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
            </a>
            <a href="<?= base_url('/usuarios')  ?>" data-toggle="tooltip" data-placement="top" title="Usuarios">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Salir" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <span class="font-weight-bold">
                    <?= todayDate() ?>
                </span>
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url('images/img.jpg')?>" alt=""><?= session('name') ?> <small>(<?= typeUser(session('rol')) ?>)</small>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href='<?= base_url('/perfil') ?>'> Perfil</a>
                        <form action="<?= base_url('/logout') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="dropdown-item" onclick="return confirm('¿Está seguro que desea salir?');">
                            <i class="fa fa-sign-out pull-right"></i> Salir
                        </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
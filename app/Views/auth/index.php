<?= $this->extend("layout/auth") ?>
<?= $this->section("content") ?>
<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <?= $this->include('shared/messages') ?>
            <form action="<?= base_url('login') ?>" method="post">
                <h1>Inicio de sesión</h1>
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Correo electronico" required="" value="<?= old('email') ?>" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required="" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <div class="text-right">
                    <small>
                        <a class="reset_pass text-right" href="#">¿Olvidaste tu contraseña?</a>
                    </small>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">¿Aun no tiene cuenta?
                        <a href="#signup" class="to_register"> Crear cuenta </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <p>Proyecto Escolar - <?= env("TITLE") ?> | &copy; <?= date('Y') ?></p>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <div id="register" class="animate form registration_form">
        <section class="login_content">
            <?php if ($msg = session()->getFlashdata('error_register')) { ?>
                <div class="alert alert-danger">
                    <?php
                    if (is_array($msg)) {
                        echo implode('<br>', $msg); // Mostrar los errores si son un array
                    } else {
                        echo $msg; // Mostrar el mensaje en caso contrario
                    }
                    ?>
                </div>
            <?php } ?>

            <form action="<?= base_url('usuarios/create') ?>" method="post">
                <h1>Crear Cuenta</h1>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="Nombre" required="" value="<?= old('name') ?>" />
                </div>
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required="" value="<?= old('email') ?>" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required="" value="<?= old('password') ?>" />
                </div>
                <div>
                    <input type="password" name="password_repeat" class="form-control" placeholder="Repetir contraseña" required="" value="<?= old('password_repeat') ?>" />
                </div>
                <input type="hidden" name="rol" value="user" />
                <div>
                    <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">¿Ya tienes una cuenta?
                        <a href="#signin" class="to_register"> Iniciar sesión </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <p>Proyecto Escolar - <?= env("TITLE") ?> | &copy; <?= date('Y') ?></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?= $this->endSection() ?>

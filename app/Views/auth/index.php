<?= $this->extend("layout/auth") ?>
<?= $this->section("content") ?>
<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <?php if ($msg = session()->getFlashdata('error')) { ?>
                <div class="alert alert-error">
                    <?php
                    if (is_array($msg)) { //es un array
                        echo implode('<br>', $msg);
                    } else { //si no es array
                        echo $msg;
                    }
                    ?>
                </div>
            <?php } ?>
            <form action="<?= base_url('login') ?>" method="post">
                <h1>Inicio de sesión</h1>
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Correo electronico" required="" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required="" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block" >Entrar</button>
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
            <form>
                <h1>Crear Cuenta</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <a class="btn btn-default submit" href="index.html">Submit</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Already a member ?
                        <a href="#signin" class="to_register"> Log in </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?= $this->endSection() ?>
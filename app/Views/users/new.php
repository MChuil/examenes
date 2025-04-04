<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <span class="h2"><?= $title ?></span>
                </div>
                <div class="card-body">
                    <?= $this->include('shared/messages') ?>
                    <form method="post" action="<?= base_url('usuarios/create') ?>">
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= old('name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_repeat">Repetir contraseña</label>
                            <input type="password" id="password_repeat" name="password_repeat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Tipo de usuario</label>
                            <select id="rol" name="rol" class="form-control" required>
                                <option value="" selected>Seleccione</option>
                                <option value="admin">Administrador</option>
                                <option value="student">Estudiante</option>
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

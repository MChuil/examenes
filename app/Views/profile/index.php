<?= $this->extend("layout/index") ?>

<?= $this->section("title") ?> Perfil de Usuario <?= $this->endSection() ?>

<?= $this->section("content") ?>
    <div class="container mt-4">
        <h1 class="mb-4">Perfil de Usuario</h1>
        <?= $this->include('shared/messages') ?>

        <!-- Datos del usuario -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Información Personal</h5>
                <p><strong>Nombre:</strong> <?= esc($user->name) ?></p>
                <p><strong>Email:</strong> <?= esc($user->email) ?></p>
                <p><strong>Rol:</strong> <?= esc($user->rol) ?></p>
            </div>
        </div>

        <!-- Formulario para cambiar la contraseña -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cambiar Contraseña</h5>
                <form action="<?= base_url('perfil/change-password') ?>" method="post">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

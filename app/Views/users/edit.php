<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <span class="h2"><?= $title ?></span>
                </div>
                <div class="card-body">
                    <?= $this->include('shared/messages') ?>
                    <form action="<?= base_url("usuarios/update/{$user->id}") ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $user->name ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $user->email ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <select name="rol" id="rol" class="form-control">
                                <option value="admin" <?= $user->rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
                                <option value="user" <?= $user->rol === 'user' ? 'selected' : '' ?>>Usuario</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

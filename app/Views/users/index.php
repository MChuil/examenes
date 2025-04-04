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
                    <div class="mb-3">
                        <a href="<?= base_url('usuarios/new') ?>" class="btn btn-primary">Nuevo usuario</a>
                    </div>

                    <table class="table table-bordered">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $user->id ?></td>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= ucfirst($user->rol) ?></td>
                                        <td>
                                            <a href="<?= base_url("usuarios/edit/{$user->id}") ?>" class="btn btn-warning btn-sm">Editar</a>
                                            
                                            <form action="<?= base_url("usuarios/delete/{$user->id}") ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">No hay usuarios registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

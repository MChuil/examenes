<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <span class="h2">
                        <?= $title ?>
                    </span>
                </div>
                <div class="card-body">
                    <?= $this->include('shared/messages') ?>
                    <div>
                        <a href="<?= base_url('examenes/new') ?>" class="btn btn-primary btn-sm">Nuevo Examen</a>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Examen</th>
                                <th>Creación</th>
                                <th>Ultimo cambio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($subjects)) : ?>
                                <?php foreach ($subjects as $subject) : ?>
                                    <tr>
                                        <td><?= $subject->id ?></td>
                                        <td><?= $subject->title ?></td>
                                        <td><?= $subject->created_at ?></td>
                                        <td><?= $subject->updated_at ?></td>
                                        <td>
                                            <a href="<?= base_url('examenes/show/' . $subject->id) ?>" class="btn btn-info btn-sm">Ver</a>
                                            <a href="<?= base_url('examenes/edit/' . $subject->id) ?>" class="btn btn-warning btn-sm">Editar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay examenes registrados</td>
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

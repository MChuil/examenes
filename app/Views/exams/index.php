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
                    <?php if(session()->getFlashdata('success')){ ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php } ?>
                    <div>
                        <a href="<?= base_url('examenes/new') ?>" class="btn btn-primary">Nuevo Examen</a>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Examen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($exams)) : ?>
                                <?php foreach ($exams as $exam) : ?>
                                    <tr>
                                        <td><?= $exam['id'] ?></td>
                                        <td><?= $exam['title'] ?></td>
                                        <td>
                                            <a href="<?= base_url('examenes/' . $exam['id']) ?>" class="btn btn-info">Ver</a>
                                            <a href="<?= base_url('examenes/edit/' . $exam['id']) ?>" class="btn btn-warning">Editar</a>
                                            <a href="<?= base_url('examenes/delete/' . $exam['id']) ?>" class="btn btn-danger">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">examkenes</td>
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

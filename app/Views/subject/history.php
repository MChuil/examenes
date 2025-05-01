<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= esc($title) ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <h2 class="my-4"><?= esc($title) ?></h2>

    <?php if (empty($subjects)) : ?>
        <div class="alert alert-info">Aún no has presentado ningún examen.</div>
    <?php else : ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Examen</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject): ?>
                    <tr>
                        <td><?= esc($subject->title) ?></td>
                        <td>
                             <a href="<?= base_url('alumno/historial/' . $subject->id) ?>" class="btn btn-info btn-sm">

                                Ver detalles
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

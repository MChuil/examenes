<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <h2 class="my-4">Examenes disponibles</h2>

    <?php if (empty($subjects)) : ?>
        <div class="alert alert-info">No hay examenes disponibles</div>
    <?php else : ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Titulo</th>
                    <th>Empezxar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $exam) : ?>
                    <tr>
                        <td><?= esc($exam->title) ?></td>
                        <td>
                            <a href="<?= base_url("exams/take/{$exam->id}") ?>" class="btn btn-success btn-sm">
                                Tomar examen
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

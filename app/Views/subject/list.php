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
            <th>Título</th>
            <th>Último intento</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $exam) : ?>
            <tr>
                <td><?= esc($exam->title) ?></td>
                <td>
                    <?php if ($exam->last_attempt_date): ?>
                        <?php
                            $date = new DateTime($exam->last_attempt_date, new DateTimeZone('UTC'));
                            $date->setTimezone(new DateTimeZone('America/Mexico_City'));
                        ?>
                        <span class="badge bg-success text-white fs-6 px-3 py-2 rounded">
                            Realizado el <?= $date->format('d \d\e F \d\e Y \a \l\a\s H:i') ?>
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger text-white fs-6 px-3 py-2 rounded">
                            No realizado
                        </span>
                    <?php endif; ?>
                </td>


                <td>
                    <a href="<?= base_url("alumno/examen/{$exam->id}") ?>" class="btn btn-success btn-sm">
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

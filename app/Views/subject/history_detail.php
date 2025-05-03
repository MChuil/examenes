<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= esc($title) ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <h2 class="my-4 text-center"><?= esc($subject->title) ?> - Resultado del Examen</h2>

    <?php if (empty($attempts) || empty($attempts[0])): ?>
        <div class="alert alert-info text-center">Aún no has realizado este examen.</div>
    <?php else: ?>
        <?php 
            $attempt = $attempts[0];
            $color = $attempt['percentage'] >= 70 ? 'success' : ($attempt['percentage'] >= 50 ? 'warning' : 'danger');
        ?>
        <div class="card border-<?= $color ?> shadow mb-4">
            <div class="card-header bg-<?= $color ?> text-white d-flex justify-content-between">
                <strong>Último intento</strong>
                <small><?= date('d \d\e M \d\e Y \a \l\a\s H:i', strtotime($attempt['date'])) ?></small>
            </div>
            <div class="card-body text-center">
                <p><strong>Preguntas Totales:</strong> <?= esc($attempt['total']) ?></p>
                <p><strong>Correctas:</strong> <?= esc($attempt['correct']) ?></p>
                <p><strong>Incorrectas:</strong> <?= esc($attempt['incorrect']) ?></p>

                <div class="progress my-3" style="height: 25px;">
                    <div class="progress-bar bg-<?= $color ?>" role="progressbar" style="width: <?= esc($attempt['percentage']) ?>%;" aria-valuenow="<?= esc($attempt['percentage']) ?>" aria-valuemin="0" aria-valuemax="100">
                        <?= esc($attempt['percentage']) ?>%
                    </div>
                </div>

                <?php if ($attempt['percentage'] >= 70): ?>
                    <p class="text-success fs-5"><i class="fa fa-check-circle"></i> ¡Aprobado!</p>
                <?php else: ?>
                    <p class="text-danger fs-5"><i class="fa fa-times-circle"></i> Reprobado</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="text-center">
        <a href="<?= base_url('/alumno/historial') ?>" class="btn btn-primary mt-3">
            <i class="fa fa-arrow-left"></i> Volver al historial
        </a>
    </div>
</div>

<?= $this->endSection() ?>

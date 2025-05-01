<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= esc($title) ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container text-center">
    <h2 class="my-4"><?= esc($subject->title) ?></h2>

    <div class="card">
        <div class="card-body">
            <h3>Resultados</h3>
            <p><strong>Preguntas Totales:</strong> <?= esc($totalQuestions) ?></p>
            <p><strong>Correctas:</strong> <?= esc($correctAnswers) ?></p>
            <p><strong>Incorrectas:</strong> <?= esc($incorrectAnswers) ?></p>
            <p><strong>Porcentaje:</strong> <?= esc($percentage) ?>%</p>
        </div>
    </div>

    <a href="<?= base_url('/alumno/historial') ?>" class="btn btn-primary mt-4">Volver al historial</a>
</div>

<?= $this->endSection() ?>

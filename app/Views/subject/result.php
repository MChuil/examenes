<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= esc($title) ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container text-center">
    <h2 class="my-4"><?= esc($title) ?></h2>

    <div class="card">
        <div class="card-body">
            <h3>Resultados</h3>
            <p><strong>Respuestas Correctas:</strong> <?= esc($correctCount) ?></p>
            <p><strong>Respuestas Incorrectas:</strong> <?= esc($incorrectCount) ?></p>
            <p><strong>Total de Preguntas:</strong> <?= esc($totalQuestions) ?></p>
            <p><strong>Porcentaje de Aciertos:</strong> <?= esc($percentage) ?>%</p>
        </div>
    </div>

    <a href="<?= base_url('/alumno/examenes') ?>" class="btn btn-primary mt-4">Volver a los exámenes</a>
</div>

<?= $this->endSection() ?>

<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= esc($title) ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <h2 class="my-4"><?= esc($subject->title) ?></h2>

    <form action="<?= base_url("alumno/examen/guardar/{$subject->id}") ?>" method="post">
        <?= csrf_field() ?>

        <?php if (empty($questions)) : ?>
            <div class="alert alert-info">No hay preguntas para este examen.</div>
        <?php else : ?>
            <?php foreach ($questions as $index => $question): ?>
                <div class="mb-4">
                    <h5><?= ($index + 1) . '. ' . esc($question->question) ?></h5>

                    <?php foreach ($question->choices as $choice): ?>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answers[<?= $question->id ?>]" 
                                id="choice_<?= $choice->id ?>" 
                                value="<?= $choice->id ?>" 
                                required
                            >
                            <label class="form-check-label" for="choice_<?= $choice->id ?>">
                                <?= esc($choice->choice_text) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Enviar respuestas</button>
        <?php endif; ?>
    </form>
</div>

<?= $this->endSection() ?>

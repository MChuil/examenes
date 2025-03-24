<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <span class="h2"><?= $subject->title ?></span>
                </div>
                <div class="card-body">
                    <?php if ($msg = session()->getFlashdata('errors')) { ?>
                        <div class="alert alert-danger">
                            <?php
                            if (is_array($msg)) { //es un array
                                echo implode('<br>', $msg);
                            } else { //si no es array
                                echo $msg;
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <?php if ($msg = session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?= $msg ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?= base_url('preguntas/create') ?>">
                        <h4>Preguntas</h4>
                        <div id="questions-container">
                            <div class="question-item">
                                <label>Pregunta:</label>
                                <input type="text" name="question" class="form-control" value="<?= old('question') ?>" required>
                                <input type="hidden" name="subject_id" class="form-control" value="<?= $subject->id ?>">

                                <div class="answers mt-2">
                                    <label>Opciones:</label>
                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                        <div class="input-group mb-2">
                                            <input type="text" name="choice-<?= $i ?>" value="<?= old("choice-$i") ?>" class="form-control" placeholder="Opción <?= $i + 1 ?>">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <input type="radio" name="choice-correct" value="<?= $i ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <span class="h2">Preguntas existentes</span>
                    </div>
                    <div class="card-body">
                        <?php
                        $questionsGrouped = [];
                        foreach($dataQuestions as $row) {
                            $questionsGrouped[$row->question][] = $row;
                        }

                        foreach($questionsGrouped as $questionText => $options) { ?>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><?= $questionText ?></h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php foreach($options as $option) { ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $option->choice_text ?>
                                                <?php if ($option->is_correct == "1") { ?>
                                                    <span class="badge badge-success">Correcta</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Incorrecta</span>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
       </div>
</div>

<?php echo json_encode($dataQuestions); ?>

<?= $this->endSection() ?>
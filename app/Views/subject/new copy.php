<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <span class="h2"><?= $title ?></span>
                    </div>
                    <div class="card-body">
                        <?php if(session()->getFlashdata('error')){ ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php } ?>

                        <form method="post" action="<?= base_url('examenes/create') ?>">
                            <div class="form-group">
                                <label for="title">Título del Examen</label>
                                <input type="text" id="title" name="title" class="form-control" required value="<?= old('title') ?>">
                            </div>

                            <hr>
                            <h4>Preguntas</h4>
                            <div id="questions-container">
                                <div class="question-item">
                                    <label>Pregunta:</label>
                                    <input type="text" name="questions[0][text]" class="form-control" required>

                                    <div class="answers mt-2">
                                        <label>Opciones:</label>
                                        <?php for ($i = 0; $i < 4; $i++) { ?>
                                            <div class="input-group mb-2">
                                                <input type="text" name="questions[0][answers][<?= $i ?>][text]" class="form-control" required placeholder="Opción <?= $i + 1 ?>">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <input type="radio" name="questions[0][correct]" value="<?= $i ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Guardar Examen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?= $this->endSection() ?>

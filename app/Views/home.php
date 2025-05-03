<?= $this->extend("layout/index") ?>

<?= $this->section("title") ?> Inicio <?= $this->endSection() ?>

<?= $this->section("content") ?>
    <h1 class="mb-4">Bienvenido al sistema de Exámenes On-line</h1>

    <?php if ($isAdmin): ?>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card shadow border-primary">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Total de Estudiantes</h5>
                    </div>
                    <div class="card-body text-center">
                        <span class="display-6"><?= esc($totalStudent) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h5>Total de Exámenes</h5>
                    </div>
                    <div class="card-body text-center">
                        <span class="display-6"><?= esc($totalSubjects) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-warning">
                    <div class="card-header bg-warning text-dark text-center">
                        <h5>Exámenes Tomados</h5>
                    </div>
                    <div class="card-body text-center">
                        <span class="display-6"><?= esc($totalAnswers) ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4">
            Inicia un examen desde el menú de navegación.
        </div>
    <?php endif; ?>

<?= $this->endSection() ?>

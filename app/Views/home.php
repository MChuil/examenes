<?= $this->extend("layout/index") ?>

<?= $this->section("title") ?> Inicio <?= $this->endSection() ?>

<?= $this->section("content") ?>
    <h1>Bienvenido al sistema de Examenes On-line</h1>

    
    <div class="row">
        <div class="col-12 d-flex justify-content-around">
            <div class="card">
                <div class="card-header">
                    <h4>Total de Estudiantes</h4>
                </div>
                <div class="card-body text-center">
                    <span class="h1"><?= $totalStudent ?></span>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Total de Examenes</h4>
                </div>
                <div class="card-body">
                    <span>8</span>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Total de Examenes Tomados</h4>
                </div>
                <div class="card-body">
                    <span>1</span>
                </div>
            </div>

        </div>

    </div>

<?= $this->endSection() ?>
<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <span class="h2">
                            <?= $title ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <?php if(session()->getFlashdata('success')){ ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                        <?php } ?>
                        <div>
                            <a href="<?= base_url('usuarios/new') ?>" class="btn btn-primary">Nuevo usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
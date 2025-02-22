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
                        <?php if($msg = session()->getFlashdata('errors')){ ?>
                            <div class="alert alert-danger">
                                <?php 
                                    if(is_array($msg)){ //es un array
                                        echo implode('<br>', $msg);
                                    }else{ //si no es array
                                        echo $msg;
                                    }
                                ?>
                            </div>
                        <?php } ?>
                        <form method="post" action="<?= base_url('examenes/create') ?>">
                            <div class="form-group">
                                <label for="title">Título del Examen</label>
                                <input type="text" id="title" name="title" class="form-control" required value="<?= old('title') ?>">
                            </div>
                            <hr>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?= $this->endSection() ?>

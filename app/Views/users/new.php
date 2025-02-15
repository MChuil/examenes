<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <span class="h2">
                        <?= $title ?>
                    </span>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('error')){ ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                    <?php } ?>

                    <?= validation_list_errors() ?>
                    
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post" action="<?= base_url('usuarios/create') ?>">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" name="name" required="required" class="form-control" value="<?= old('name') ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Coreo electronico <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="email" id="email" name="email" required="required" class="form-control"  value="<?= old('email') ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password" class="col-form-label col-md-3 col-sm-3 label-align">Contraseña</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="password" class="form-control" type="password" name="password" required="required"  value="<?= old('password') ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password_repeat" class="col-form-label col-md-3 col-sm-3 label-align">Repetir contraseña</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="password_repeat" class="form-control" type="password" name="password_repeat" required="required"  value="<?= old('password_repeat') ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="rol" class="col-form-label col-md-3 col-sm-3 label-align">Tipo de usuario</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" id="rol" name="rol">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="admin">Administrador</option>
                                    <option value="user">Alumno</option>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group mt-3">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-danger" type="reset">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
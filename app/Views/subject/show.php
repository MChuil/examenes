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
                                            <input type="text" name="choice-<?= $i ?>" value="<?= old("choice-$i") ?>" class="form-control" placeholder="Opción <?= $i ?>">
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
                                                <div>
                                                    <?= $option->choice_text ?>
                                                    <?php if ($option->is_correct == "1") { ?>
                                                        <span class="badge badge-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target=".edit-choice" onclick="loadChoice(<?= $option->choice_id ?>)"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                                    <form action ="<?= base_url('respuestas/delete')?>/<?= $option->choice_id ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta respuesta?');">
                                                        <button type= "submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="#" class="btn btn-info btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>

                                        <form action ="<?= base_url('preguntas/delete')?>/<?= $options[0]->id ?>" method="post"  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta pregunta y todas sus respuestas?');">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
       </div>
</div>
<?= $this->include('subject/modals/edit_choice') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        function loadChoice(id){
            fetch("<?= base_url('respuestas/show')?>/" + id)
            .then(response => response.text())
            .then(data =>{
                data = JSON.parse(data)
                console.log(data)
                document.querySelector("#choice_text").value = data.choice_text
                document.querySelector("#idChoice").value = data.id
                if(data.is_correct == "1"){
                    document.querySelector("#is_correct").checked = true
                }else{
                    document.querySelector("#is_correct").checked = false
                }
            })
        }
    </script>
<?= $this->endSection() ?>
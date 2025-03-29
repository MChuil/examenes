<div class="modal fade edit-choice" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Editar respuesta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="editChoiceForm" method="post" action="<?= base_url('respuestas/update') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="choice_text">Respuesta</label>
                        <input type="text" class="form-control" name="choice_text" id="choice_text" required>
                    </div>

                    <div class="form-group">
                        <label for="is_correct">Correcta</label>
                        <input type="checkbox" name="is_correct" id="is_correct">
                    </div>

                    <input type="hidden" name="id" id="idChoice">
                </div>

               
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="editChoiceForm">Actualizar</button>
                </div>
            </form>


        </div>
    </div>
</div>
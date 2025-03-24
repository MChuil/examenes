<div class="modal fade edit-choice" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Editar respuesta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Respuesta</label>
                        <input type="text" class="form-control" name="choice_text" id="choice_text">
                    </div>
                    <div class="form-group">
                        <label for="">Correcta</label>
                        <input type="checkbox"  name="is_correct" id="is_correct">
                    </div>
                    <input type="hidden" name="id" id="idChoice">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Actualizar</button>
            </div>

        </div>
    </div>
</div>
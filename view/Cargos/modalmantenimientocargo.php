<div id="modalcargos" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="cargo_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cargo_id" name="cargo_id">

                    <div class="form-layout form-layout-4">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" id="cargo_nom" name="cargo_nom" placeholder="Ingrese el nombre del cargo" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Descripción: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" id="cargo_desc" name="cargo_desc" placeholder="Ingrese una descripción del cargo" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal" >Cerrar</button>
                    <button type="submit" name="action" id="btnagregar" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

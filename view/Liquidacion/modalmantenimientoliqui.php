<div id="modalliqui" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" id="liquidacion_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="liqui_id" name="liqui_id">
                    <div class="form-layout form-layout-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control mg-t-5" id="liqui_nom" name="liqui_nom" placeholder="Ingrese un nombre " required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                                    <textarea type="text" class="form-control mg-t-5" id="liqui_desc" name="liqui_desc" placeholder="Ingrese una descripción " style="height: 120px" required></textarea>
                                </div>
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

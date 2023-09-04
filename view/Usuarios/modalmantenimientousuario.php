<div id="modalmantenimientousuario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="usuario_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="us_id" name="us_id">


                    <div class="form-layout form-layout-4">
                        <div class="row">
                        <label class="col-sm-4 form-control-label">Nombres: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="us_nom" name="us_nom" placeholder="Ingrese su Nombre" required>
                        </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Apellido : <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="us_ape" name="us_ape" placeholder="Ingrese su Apellido" required>
                        </div>
                        </div>
                        <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Usuario: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="us_alias" name="us_alias" placeholder="Ingrese su Usuario" required>
                        </div>
                        </div>
                        <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="us_pass" name="us_pass" placeholder="Ingrese su Contraseña" required>
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


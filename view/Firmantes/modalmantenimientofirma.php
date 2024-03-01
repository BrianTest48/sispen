<div id="modalfirma" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="firma_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="firma_id" name="firma_id">


                    <div class="form-layout form-layout-4">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">RUC Empresa: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" id="firma_ruc" name="firma_ruc" placeholder="Ingrese el Ruc" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Nombres: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" id="firma_nom" name="firma_nom" placeholder="Ingrese su Nombre" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">DNI: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="number" class="form-control" id="firma_dni" name="firma_dni" placeholder="Ingrese su DNI" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Cargo: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" name="id_cargo" id="id_cargo" data-placeholder="Seleccione" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Fecha Inicio: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="date" class="form-control" id="firma_f_inicio" name="firma_f_inicio" placeholder="" required>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Fecha Fin: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="date" class="form-control" id="firma_f_fin" name="firma_f_fin" placeholder="" >
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Estado: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" name="firma_estado" id="firma_estado" data-placeholder="Seleccione" style="width: 100%" required>
                                    <option label='Seleccione'></option>
                                    <option value="VIVO">VIVO</option>
                                    <option value="FALLECIDO">FALLECIDO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Fecha Fallecimiento:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="date" class="form-control" id="firma_f_falle" name="firma_f_falle" placeholder="">
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


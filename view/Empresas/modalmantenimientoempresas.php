<div id="modalmantenimientoempresas" class="modal fade" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <form method="post" id="empresa_form">
                <div class="modal-header  pd-x-20">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-20">
                    <input type="hidden" id="emp_id" name="emp_id">
                    <div class="form-layout form-layout-1">
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Tipo : <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="emp_tipo" id="emp_tipo" data-placeholder="Seleccione" style="width: 100%" required>
                                        <option value="P">P</option>
                                        <option value="M">M</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">R.U.C : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" name="emp_ruc" id="emp_ruc"  placeholder="Ingrese RUC" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Razon Social: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_razonsocial" id="emp_razonsocial"  placeholder="Ingrese Razon Social" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Direccion: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_direccion" id="emp_direccion" placeholder="Ingrese Direccion" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label class="form-control-label">Departamento: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_dpto" id="emp_dpto"  placeholder="Ingrese Departamento" required>
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Provincia: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_prov" id="emp_prov" placeholder="Ingrese Provincia" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label class="form-control-label">Distrito: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_dist" id="emp_dist" placeholder="Ingrese Distrito" required>
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">Inicio de Actividades: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="emp_ini_act" id="emp_ini_act" placeholder="" required>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">Fin de Actividades: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="emp_fin_act" id="emp_fin_act" placeholder="" required>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Representant Legal: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_rep_legal" id="emp_rep_legal" placeholder="Ingrese Representante Legal" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-3">
                                <div class="form-group ">
                                    <label class="form-control-label">D.N.I Rep. Legal: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" name="emp_dni" id="emp_dni" placeholder="Ingrese D.N.I" >
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-3">
                                <div class="form-group ">
                                    <label class="form-control-label">Fecha de Inicio R. Legal</label>
                                    <input class="form-control" type="date" name="emp_fech_rep_legal" id="emp_fech_rep_legal" placeholder="" >
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Segundo Representante</label>
                                    <input class="form-control" type="text" name="emp_seg_rep" id="emp_seg_rep" placeholder="Ingrese Otro Represetante">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-3">
                                <div class="form-group ">
                                    <label class="form-control-label">D.N.I Representante</label>
                                    <input class="form-control" type="number" name="emp_dni_seg_rep" id="emp_dni_seg_rep" placeholder="Ingrese D.N.I ">
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-3">
                                <div class="form-group ">
                                    <label class="form-control-label">Fecha de Inicio R. Legal</label>
                                    <input class="form-control" type="date" name="emp_fech_seg_rep_legal" id="emp_fech_seg_rep_legal" placeholder="">
                                </div>
                            </div><!-- col-3 -->
                        </div><!-- row -->
                    </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal"  >Cerrar</button>
                    <button type="submit" name="action" id="btnagregar" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

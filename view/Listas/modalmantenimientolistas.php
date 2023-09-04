<div id="modalmantenimientolistas" class="modal fade" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content tx-size-sm">
            <form method="post" id="lista_form">
                <div class="modal-header  pd-x-20">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-20">
                    <input type="hidden" id="lista" name="lista">
                    <input type="hidden" id="af_id" name="af_id">
                    <input type="hidden" id="tipo" name="tipo">
                    <input type="hidden" id="txtdate" name="txtdate">
                    <div class="form-layout form-layout-1">
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Nombre : </label>
                                    <input class="form-control" type="text" id="nombre_af" name="nombre_af"   placeholder="" disabled>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Documento : </label>
                                    <input class="form-control" type="text" id="documento" name="documento"   placeholder="" disabled>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cantidad de Empresas : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" id="txtcant_emp" name="txtcant_emp"  placeholder="Ingrese Cantidad" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="card mg-b-10">
                                <div class="card-header pd-b-0">
                                    <h6 class="card-title mg-b-5">Empresa 1</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">R.U.C  : <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="ruc1" id="ruc1"  placeholder="Ingrese RUC" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Inicio: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="fech1" name="fech1"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Final: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="fech_final_1" name="fech_final_1"   required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 cargos_empresa" type="text" id="cargo1" name="cargo1" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Firmante: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="firmante_emp_1" name="firmante_emp_1" placeholder="Ingrese Firmante"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 logos_empresa" type="text" id="logo_emp_1" name="logo_emp_1" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                    </div>
                                </div>  
                            </div>
                            <div class="card mg-b-10">
                                <div class="card-header pd-b-0">
                                    <h6 class="card-title mg-b-5">Empresa 2</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">R.U.C  : <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="ruc_emp_2" id="ruc_emp_2"  placeholder="Ingrese RUC" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Inicio: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_inicio_2" name="f_inicio_2"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Final: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_final_2" name="f_final_2"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 cargos_empresa" type="text" id="cargo_emp_2" name="cargo_emp_2" style="width: 100%"  required></select>
                                            </div>
                                        </div><!-- col-8 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Firmante: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="firmante_emp_2" name="firmante_emp_2" placeholder="Ingrese Firmante"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 logos_empresa" type="text" id="logo_emp_2" name="logo_emp_2" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                    </div>
                                </div>  
                            </div>
                            <div class="card mg-b-10">
                                <div class="card-header pd-b-0">
                                    <h6 class="card-title mg-b-5">Empresa 3</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">R.U.C  : <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="ruc_emp_3" id="ruc_emp_3"  placeholder="Ingrese RUC" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Inicio: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_inicio_3" name="f_inicio_3" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Final: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_final_3" name="f_final_3"   required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 cargos_empresa" type="text" id="cargo_emp_3" name="cargo_emp_3" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Firmante: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="firmante_emp_3" name="firmante_emp_3" placeholder="Ingrese Firmante"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 logos_empresa" type="text" id="logo_emp_3" name="logo_emp_3" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                    </div>
                                </div>  
                            </div>
                            <div class="card mg-b-10">
                                <div class="card-header pd-b-0">
                                    <h6 class="card-title mg-b-5">Empresa 4</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">R.U.C  : <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="ruc_emp_4" id="ruc_emp_4"  placeholder="Ingrese RUC" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Inicio: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_inicio_4" name="f_inicio_4" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Final: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_final_4" name="f_final_4"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 cargos_empresa" type="text" id="cargo_emp_4" name="cargo_emp_4" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Firmante: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="firmante_emp_4" name="firmante_emp_4" placeholder="Ingrese Firmante"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 logos_empresa" type="text" id="logo_emp_4" name="logo_emp_4" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                    </div>
                                </div>  
                            </div>
                            <div class="card mg-b-10">
                                <div class="card-header pd-b-0">
                                    <h6 class="card-title mg-b-5">Empresa 5</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">R.U.C  : <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="ruc_emp_5" id="ruc_emp_5"  placeholder="Ingrese RUC" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Inicio: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_inicio_5" name="f_inicio_5" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">F. Final: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" id="f_final_5" name="f_final_5"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 cargos_empresa" type="text" id="cargo_emp_5" name="cargo_emp_5" style="width: 100%"  required></select>
                                            </div>
                                        </div><!-- col-8 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Firmante: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="firmante_emp_5" name="firmante_emp_5" placeholder="Ingrese Firmante"  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2 logos_empresa" type="text" id="logo_emp_5" name="logo_emp_5" style="width: 100%"  required> </select>
                                            </div>
                                        </div><!-- col-8 -->
                                    </div>
                                </div>  
                            </div>
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

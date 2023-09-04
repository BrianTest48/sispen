<div id="modalmantenimientosalario" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <form method="post" id="salario_form">
                <div class="modal-header pd-x-20">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body pd-20">
                    <input type="hidden" id="sal_id" name="sal_id">

                    <div class="form-layout form-layout-1">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha Inicio : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="sal_f_inicio" id="sal_f_inicio"  placeholder="Ingrese Fecha de Inicio" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Fecha Final: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="sal_f_final" id="sal_f_final"  placeholder="Ingrese Razon Social" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="sal_moneda" >Moneda: <span class="tx-danger">*</span></label>
                                   <!-- <input class="form-control" type="text" name="sal_moneda" id="sal_moneda"  placeholder="Ingrese Tipo de Moneda" required>-->
                                    <select class="form-control select2" name="sal_moneda" id="sal_moneda" data-placeholder="Seleccione" style="width: 100%" required> 
                                        <option label="Seleccione"></option>
                                        <option value="S/.">S/.</option>
                                        <option value="I/.">I/.</option>
                                        <option value="I/m.">I/m.</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">Sueldo Minimo: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_minimo" id="sal_minimo"  placeholder="Ingrese Sueldo Minimo" required>
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Seguro Social(Aporte Trabajador): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_ss_ap_tra" id="sal_ss_ap_tra" placeholder="Ingrese Seguro Social Trabajador" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">FONAVI(Aporte Trabajador): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_fonavi_ap_tra" id="sal_fonavi_ap_tra" placeholder="Ingrese FONAVI Trabajador" required>
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">Pension(Aporte Trabajador): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_p_ap_tra" id="sal_p_ap_tra" placeholder="Ingrese Pension  Trabajador" required >
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Seg. Social(Aporte Patrono):  <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_ss_ap_pat" id="sal_ss_ap_pat" placeholder="Ingrese Seguro Social Patrono" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">Pension(Aporte Patrono): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_p_ap_pat" id="sal_p_ap_pat" placeholder="Ingrese Pension Patrono" required>
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label class="form-control-label">FONAVI(Aporte Patrono): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sal_fonavi_ap_pat" id="sal_fonavi_ap_pat" placeholder="Ingrese FONAVI Patrono" required>
                                </div>
                            </div><!-- col-8 -->
                            
                        </div><!-- row -->
                    </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal" >Cerrar</button>
                    <button type="submit" name="action" id="btnagregar" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

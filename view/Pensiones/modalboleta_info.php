<div id="modalboleta_info" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <!--<form method="post" id="firma_form">-->
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo_info"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="" name="">
                    <div class="form-layout form-layout-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">Sueldo: </label>
                                    <input class="form-control col-lg-6" type="number" name="sueldo_boleta_info" id="sueldo_boleta_info"  oninput="calcularTotalBoletaInfo()"  placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">REM. Vacacional: </label>
                                    <input class="form-control col-lg-6" type="number" name="rm_vacacional_boleta_info" id="rm_vacacional_boleta_info"  oninput="calcularTotalBoletaInfo()"   placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">Reintegro: </label>
                                    <input class="form-control col-lg-6" type="number" name="reintegro_boleta_info" id="reintegro_boleta_info" oninput="calcularTotalBoletaInfo()"   placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">H. Extras: </label>
                                    <input class="form-control col-lg-6" type="number" name="horaex_boleta_info" id="horaex_boleta_info" oninput="calcularTotalBoletaInfo()"   placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">Bonificacion: </label>
                                    <input class="form-control col-lg-6" type="number" name="boni_boleta_info" id="boni_boleta_info" oninput="calcularTotalBoletaInfo()"   placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="row mg-b-5">
                                    <label class="form-control-label col-lg-6">Otros: </label>
                                    <input class="form-control col-lg-6" type="number" name="otros_boleta_info" id="otros_boleta_info" oninput="calcularTotalBoletaInfo()"   placeholder="" >
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_info" >Cerrar</button>
                   <!-- <button type="submit" name="action" id="btnagregar" value="add" class="btn btn-rounded btn-primary">Guardar</button>-->
                </div>
            <!--</form>-->
        </div>
    </div>
</div>


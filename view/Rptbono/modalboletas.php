<div id="modalboletas" class="modal fade">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <!--<form method="post" id="firma_form">-->
            <div class="modal-header">
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="" name="">
                <div class="form-layout form-layout-4">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                        <p>DNI - <span id="dni_cal_bono">0000000</span>  /  <span id="fecha_inicio_bol"></span> / <span id="fecha_final_bol"></span> / Edad: <span id="edad_actual_afiliado"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-12">
                            <p class="font-weight-bold">Calculo de Bono</p>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Sueldo</p>
                                </div>
                                <div class="col-6">
                                    <p id="prom_meses"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Meses</p>
                                </div>
                                <div class="col-6">
                                    <p id="cant_meses_bono"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Constante</p>
                                </div>
                                <div class="col-6">
                                    <p>0.1831</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Total</p>
                                </div>
                                <div class="col-6">
                                    <p id="prom_total"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Variable</p>
                                </div>
                                <div class="col-6">
                                    <input type="number" id="variable" value="1" step="0.0001" style="width: 100%; text-align: right;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-end ">
                        <div class="col-lg-3 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="font-weight-bold">Monto Final</p>
                                </div>
                                <div class="col-6">
                                    <p  class="font-weight-bold text-right" id="monto_final"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-wrapper">
                                <table class="table display responsive nowrap" id="tabla_boleta" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Conceptos</th>
                                            <th>Dic - 91</th>
                                            <th>Ene - 92</th>
                                            <th>Feb - 92</th>
                                            <th>Mar - 92</th>
                                            <th>Abr - 92</th>
                                            <th>May - 92</th>
                                            <th>Jun - 92</th>
                                            <th>Jul - 92</th>
                                            <th>Ago - 92</th>
                                            <th>Sep - 92</th>
                                            <th>Oct - 92</th>
                                            <th>Nov - 92</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sueldo</td>
                                            <td><input id="dic_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"></td>
                                            <td><input id="jul_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jul')"></td>
                                            <td><input id="ago_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_1" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                        <tr>
                                            <td>RM. Vacacional</td>
                                            <td><input id="dic_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"'></td>
                                                <td><input id="jul_2" class="table_row conceptos" type="text" value="0"  oninput="Sumarmonto(' jul')"></td>
                                            <td><input id="ago_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_2" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                        <tr>
                                            <td>Reintegro</td>
                                            <td><input id="dic_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"></td>
                                            <td><input id="jul_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jul')"></td>
                                            <td><input id="ago_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_3" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                        <tr>
                                            <td>H. Extras</td>
                                            <td><input id="dic_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"></td>
                                            <td><input id="jul_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jul')"></td>
                                            <td><input id="ago_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_4" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                        <tr>
                                            <td>Bonificacion</td>
                                            <td><input id="dic_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"></td>
                                            <td><input id="jul_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jul')"></td>
                                            <td><input id="ago_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_5" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td><input id="dic_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('dic')"></td>
                                            <td><input id="ene_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ene')"></td>
                                            <td><input id="feb_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('feb')"></td>
                                            <td><input id="mar_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('mar')"></td>
                                            <td><input id="abr_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('abr')"></td>
                                            <td><input id="may_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('may')"></td>
                                            <td><input id="jun_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jun')"></td>
                                            <td><input id="jul_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('jul')"></td>
                                            <td><input id="ago_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('ago')"></td>
                                            <td><input id="sep_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('sep')"></td>
                                            <td><input id="oct_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('oct')"></td>
                                            <td><input id="nov_6" class="table_row conceptos" type="text" value="0" oninput="Sumarmonto('nov')"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td><span id="dic_total" class="totalmesboleta"></span></td>
                                            <td><span id="ene_total" class="totalmesboleta"></span></td>
                                            <td><span id="feb_total" class="totalmesboleta"></span></td>
                                            <td><span id="mar_total" class="totalmesboleta"></span></td>
                                            <td><span id="abr_total" class="totalmesboleta"></span></td>
                                            <td><span id="may_total" class="totalmesboleta"></span></td>
                                            <td><span id="jun_total" class="totalmesboleta"></span></td>
                                            <td><span id="jul_total" class="totalmesboleta"></span></td>
                                            <td><span id="ago_total" class="totalmesboleta"></span></td>
                                            <td><span id="sep_total" class="totalmesboleta"></span></td>
                                            <td><span id="oct_total" class="totalmesboleta"></span></td>
                                            <td><span id="nov_total" class="totalmesboleta"></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div><!-- row -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal">Cerrar</button>
                <!-- <button type="submit" name="action" id="btnagregar" value="add" class="btn btn-rounded btn-primary">Guardar</button>-->
            </div>
            <!--</form>-->
        </div>
    </div>
</div>
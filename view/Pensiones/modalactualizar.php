<div id="modalactualizar" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <!--<form method="post" id="firma_form">-->
                <div class="modal-header">
                    <h4 class="modal-title">Datos de la Empresa</h4>
                    <input type="hidden" name="ruc_empresa_firmante" id="ruc_empresa_firmante">
                    <input type="hidden" name="num_tab" id="num_tab">
                </div>
                <div class="modal-body">

                    <div class="form-layout form-layout-4">
                        <h4 id="lb_razon">DESMONTADORA CIALA</h4>
                        <div class="row">
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">RUC: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_ruc"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Departamento: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_depa"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Provincia: </label>
                            </div>
                            <div class="col-3">
                                <label  style="color: black;" for="" class="form-label" id="lb_prov"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Distrito: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_dist"></label>
                            </div>
                            <div class="col-3">
                                <label  style="color: black;"for="" class="form-label">Direccion: </label>
                            </div>
                            <div class="col-9">
                                <label style="color: black;" for="" class="form-label" id="lb_direccion"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Estado: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_estado"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Condicion: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_condicion"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Fecha Inicio: </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_fecha_ini"></label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label">Fecha Fin : </label>
                            </div>
                            <div class="col-3">
                                <label style="color: black;" for="" class="form-label" id="lb_fecha_fin"></label>
                            </div>
                            
                        </div>
                        <br>
                        <h4>Representantes Legales</h4>
                        <div class="row">
                           <div class="col-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Tipo de Doc</th>
                                            <th>Nro. Documento</th>
                                            <th>Nombre</th>
                                            <th>Cargo</th>
                                            <th>Fecha Desde</th>
                                        </tr>
                                    </thead>
                                    <tbody id="div_firmante_actualizar">

                                    </tbody>
                                </table>
                           </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_cerrar_actualizar" onclick="CerrarFirmanteActualizar()" >Cerrar</button>
                    <button type="button"  id="btnseleccionar" onclick="ActualizarFirmante()"  class="btn btn-rounded btn-primary">Actualizar</button>
                </div>
            <!--</form>-->
        </div>
    </div>
</div>


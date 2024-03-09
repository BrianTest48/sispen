<div id="modalconsulta" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
           
            <div class="modal-header">
                <h4 class="modal-title" >Datos de la Empresa</h4>
            </div>
            <div class="modal-body">
                <div class="form-layout form-layout-4">
                   <div class="row">
                        <label class="col-sm-4 form-control-label">RUC Empresa: </label>
                        <div class="col-6 col-sm-5">
                            <input class="form-control" type="number" name="int_ruc" id="int_ruc" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                        <div class="col-6 col-sm-2" style="padding-left : 0">
                            <button type="button" onclick="BuscarRuc()" id="btn_busqueda" class="btn btn-outline-primary btn-icon" style="width:100%;">
                                <div style="width:100%;">
                                    <i class="fa fa-search"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <br><br>
                    <div class="row" id="div_response">
                        <h4>Representantes Legales - Local </h4>
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
                                <tbody id="div_firmantes">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="div_response_sunat">
                        <h4>Representantes Legales - SUNAT </h4>
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
                                <tbody id="div_firmante_sunat">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" id="btnclosemodalconsulta" >Cerrar</button>
                <button type="button" id="btnagregar_acip" onclick="ActualizarFirmante()"  class="btn btn-rounded btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<div id="modalfirmante" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <!--<form method="post" id="firma_form">-->
                <div class="modal-header">
                    <h4 class="modal-title">Firmantes</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="num_empresa" name="num_empresa">
                    <div class="form-layout form-layout-4">
                        <div class="row">
                           <div class="col-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Final</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="div_firmante">

                                    </tbody>
                                </table>
                           </div>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_firmante" onclick="CerrarFirmante()" >Cerrar</button>
                    <button type="button"  id="btnseleccionar" onclick="SeleccionarFirmante()"  class="btn btn-rounded btn-primary">Seleccionar</button>
                </div>
            <!--</form>-->
        </div>
    </div>
</div>


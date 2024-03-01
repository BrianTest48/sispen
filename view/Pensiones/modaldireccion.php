<div id="modaldireccion" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <!--<form method="post" id="firma_form">-->
                <div class="modal-header">
                    <h4 class="modal-title">Direcciones</h4>
                </div>
                <div class="modal-body">
                    <!-- <input type="hidden" id="num_empresa" name="num_empresa"> -->
                    <div class="form-layout form-layout-4">
                        <div class="row">
                           <div class="col-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Direccion</th>
                                            <th>Departamento</th>
                                            <th>Provincia</th>
                                            <th>Distrito</th>
                                        </tr>
                                    </thead>
                                    <tbody id="div_direccion">

                                    </tbody>
                                </table>
                           </div>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_direccion" onclick="CerrarDireccion()" >Cerrar</button>
                    <button type="button"  id="btnseleccionar" onclick="SeleccionarDireccion()"  class="btn btn-rounded btn-primary">Seleccionar</button> 
                </div>
            <!--</form>-->
        </div>
    </div>
</div>


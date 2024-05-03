<div id="modalempresas" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
            <div class="modal-header">
                <h4 class="modal-title">Seleccion de Empresas</h4>
            </div>
            <div class="modal-body" >
                <input type="text" id="searchInput" class="form-control mb-2" placeholder="Buscar empresa...">
                <input type="hidden" name="val_number_emp" id="val_number_emp">
                <div class="form-layout form-layout-4">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm" style="width: 600px">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ruc</th>
                                        <th>Raz. Social</th>
                                    </tr>
                                </thead>
                                <tbody id="div_empresas">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-6">
                             <!-- Botones de paginación -->
                             <div id="paginacion" class="pagination-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               
                <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_empresa">Cerrar</button>
                <button type="button" onclick="SeleccionarEmpresa()" class="btn btn-rounded btn-primary">Seleccionar</button>
            </div>
        </div>
    </div>
</div>

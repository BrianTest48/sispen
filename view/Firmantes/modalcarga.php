<div id="modalcargamasiva" class="modal fade" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content tx-size-sm">
          
            <div class="modal-header  pd-x-20">
                <h4 class="modal-title" id="mdltitulo_carga"></h4>
            </div>
            <div class="modal-body pd-20">
            <form id="carga_form">
                <div class="form-layout form-layout-1">
                    <div class="row ">
                        <div class="col-lg-12">
                            <br>
                            <h6>Seleccione el Archivo para realizar la carga masiva</h6>
                            <br>
                            <div class="">
                                <input type="file" id="archivo" name="archivo" accept=".csv">
                            </div>
                            <br>
                            <br>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    
                </div>
                </form>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" id="btnclosemodal_carga"  >Cerrar</button>
                <button type="button"  id="btncargar" onclick="CargarCSV()" class="btn btn-rounded btn-danger">Cargar</button> 
            </div>
            
        </div>
    </div>
</div>

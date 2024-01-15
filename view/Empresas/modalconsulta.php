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
                    <div class="row div_empresa">
                        <h5 class="font-weight-bold">Consulta Local</h5>
                        <h4 id="lb_razon">DESMONTADORA CIALA</h4>
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
                    <div class="row div_empresa">
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
                    <br>
                    <div id="loader" class="text-center mt-3">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-2">Cargando...</p>
                    </div>
                    <br>
                    <div class="row div_empresa_sunat">
                        <h5 class="font-weight-bold">Consulta SUNAT</h5>
                        <h4 id="lb_razon_st">DESMONTADORA CIALA</h4>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">RUC: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_ruc_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Departamento: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_depa_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Provincia: </label>
                        </div>
                        <div class="col-3">
                            <label  style="color: black;" for="" class="form-label" id="lb_prov_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Distrito: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_dist_st"></label>
                        </div>
                        <div class="col-3">
                            <label  style="color: black;"for="" class="form-label">Direccion: </label>
                        </div>
                        <div class="col-9">
                            <label style="color: black;" for="" class="form-label" id="lb_direccion_st"></label>
                        </div>
                    </div>
                    <div class="row div_empresa_sunat">
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Estado: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_estado_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Condicion: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_condicion_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Fecha Inicio: </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_fecha_ini_st"></label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label">Fecha Fin : </label>
                        </div>
                        <div class="col-3">
                            <label style="color: black;" for="" class="form-label" id="lb_fecha_fin_st"></label>
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" id="btnclosemodalconsulta" >Cerrar</button>
                <button type="button" id="btnagregar_acip" onclick="ActualizarEmpresa()" class="btn btn-rounded btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>


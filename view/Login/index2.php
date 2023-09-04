<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Login</title>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse mg-b-10">
                   <span class="tx-normal">[</span> APP PREV <span class="tx-normal">]</span>
       
                </div>
                <div class="tx-center mg-b-20">Administra tus pensiones</div>
                    <div class="form-group">
                        <label class="form-control-label">Usuario:</label>
                        <input type="text" class="form-control" placeholder="Ingrese su Usuario" id="alias">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="form-control-label">Contraseña:</label>
                        <input type="password" class="form-control" placeholder="Ingrese su Contraseña" id="clave">
                    </div><!-- form-group -->
                    <button type="submit" class="btn btn-info btn-block" id="btningresar">Ingresar</button>

            </div><!-- login-wrapper -->

        </div><!-- d-flex -->
        <?php require_once("../Main/mainjs.php") ?>
        <script src="./login.js"></script>
    </body>
</html>
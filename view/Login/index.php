<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ - Login</title>
        <style>
            @font-face {
                font-family: MiFuentePersonal;
                src: url("../../public/font/Saiyan-Sans.ttf") format("opentype");
            }
        </style>
    </head>
    <body class="d-flex flex-column h-100" style="background: url(../../public/img/fondo.jpg);">

<audio id="audio" controls     webkit-playsinline="true" playsinline="true" autoplay="" >
    <source src="../../dbz.mp3" type="audio/mpeg">
</audio>
        <main class="flex-shrink-0">
            <!-- Header-->
            <header class="py-5">
                <div class="container-xxl px-5 pb-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-xxl-3">
                            <!-- Header profile picture-->
                            <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                                <div class="profile bg-gradient-primary-to-secondary">
                                    <!-- TIP: For best results, use a photo with a transparent background like the demo example below-->
                                    <!-- Watch a tutorial on how to do this on YouTube (link)-->
                                    <img class="profile-img" src="../../public/img/goku.png" width="100%" alt="..." />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6" style="background-color: #9A1E04; border-radius: 50px 50px 50px 50px; z-index: 1">
                            <!-- Header text content-->
                            <div class="text-center text-xxl-start">
                                <div class="fs-3 fw-light text-muted mt-3 mb-3 text-center">
                                    <img src="../../public/img/logo_dbz.png" width="80%">
                                </div>
                                <h1 class="display-3 fw-bolder">
                                    <span class="text-gradient d-inline">
                                        <img src="../../public/img/familia.png" width="50%">
                                    </span>
                                </h1>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" style="font-weight: bold; background: linear-gradient(yellow,red); -webkit-background-clip: text; color: transparent; font-family: MiFuentePersonal, Helvetica, sans-serif; font-size: 43px; -webkit-text-stroke: 1px black;">Usuario:</label>
                                        <input type="text" class="form-control" placeholder="Ingrese su Usuario" id="alias">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" style="font-weight: bold; background: linear-gradient(yellow,red); -webkit-background-clip: text; color: transparent;  font-family: MiFuentePersonal, Helvetica, sans-serif; font-size: 43px; -webkit-text-stroke: 1px black;">Clave:</label>
                                        <input type="password" class="form-control" placeholder="Ingrese su Contraseña" id="clave">
                                    </div>
                                    <button type="submit" class="btn" id="btningresar" style="padding-top:55px">
                                        <img src="../../public/img/bola.png" height="55" width="55" style="-webkit-transform: rotate(360deg);transform: rotate(360deg)" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 p-l-20">
                            <!-- Header profile picture-->
                            <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                                <div class="profile bg-gradient-primary-to-secondary">
                                    <!-- TIP: For best results, use a photo with a transparent background like the demo example below-->
                                    <!-- Watch a tutorial on how to do this on YouTube (link)-->
                                    <img class="profile-img" src="../../public/img/gohansuper.png" width="130%" alt="..." />
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </main>


        <!-- 
        <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
                    <span class="tx-normal">[</span> APP PREV <span class="tx-normal">]</span>
                </div>
                <div class="tx-center mg-b-20">Administra tus pensiones</div>
                    <div class="form-group">
                        <label class="form-control-label">Usuario:</label>
                        <input type="text" class="form-control" placeholder="Ingrese su Usuario" id="alias">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Contraseña:</label>
                        <input type="password" class="form-control" placeholder="Ingrese su Contraseña" id="clave">
                    </div>
                    <button type="submit" class="btn btn-info btn-block" id="btningresar">Ingresar</button>

            </div>

        </div>
        -->
        <?php require_once("../Main/mainjs.php") ?>
        <script src="./login.js"></script>
        <script>
         
        </script>
    </body>
</html>
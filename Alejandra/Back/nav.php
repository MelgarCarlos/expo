    <div class="app-bar bg-darkCyan fixed-top" data-role="appbar" style="padding-right: 12%;;">
        <div class="app-bar-element">Trazos Digitales</div>
        <div class="app-bar-divider"></div>
        <ul class="app-bar-menu">
            <?php if($_SESSION['tipo']==1){ ?>
            <li>
                <a class="dropdown-toggle" href="#"><span class="mif-users icon"></span> Usuarios</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="usuarioagregar.php"><span class="mif-user icon fg-black" ></span> Usuarios</a></li>
                    <li><a href="preguntasagregar.php"><span class="mif-question icon fg-black" ></span> Preguntas de seguridad</a></li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a class="dropdown-toggle" href="#"><span class="mif-cog icon"></span> Servicios</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="serviciosagregar.php"><span class="mif-cog icon fg-black" ></span> Servicios</a></li>
                    <li><a href="serviciosmanto.php"><span class="mif-pencil icon fg-black" ></span> Mantenimiento</a></li>
                    <li><a href="iconos.php" target="_blank"><span class="mif-image icon fg-black" ></span> Iconos</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><span class="mif-dollars icon"></span> Promociones</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="promocionesagregar.php"><span class="mif-dollars icon fg-black" ></span> Promociones</a></li>
                    <li><a href="promocionesmanto.php"><span class="mif-pencil icon fg-black" ></span> Mantenimiento</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><span class="mif-images icon"></span> Editor Slider</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="slideragregar.php"><span class="mif-images icon fg-black" ></span> Agregar imagenes</a></li>
                    <li><a href="slidermanto.php"><span class="mif-pencil icon fg-black" ></span> Mantenimiento</a></li>
                </ul>
            </li>
        </ul>
        <?php
        if(!verificar_usuario()){
        ?>
        <div class="app-bar-element place-right">
                <a class="dropdown-toggle fg-white"><span class="mif-enter"></span> Entrar</a>
                <div class="app-bar-drop-container bg-white fg-dark place-right" data-role="dropdown" data-no-close="true">
                    <div class="padding20">
                        <form action="../login/login.php" method="post" data-role="validator" data-hide-error="5000" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" onsubmit="false">
                            <h4 class="text-light">Iniciar sesión</h4>
                            <div class="input-control text">
                                <span class="mif-user prepend-icon"></span>
                                <input name="user_login" type="text" data-validate-func="required" placeholder="Usuario" data-validate-hint="Llene el campo usuario" maxlength="40">
                                <span class="input-state-error mif-warning"></span>
                                <span class="input-state-success mif-checkmark"></span>
                            </div>
                            <div class="input-control text">
                                <span class="mif-lock prepend-icon"></span>
                                <input name="user_password" type="password" data-validate-func="required" placeholder="Contraseña" data-validate-hint="Llene el campo contraseña" maxlength="40">
                                <span class="input-state-error mif-warning"></span>
                                <span class="input-state-success mif-checkmark"></span>
                            </div>
                            <div class="form-actions">
                                <button class="button bg-darkBlue fg-white">Iniciar</button>
                                <button class="button link">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
        <div class="app-bar-element place-right">
            <form action="../login/logout.php" method="post">
                <button name="cerrar" style="border: none;" class="button bg-darkCyan fg-white"><span class="mif-enter"></span> Cerrar sesión</button>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class="app-bar bg-darkCyan fixed-top" data-role="appbar" style="padding-right: 12%;;">
        <div class="app-bar-element">Trazos Digitales</div>
        <div class="app-bar-divider"></div>
        
        <ul class="app-bar-menu">
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Front/index.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-home"></span> Inicio</a></li>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Front/quienes.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-organization"></span>¿Quienes Somos?</a></li>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Front/mision_vision.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-cog"></span>Misión y Visión</a></li>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Front/contacto.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-mail"></span>Contáctanos</a></li>
            <?php
            if(!verificar_usuario()){
            ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Front/login.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-user"></span>Iniciar sesión</a></li>
            <?php
            }
            ?>
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
    <div class="app-bar bg-darkCyan fixed-top" data-role="appbar" style="padding-right: 12%;;">
        <div class="app-bar-element">Trazos Digitales</div>
        <div class="app-bar-divider"></div>
        
        <ul class="app-bar-menu">
            <?php
            if(verificar_usuario()){
                if($_SESSION['tipo']==3){ 
                    ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="index.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-barcode"></span> Productos</a></li>
            <?php
            }}else{
            ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="index.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-home"></span> Inicio</a></li>
            <?php
            }
            ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="quienes.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-list2"></span>¿Qué Ofrecemos?</a></li>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="promocion.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-dollars"></span>Promociones</a></li>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="mision_vision.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-cog"></span>Misión y Visión</a></li>
            <?php
            if(verificar_usuario()){
                if($_SESSION['tipo']==3){ 
                    ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Back/admin.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-cart"></span>Carrito de compra</a></li>
            <?php
                }else if(($_SESSION['tipo']==2)||($_SESSION['tipo']==1)){
            ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="../Back/admin.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-stack"></span>Administracion</a></li>
            <?php
            }
            }
            ?>
            <?php
            if(!verificar_usuario()){
            ?>
            <li style="padding-right: 5px;padding-left: 5px;"><a href="login.php"><span style="padding-bottom: 5px;padding-right: 4px;" class="mif-user"></span>Iniciar sesión</a></li>
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
                                <input name="user_login" type="text" autocomplete="off"  data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario" maxlength="40">
                                <span class="input-state-error mif-warning"></span>
                                <span class="input-state-success mif-checkmark"></span>
                            </div>
                            <div class="input-control text">
                                <span class="mif-lock prepend-icon"></span>
                                <input name="user_password" type="password" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9]){6,10}"  placeholder="Contraseña" data-validate-hint="Llene el campo contraseña" maxlength="40">
                                <span class="input-state-error mif-warning"></span>
                                <span class="input-state-success mif-checkmark"></span>
                            </div>
                            <div class="form-actions">
                                <button name="login" class="button bg-darkBlue fg-white">Iniciar</button>
                                <a href="registro.php" class="button link">Registrarme</a>
                                <a href="recuperar.php" class="button link">¿Olvidaste tu contraseña?</a>
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
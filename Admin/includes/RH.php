<?php

if ($page == '0') {
    $state = 'active';
    $state1 = '';
    $state2 = '';
} else {
    if ($page == '1') {
        $state = '';
        $state1 = 'active';
        $state2 = '';
    } else {
        if ($page == '2') {
            $state = '';
            $state1 = '';
            $state2 = 'active';
        } else {
            $state = '';
            $state1 = '';
            $state2 = '';
        }
    }
}
echo '<ul class="nav">
                    <li class="' . $state . '">
                        <a href="Agregar.php">
                            <i class="pe-7s-plus"></i>
                            <p>Administrador</p>
                        </a>
                    </li>
                    <li class="' . $state1 . '">
                        <a href="ModificarClave.php">
                            <i class="pe-7s-door-lock"></i>
                            <p>cambiar mi Clave</p>
                        </a>
                    </li>                  
                    <li class="' . $state2 . '">
                        <a href="restaurarclaveAdmin.php">
                            <i class="pe-7s-helm"></i>
                            <p>Cambiar Clave Docentes</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="index.php">
                            <i class="pe-7s-power"></i>
                            <p>Salir</p>
                        </a>
                    </li>
                </ul>';

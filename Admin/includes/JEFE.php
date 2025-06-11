<?php

if ($page == '0') {
    $state = 'active';
    $state1 = '';
    $state2 = '';
    $state3 = '';
} else {
    if ($page == '1') {
        $state = '';
        $state1 = 'active';
        $state2 = '';
        $state3 = '';
    } else {
        if ($page == '2') {
            $state = '';
            $state1 = '';
            $state2 = 'active';
            $state3 = '';
        } else {
            if ($page == '3') {
                $state = '';
                $state1 = '';
                $state2 = '';
                $state3 = 'active';
            } else {
                $state = '';
                $state1 = '';
                $state2 = '';
                $state3 = '';
            }
        }
    }
}

echo '<ul class="nav">
                    <li class="' . $state . '">
                        <a href="inicioAdminJefe.php">
                            <i class="pe-7s-photo-gallery"></i>
                            <p>Inscritos por Áreas</p>
                        </a>
                    </li>
                    <li class="' . $state1 . '">
                        <a href="CalificadosJefe.php">
                            <i class="pe-7s-photo-gallery"></i>
                            <p>Inscritos Calificados</p>
                        </a>
                    </li>
                    <li class="' . $state2 . '">
                        <a href="DocentesSinArea.php">
                            <i class="pe-7s-photo-gallery"></i>
                            <p>Docentes Sin Area Escogida</p>
                        </a>
                    </li>
                    <li class="' . $state3 . '">
                        <a href="ModificarClaveJefe.php">
                            <i class="pe-7s-photo-gallery"></i>
                            <p>cambiar mi Clave</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="index.php">
                            <i class="pe-7s-power"></i>
                            <p>Salir</p>
                        </a>
                    </li>
                </ul>';

<?php

//$page = $_GET["page"];
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
        $state = '';
        $state1 = '';
        $state2 = 'active';
    }
}

echo '<ul class="nav">
                        <li class="' . $state . '">
                            <a href="inicioAdminDecano.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos por Áreas</p>
                            </a>
                        </li>
                        <li class="' . $state1 . '">
                            <a href="CalificadosDecano.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos Calificados</p>
                            </a>
                        </li>
                        <li class="' . $state2 . '">
                            <a href="ModificarClaveDecano.php">
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

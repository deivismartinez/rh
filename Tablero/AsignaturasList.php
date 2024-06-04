
<?php
    require_once("clases/Programas.php");
    $fac = trim(filter_input(INPUT_GET, 'dep', FILTER_SANITIZE_SPECIAL_CHARS));
    $d = new Programas();
    if($fac==''){$fac=0;}
    $fac1 = $d->getNombreArea($fac);
    $program = $d->getAsignaturas($fac1);
    echo '<textarea rows="12" cols="50" disabled="true">';
    foreach ($program as $arregloProg) {
    echo $arregloProg[0]."\n";
    }
    ?>                                                    
    </textarea>
    
<select required="true" name="areasCmb" id="areasCmb" class="form-control" onchange="cargarAsignaturas(this.value)">
    <option value="">SELECCIONE</option>
    <?php
    require_once("clases/Programas.php");
    $dep = trim(filter_input(INPUT_GET, 'dep', FILTER_SANITIZE_SPECIAL_CHARS));
    $d = new Programas();
    $areas = $d->getAreas($dep);
    foreach ($areas as $arregloProg) {
            echo '<OPTION value="' . $arregloProg[1] . '">' . $arregloProg[0] . '</OPTION>';
    }
    ?>
</select>
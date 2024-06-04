<select required="true" name="programaCmb" id="programaCmb" class="form-control" onchange="cargarAreas(this.value)">
    <option value="">SELECCIONE</option>
    <?php
    require_once("clases/Programas.php");
    $fac = trim(filter_input(INPUT_GET, 'fac', FILTER_SANITIZE_SPECIAL_CHARS));
    $d = new Programas();
    $program = $d->getProgramasDocente($fac);
    foreach ($program as $arregloProg) {
            echo '<OPTION value="' . $arregloProg[0] . '">' . $arregloProg[1] . '</OPTION>';
    }
    ?>
</select>
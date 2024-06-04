<select required="true" name="municipioCmb" id="municipioCmb" class="form-control">
    <?php
    require_once("clases/Docente.php");
    $dto = trim(filter_input(INPUT_GET, 'dto', FILTER_SANITIZE_SPECIAL_CHARS));
    $d = new Docente();
    $municipioss = $d->getMunicipios($dto);
    foreach ($municipioss as $arregloMunicipios) {
            echo '<OPTION value="' . $arregloMunicipios[0] . '">' . $arregloMunicipios[1] . '</OPTION>';
    }
    ?>
</select>
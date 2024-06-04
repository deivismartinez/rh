<select required="true" name="departamentoCmb" id="departamentoCmb" class="form-control" onchange="cargarMunicipios(this.value)">
    <?php
    require_once("clases/Docente.php");
    $pais = trim(filter_input(INPUT_GET, 'pais', FILTER_SANITIZE_SPECIAL_CHARS));
    $d = new Docente();
    $departamentos = $d->getDepartamentos($pais);
    foreach ($departamentos as $arregloDto) {
            echo '<OPTION value="' . $arregloDto[0] . '">' . $arregloDto[1] . '</OPTION>';
    }
    ?>
</select>
function eliminar(url) {
    if (window.confirm("¿Realmente desea eliminar este registro?")) {
        window.location = url;
    }
}

function evaluado(url) {
    if (window.confirm("¿Su hoja de vida ya ha sido evaluada anteriormente, si realiza este cambio, será sometida nuevamente a evaluacion?")) {
        //funcion que cambie en la base de datos el campo 'estado' tabla 'calificacion'(null  CALIFICADO MODIFICAR)

        window.location = url;
    }

}

function seguir(url) {
    if (window.confirm("¿Está seguro de Seguir?")) {
        window.location = url;
    }
}

function cargarDepartamentos(pais) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboDepartamento").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Departamentos.php?pais=" + pais, true);
    xhttp.send();
}

function cargarMunicipios(dto) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboMunicipio").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Municipios.php?dto=" + dto, true);
    xhttp.send();
}

function cargarProgramas(fac) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboProg").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ProgramasList.php?fac=" + fac, true);
    xhttp.send();
}

function cargarProgPost(fac) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboProg").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../Tablero/ProgramasListPostgrados.php?fac=" + fac, true);
    xhttp.send();
}

function cargarAreas(dep) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboAreas").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "AreasList.php?dep=" + dep, true);
    xhttp.send();
}

function cargarAsignaturas(dep) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboAsig").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "AsignaturasList.php?dep=" + dep, true);
    xhttp.send();
}
function eliminar(url)
{
    if(window.confirm("Realmente desea eliminar este registro?"))
    {
        window.location=url;
    }
}
function cargarDepartamentos(pais) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboDepartamento").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Departamentos.php?pais="+pais, true);
    xhttp.send();
}

function cargarMunicipios(dto) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboMunicipio").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Municipios.php?dto="+dto, true);
    xhttp.send();
}

function cargarProgramas(fac) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("comboProg").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ProgramasList.php?fac="+fac, true);
    xhttp.send();
}
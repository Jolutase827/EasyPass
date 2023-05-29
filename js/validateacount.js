function validarFormulario() {
    var nombreUsuario = document.getElementById("name").value;
    var contrasena = document.getElementById("contrasenya").value;
    // Leer el archivo XML para comprobar si los datos coinciden
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
    // Ready_state está completado y la petición http es OK
    if (this.readyState == 4 && this.status == 200) {
        var xmlDoc = this.responseXML;
        var cuentas = xmlDoc.getElementsByTagName("usuario");
        for (var i = 0; i < cuentas.length; i++) {
            var cuenta = cuentas[i];
            var nombreUsuarioXML = cuenta.getElementsByTagName("nombre")[0].childNodes[0].nodeValue;
            var contrasenaXML = cuenta.getElementsByTagName("contrasenya")[0].childNodes[0].nodeValue;
            if (nombreUsuario === nombreUsuarioXML && contrasena === contrasenaXML) {
                window.location.href = "Prueba.html";
                return true;
            }
        }
        alert("Nombre de usuario o contraseña incorrectos");
        return false;
    }

};
xhttp.open("GET", "http://jtarragas.ieslavereda.es/ProyectoLenguajesFinalCurso1%C2%BA/XML/proyecto.xml", true);
xhttp.send();





}



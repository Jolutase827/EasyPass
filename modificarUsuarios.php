<?php
    $nombreusuario = $_GET['nombre'];
    $contrasenyausuario = $_GET['contra'];
    $correousuario = $_GET['correo'];
    $imagenusuario = $_GET['img'];
    $activa=false;
    $contrasenyasdistintas = false;
    if($contrasenyausuario == ''){
        $contrasenyausuario = $_POST['contrasenya'];
        $contrasenyausuariorepe =$_POST['repecontrasenya'];
        $correousuario = $_POST['correo'];
        $imagenusuario=$_POST['img'];
        if($contrasenyausuario==''){
            $xml = new DOMDocument();
            $xml->load('XML/proyecto.xml');
            $xpath = new DOMXPath($xml);
            $expresion = '//usuario[nombre/text() = "'.$nombreusuario.'"]';
            $nodos = $xpath->query($expresion);
            foreach ($nodos as $nodo) {
                $contrasenyaNodo = $nodo->getElementsByTagName('contrasenya')->item(0);
                $contrasenyausuario = $contrasenyaNodo->nodeValue;
    
                // Obtener el valor del campo "correo"
                $correoNodo = $nodo->getElementsByTagName('correo')->item(0);
                $correousuario = $correoNodo->nodeValue;
    
                // Obtener el valor del campo "imagen"
                $imagenNodo = $nodo->getElementsByTagName('imagen')->item(0);
                $imagenusuario = $imagenNodo->nodeValue;
            }

            // Obtener el valor del campo "contrasenya"
            
        }else{
            $nombreusuario = $_POST['name'];
            if($contrasenyausuariorepe==$contrasenyausuario){
                $activa = true;
            }else{
                $contrasenyasdistintas = true;
            }
        }
    }else{
        $xml = new DOMDocument();
        $xml->load('XML/proyecto.xml');
        $xpath = new DOMXPath($xml);
        $expresion = '//usuario[nombre/text() = "'.$nombreusuario.'"]';
        $nodos = $xpath->query($expresion);
        foreach ($nodos as $nodo) {
        // Modificar el nodo hijo "contrasenya"
        $contrasenyaNodo = $nodo->getElementsByTagName('contrasenya')->item(0);
        $contrasenyaNodo->nodeValue = $contrasenyausuario;

        // Modificar el nodo hijo "imagen"
        $imagenNodo = $nodo->getElementsByTagName('imagen')->item(0);
        $imagenNodo->nodeValue = $imagenusuario;
        
        // Modificar el nodo hijo "correo"
        $correoNodo = $nodo->getElementsByTagName('correo')->item(0);
        $correoNodo->nodeValue = $correousuario;
        }
        $xml->save('XML/proyecto.xml');
    }

echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPass</title>
    <link rel="stylesheet" type="text/css" href="modificarUsuarios.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <img src="https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2020/02/curriculum-vitae-1877167.jpg?tf=3840x" alt="" style="position: absolute; width: 100%; margin-top: 5%;">
    <header>
        <div class="logo">
             <a href="index.php?nombre='.$nombreusuario.'"><img class="logoDibujo" src="EasyPass.png" alt="Logo"></a>
        </div>
        <input type="checkbox" id="menuOpcionesUsuario"/>
        <label for="menuOpcionesUsuario" class="labelMenu">
            
            <span id="menuHeader" class="material-symbols-outlined"> menu</span>
        </label>
        <div class="menu">
            <div class="infoUsuarioMenu">
                <img src="'.$imagenusuario.'" alt="" class="imgMenu">
                <p class="nameUserMenu">'.$nombreusuario.'</p>
            </div>
            <div class="divOpcionesMenu">
                <a href="crearCV.php?nombre='.$nombreusuario.'" class="opcionesMenu">Crear CV</a>
                <a href="listadocurriculums.php?nombre='.$nombreusuario.'" class="opcionesMenu">Mis CV\'s</a>
                <a href="index.php?nombre='.$nombreusuario.'" class="opcionesMenu">Página principal</a>
                <a href="index.php" class="opcionesMenu">Cerrar sesión</a>
            </div>
            <label for="menuOpcionesUsuario" id="clicarCruz"><span id="cruzHeader" class="material-symbols-outlined">close</span></label>
        </div>
    </header>
    <div id="mensajeConfirmación">
        
    </div>
    <div class="contenedor">
        <div class="divNombre">
            <img src="'.$imagenusuario.'" alt="" class="imgUsuario">
            <h1 id="nombreUsuario">'.$nombreusuario.'</h1>
        </div>
        <form action="modificarUsuarios.php" method="post">
            <input type="text" style="visibility: hidden; position: absolute;" name="name" value="'.$nombreusuario.'"/>
            <div class="divCorreo">
                <p>Correo:</p>
                <input type="email" id="correo" class="inputs" name="correo" value="'.$correousuario.'" placeholder="Correo electrónico" required/>
            </div>
            <div class="divContra">
                <p>Contraseña:</p>
                <input type="password" id="contrasenya" class="inputs" name="contrasenya" value="'.$contrasenyausuario.'" placeholder="Contraseña" required/>
                <br>
                <br>
                <input type="password" id="repecontrasenya" class="inputs" name="repecontrasenya" value="'.$contrasenyausuario.'" placeholder="Repetir contraseña" required/>';
                if($contrasenyasdistintas==true){
                    echo' <p class="errorContra">  <span class="material-symbols-outlined">cancel</span>  Contraseñas distintas</p>';
                }
                echo '</div>
            <div class="divImg">
                <p style="text-align: center;">URL imagen</p>
                <input type="text" id="img" name="img" class="inputs" value="'.$imagenusuario.'" placeholder="Imagen" required/>
            </div>
            <input type="submit" value="Aplicar" id="botonAplicar">
        </form>
        <a href="index.php?nombre='.$nombreusuario.'" class="volver">Volver</a>
    </div>
    <footer>
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
    </footer>
    <script>';
        if($activa==true){
        echo 'const form = `<div class="opacidadTodo">
            </div>
            <div class="borrarUser">
                <button id="cerrarEliminarUser"><span id="cruzCerrarBorrar" class="material-symbols-outlined">close</span></button>
                <p style="width:70%; margin-left:15%; margin-bottom:4%;">¿Estas de acuerdo en que quieres realizar estos cambios?</p>
                <a href="modificarUsuarios.php?nombre='.$nombreusuario.'&contra='.$contrasenyausuario.'&correo='.$correousuario.'&img='.$imagenusuario.'" class="aceptarCambios">Aceptar</a>
            </div>`;
            document.getElementById("mensajeConfirmación").innerHTML = form;
                document.getElementById("cerrarEliminarUser").addEventListener(`click`,function(){
                        document.getElementById("mensajeConfirmación").innerHTML = "";
            });';
        }
    echo '</script>
</body>
</html>';

?>
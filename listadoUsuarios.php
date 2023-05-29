<?php
    $nombreGetAEliminar = $_GET['nombre'];
    $nombrePOST = $_POST['nombreEliminar'];
    if($nombrePOST!=''){
        $documento = new DOMDocument();
    //Cargamos el XML que queremos tratar.
        $documento->load('XML/proyecto.xml');
        $xpath = new DOMXPath($documento);
        $expresion = '//usuario[nombre/text() = "'.$nombrePOST.'"]';
    //Recuperamos el nodo padre y el nodo hijo.
        $nodos = $xpath->query($expresion);
        foreach ($nodos as $nodo) {
            $nodo->parentNode->removeChild($nodo);
        }
    //Guardamos el archivo.
        $documento->save('XML/proyecto.xml');
    }
    $contador =0;
    $carga_xml = simplexml_load_file("XML/proyecto.xml");
    foreach($carga_xml->usuarios->noroot->usuariosnoroot->usuario as $usuariosnotRoot){
        $nombreNoroot = $usuariosnotRoot->nombre;
        $emailNoroot = $usuariosnotRoot->correo;
        $contador++;
    }
    echo'<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EasyPass</title>
        <link rel="stylesheet" type="text/css" href="listarusuarios.css">
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
        <header>
            <div class="logo">
                 <a href="index.php?nombre=root"><img class="logoDibujo" src="EasyPass.png" alt="Logo"></a>
            </div>
            <input type="checkbox" id="menuOpcionesUsuario"/>
            <label for="menuOpcionesUsuario" class="labelMenu">
                
                <span id="menuHeader" class="material-symbols-outlined"> menu</span>
            </label>
            <div class="menu">
                <div class="infoUsuarioMenu">
                    <img src="imagenUsuario.png" alt="" class="imgMenu">
                    <p class="nameUserMenu">root</p>
                </div>
                <div class="divOpcionesMenu">
                    <a href="listadocurriculums.php?nombre=root"class="opcionesMenu">CV\'s</a>
                    <a href="index.php?nombre=root" class="opcionesMenu">Página principal</a>
                    <a href="index.php" class="opcionesMenu">Cerrar sesión</a>
                </div>
                <label for="menuOpcionesUsuario" id="clicarCruz"><span id="cruzHeader" class="material-symbols-outlined">close</span></label>
            </div>
        </header>
        <div id="eliminarUsuario">
        
        </div>
        <div class="contenedor">
            <p class="contadorUsuarios">______________________________________Usuarios disponibles: '.$contador.'___________________________________</p>';
            foreach($carga_xml->usuarios->noroot->usuariosnoroot->usuario as $usuariosnotRoot){
                $nombreNoroot = $usuariosnotRoot->nombre;
                $emailNoroot = $usuariosnotRoot->correo;
                echo '<div class="contenedorUsuario">
                <img class="imgUsuario" src="imagenUsuario.png" alt=""/>
                <p class="nombreUsuario">'.$nombreNoroot.'</p>
                <p class="emailUsuario">'.$emailNoroot.'</p>
                <a href="listadoUsuarios.php?nombre='.$nombreNoroot.'"><span  id="cruz" class="material-symbols-outlined">close</span></a>
            </div>';
            }
            
            
        echo '</div>
        <footer>
            <br/>
            <br/>
            <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
        </footer><script>';
        if($nombreGetAEliminar!=''){
            echo '
            const form = `<div class="opacidadTodo">
            </div>
            <div class="borrarUser">
                <button id="cerrarEliminarUser"><span id="cruzCerrarBorrar" class="material-symbols-outlined">close</span></button>
                <p>¿Seguro que quieres eliminar a este usuario?</p>
                <form action="listadoUsuarios.php" method="post">
                    <input type="text" style="visibility: hidden; position: absolute;" name="nombreEliminar" value="'.$nombreGetAEliminar.'"/>
                    <input id="botonBorrar" type="submit"  value="Borrar"/>
                </form>
            </div>`;
            document.getElementById("eliminarUsuario").innerHTML = form;
                document.getElementById("cerrarEliminarUser").addEventListener(`click`,function(){
                        document.getElementById("eliminarUsuario").innerHTML = "";
            });
            ';
        }
        
    echo '</script>
    </body>
    </html>';


?>
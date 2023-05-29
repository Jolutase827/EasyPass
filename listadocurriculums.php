<?php
$nombreusuario = $_GET['nombre'];
$eliminarID = $_GET['eliminarid'];
$contador =0;

        $xml = new DOMDocument();
$xml->load('XML/proyecto.xml');
$xpath = new DOMXPath($xml);
$expresion = '//usuario[nombre/text() = "'.$nombreusuario.'"]';
$nodos = $xpath->query($expresion);
foreach ($nodos as $nodo) {
        // Obtener el valor del campo "imagen"
        $imagenNodo = $nodo->getElementsByTagName('imagen')->item(0);
        $imagenusuario = $imagenNodo->nodeValue;
}
if($eliminarID!=''){
    $documento = new DOMDocument();
    //Cargamos el XML que queremos tratar.
        $documento->load('XML/proyecto.xml');
        $xpath = new DOMXPath($documento);
        $expresion = '//cv[@id = "'.$eliminarID.'"]';
    //Recuperamos el nodo padre y el nodo hijo.
        $nodos = $xpath->query($expresion);
        foreach ($nodos as $nodo) {
            $nodo->parentNode->removeChild($nodo);
        }
    //Guardamos el archivo.
        $documento->save('XML/proyecto.xml');
}
$carga_xml = simplexml_load_file("XML/proyecto.xml");
        foreach($carga_xml->curriculums->cv as $curriculums){
            if($curriculums['cuenta']==$nombreusuario){
            $contador++;
        }
        }
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPass</title>
    <link rel="stylesheet" type="text/css" href="listadocurriculums.css">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
     
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
                <a href="modificarUsuarios.php?nombre='.$nombreusuario.'"class="opcionesMenu">Mi perfil</a>
                <a href="crearCV.php?nombre='.$nombreusuario.'"class="opcionesMenu">Crear CV</a>
                <a href="index.php?nombre='.$nombreusuario.'" class="opcionesMenu">Página principal</a>
                <a href="index.php" class="opcionesMenu">Cerrar sesión</a>
            </div>
            <label for="menuOpcionesUsuario" id="clicarCruz"><span id="cruzHeader" class="material-symbols-outlined">close</span></label>
        </div>
    </header>
    <div id="eliminarUsuario">
    
    </div>
    <div class="contenedor">
        <p class="contadorUsuarios">________________Curriculums: '.$contador.'_______________</p>';
        $carga_xml = simplexml_load_file("XML/proyecto.xml");
        foreach($carga_xml->curriculums->cv as $curriculums){
            if($curriculums['cuenta']==$nombreusuario||$nombreusuario=='root'){
            $tituloNode = $curriculums->titulo;
            $idCV = $curriculums['id'];
        echo '<div class="contedorCV" id="'.$idCV.'">
            <img class="imgUsuario" src="imagenCV.png" alt=""/>
            <p class="tituloCV">'.$tituloNode.'</p>
            <a href="listadocurriculums.php?nombre='.$nombreusuario.'&eliminarid='.$idCV.'"><span  id="cruz" class="material-symbols-outlined">close</span></a>
            <a href="crearCV.php?nombre='.$nombreusuario.'&id='.$idCV.'"><span id="simboloEdit"class="material-symbols-outlined">edit</span></a>
        </div>';
        }
        }
    echo'
    <a href="crearCV.php?nombre='.$nombreusuario.'"><div class="contedorCV" >
                <img class="imgUsuario" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" alt=""/>
                <p class="tituloCV">Añadir CV</p>
            </div>
            </a>
            <div class="mostrarcontenido" id="mostrarContenido">
                
            </div>
        </div>
    <footer>
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
    </footer><script>';
        
    $carga_xml = simplexml_load_file("XML/proyecto.xml");
    foreach($carga_xml->curriculums->cv as $curriculums){
        if($curriculums['cuenta']==$nombreusuario||$nombreusuario=='root'){
        $idCV = $curriculums['id'];
    echo ' document.getElementById(\''.$idCV.'\').addEventListener(\'click\',function(){
        const form = `<img src="'.$imagenusuario.'" alt="" width="30%" height="20%" style="border-radius: 50%;">
        <h3 class="font">Titulo</h3>
        <div class="font">
            <h4>Idiomas</h4>';
            $xml = new DOMDocument();
            $xml->load('XML/proyecto.xml');

            $xpath = new DOMXPath($xml);
            $query = '//cv[@id="' . $idCV . '"]/formacion/idioma';
            $idiomaNodes = $xpath->query($query);
            foreach ($idiomaNodes as $idiomaNode) {
                // Acceder a los subcampos del elemento idioma
                $nombre = $idiomaNode->getElementsByTagName('nombre')->item(0)->nodeValue;
                $nivel = $idiomaNode->getElementsByTagName('nivel')->item(0)->nodeValue;
                $certificado = $idiomaNode->getElementsByTagName('certificado')->item(0)->nodeValue;
            echo'<p>'.$nombre.': '.$nivel.'(Certificado '.$certificado.')</p>';
            }
        echo'</div>
        <div class="font">
            <h4>Titulaciones</h4>';
            $query = '//cv[@id="' . $idCV . '"]/formacion/titulacion';
            $titulacionNodes = $xpath->query($query);
                        foreach ($titulacionNodes as $titulacionNode) {
                            $nombre = $titulacionNode->getElementsByTagName('nombre')->item(0)->nodeValue;
                            $fecha = $titulacionNode->getElementsByTagName('fecha')->item(0)->nodeValue;
                            $centro = $titulacionNode->getElementsByTagName('centro')->item(0)->nodeValue;
                            echo'<strong>'.$fecha.' - '.$nombre.'</strong>
                            <p class="centro">'.$centro.'</p>';
                        }
        echo'</div>
        <div class="font">
            <h4>Experiencia</h4>';
            $query = '//cv[@id="' . $idCV . '"]/experiencia/item';
            $itemNodes = $xpath->query($query);
                        foreach ($itemNodes as $itemNode) {
                        // Acceder a los subcampos del elemento item
                        $titulo = $itemNode->getElementsByTagName('titulo')->item(0)->nodeValue;
                        $sector = $itemNode->getElementsByTagName('sector')->item(0)->nodeValue;
                        $descripcion = $itemNode->getElementsByTagName('descripcion')->item(0)->nodeValue;
                        $fechaInicio = $itemNode->getElementsByTagName('fecha_inicio')->item(0)->nodeValue;
                        $fechaFin = $itemNode->getElementsByTagName('fecha_fin')->item(0)->nodeValue;
                        echo '<strong>'.$fechaInicio.' - '.$fechaFin.' -> '.$titulo.'</strong>
                        <p class="desc">'.$descripcion.'</p>';
                        }
        echo' </div>`;
        document.getElementById(\'mostrarContenido\').innerHTML = form;
    });';
    }
    }
    echo'</script>
</body>
</html>';
?>
<?php 
$contador = 0;
$nombreusuario = $_GET['nombre'];
$idCV = $_GET['id'];
$titulacionEliminar = $_GET['nombreTitu'];
$idiomaEliminar = $_GET['nombreIdioma'];
$xpeliminar = $_GET['nombreXP'];
if($titulacionEliminar!=''){
    $xml = new DOMDocument();
    $xml->load('XML/proyecto.xml');
    $xpath = new DOMXPath($xml);
    $queryCV = '//cv[@id="' . $idCV . '"]/formacion';
    $cvsNode = $xpath->query($queryCV);
    foreach ($cvsNode as $cvNode) {
    // Buscar el elemento "titulacion" con el nombre especificado dentro del CV
    $queryTitulacion = '//titulacion[nombre="' . $titulacionEliminar . '"]';
    $titulacionNodes = $xpath->query($queryTitulacion, $cvNode);
    foreach ($titulacionNodes as $titulacionNode) {
    $cvNode->removeChild($titulacionNode);
    }
    }
    $xml->save('XML/proyecto.xml');
    $contador = 1;
}
if($idiomaEliminar!=''){
    $xml = new DOMDocument();
    $xml->load('XML/proyecto.xml');

    $xpath = new DOMXPath($xml);
    $queryCV = '//cv[@id="' . $idCV . '"]/formacion';
    $cvsNode = $xpath->query($queryCV);
    foreach ($cvsNode as $cvNode) {
    // Buscar el elemento "titulacion" con el nombre especificado dentro del CV
    $queryIdioma = '//idioma[nombre="' . $idiomaEliminar. '"]';
    $idiomasNode = $xpath->query($queryIdioma, $cvNode);
    foreach ($idiomasNode as $idiomaNode) {
    $cvNode->removeChild($idiomaNode);
    }
    }
    $xml->save('XML/proyecto.xml');
    $contador = 1;
}
if($xpeliminar!=''){
    $xml = new DOMDocument();
    $xml->load('XML/proyecto.xml');
    $xpath = new DOMXPath($xml);
    $queryCV = '//cv[@id="' . $idCV . '"]/experiencia';
    $cvsNode = $xpath->query($queryCV);
    foreach ($cvsNode as $cvNode) {
    // Buscar el elemento "titulacion" con el nombre especificado dentro del CV
    $queryItem = '//item[titulo="' . $xpeliminar . '"]';
    $itemsNode = $xpath->query($queryItem, $cvNode);
        foreach ($itemsNode as $itemNode) {
            $cvNode->removeChild($itemNode);
        }
    }
    $xml->save('XML/proyecto.xml');
    $contador = 2;
}

if($nombreusuario ==''){
    $nombreusuario = $_POST['nombre'];
    $idCV = $_POST['idCV'];
    $tituloCV = $_POST['tituloCV'];
    if($tituloCV==''){
        $nombreTitul = $_POST['nombreTitul'];
        if($nombreTitul==''){
            $nombreIdioma = $_POST['nombreIdioma'];
            if($nombreIdioma ==''){
                $tituloXP = $_POST['tituloXP'];
                if($tituloXP!=''){
                    $contador = 2;
                    $sectorXP = $_POST['sectorXP'];
                    $descXP = $_POST['descXP'];
                    $fechaIni = $_POST['fechaIni'];
                    $fechaFin = $_POST['fechaFin'];
                    $xml = new DOMDocument();
                    $xml->load('XML/proyecto.xml');

                    $xpath = new DOMXPath($xml);
                    // Buscar el nodo CV con el ID especificado
                    $query = '//cv[@id="' . $idCV . '"]';
                    $cvsNode = $xpath->query($query);
                    foreach ($cvsNode as $cvNode) {
                    $itemNode = $xml->createElement('item');
    
                    $tituloNode = $xml->createElement('titulo', $tituloXP);
                    $sectorNode = $xml->createElement('sector', $sectorXP);
                    $descripcionNode = $xml->createElement('descripcion', $descXP);
                    $fechaInicioNode = $xml->createElement('fecha_inicio', $fechaIni);
                    $fechaFinNode = $xml->createElement('fecha_fin', $fechaFin);
    
                    $itemNode->appendChild($tituloNode);
                    $itemNode->appendChild($sectorNode);
                    $itemNode->appendChild($descripcionNode);
                    $itemNode->appendChild($fechaInicioNode);
                    $itemNode->appendChild($fechaFinNode);

                    $experienciaNode = $cvNode->getElementsByTagName('experiencia')->item(0);
                    $experienciaNode->appendChild($itemNode);
                    }
                    // Guardar los cambios en el archivo XML
                    $xml->save('XML/proyecto.xml');
                }
            }else{
                $contador = 1;
                $nivelIdioma = $_POST['nivelIdioma'];
                $certificadoIdioma = $_POST['certificadoIdioma'];
                $xml = new DOMDocument();
                $xml->load('XML/proyecto.xml');

                $xpath = new DOMXPath($xml);
                // Buscar el nodo CV con el ID especificado
                $query = '//cv[@id="' . $idCV . '"]';
                $cvsNode = $xpath->query($query);
                foreach ($cvsNode as $cvNode) {
                $idiomaNode = $xml->createElement('idioma');
    
                $nombreNode = $xml->createElement('nombre', $nombreIdioma);
                $nivelNode = $xml->createElement('nivel', $nivelIdioma);
                $certificadoNode = $xml->createElement('certificado', $certificadoIdioma);
    
                $idiomaNode->appendChild($nombreNode);
                $idiomaNode->appendChild($nivelNode);
                $idiomaNode->appendChild($certificadoNode);
    
                // Agregar el nodo de idioma al CV
                $experienciaNode = $cvNode->getElementsByTagName('formacion')->item(0);
                $experienciaNode->appendChild($idiomaNode);
                }
    
                // Guardar los cambios en el archivo XML
                $xml->save('XML/proyecto.xml');
            }
        }else{
            $contador = 1;
            $fechatitul = $_POST['fechaTitul'];
            $centroTitul = $_POST['centroTitul'];

            $xml = new DOMDocument();
            $xml->load('XML/proyecto.xml');

            $xpath = new DOMXPath($xml);
            // Buscar el nodo CV con el ID especificado
            $query = '//cv[@id="' . $idCV . '"]';
            $cvsNode = $xpath->query($query);
            foreach ($cvsNode as $cvNode) {
            
            $titulacionNode = $xml->createElement('titulacion');
            $nombreNode = $xml->createElement('nombre', $nombreTitul);
            $fechaNode = $xml->createElement('fecha', $fechatitul);
            $centroNode = $xml->createElement('centro', $centroTitul);
    
            $titulacionNode->appendChild($nombreNode);
            $titulacionNode->appendChild($fechaNode);
            $titulacionNode->appendChild($centroNode);


            $experienciaNode = $cvNode->getElementsByTagName('formacion')->item(0);
            $experienciaNode->appendChild($titulacionNode);
            }
    
            // Guardar los cambios en el archivo XML
            $xml->save('XML/proyecto.xml');
        }
    }else if($idCV!=''){
        $contador = 1;
        $xml = new DOMDocument();
        $xml->load('XML/proyecto.xml');

        $xpath = new DOMXPath($xml);
        // ID del CV que deseas editar

        // Buscar el nodo CV con el ID especificado
        $query = '//cv[@id="' . $idCV . '"]';
        $cvsNode = $xpath->query($query);
        foreach ($cvsNode as $cvNode) {
        // Obtener el nodo "titulo"
            $tituloNode = $cvNode->getElementsByTagName('titulo')->item(0);
            $tituloNode->nodeValue =  $tituloCV;
        }

        // Guardar los cambios en el archivo XML
        $xml->save('XML/proyecto.xml');
    }
}else if($idCV==''){
    $xml = new DOMDocument();
    $xml->load('XML/proyecto.xml');

    $xpath = new DOMXPath($xml);

    // Obtener el último ID insertado
    $query = '//cv[last()]';
    $lastIdNode = $xpath->query($query);
    foreach ($lastIdNode as $lastCVNode) {
        $lastId = $lastCVNode->getAttribute('id');
        $newId = $lastId + 1;
    }
    $idCV = $newId;

    

    // Crear el nuevo nodo CV
    $newCVNode = $xml->createElement('cv');
    $newCVNode->setAttribute('id', $newId);
    $newCVNode->setAttribute('cuenta', $nombreusuario);

    // Crear los nodos titulo, formacion y experiencia con valores vacíos
    $tituloNode = $xml->createElement('titulo','');
    $newCVNode->appendChild($tituloNode);

    $formacionNode = $xml->createElement('formacion','');
    $newCVNode->appendChild($formacionNode);

    $experienciaNode = $xml->createElement('experiencia','');
    $newCVNode->appendChild($experienciaNode);

    // Agregar el nuevo CV al documento XML
    $cvList = $xml->getElementsByTagName('curriculums')[0]->appendChild($newCVNode);
    ;

    // Guardar los cambios en el archivo XML
    $xml->save('XML/proyecto.xml');
    $contador = 0;
}


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
if($tituloCV==''&&$idCV!=''){
    $xml = new DOMDocument();
    $xml->load('ruta_al_archivo.xml');

    $xpath = new DOMXPath($xml);
    $queryCV = '//cv[@id="' . $idCV . '"]';
    $cvNode = $xpath->query($queryCV)[0];
    $tituloNode = $xpath->query('titulo', $cvNode)[0];
    $tituloCV = $tituloNode->nodeValue;
}



echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPass</title>
    <link rel="stylesheet" type="text/css" href="crearCV.css">
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
    <img src="https://img.freepik.com/vector-gratis/fondo-abstracto-azul-formas-geometricas_1035-17545.jpg" alt="" style="position: fixed; width: 100%; margin-top: 5%;">
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
                <a href="listadocurriculums.php?nombre='.$nombreusuario.'"class="opcionesMenu">Mis CV\'s</a>
                <a href="index.php?nombre='.$nombreusuario.'" class="opcionesMenu">Página principal</a>
                <a href="index.php" class="opcionesMenu">Cerrar sesión</a>
            </div>
            <label for="menuOpcionesUsuario" id="clicarCruz"><span id="cruzHeader" class="material-symbols-outlined">close</span></label>
        </div>
    </header>
    <div id="mensajeConfirmación">
        
    </div>
    <div class="contenedor">
        <h1 id="tituloCV">____CV____</h1>
        <div id="pasos">
            <p class="numero1" id="numero1">1</p>
            <div class="linea1" id="linea1"></div>
            <p class="numero2" id="numero2">2</p>
            <div class="linea2" id="linea2"></div>
            <p class="numero3" id="numero3">3</p>
        </div>
        <div id="contenido">
                <div id="titulo">
                    <form id="ponerTituloCV" action="crearCV.php" method="post">
                        <p class="titulotext">Titulo</p>
                        <input type="text" name="idCV" value="'.$idCV.'" style="display: none;"/>
                        <input type="text" name="nombre" value="'.$nombreusuario.'" style="display: none;"/>
                        <input type="text" class="ponerTitulo" name="tituloCV" value="'.$tituloCV.'" placeholder="Inserte título" required/>
                    </form>
                </div>
                <div id="dos">
                    <p class="titulotext">Formación</p>
                    <div id="idiomastitulaciones">';
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
                        
                            echo '<div id="idiomaotitulacion"> 
                            <h2>Idioma</h2>
                            <p>'.$nombre.': '.$nivel.'(Certificado '.$certificado.')</p>
                            <a href="crearCV.php?nombre='.$nombreusuario.'&id='.$idCV.'&nombreIdioma='.$nombre.'"><span id="cruz" class="material-symbols-outlined">close</span></a>
                        </div>';
                        }
                        $query = '//cv[@id="' . $idCV . '"]/formacion/titulacion';
                        $titulacionNodes = $xpath->query($query);
                        foreach ($titulacionNodes as $titulacionNode) {
                            $nombre = $titulacionNode->getElementsByTagName('nombre')->item(0)->nodeValue;
                            $fecha = $titulacionNode->getElementsByTagName('fecha')->item(0)->nodeValue;
                            $centro = $titulacionNode->getElementsByTagName('centro')->item(0)->nodeValue;
                            
                            echo'<div id="idiomaotitulacion"> 
                                <h2>Titulación</h2>
                                <strong>'.$fecha.' - '.$nombre.'</strong>
                                <p class="centro">'.$centro.'</p>
                                <a href="crearCV.php?nombre='.$nombreusuario.'&id='.$idCV.'&nombreTitu='.$nombre.'"><span id="cruz" class="material-symbols-outlined">close</span></a>
                            </div>';
                        }
                    echo'</div>
                    <div id="contenedorformacion">
                        <button id="anyadirtitul">Añadir titulación</button>
                        <div id="divtitulacion">
                        </div>
                        <button id="anyadiridioma">Añadir idioma</button>
                        <div id="dividiomas">
                            <div id="idiomaotitulacion"> 
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tres">
                    <p class="titulotext">Experiencia</p>
                    <div id="contenedorexperiencia">
                        <div id="experiencias">';


                        // Buscar todos los elementos "item" dentro del CV con el ID especificado
                        $query = '//cv[@id="' . $idCV . '"]/experiencia/item';
                        $itemNodes = $xpath->query($query);
                        foreach ($itemNodes as $itemNode) {
                        // Acceder a los subcampos del elemento item
                        $titulo = $itemNode->getElementsByTagName('titulo')->item(0)->nodeValue;
                        $sector = $itemNode->getElementsByTagName('sector')->item(0)->nodeValue;
                        $descripcion = $itemNode->getElementsByTagName('descripcion')->item(0)->nodeValue;
                        $fechaInicio = $itemNode->getElementsByTagName('fecha_inicio')->item(0)->nodeValue;
                        $fechaFin = $itemNode->getElementsByTagName('fecha_fin')->item(0)->nodeValue;
                            echo'<div class="experiencia">
                                <h2>Titulación</h2>
                                <strong>'.$fechaInicio.' - '.$fechaFin.': '.$titulo.'</strong>
                                <p class="desc">'.$descripcion.'</p>
                                <a href="crearCV.php?nombre='.$nombreusuario.'&id='.$idCV.'&nombreXP='.$titulo.'"><span id="cruz" class="material-symbols-outlined">close</span></a>
                            </div>';
                        }
                        echo' </div>
                        <button id="anyadirxp">Añadir experiencia</button>
                        <div id="divexperiencia">
                            <form action="crearCV.php" method="post">
                                <input type="text" name="nombre" value="'.$nombreusuario.'" style="display: none;"/>
                                <input type="text" name="idCV" value="'.$idCV.'" style="display: none;"/>
                                <p>Titulo:</p>
                                <input type="text" class="typetext" name="tituloXP" placeholder="Nombre puesto realizado" required/>
                                <p>Sector:</p>
                                <input type="text" class="typetext" name="sectorXP" placeholder="Sector al que pertenece el puesto" required/>
                                <p>Descripción:</p>
                                <input type="text" class="typetext" name="descXP" placeholder="Qué hacias en el puesto, observaciones,..." required/>
                                <p>Fecha inicio:</p>
                                <input type="date" name="fechaIni" class="typetext" required/>
                                <p>Fecha fin:</p>
                                <input type="date" name="fechaFin" class="typetext" required/>
                                <input type="submit" id="guardarexp" value="Añadir"/>
                                <button id="cancelar">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
        <div id="botones">
            <button id="siguiente">Siguiente</button>
            <button id="atras">Atras</button>
            <a href="listadocurriculums.php?nombre='.$nombreusuario.'" id="guardarimprimir">Guardar</a>
        </div>
        </div>
    </div>
    <footer>
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
    </footer>
    <script>
        var cont = '.$contador.';
        var curriculumActual = localStorage.getItem(\'curriculumHaciendose\');
        if (cont===0) {
            document.getElementById(\'atras\').style.visibility = "hidden";
            document.getElementById(\'titulo\').style.display = "";
            document.getElementById(\'dos\').style.display = "none";
            document.getElementById(\'tres\').style.display = "none";
            document.getElementById(\'guardarimprimir\').style.visibility = "hidden";
        }
        if(cont===1){
            document.getElementById(\'atras\').style.visibility = "visible";
            document.getElementById(\'titulo\').style.display = "none";
            document.getElementById(\'dos\').style.display = "";
            document.getElementById(\'tres\').style.display = "none";
            document.getElementById(\'guardarimprimir\').style.visibility = "hidden";
            document.getElementById(\'numero1\').style.backgroundColor = \'#00f804\';
            document.getElementById(\'linea1\').style.backgroundColor = \'#00f804\';
        }
        if(cont===2){
            document.getElementById(\'atras\').style.visibility = "visible";
            document.getElementById(\'titulo\').style.display = "none";
            document.getElementById(\'dos\').style.display = "none";
            document.getElementById(\'tres\').style.display = "";
            document.getElementById(\'guardarimprimir\').style.visibility = "visible";
            document.getElementById(\'siguiente\').style.visibility = "hidden";
            document.getElementById(\'linea2\').style.backgroundColor = \'#00f804\';
            document.getElementById(\'numero2\').style.backgroundColor = \'#00f804\';
            document.getElementById(\'numero1\').style.backgroundColor = \'#00f804\';
        document.getElementById(\'linea1\').style.backgroundColor = \'#00f804\';
        }
        document.getElementById(\'divexperiencia\').style.display = "none";
        document.getElementById(\'atras\').addEventListener(\'click\', function () {
            window.scrollTo(0, 0);
        cont--;
        if (cont===0) {
            document.getElementById(\'atras\').style.visibility = "hidden";
            document.getElementById(\'linea1\').style.backgroundColor = \'#0091f8\';
            document.getElementById(\'numero1\').style.backgroundColor = \'#0091f8\';
            document.getElementById(\'titulo\').style.display = "grid";
        } else {
            document.getElementById(\'atras\').style.visibility = "visible";
            
        }
        if(cont===1){
            document.getElementById(\'dos\').style.display = "grid";
        }else{
            document.getElementById(\'dos\').style.display = "none";
        }
        if (cont === 2) {
            document.getElementById(\'siguiente\').style.visibility = "hidden";
            document.getElementById(\'tres\').style.display = "grid";
        } else {
            document.getElementById(\'siguiente\').style.visibility = "visible";
            document.getElementById(\'tres\').style.display = "none";
        }
        document.getElementById(\'guardarimprimir\').style.visibility = "hidden";
        document.getElementById(\'numero2\').style.backgroundColor = \'#0091f8\';
        document.getElementById(\'linea2\').style.backgroundColor = \'#0091f8\';
        });

        document.getElementById(\'siguiente\').addEventListener(\'click\', function () {
            window.scrollTo(0, 0);
        cont++;
        if (cont===0) {
            document.getElementById(\'atras\').style.visibility = "hidden";
        } else {
            document.getElementById(\'atras\').style.visibility = "visible";
        }
        if(cont===1){
            document.getElementById(\'dos\').style.display = "grid";
            document.getElementById(\'ponerTituloCV\').submit();
        }else{
            document.getElementById(\'dos\').style.display = "none";
        }
        if (cont === 2) {
            document.getElementById(\'siguiente\').style.visibility = "hidden";
            document.getElementById(\'linea2\').style.backgroundColor = \'#00f804\';
            document.getElementById(\'numero2\').style.backgroundColor = \'#00f804\';
            document.getElementById(\'tres\').style.display = "grid";
            document.getElementById(\'guardarimprimir\').style.visibility = "visible";
        } else {
            document.getElementById(\'siguiente\').style.visibility = "visible";
            document.getElementById(\'tres\').style.display = "hidden";
        }
        document.getElementById(\'numero1\').style.backgroundColor = \'#00f804\';
        document.getElementById(\'linea1\').style.backgroundColor = \'#00f804\';
        document.getElementById(\'titulo\').style.display = "none";
    });
    document.getElementById(\'divtitulacion\').style.visibility="hidden";
    document.getElementById(\'anyadirtitul\').addEventListener(\'click\', function () {
        const form1 = `
                    <form action="crearCV.php" method="post">
                        <input type="text" name="nombre" value="'.$nombreusuario.'" style="display: none;"/>
                        <input type="text" name="idCV" value="'.$idCV.'" style="display: none;"/>
                        <p>Nombre:</p>
                        <input type="text" name="nombreTitul" class="typetext" placeholder="Nombre titulación" required/>
                        <p>Fecha:</p>
                        <input type="date" name="fechaTitul" class="typetext" required/>
                        <p>Centro</p> 
                        <input type="text"  name="centroTitul" class="typetext" placeholder="Centro de formación" required/>
                        <input type="submit" id="guardar" value="Guardar"/>
                        <button id="cancelar">Cancelar</button>
                    </form>
                    `;
        document.getElementById(\'divtitulacion\').style.visibility="visible";
        document.getElementById(\'divtitulacion\').innerHTML += form1;
        document.getElementById(\'anyadirtitul\').style.visibility = "hidden";
        document.getElementById(\'cancelar\').addEventListener(\'click\', function () {
            document.getElementById(\'divtitulacion\').innerHTML ="";
            document.getElementById(\'divtitulacion\').style.visibility="hidden";
            document.getElementById(\'anyadirtitul\').style.visibility = \'visible\';
        });
    });
    document.getElementById(\'dividiomas\').style.visibility="hidden";
    document.getElementById(\'anyadiridioma\').addEventListener(\'click\', function () {
        const form1 = `
                    <form action="crearCV.php" method="post">
                        <input type="text" name="nombre" value="'.$nombreusuario.'" style="display: none;"/>
                        <input type="text" name="idCV" value="'.$idCV.'" style="display: none;"/>
                        <p>Nombre:</p>
                        <input type="text" name="nombreIdioma" class="typetext" placeholder="Nombre idioma" required/>
                        <p>Nivel:</p>
                        <input type="text" name="nivelIdioma" class="typetext" placeholder="Nivel de habla" required/>
                        <p>Certificado:</p>
                        <input type="text" name="certificadoIdioma" class="typetext" placeholder="Certificado" required/>
                        <input type="submit" id="guardar" value="Guardar"/>
                        <button id="cancelar">Cancelar</button>
                    </form>
`;
        document.getElementById(\'dividiomas\').style.visibility="visible";
        document.getElementById(\'dividiomas\').innerHTML += form1;
        document.getElementById(\'anyadiridioma\').style.visibility = \'hidden\';
        document.getElementById(\'cancelar\').addEventListener(\'click\', function () {
            document.getElementById(\'dividiomas\').innerHTML ="";
            document.getElementById(\'dividiomas\').style.visibility="hidden";
            document.getElementById(\'anyadiridioma\').style.visibility = \'visible\';
        });  
    });

    document.getElementById(\'anyadirxp\').addEventListener(\'click\', function () {
            document.getElementById(\'divexperiencia\').style.display = "";
            document.getElementById(\'anyadirxp\').style.display = "none";
            document.getElementById(\'cancelar\').addEventListener(\'click\', function () {
                document.getElementById(\'divexperiencia\').style.display = "none";
                document.getElementById(\'anyadirxp\').style.display = "";
            });
        });
    </script>
</body>
</html>';
?>
<?php 
$nombreUsuario = $_GET['nombre'];
$nombreFormulario = $_POST['name'];
$contrasenyaFormulario = $_POST['contrasenya'];
$activar =$_GET['activar'];
$noencontrado = true;

if( $nombreFormulario!='' && $contrasenyaFormulario!=''){
    $nombreFormulario= trim($nombreFormulario,' ');
    $contrasenyaFormulario = trim($contrasenyaFormulario,' ');
    $noencontrado = false;
    $encontradoUsuario = false;
    if($nombreFormulario=='root'&&$contrasenyaFormulario=='1234'){
        header('location:index.php?nombre='.$nombreFormulario);
        $noencontrado = false;
    }
    $carga_xml = simplexml_load_file("XML/proyecto.xml");
    foreach($carga_xml->usuarios->noroot->usuariosnoroot->usuario as $usuariosnotRoot){
        $nombreNoroot = $usuariosnotRoot->nombre;
        $email = $usuariosnotRoot -> correo;
        $contrasenyaNoroot = $usuariosnotRoot->contrasenya;
        if($nombreNoroot==$nombreFormulario||$email==$nombreFormulario){
            $encontradoUsuario=true;
        }
        if(($nombreNoroot==$nombreFormulario||$email==$nombreFormulario)&&$contrasenyaNoroot==$contrasenyaFormulario){
            $nombreFormulario = $nombreNoroot;
            header('location:index.php?nombre='.$nombreFormulario);
        }
    }
}


echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EasyPass</title>
<link rel="stylesheet" href="index.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda&family=Josefin+Slab:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<body>
    <header>
       <div class="logo">
            <img class="logoDibujo" src="EasyPass.png" alt="Logo">
       </div>';
        if($nombreUsuario==''){
        echo '<div class="botonesUsuario">
        <button id="botonIniciarSesion" class="botonFondoAzul-InicioSesion">Inciar sesión</button>
        <a href="registrousuario.php" class="botonFondoAzul-crearCuenta">Resgistrate</a>
        </div>
    </header>
    <div id="iniciaSesions">

    </div>';
        }else{
            $xml = new DOMDocument();
            $xml->load('XML/proyecto.xml');
            $xpath = new DOMXPath($xml);
            $expresion = '//usuario[nombre/text() = "'.$nombreUsuario.'"]';
            $nodos = $xpath->query($expresion);
            foreach ($nodos as $nodo) {
                // Obtener el valor del campo "imagen"
                $imagenNodo = $nodo->getElementsByTagName('imagen')->item(0);
                $imagenusuario = $imagenNodo->nodeValue;
            }
            echo'<input type="checkbox" id="menuOpcionesUsuario"/>
            <label for="menuOpcionesUsuario" class="labelMenu">
            <div class="nombreUsuario" >
                 <img src="'.$imagenusuario.'" alt="imagenUsuar" id="imagenUsuar">
                 <span id="expand_more" class="material-symbols-outlined">
                     expand_more
                     </span>
                 <span id="expand_less" class="material-symbols-outlined">
                     expand_less
                 </span>
                 <p id="texto">'.$nombreUsuario.'</p>
             </div>
             </label>
             <div class="opcionesUsuario">';
                if($nombreUsuario=='root'){
                    echo '<a href="listadoUsuarios.php" class="opcionUsuario">Usuarios creados</a>
                          <a href="listadocurriculums.php?nombre=root" class="opcionUsuario">CV\'s</a>';
                }else{
                 echo '<a href="listadocurriculums.php?nombre='.$nombreUsuario.'" class="opcionUsuario">Mis CV</a>
                 <a href="#sobreNosotros" class="opcionUsuario">Sobre Nosotros</a>
                 <a href="modificarUsuarios.php?nombre='.$nombreUsuario.'" class="opcionUsuario">Modificar datos</a>';
                }
                 echo '<a href="index.php" class="opcionUsuario">Cerrar sesión</a>
             </div>';
             if($nombreUsuario!='root'){
                echo '<a href="crearCV.php?nombre='.$nombreUsuario.'" class="crearCV">Crear CV</a>';
             }
        }
    echo '</header>
    <div id="circuloInicio">
            <h1 id="texto-circulo">Crea tu CV facíl y rápido para entrar en la empresa que quieras</h1>
            <a href="';
        if($nombreUsuario==''){
            echo 'registrousuario.php';
        }else{
            echo'crearCV.php?nombre='.$nombreUsuario.'';
        }
            echo'" class="botonFondoAzul-empezar">Empezar</a>
    </div>
    <h1 id="sobreNosotros">SOBRE NOSOTROS</h1>
        <div class="contenedorInfo">
            <div class="info1">
                <img class="imgInfo" src="https://traveler.marriott.com/es/wp-content/uploads/sites/2/2022/05/GI-952968964-Team-Building-1920x1080.jpg" alt="">
                <h3 class="titInfo">Ahorra tiempo y disfruta</h3>
                <p class="textInfo">Ház en segundo tú CV y deja de perder en pensar que campos rellenar y elegir diseños</p>
                <br/>
            </div>
            <div class="info1">
                <img class="imgInfo" src="https://img.freepik.com/fotos-premium/exitoso-grupo-empresarial-feliz-personas-trabajo-oficina_522218-613.jpg" alt="">
                <h3 class="titInfo">Encuentra tu trabajo ideal</h3>
                <p class="textInfo">Cuando crees tu correo podrás encontrar tú trabajo que siempre has deseado</p>
                <br/>
            </div>
            <div class="info1">
                <img class="imgInfo" src="https://media.adeo.com/media/2293964/format/jpeg" alt="">
                <h3 class="titInfo">¿Quiénes somos?</h3>
                <p class="textInfo">Soy José Luis Tárraga un alumno de 1ºDAW, que tiene interés en que puedas encontrar un trabajo adecuado para tí</p>
                <br/>
            </div>
        </div>
        <footer>
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
    </footer>
    <script>';
    if($noencontrado == false){
        echo'const form = `<div class="opacidad">
        </div>
        <form action="index.php" method="POST">
            <h1 id="textoInfo">Iniciar sesión</h1>
            <input type="text" class="nameInput" name="name" id="name"placeholder="Nombre de usuario o correo" required/>';
            if($encontradoUsuario == false){
                echo '<p class="errorNombre">  <span id="errorNom" class="material-symbols-outlined">cancel</span>  Usuario no encontrado</p>';
            }
            echo'<input type="password" class="contrasenyaInput" id="contrasenya" name="contrasenya" placeholder="Contraseña" required/>';
            if($encontradoUsuario==true){
                echo'<p class="errorContra"><span id="errorCon" class="material-symbols-outlined">cancel</span>  Contraseña incorrecta</p>';
            }
            echo'<button id="cerrarDiv" ><span class="material-symbols-outlined">close</span></button>
            <input type="submit" id="iniciarSesion"  class="enviarFormulario" value="Iniciar sesión"/>
            <p id="iniciaSesion">¿No tienes cuenta? <a href="registrousuario.php" id="ainiciaSesion">Regístrate aquí</a></p>
        </form>`;
        document.getElementById("iniciaSesions").innerHTML = form;
        document.getElementById("cerrarDiv").addEventListener(\'click\',function(){
                document.getElementById("iniciaSesions").innerHTML = "";
            });';
    }
    if($activar=='si'){
        echo 'const form = `<div class="opacidad">
        </div>
        <form action="index.php" method="POST">
            <h1 id="textoInfo">Iniciar sesión</h1>
            <input type="text" class="nameInput" name="name" id="name"placeholder="Nombre de usuario o correo" required/>
            <input type="password" class="contrasenyaInput" id="contrasenya" name="contrasenya" placeholder="Contraseña" required/>
            <button id="cerrarDiv" ><span class="material-symbols-outlined">close</span></button>
            <input type="submit" class="enviarFormulario" value="Iniciar sesión"/>
            <p id="iniciaSesion">¿No tienes cuenta? <a href="registrousuario.php" id="ainiciaSesion">Regístrate aquí</a></p>
        </form>`;
            document.getElementById("iniciaSesions").innerHTML = form;
            document.getElementById("cerrarDiv").addEventListener(\'click\',function(){
                document.getElementById("iniciaSesions").innerHTML = "";
            });';
    }

        echo 'document.getElementById("botonIniciarSesion").addEventListener(\'click\',function (){
            const form = `<div class="opacidad">
        </div>
        <form action="index.php" method="POST">
            <h1 id="textoInfo">Iniciar sesión</h1>
            <input type="text" class="nameInput" name="name" id="name"placeholder="Nombre de usuario o correo" required/>
            <input type="password" class="contrasenyaInput" id="contrasenya" name="contrasenya" placeholder="Contraseña" required/>
            <button id="cerrarDiv" ><span class="material-symbols-outlined">close</span></button>
            <input type="submit" class="enviarFormulario" value="Iniciar sesión"/>
            <p id="iniciaSesion">¿No tienes cuenta? <a href="registrousuario.php" id="ainiciaSesion">Regístrate aquí</a></p>
        </form>`;
            document.getElementById("iniciaSesions").innerHTML = form;
            document.getElementById("cerrarDiv").addEventListener(\'click\',function(){
                document.getElementById("iniciaSesions").innerHTML = "";
            });
        });
    </script>
</body>
</html>';


?>
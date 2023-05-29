<?php
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $contrasenya = $_POST['contrasenya'];
    $contrasenyarepe = $_POST['repetic'];
    $cont = 0;

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPass</title>
    <link rel="stylesheet" type="text/css" href="registrousuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
             <a href="index.php"><img class="logoDibujo" src="EasyPass.png" alt="Logo"></a>
        </div>
    </header>';
    if($nombre == null){
    
        echo '<form action="registrousuario.php" method="post">
        <h1 id="textoInfo">Registro de usuario</h1>
        <input type="text" class="nameInput" name="name" placeholder="Nombre de usuario" required/>
        <input type="email" class="emailInput" name="email" placeholder="Correo" required/>
        <input type="password" class="contrasenyaInput" name="contrasenya" placeholder="Contraseña" required/>
        <input type="password" class="contrasenyaRepInput" name="repetic" placeholder="Repite contraseña" required/>
        <input type="submit" class="enviarFormulario" value="Crear"/>
        <p id="iniciaSesion">¿Tienes cuenta ya?<a href="index.php?activar=si" id="ainiciaSesion">Inicia sesión</a></p>
        </form>';
    }else{
        $encontradoUsuario = false;
        $encontradoEmail = false;
        $contrasenyadistintas = false;
        $nombre = trim($nombre,' ');
        $email = trim($email,' ');
        $contrasenya = trim($contrasenya,' ');
        $carga_xml = simplexml_load_file("XML/proyecto.xml");
        foreach($carga_xml->usuarios->noroot->usuariosnoroot->usuario as $usuariosnotRoot){
            $nombreNoroot = $usuariosnotRoot->nombre;
            $emailNoroot = $usuariosnotRoot->correo;
            if($nombreNoroot==$nombre){
                $encontradoUsuario = true;
            }
            if($emailNoroot==$email){
                $encontradoEmail = true;
            }
        }

        if($nombre == 'root'){
            $encontradoUsuario = true;
        }

        if($contrasenya!=$contrasenyarepe){
            $contrasenyadistintas=true;
        }

        if($encontradoEmail==true||$encontradoUsuario==true||$contrasenyadistintas==true){
            echo '<form action="registrousuario.php" method="post">
                <h1 id="textoInfo">Registro de usuario</h1>';
            
            echo '<input type="text" class="nameInput" name="name" placeholder="Nombre de usuario" maxlength="9" required/>';
            if($encontradoUsuario==true){
                echo '<p class="errorNombre">  <span class="material-symbols-outlined">cancel</span>  Nombre ya existe</p>';
                $cont++;
            }
            echo '<input type="email" class="emailInput" name="email" placeholder="Correo" required/>';
            if($encontradoEmail==true){
                echo '<p class="errorEmail">  <span class="material-symbols-outlined">cancel</span>  Email ya existe</p>';
                $cont++;
            }
            echo '<input type="password" class="contrasenyaInput" name="contrasenya" placeholder="Contraseña" required/>';
            echo' <input type="password"  class="contrasenyaRepInput" name="repetic" placeholder="Repite contraseña" required/>';

            if($contrasenyadistintas==true){
                echo '<p class="errorContra">  <span class="material-symbols-outlined">cancel</span>  Contraseñas distintas</p>';
                $cont++;
            }
            echo '<input type="submit" class="enviarFormulario" value="Crear"/>
            <p id="iniciaSesion">¿Tienes cuenta ya?<a href="index.php?activar=si" id="ainiciaSesion">Inicia sesión</a></p>';
            

            echo '</form>';
        }else{
            $documento = new DOMDocument();
            //Cargamos el XML que queremos tratar.
            $documento->load('XML/proyecto.xml');
        
            //Nodo alumnos.
            $usuariosNoRoot = $documento->getElementsByTagName('usuariosnoroot')[0];
        
            //Nodo alumno.
            $usuario = $documento->createElement('usuario');
        
            //Nombre nombre
            $nombreusuario = $documento->createElement('nombre', $nombre);
        
            //Nombre apellido
            $contrasenya = $documento->createElement('contrasenya', $contrasenya);
        
            //Nombre nivel
            $email = $documento->createElement('correo', $email);
            $imagen = $documento->createElement('imagen','imagenUsuario.php');

            $masinfo = $documento->createElement('mas_datos');
        
            //Agregamos los nodos hijos.
            $usuario->appendChild($nombreusuario);
            $usuario->appendChild($contrasenya);
            $usuario->appendChild($email);
            $usuario->appendChild($imagen);
            $usuario->appendChild($masinfo);
            $usuariosNoRoot->appendChild($usuario);
        
            //Agregamos todo el árbol al objeto.
            $documento->getElementsByTagName('noroot')[0]->appendChild($usuariosNoRoot);
        
            

            //Guardamos el XML.
            $documento->save('XML/proyecto.xml');
            header('location:index.php?nombre='.$nombre);
            
        }
    }
echo '
        <br/>
        <footer id="';
        if($cont==1){
            echo'unError';
        }
        if($cont==2){
            echo'dosError';
        }
        if($cont==0){
            echo'noError';
        }

        echo'">
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
        </footer>
    </body>
</html>';


?>

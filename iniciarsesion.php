<?php
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="iniciousuario.css">
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
    </header>
    <form action="registrousuario.php" method="post">
        <h1 id="textoInfo">Iniciar sesión</h1>
        <input type="text" class="nameInput" name="name" placeholder="Nombre de usuario o correo" required/>
        <input type="password" class="contrasenyaInput" name="contrasenya" placeholder="Contraseña" required/>
        
        <input type="submit" class="enviarFormulario" value="Crear"/>
        <p id="iniciaSesion">¿No tienes cuenta? <a href="registrousuario.php" id="ainiciaSesion">Regístrate aquí</a></p>
    </form>
    <br/>
    <footer id="noError">
        <br/>
        <br/>
        <p style="font-size: x-large; color: aliceblue; font-family: \'Bebas Neue\', sans-serif;">&copy;1ºDAW/JOSE LUIS TARRAGA SEGURA 2023 </p>
    </footer>
    </body>
</html>';







?>
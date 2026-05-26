<?php
session_start();
session_destroy();
$_SESSION['swlogin'] = '0';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/favicon.ico" rel="icon">
    <title>DATM</title>
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>

<body>
    <div class="menu">
        <a href="index.php">SITIO DATM</a> | <a href="consultaTramite.php">SEGIMIENTO A TRAMITE</a>
    </div>
    <div class="containerLogin">
        <!-- <div class="containerLogin__form containerLogin--signup">
            <div class="form" id="form1">
                <h2 class="form__title">Registrarse</h2>
                <input type="text" placeholder="Usuario" class="input" />
                <input type="email" placeholder="Email" class="input" />
                <input type="password" placeholder="Password" class="input" />
                <button class="btn">Solicitar</button>
            </div>
        </div> -->


        <div class="containerLogin__form containerLogin--signin">
            <div class="form" id="form2">
                <!-- <h2 class="form__title">Ingresar</h2> -->
                <p><img src="../img/logogamea.png" style="max-height: 6rem;"></p>
                <input type="text" placeholder="Usuario" id="usuario" class="input" />
                <input type="password" placeholder="Password" id="password" class="input" />
                <a href="#" class="link">Olvido su contraseña?</a>
                <span id="err" class="err"></span>
                <button class="btn" id="btnLogin">Acceder</button>
            </div>
        </div>

        <!-- <div class="containerLogin__overlay">
            <div class="overlay">
                <div class="overlay__panel overlay--left">
                    <button class="btn" id="signIn">Ingresar</button>
                </div>
                <div class="overlay__panel overlay--right">
                    <button class="btn" id="signUp">Registrarse</button>
                </div>
            </div>
        </div> -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script defer src="../js/mainLogin.js"></script>
</body>

</html>
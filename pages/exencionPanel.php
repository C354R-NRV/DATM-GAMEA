<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<html lang="es">

<head>
    <title>EXENCION</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">

    <style>
        .wrapper {
            width: 100%;
            height: 100%;
            min-height: 89vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            background-image: url("../img/backgroundlogin3.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .wrapper .box {
            position: relative;
            width: 280px;
            height: 400px;
            box-shadow: 20px 20px 50px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            border-left: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
            transform-style: preserve-3d;
            transform: perspective(800px);
            cursor: pointer;
        }

        .h2Panel {
            color: rgb(26, 23, 23);
            font-size: 2.5rem;
            text-align: center;
            font-family: 'Acme', sans-serif;
        }

        .pPanel {
            color: #1f1f1f;
            margin: 20px 10px;
            font-family: 'Fira Code', monospace;
        }

        .ulPanel {
            list-style: none;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            margin: 30px 0;
            padding: 10px;
        }

        .liPanel {
            cursor: pointer;
            width: 30px;
            height: 30px;
        }

        .box i {
            color: #454545; 
            transition: all 0.3s ease; 
            text-align: center;
            font-size: 7rem;
            color: rgb(30, 65, 87, 0.8);
            padding: 1rem;
        } 

        .box p {
            text-align: center;
            color: rgb(30, 65, 87);
            font-size: 1rem;
            font-weight: bold;
            padding: 1rem;
        }

        .box:hover .fa-car  {
            transform: translate3d(0, -10px, 30px);
            color:rgb(1, 47, 65);
        }

        .box:hover .fa-shopping-basket {
            transform: translate3d(0, -10px, 30px);
            color:rgb(1, 47, 65);
        }

        .box:hover .fa-home {
            transform: translate3d(0, -10px, 20px);
            color:rgb(1, 47, 65);
        }

        .card-0 {
            background-color: rgba(243, 252, 191, 0.52);
        }
        .card-1 {
            background-color: rgba(190, 241, 248, 0.52);
        }
        .card-2 {
            background-color: rgba(240, 240, 240, 0.35);
        }
    </style>
</head>

<body>
    <?php
    echo $twig->render('load.twig');
    ?>
    <!-- Navbar Start -->
    <?php
    echo $twig->render('menuIni.twig');

    if ($_SESSION['swlogin'] == '1') {
        echo $twig->render('menuLogin.twig', array('datSesion' => $_SESSION));
    } else {
        echo $twig->render('menuVisita.twig');
    }

    echo $twig->render('menuFin.twig');
    ?>
    <!-- Navbar End -->
    <!-- Hero Start -->
    <?php
    echo $twig->render('prebodyltIni.twig');
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="exencionList.php">EXENCION</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- About Start -->
    <div>

        <div class="overlay">
        </div>
        <div class="wrapper">
            <div class="box card-0" onclick="">
                <div class="description">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <hr>
                    <p>Vehículos</p> 
                </div>
            </div>
            <div class="box card-1">
                <div class="description">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <hr>
                    <p>Inmuebles</p> 
                </div>
            </div>
            <!-- <div class="box card-2">
                <div class="description">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <hr>
                    <p>Act. Económica</p> 
                </div>
            </div> -->
        </div>
    </div>

    <!-- About End -->
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
</body>
<script src="../js/mainRecursoIa.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".box"), {
        max: 25,
        speed: 400,
        easing: "cubic-bezier(.03,.98,.52,.99)",
        perspective: 500,
        transition: true
    });
    $('.card-0').click(function() {
        window.location.href = 'exencionFormVeh.php';
    });
    $('.card-1').click(function() {
        window.location.href = 'exencionRevision.php';
    });
    /* $('.card-2').click(function() {
        window.location.href = 'exencionRevision.php';
    }); */
</script>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/favicon.ico" rel="icon">
    <title>DATM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        :root {
            --white: #e9e9e9;
            --white-transparent: rgba(255, 255, 255, 0.5);
            --gray: #333;
            --blue: #0367a6;
            --lightblue: #008997;
            --button-radius: 0.7rem;
            --max-width: 25rem;
            --max-height: 40rem;
            font-size: 16px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        body {
            align-items: center;
            background-color: var(--white);
            /* background: url("../img/backgroundlogin.jpg"); */
            background: url("../img/backgroundlogin.jpg");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: grid;
            height: 85vh;
            place-items: center;
            /* overflow: hidden; */
        }

        .link {
            color: var(--gray);
            font-size: 0.9rem;
            margin: 1.5rem 0;
            text-decoration: none;
        }

        .err {
            color: #8d1919;
            font-size: 0.8rem;
            text-decoration: none;
        }

        .btn {
            background-color: var(--blue);
            background-image: linear-gradient(90deg, var(--blue) 0%, var(--lightblue) 74%);
            border-radius: 20px;
            border: 1px solid var(--blue);
            color: var(--white);
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: bold;
            letter-spacing: 0.1rem;
            padding: 0.3rem 0rem;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        .form>.btn {
            margin-top: 1.5rem;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:focus {
            outline: none;
        }

        #Principal {
            width: 100%;
            /* height: 100%; */
            height: auto;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            /* padding-top: 5px; */
        }

        #Calculadora {
            /* background-color: #d7d7d7;
			opacity: 0.9; */

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
        }

        #Pantalla {
            background: white;
            background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
            font-size: 20px;
            height: 100px;
            width: 100%;
            border: 0;
            margin: 0;
            text-align: right;
            padding: 10px;
            color: white;
            font-family: 'Roboto Condensed', sans-serif;
        }

        #Teclado {
            background: #ffffff;
            opacity: 0.8;
        }

        #Teclado .button {
            font-size: 2rem;
        }

        .button {
            background: #e3e3e3;
            opacity: 0.8;
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 20px;
            margin: 0;
            padding: 15px;
            border: 0;
            color: #202031;
            width: 100px;
            height: 80px;
            min-width: 10px;
            min-height: 10px;
            transition: all .2s ease-in-out;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
        }

        .button:hover {
            transform: scale(1.1);
            background: #fae4e4;
            border-radius: 5px;
            opacity: 0.7;
            color: #101018;
            -webkit-transform: scale(1.1);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
        }

        .button:active {
            transform: scale(1);
        }

        .containerLogin {
            background-color: var(--white-transparent);
            border-radius: var(--button-radius);
            box-shadow: 0 0.9rem 1.7rem rgba(0, 0, 0, 0.25), 0 0.7rem 0.7rem rgba(0, 0, 0, 0.22);
            height: var(--max-height);
            max-width: var(--max-width);
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .containerLogin__form {
            height: 100%;
            position: absolute;
            top: 0;
            transition: all 0.6s ease-in-out;
        }

        .form {
            /* background-color: var(--white-transparent); */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            /* padding: 0 3rem; */
            height: 100%;
            text-align: center;
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .d-flex input[type="text"] {
            flex: 0 0 60%;
            margin-top: 8px;
            padding: 3px;
            width: auto;
        }

        .d-flex select {
            flex: 0 0 25%;
            height: auto;
            margin-top: 8px;
            margin-right: 15px;
            padding: 3px;
        }

        .col-md-4 {
            flex: 0 0 auto;
            width: 33.3333333333%
        }

        .offset-md-4 {
            margin-left: 33.33333333%;
        }

        .col-md-offset-4 {
            margin-left: 33.33333333%;
        }

        .col-md-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .offset-md-12 {
            width: 100%;
        }

        .col-md-offset-6 {
            width: 100%;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table tr {
            border-bottom: 1px solid #ddd;
        }

        .custom-table tr:last-child {
            border-bottom: none;
        }

        .custom-table td {
            padding: 10px;
        }

        .menu {
            background-color: transparent;
            text-align: left;
            width: 100%;
            z-index: 999;
            position: relative;
            font-size: 0.7rem;
            margin-left: 5rem;
        }

        .menu a {
            color: #aaaaaa;
        }

        .menu a:hover {
            color: white;
            /* text-decoration: underline;  */
        }

        .loadGralOn {
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            background-color: #121212;
            opacity: 0.8;
            filter: alpha(opacity=80);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loadGralOn img {
            height: 6em;
        }

        .loadGralOff {
            display: none;
            height: 0%;
            width: 0%;
        }
    </style>
</head>

<body>
    <div class="loadGral"></div>
    <div class="menu">
        <a href="index.php">SITIO DATM</a> | <a href="login.php">LOGIN</a>
    </div>
    <div class="containerLogin">

        <div class="form" id="form2">
            <!-- <h2 class="form__title">Ingresar</h2> -->
            <!-- <img src="../img/logogamea.png" style="max-height: 2.7rem; "> -->
            <img src="../img/datmInteligente.png" style="max-height: 3.5rem; margin: -4rem 0 1rem 0 !important; ">

            <center>
                <h2 style="color:#d7d7d7; font-size: 1rem;padding-top: 0.5rem; ">
                    <p>SEGUIMIENTO A SU TRÁMITE</p>
                </h2>
            </center>

            <div id="Principal">
                <div id="Calculadora">
                    <div class="col-auto ms-auto d-print-none">
                        <form class="ui form" id="form_search" method="GET">
                            <div class="d-flex">
                                <input type="text" value="" id="nrohhrr" name="nrohhrr" class="form-control" style="margin-top: 8px;  width:auto; margin-right:10px; " autocomplete="off" placeholder="Nro. de hoja de ruta">
                                <select class="custom-select form-control-sm fuente" id="gestion" name="gestion" style="height: auto; margin-top: 8px; width:100%; margin-right:15px; padding:3; border-radius:5px;" aria-invalid="false">
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025" selected="selected">2025</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit_dtm" style="margin: 0.5rem; margin-left:13px; margin-right:13px;  width:90%;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="10" cy="10" r="7"></circle>
                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                </svg> BUSCAR
                            </button>
                        </form>
                    </div>
                    <div id="Teclado" class="buttons">
                        <button class="button" value="7">7</button><button class="button" value="8">8</button><button class="button" value="9">9</button><br>
                        <button class="button" value="4">4</button><button class="button" value="5">5</button><button class="button" value="6">6</button><br>
                        <button class="button" value="1">1</button><button class="button" value="2">2</button><button class="button" value="3">3</button><br>
                        <button class="button" value="">&nbsp;</button><button class="button" value="0">0</button><button class="button" value="CE">
                            < </button>
                    </div>
                    <!-- <button type="submit" class=" BotonBuscar btn btn-primary btn-lg btn-block p-3" id="search" name="search" style="margin-top: 1.666667%;"><i class="fas fa-search"></i><span class="BotonBuscar">BUSCAR</span></button>-->
                </div>
            </div>
            <span id="err" class="err"></span>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/mainv2.js"></script>
    <script>
        var ans = "";
        var clear = false;
        var calc = "";

        $(function() {
            /* divBody = document.getElementById('BodyContainer'); */
            divTeclado = document.getElementById('Principal');
            /* divBody.style.display = 'none'; */
            TxtBuscar = document.getElementById("nrohhrr");
            TxtBuscar.focus();
        });
        var ans = "";
        var clear = false;
        var calc = "";

        $(document).ready(function() {
            $("button").click(function() {
                var text = $(this).attr("value");

                if (parseInt(text, 10) == text || text === "." || text === "/" || text === "*" || text === "-" || text === "+" || text === "%") {
                    if (clear === false) {
                        calc += text;
                        $("#nrohhrr").val(calc);
                    } else {
                        calc = text;
                        $("#nrohhrr").val(calc);
                        clear = false;
                    }
                } else if (text === "CE") {
                    calc = calc.slice(0, -1);
                    $("#nrohhrr").val(calc);
                }
            });
        });

        function Limpiar() {
            calc = "";
            $("#nrohhrr").val("");
            $('select#gestion option[value="2024"]').prop('selected', true);
        }

        $("#form_search").submit(function() {

            event.preventDefault();

            datos = '&nrohhrr=' + $('#nrohhrr').val() + '&gestion=' + $('#gestion').val();
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "../php/searchHhrr.php",
                data: datos,
                beforeSend: function() {
                    loadGralOn();
                },
                success: function(e) {
                    loadGralOff();
                    console.log(e);
                    dat = $.parseJSON(e);
                    $.confirm({
                        title: dat.titulo_,
                        content: dat.contenido,
                        type: dat.color_,
                        typeAnimated: true,
                        columnClass: 'col-md-12 col-xs-4',
                        buttons: {
                            cancel: {
                                text: "Cerrar",
                                action: function() {},
                            },
                        },
                        onOpenBefore: function() {
                            $('.jconfirm-title-c').css('text-align', 'center');
                        }
                    });
                    Limpiar();
                },
                error: function() {}
            });

        });

        function CerrarDatosConsulta() {
            /* divBody.style.display = 'none'; */
            divTeclado.style.display = 'block';
            divTeclado.style.display = 'flex';
        }

        function startTime() {
            var today = new Date();
            var hr = today.getHours();
            var min = today.getMinutes();
            var sec = today.getSeconds();
            ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
            hr = (hr == 0) ? 12 : hr;
            hr = (hr > 12) ? hr - 12 : hr;
            //Add a zero in front of numbers<10
            hr = checkTime(hr);
            min = checkTime(min);
            sec = checkTime(sec);
            document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
            var months = ['Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
            ];
            var days = ['Domingo',
                'Lunes',
                'Martes',
                'Miercoles',
                'Jueves',
                'Viernes',
                'Sabado'
            ];
            var curWeekDay = days[today.getDay()];
            var curDay = today.getDate();
            var curMonth = months[today.getMonth()];
            var curYear = today.getFullYear();
            var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
            document.getElementById("date").innerHTML = date;

            var time = setTimeout(function() {
                    startTime()
                }

                , 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }

            return i;
        }
    </script>
</body>

</html>
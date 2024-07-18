var sw_ = true;
(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  // Sticky Navbar
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".sticky-top").addClass("bg-primary shadow-sm").css("top", "0px");
      $("#logodinamico_").html(
        '<img src="../img/logoDATM.png" style="max-width: 8rem;">'
      );
    } else {
      $(".sticky-top").removeClass("bg-primary shadow-sm").css("top", "-150px");
      $("#logodinamico_").html(
        '<img src="../img/SMAF_.png" style="max-width: 8rem;">'
      );
    }
  });

  var timer;
  $(window).scroll(function () {
    clearTimeout(timer);
    timer = setTimeout(checkEndOfPage, 100); // Espera 100 milisegundos antes de verificar
  });
  // Facts counter
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 2000,
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 100, "easeInOutExpo");
    return false;
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    items: 1,
    autoplay: true,
    smartSpeed: 1000,
    dots: true,
    loop: true,
    nav: true,
    navText: [
      '<i class="bi bi-chevron-left"></i>',
      '<i class="bi bi-chevron-right"></i>',
    ],
  });
})(jQuery);

function checkEndOfPage() {
  // Si la posición de desplazamiento más la altura de la ventana es igual a la altura del documento, entonces estamos en el pie de página

  if (
    $(window).scrollTop() + $(window).height() >= $(document).height() &&
    !$("#swLogin").val()
  ) {
    var contenido = `<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button> 
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">  
                <div class="bd-placeholder-img text-center">
                    <img src="../img/anuncios/20_descuento.jpg">
                    <div class="container text-center">
                        <div class="carousel-caption text-start"> 
                            <p><a class="btn btn-lg btn-warning" href="#"><i class="fa fa-facebook-f"></i> <span style="font-size:0.7rem;">Más info aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="carousel-item text-end">  
                <div class="bd-placeholder-img text-center">
                    <img src="../img/anuncios/20_descuento.jpg">
                    <div class="container text-center">
                        <div class="carousel-caption text-start"> 
                            <p><a class="btn btn-lg btn-warning" href="#"><i class="fa fa-facebook-f"></i> <span style="font-size:0.7rem;">Más info aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
        </div>`;
    let dialog = bootbox.dialog({
      message: contenido,
      size: "large",
    });
  }
}

$("#mensajeWtsp").keydown(detectarTecla);
$(".mensajeWtspBtn").click(detectarTecla);
$(".miRegistroBtn").click(formVerificaRegistros);

function formVerificaRegistros() {

  var sinLogin = `  
    <div>
        <div class="col-md-12">
          <label>PIN<span style="color:red;">*</span></label>
          <input type="password" id="pin_" class="form-control" placeholder="NUMERO PIN" value="6037"  required />
        </div>
    </div>
    <hr>
    <div style="color:red;font-size:0.8rem;">
      * Para obtener su número PIN, por favor realice su registro
    </div>
  `;
  if ($("#swLogin").val()) {
    sinLogin = '';
  }
  var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <label>CI/NIT</label>
                <div class="col-md-4">
                    <select id="tipodoc_" class="form-control">
                        <option selected value="CI">CI</option>
                        <option value="CEX">CEX</option>
                        <option value="NIT">NIT</option>
                        <option value="OD">OD</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="5725577" required />
                </div>
            </div>
            ${sinLogin} 
        </div>
        `;
  var errorContribuyente = true;
  $.confirm({
    title: "Por favor, ingrese la siguiente información:",
    type: "dark",
    content: content_,
    buttons: {
      tryAgain2: {
        text: "Registrarme",
        btnClass: "btn-green",
        action: function () {
          formRegistroContri($("#tipodoc_").val(), $("#ci_").val());
        },
      },
      formSubmit: {
        text: "Consultar",
        btnClass: "btn-blue",
        action: function () {
          var formSubmitButton = this.buttons.formSubmit;
          datos =
            "&tipodoc_=" + $("#tipodoc_").val() +
            "&ci_=" + $("#ci_").val() +
            "&pin_=" + $("#pin_").val();

          $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/getInfoGralContribuyente.php",
            data: datos,
            beforeSend: function () {
              formSubmitButton.setText('Procesando...');
              formSubmitButton.disable();
              loadGralOn();

            },
            success: function (e) {
              loadGralOff();
              formSubmitButton.setText('Consultar');
              formSubmitButton.enable();
              dat = JSON.parse(e);
              if (dat.color_ != 'red') {
                errorContribuyente = true;
              }
              contenido = dat.html;
              $.confirm({
                title: dat.titulo_,
                content: contenido,
                type: dat.color_,
                typeAnimated: true,
                containerFluid: true,
                buttons: {
                  cancel: {
                    text: "Cerrar",
                    action: function () { },
                  },
                },
                onOpenBefore: function () {
                  $('.jconfirm-title-c').css('text-align', 'center');
                }
              });
            },
            timeout: 16000,
            error: function () { },
          });
        },
      },
      cancel: function () { },
    },
    onContentReady: function () {
      var jc = this;
      /* this.$content.find("form").on("submit", function (e) {
        e.preventDefault();
        jc.$$formSubmit.trigger("click");
      }); */
      $('#pin_').on('keypress', function (ev) {
        if (ev.which === 13) {
          jc.$$formSubmit.trigger('click');
        }
      });
    },
  });
}
function formRegistroContri(tipo_, ci_) {
  selectCI = "";
  selectCEX = "";
  selectNIT = "";
  selectOD = "";
  switch (tipo_) {
    case "CI":
      selectCI = "selected";
      break;
    case "CEX":
      selectCEX = "selected";
      break;
    case "NIT":
      selectNIT = "selected";
      break;
    case "OD":
      selectOD = "selected";
      break;
  }

  html = `
    <div class="loadGral"></div>
    <div class="form-group" >
            <label>CI/NIT</label>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-4">
                    <select id="tipodoc_" class="form-control">
                        <option value="CI" ${selectCI}>CI</option>
                        <option value="CEX" ${selectCEX}>CEX</option>
                        <option value="NIT" ${selectNIT}>NIT</option>
                        <option value="OD" ${selectOD}>OD</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" id="ci_" placeholder="No." class="form-control" value="${ci_}" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nombre(s)/Razon Soc.</label>
                    <input type="text" id="nombre_" placeholder="Nombres ó Razon Social" value="ROMELIO" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label>Paterno/Sigla</label>
                    <input type="text" id="paterno_" placeholder="Ap. paterno ó sigla" value="YAMPARA" class="form-control" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Materno</label>
                    <input type="text" id="materno_" placeholder="Ap. Materno" value="CRUZ" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label>Ap. Casada</label>
                    <input type="text" id="apcasada_" placeholder="Ap. Casada" value="" class="form-control" required /> 
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Num. Celular</label>
                    <input type="text" id="cel_" placeholder="Celular" class="form-control" value="68110661"  required /> 
                </div>
                <div class="col-md-6">    
                    <label>Correo</label>
                    <input type="email" id="correo_" placeholder="Correo electronico" class="form-control" value="cesar.nrv@gmail.com" required />
                </div>
            </div>
            <hr>
            <label><span style="font-size:11px">* Se realizara una verificación interna de la información proporcionada previo a emitirle un numero PIN de acceso.</span></label>
            
            <!-- <label>Fecha nacimiento</label> <input type="text" id="fnacimiento_" placeholder="dd/mm/AAAA"  value="13/05/2001" class="form-control" required /> -->
            
        </div>
    `;
  var confirmForm = $.confirm({
    title: "Solicitud de PIN",
    content: html,
    type: "green",
    typeAnimated: true,
    columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
    containerFluid: true,
    buttons: {
      tryAgain: {
        text: "Solicitar PIN",
        btnClass: "btn-green",
        action: function () {
          var confirmButton = this.buttons.tryAgain;
          var datos =
            "&tipodoc_=" + $("#tipodoc_").val() +
            "&ci_=" + $("#ci_").val() +
            "&nombre_=" + $("#nombre_").val() +
            "&paterno_=" + $("#paterno_").val() +
            "&materno_=" + $("#materno_").val() +
            "&apcasada_=" + $("#apcasada_").val() +
            "&cel_=" + $("#cel_").val() +
            "&correo_=" + $("#correo_").val() +
            "&fnacimiento_=" + $("#fnacimiento_").val();
          $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/setContribuyente.php",
            data: datos,
            beforeSend: function () {
              loadGralOn();
              confirmButton.setText('Procesando...');
              confirmButton.disable();
            },
            success: function (e) {
              loadGralOff();
              dat = $.parseJSON(e);
              console.log(dat.sql);
              var respForm = $.confirm({
                title: dat.titulo_,
                content: dat.contenido_,
                type: dat.color_,
                typeAnimated: true,
                columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
                containerFluid: true,
                buttons: {
                  cancel: {
                    text: "Cerrar",
                    action: function () {
                      if (dat.color_ == 'green')
                        formVerificaRegistros();
                      else {
                        confirmButton.setText('Solicitar PIN');
                        confirmButton.enable();
                      }
                    },
                  },
                },
              });
              if (dat.color_ == 'green') {
                confirmForm.close();
              }

            },
            timeout: 16000,
            error: function () { },
          });

          return false; // EVITA QUE SE SIERRE EL DIALOGO
        },
      },
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
  });
}
function detectarTecla(event) {
  if (event.key === "Enter" || event.which === 1) {
    var mensajeWtsp = $("#mensajeWtsp").val();
    var url =
      "https://api.whatsapp.com/send?phone=59160103191&text=Hola%20DATM%20tengo la siguiente consulta";
    if (mensajeWtsp)
      url =
        "https://api.whatsapp.com/send?phone=59160103191&text=" + mensajeWtsp;
    window.open(url, "_blank");
  }
}
var mainDialog1 = "";
function getEstructuraContenido(elemt, color) {
  var contenido = "";
  datos = "&categoria_=" + elemt + "&color_=" + color;

  $.ajax({
    async: true,
    type: "POST",
    dataType: "html",
    contentType: "application/x-www-form-urlencoded",
    url: "../php/getRequisitos.php",
    data: datos,
    beforeSend: function () { },
    success: function (e) {
      dat = $.parseJSON(e);
      console.log(dat.query);
      contenido = dat.html;

      mainDialog1 = $.confirm({
        title: "Requisitos para <b>" + elemt + "</b>",
        content: contenido,
        type: color,
        typeAnimated: true,
        columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
        containerFluid: true,
        buttons: {
          cancel: {
            text: "Cerrar",
            action: function () { },
          },
        },
      });
    },
    timeout: 1600,
    error: function () { },
  });
}

function getcontenido(elemt, color, subelemt, descr, documento = false) {
  var src_ = "img/requisitos/" + elemt + "/" + subelemt + ".jpg";
  var contenido = "<div style='width:100%; text-align:center;'><img src='../img/requisitos/" + elemt + "/" + subelemt + ".jpg'></div>";
  title_ = "Requisitos para " + descr;

  var datosContactos = `<hr>
            <label>Contacto</label>
            <input type="text" id="contacto_" placeholder="Numero de celular" value="68110661"  class="form-control" required />
            <label>Correo</label>
            <input type="email" id="correo_" placeholder="Correo electrónico" value="cesar.nrv@gmail.com"  class="form-control" required />`;

  if (documento) {
    // aca ver como generar diferentes docuemntos para cada caso
    var text_ = "Generar solicitud";

    var content_ = "";

    if (subelemt == "inm_3") {
      content_ = `
      <div class="form-group">
          <label>CI/NIT</label>
          <div class="row">
              <div class="col-md-4">
                  <select id="tipodoc_" class="form-control">
                      <option selected value="CI">CI</option>
                      <option value="CEX">CEX</option>
                      <option value="NIT">NIT</option>
                      <option value="OD">OD</option>
                  </select>
              </div>
              <div class="col-md-8">
                  <input type="text" id="ci_" placeholder="No." class="form-control" value="6062066" required />
              </div>
          </div>
          <label>Nombre completo</label>
          <input type="text" id="nombre_" placeholder="Nombres Paterno Materno" value="Juan Poma Mamani" class="form-control" required />
          <label>Número de inmueble</label>
          <input type="text" id="numinmueble_" placeholder="No.inmueble"  value="1510399000" class="form-control" required />
          <label>Número de lote</label>
          <input type="text" id="numlote_" placeholder="Lote" class="form-control" value="24A"  required />
          <label>Manzano</label>
          <input type="text" id="manzano_" placeholder="Manzano" class="form-control" value="12" required />
          <label>Superficie Terreno</label>
          <input type="text" id="superficie_" placeholder="Superficie en metros cuadrados del terreno"value="250"  class="form-control" required />
          <label>Ubicación</label>
          <input type="text" id="ubicacion_" placeholder="Zona, Calle, Puerta" value="Z. Los Rosales, Calle Carrasco, No 452"  class="form-control" required />
          
          ${datosContactos} 
      </div>
      `;
    }
    if (subelemt == "inm_20") {
      content_ = `
                <div class="form-group">
                    <label>Número de inmueble</label>
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="1510390126" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="3384517" required />
                    
                    <label>Nuevo nombre:</label>
                    <input type="text" id="nuevonombre_" placeholder="Nuevo nombre" class="form-control"  value="JUAN ROJAS" required />
                    
                    ${datosContactos}
                </div>
                `;
    }
    if (
      subelemt == "inm_22" ||
      subelemt == "inm_23" ||
      subelemt == "inm_24" ||
      subelemt == "inm_27" ||
      subelemt == "inm_28" ||
      subelemt == "inm_1" ||
      subelemt == "inm_5" ||
      subelemt == "inm_7" ||
      subelemt == "inm_8" ||
      subelemt == "inm_30"
    ) {
      content_ = `
                <div class="form-group">
                    <label>Número de inmueble</label>
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="1510390126" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="3384517" required />  

                    ${datosContactos}
                </div>
                `;
    }
    if (subelemt == "inm_15" || subelemt == "inm_21") {
      content_ = `
                <div class="form-group">
                    <label>Número de inmueble</label>
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="1510390126" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="3384517" required />  

                    <label>Gestion</label>
                    <select id="gestion_" class="form-control">
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023" selected>2023</option>
                        <option value="2024">2024</option>
                    </select> 

                    ${datosContactos}

                </div>
                `;
    }

    // ---------------------------------------------- VEHICULOS -------------------------------------------
    if (subelemt == "veh_1" || subelemt == "veh_2" || subelemt == "veh_2_1" || subelemt == "veh_3") {
      content_ = `
                <div class="form-group">
                    <label>Número de placa</label>
                    <input type="text" id="num_placa_" placeholder="No.inmueble" class="form-control" value="1229EKF" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="2025873" required />
                    
                    ${datosContactos}
                </div>
                `;
    }

    if (subelemt == "veh_10" || subelemt == "veh_11" || subelemt == "veh_17") {
      content_ = `
                <div class="form-group">
                  <label>Número de placa</label>
                  <input type="text" id="num_placa_" placeholder="No.inmueble" class="form-control" value="2977IEK" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="5725577" required />
                  
                  <label>De Gestión</label>
                  <input type="text" id="gestionIni_" placeholder="2023" class="form-control" value="2021" required />
                  
                  <label>A Gestión</label>
                  <input type="text" id="gestionFin_" placeholder="2024" class="form-control" value="2023" required />
                  
                  ${datosContactos}

                </div>
                `;
    }

    if (subelemt == "eco_1") {
      content_ = `
                <div class="form-group">
                  <label>Número de patente</label>
                  <input type="text" id="num_act_" placeholder="No. patente" class="form-control" value="1511079444" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="1002831024" required />
                  
                  ${datosContactos}

                </div>
                `;
    }

    if (subelemt == "eco_5" || subelemt == "eco_7") {
      content_ = `
                <div class="form-group">
                  <label>Número de patente</label>
                  <input type="text" id="num_act_" placeholder="No. patente" class="form-control" value="1511079444" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="1002831024" required />
                  
                  <label>De Gestión</label> 
                  <select id="gestionIni_" class="form-control">
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023" selected>2023</option>
                        <option value="2024">2024</option>
                    </select> 
                  
                  ${datosContactos}

                </div>
                `;
    }

    mainDialogInf = $.confirm({
      title: title_,
      content: contenido,
      type: color,
      typeAnimated: true,
      columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
      containerFluid: true,
      buttons: {
        tryAgain2: {
          text: text_,
          btnClass: "btn-green",
          action: function () {
            formGeneraPdf(content_, subelemt, elemt);
          },
        },
        tryAgain: {
          text: "Descargar requisitos",
          btnClass: "btn-" + color,
          action: function () {
            var imageUrl = "../img/requisitos/" + elemt + "/" + subelemt + ".jpg";
            var link = $("<a>")
              .attr("href", imageUrl)
              .attr("download", subelemt + ".jpg")
              .appendTo("body");
            link[0].click();
            link.remove();
          },
        },
        cancel: {
          text: "Cerrar",
          action: function () { },
        },
      },
    });


  } else {
    $.confirm({
      title: title_,
      content: contenido,
      type: color,
      typeAnimated: true,
      columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
      containerFluid: true,
      buttons: {
        tryAgain: {
          text: "Descargar requisitos",
          btnClass: "btn-" + color,
          action: function () {
            var imageUrl = src_;
            var link = $("<a>")
              .attr("href", imageUrl)
              .attr("download", subelemt + ".jpg")
              .appendTo("body");
            link[0].click();
            link.remove();
          },
        },
        cancel: {
          text: "Cerrar",
          action: function () { },
        },
      },
    });
  }
}
function formGeneraPdf(content_, subelemt, elemt) {
  console.log('formGeneraPdf | ', subelemt, ' | ', elemt);

  if (content_ != '' && content_) {
    $.confirm({
      title: "Por favor, ingrese la siguiente información:",
      type: "dark",
      content: content_,
      buttons: {
        formSubmit: {
          text: "Generar",
          btnClass: "btn-blue",
          action: function () {
            var ci_ = this.$content.find("#ci_").val();

            console.log("==============>ci_:" + ci_);

            var num_act_ = this.$content.find("#num_act_").val();
            var numinmueble_ = this.$content.find("#numinmueble_").val();
            var nombre_ = this.$content.find("#nombre_").val();
            var numlote_ = this.$content.find("#numlote_").val();
            var manzano_ = this.$content.find("#manzano_").val();
            var superficie_ = this.$content.find("#superficie_").val();
            var ubicacion_ = this.$content.find("#ubicacion_").val();
            var nuevonombre_ = this.$content.find("#nuevonombre_").val();
            var tipodoc_ = this.$content.find("#tipodoc_").val();
            var gestion_ = this.$content.find("#gestion_").val();
            var contacto_ = this.$content.find("#contacto_").val();
            var correo_ = this.$content.find("#correo_").val();

            var num_placa_ = this.$content.find("#num_placa_").val();
            var gestionIni_ = this.$content.find("#gestionIni_").val();
            var gestionFin_ = this.$content.find("#gestionFin_").val();

            if (
              subelemt == "inm_3" && (!tipodoc_ || !nombre_ || !ci_ ||
                !numinmueble_ || !numlote_ || !manzano_ ||
                !superficie_ || !ubicacion_)
            ) {
              numlote_ = "";
              manzano_ = "";
              superficie_ = "";
              ubicacion_ = "";
              $.alert("Por favor, ingrese información válida.");
              return false;
            }
            if (subelemt == "inm_20" && (!ci_ || !numinmueble_ || !nuevoNombre)) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }

            if ((subelemt == "inm_27" || subelemt == "inm_15" || subelemt == "inm_5" || subelemt == "inm_1"
              || subelemt == "inm_7" || subelemt == "inm_8") && (!ci_ || !numinmueble_)) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }

            if ((subelemt == "inm_21" || subelemt == "inm_22" || subelemt == "inm_24" ||
              subelemt == "inm_28" || subelemt == "inm_30") && (!ci_ || !numinmueble_)) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }
            // -------VEHICULOS-------
            if ((subelemt == "veh_1" || subelemt == "veh_3" || subelemt == "veh_2" || subelemt == "veh_2_1") && (!ci_ || !num_placa_)) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }

            if ((subelemt == "veh_10" || subelemt == "veh_11" || subelemt == "veh_17") && (!ci_ || !num_placa_ || !verifNum4dig(gestionIni_) || !verifNum4dig(gestionFin_))) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }

            // -------ACTIVIDAD-------  
            if ((subelemt == "eco_1" || subelemt == "eco_1") && (!ci_ || !num_act_)) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }
            if ((subelemt == "eco_5" || subelemt == "eco_7") && (!ci_ || !num_act_ || !verifNum4dig(gestionIni_))) {
              $.alert("Por favor, ingrese información válida.");
              return false;
            }

            generarSolicitud(elemt, subelemt, ci_, numinmueble_, nombre_,
              numlote_, manzano_, superficie_,
              ubicacion_, nuevonombre_, tipodoc_,
              gestion_, contacto_, correo_,
              num_placa_, gestionIni_, gestionFin_,
              num_act_
            );
            //$.alert('Generando solicitud para: ' + name);
          },
        },
        cancel: function () {
          //close
        },
      },
      onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find("form").on("submit", function (e) {
          e.preventDefault();
          jc.$$formSubmit.trigger("click");
        });
      },
    });

  } else {
    $.confirm({
      title: "<b>Recurso no encontrado</b>",
      content: "No se ha logrado obtener el recurso requerido, estamos trabajando en la actualización del recurso.",
      type: 'red',
      typeAnimated: true,
      columnClass: "col-md-6 col-md-offset-8 col-xs-6 col-xs-offset-8",
      containerFluid: true,
      buttons: {
        cancel: {
          text: "Cerrar",
          action: function () { },
        },
      },
    });
  }
}
function verifNum4dig(value) {
  var regex = /^-?\d{1,4}$/;
  if (regex.test(value)) {
    return true;
  }
  return false;
}
function generarSolicitud(elemt,
  subelemt, ci_, numInmueble_, nombre_,
  numlote_, manzano_, superficie_,
  ubicacion_, nuevonombre_, tipodoc_,
  gestion_, contacto_, correo_,
  num_placa_, gestionIni_, gestionFin_,
  num_act_
) {
  //subelemt == 'inm_20'
  datos =
    "&ci_=" + ci_ + "&numInmueble_=" + numInmueble_ + "&nombre_=" + nombre_ +
    "&numlote_=" + numlote_ + "&manzano_=" + manzano_ + "&superficie_=" + superficie_ +
    "&ubicacion_=" + ubicacion_ + "&nuevonombre_=" + nuevonombre_ + "&tipodoc_=" + tipodoc_ +
    "&gestion_=" + gestion_ + "&contacto_=" + contacto_ + "&correo_=" + correo_ +
    "&num_placa_=" + num_placa_ + "&gestionIni_=" + gestionIni_ + "&gestionFin_=" + gestionFin_ + "&num_act_=" + num_act_
    ;

  mainDialog1.close();
  $.ajax({
    async: true,
    type: "POST",
    dataType: "html",
    contentType: "application/x-www-form-urlencoded",
    url: "../php/prevSolicitud.php",
    data: datos,
    beforeSend: function () {
      loadGralOn();
    },
    success: function (e) {
      loadGralOff(); 
      dat = $.parseJSON(e);
      if (dat.rsp || subelemt == 'inm_3') {
        var url_ = "../php/rpt" + subelemt + ".php?" + datos;
        $.ajax({
          url: url_,
          type: 'HEAD',
          success: function () {
            window.open(url_, "_blank");
          },
          error: function () {
            $.confirm({
              title: "Documento no encontrado!",
              type: "red",
              content:
                "No se ha logrado encontrar el documento solicitado, estamos trabajando en la actualización del recurso.",
              buttons: {
                cancel: {
                  text: "Cerrar",
                  action: function () { },
                },
              },
            });
          }
        });

      } else {
        var numid = numInmueble_;
        var tit_ = 'inmueble';
        if (elemt == 'vehiculos') {
          numid = num_placa_;
          tit_ = 'placa de vehiculo';
        }
        if (elemt == 'mercados') {
          numid = num_act_;
          tit_ = 'actividad económica';
        }
        $.confirm({
          title: "No se encontraron registros!",
          type: "red",
          content:
            "El C.I.:<b>" + ci_ + "</b>, con el número de " + tit_ + ": <b>" + numid + "</b>, no se encuentra en la base de datos, asegurese de ingresar correctamente la información.",
          buttons: {
            cancel: {
              text: "Cerrar",
              action: function () { },
            },
          },
        });
      }
    },
    timeout: 1600,
    error: function () { },
  });
}

function loadGralOn() {
  $(".loadGral").addClass("loadGralOn");
  $(".loadGral").removeClass("loadGralOff");
  $(".loadGral").html("<img src='../img/ia.gif'>");
  
}
function loadGralOff() {
  $(".loadGral").removeClass("loadGralOn");
  $(".loadGral").addClass("loadGralOff");
}

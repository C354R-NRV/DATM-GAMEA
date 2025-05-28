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
        '<img src="../img/gamea_.png" style="max-width: 12rem; padding-right: 1rem;"><img src="../img/logoDATM.png" style="max-width: 6rem;">'
      );
    } else {
      $(".sticky-top").removeClass("bg-primary shadow-sm").css("top", "-150px");
      $("#logodinamico_").html(
        '<img src="../img/gamea_.png" style="max-width: 12rem; padding-right: 1rem;"><img src="../img/SMAF_.png" style="max-width: 6rem;">'
      );
    }
  });

  /* var timer;
  $(window).scroll(function () {
    clearTimeout(timer);
    timer = setTimeout(checkEndOfPage, 100); // Espera 100 milisegundos antes de verificar
  }); */
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


document.addEventListener('input', function (e) {
  if (e.target && e.target.id === 'token_') {
    e.target.value = e.target.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, 6);
  }
});

document.addEventListener('keydown', function (e) {
  if (e.target && e.target.id === 'token_') {
    if (e.key === '-' || e.keyCode === 189) {
      e.preventDefault();
    }
  }
});

let cntIntentos = 3;
function enviarDocumentosExencion(codigo_solicitud) {
  if (cntIntentos > 0) {
    $.confirm({
      title: "Confirmar envío de documentos",
      type: "blue",
      columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
      content: `Se le ha enviado el TOKEN correspondiente para validar y confirmar su envio de documentos para la solicitud ${codigo_solicitud}, favor ingresar el mismo en el siguiente recuadro:<br>
            <div class="token-container">
                <h2 class="token-title">TOKEN ASIGNADO</h2>
                <input type="text" class="token-input" id="token_" value=""   autocomplete="off" maxlength="6">
            </div>
            `,
      buttons: {
        aceptar: {
          btnClass: "btn-green",
          text: "Aceptar",
          action: function () {
            $.ajax({
              async: true,
              type: "POST",
              dataType: "html",
              url: "../php/exencionVerificaToken.php",
              data: {
                token_: $('#token_').val(),
                codigo_solicitud: codigo_solicitud
              },
              beforeSend: function () {
                loadGralOn();
              },
              success: function (e) {
                loadGralOff();
                console.log(e);
                dat = JSON.parse(e);
                if (dat.err == '0') {
                  $.confirm({
                    title: "Envio correcto!",
                    type: "green",
                    content: "Se ha enviado satisfactoriamente los requisitos a la DATM!",
                    buttons: {
                      aceptar: {
                        text: "Aceptar",
                        type: "green",
                        action: function () {
                          window.location.href = 'exencionList.php';
                        },
                      },
                    },
                  });
                } else {
                  cntIntentos = dat.intentos_token;
                  $.confirm({
                    title: "Error!",
                    type: "red",
                    content: dat.log + "<br><br>Usted cuenta con <b>" + (cntIntentos) + "</b> intentos para el ingreso del token.",
                    buttons: {
                      cancel: {
                        text: "Aceptar",
                        action: function () {
                          enviarDocumentosExencion(codigo_solicitud)
                        },
                      },
                    },
                  });
                }
              },
              error: function () {
                $.confirm({
                  title: "Error!",
                  type: "red",
                  content: "Hubo un error en la negociacion con el servidor.",
                  buttons: {
                    cancel: {
                      text: "Cerrar",
                      action: function () { },
                    },
                  },
                });
              }
            });

          }
        },
        cerrar: {
          text: "cerrar",
          action: function () {
            window.location.href = './exencionList.php';
          }
        }

      },
      onOpen: function () {
        setTimeout(() => {
          this.$content.find('.token-input').focus();
        }, 100);
      }
    });

  } else {
    cntIntentos = 3;
    enviarNuevoToken(codigo_solicitud);
  }
}
function enviarNuevoToken(codigo_solicitud) {
  console.log("enviamos nuevo token para:" + codigo_solicitud);

  $.ajax({
    async: true,
    type: 'POST',
    data: {
      codigo_solicitud: codigo_solicitud,
    },
    url: '../php/exencionReenviaToken.php',
    beforeSend: function () {
      loadGralOn();
    },
    success: function (e) {
      loadGralOff();
      dat = JSON.parse(e);
      if (dat.err == '0')
        enviarDocumentosExencion(codigo_solicitud);
      else
        $.confirm({
          title: "Error!",
          type: "red",
          content: "Hubo un error en la negociacion con el servidor, intente mas tarde por favor.",
          buttons: {
            cancel: {
              text: "Cerrar",
              action: function () { },
            },
          },
        });

    },
    timeout: 16000,
    error: function (xhr, status, error) {
      alert('Error: ' + error);
    }
  });
}

function numeroALetras() {
  let numero = $('#numeral_').val();
  // Eliminar comas y convertir a número
  numero = parseFloat(numero.replace(/,/g, ''));

  if (isNaN(numero)) {
    $('#literal_').val('Por favor, ingrese un número válido.');
    return;
  }

  const unidades = ['', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
  const unidadesEspeciales = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
  const decenas = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
  const decenas2 = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
  const centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

  function convertirGrupo(n, final) {
    let resultado = '';

    if (n === 100) return 'cien';

    if (n >= 100) {
      resultado += centenas[Math.floor(n / 100)] + ' ';
      n %= 100;
    }

    if (n >= 30) {
      resultado += decenas2[Math.floor(n / 10)];
      if (n % 10 !== 0) {
        resultado += ' y ' + (final ? unidadesEspeciales[n % 10] : unidades[n % 10]);
      }
    } else if (n >= 20) {
      if (n === 20) {
        resultado += 'veinte';
      } else {
        resultado += 'veinti' + (final ? unidadesEspeciales[n % 10] : unidades[n % 10]);
      }
    } else if (n >= 10) {
      resultado += decenas[n - 10];
    } else if (n > 0) {
      resultado += final ? unidadesEspeciales[n] : unidades[n];
    }

    return resultado.trim();
  }

  if (numero === 0) return 'Cero 00/100';

  const grupos = ['', 'mil', 'millones', 'mil millones', 'billones'];
  let resultado = '';
  let i = 0;
  let parteEntera = Math.floor(numero);
  const parteDecimal = Math.round((numero - parteEntera) * 100);

  while (parteEntera > 0) {
    const grupo = parteEntera % 1000;
    if (grupo > 0) {
      const texto = convertirGrupo(grupo, i === 0);
      if (i === 1) {
        if (grupo === 1) {
          resultado = 'mil ' + resultado;
        } else {
          resultado = texto + ' mil ' + resultado;
        }
      } else if (i === 2 && grupo === 1) {
        resultado = 'un millón ' + resultado;
      } else {
        resultado = texto + (i > 0 ? ' ' + grupos[i] : '') + (resultado ? ' ' + resultado : '');
      }
    }
    parteEntera = Math.floor(parteEntera / 1000);
    i++;
  }

  resultado = resultado.trim();

  // Capitalizar la primera letra
  resultado = resultado.charAt(0).toUpperCase() + resultado.slice(1);

  // Reemplazar "Uno mil" por "Un mil" al inicio de la cadena
  if (resultado.startsWith('Mil')) {
    resultado = 'Un mil' + resultado.slice(3);
  }

  resultado += ' ' + parteDecimal.toString().padStart(2, '0') + '/100';

  $('#literal_').val(resultado);
}
function numeralLiteral() {
  $.confirm({
    title: "<div style='width:98%;text-align:center;'>Numeral>literal</div>",
    type: "green",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-8 col-xs-offset-8",
    content: `                      
                    <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                        <input type='number' id='numeral_' onkeyup='numeroALetras();'   class='form-control' placeholder='Ingrese el numero del cual obtener su formato literal' >
                    </div>
                    <hr>
                    <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                        <input type='text' id='literal_' class='form-control' placeholder='Numero en formato literal' autocomplete='off'>
                    </div>
            `,
    buttons: {
      copiar: {
        text: "Copiar",
        btnClass: "btn-green",
        action: function () {
          let literal_ = $("#literal_").val();
          (async () => {
            try {
              await copyToClipboard(literal_);
              toastr["success"]("Número literal copiado!");

            } catch (err) {
              console.error('Error al copiar: ', err);
            }
          })();
          return false;
        },
      },
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
    onOpenBefore: function () {
      $('.jconfirm-title-c').css('text-align', 'center');
    }
  });
}




function proformaRuat() {
  $.confirm({
    title: "<div style='width:100%;text-align:center;'>De que rubro desea generar la proforma de deuda?</div>",
    type: "blue",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
    content: ` 
              <div class='rubrosInfo'>
                <div class='row align-items-center'>   
                  <div class='col-md-6'>
                    <a href="https://www.ruat.gob.bo/inmuebles/consultageneral/InicioBusquedaInmueble.jsf" target="blank_" class="btn btn-sm"><img src='../img/casa2_.png' alt='Inmuebles'></a>
                  </div>                     
                  <div class='col-md-6'>
                    <a href="https://www.ruat.gob.bo/inmuebles/consultageneral/InicioBusquedaInmueble.jsf" target="blank_" class="btn btn-sm">
                      <span style='color: #1BA9D0;'>Inmuebles</span></a>
                  </div>
                </div>
                <hr>            
                <div class='row align-items-center'>
                <div class='col-md-6'>
                  <a href="https://www.ruat.gob.bo/vehiculos/consultageneral/InicioBusquedaVehiculo.jsf" target="blank_" class="btn btn-sm">
                  <img src='../img/coche2_.png' alt='Vehiculo'></a>
                </div>                     
                  <div class='col-md-6'>
                    <a href="https://www.ruat.gob.bo/vehiculos/consultageneral/InicioBusquedaVehiculo.jsf" target="blank_" class="btn btn-sm">
                    <span style='color: #1BA9D0;'>Vehiculos</span></a>
                  </div>                     
                </div>          
                <hr>                       
                <div class='row align-items-center'>
                <div class='col-md-6'>
                  <a href="https://www.ruat.gob.bo/actividadeseconomicas/consultageneral/InicioBusquedaActividadesEconomicas.jsf" target="blank_" class="btn btn-sm"><img src='../img/caseta2_.png' alt='Actividad Economica'></a>
                </div>                     
                  <div class='col-md-6'>
                    <a href="https://www.ruat.gob.bo/actividadeseconomicas/consultageneral/InicioBusquedaActividadesEconomicas.jsf" target="blank_" class="btn btn-sm">
                    <span style='color: #1BA9D0;'>Actividad Económica</span></a>
                  </div>                     
                </div>    
              </div>   
              `,
    buttons: {
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
  });
}

function simatSiim() {
  $.confirm({
    title: "<div style='width:100%;text-align:center;'>Ingrese el CI/NIT/RUC ó PMC ANTIGUO:</div>",
    type: "green",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
    content: ` 
            <div class='rubrosInfo'>
                <div class='row align-items-center'>                      
                    <div class='col-md-4'>
                        <select id='tipo_'  class='form-control'>
                          <option value='doc'>CI/NIT/RUC...</option>
                          <option value='pmcAnt'>PMC ANTIGUO</option>
                          <option value='numInm'>NUM. INMUEBLE</option>
                        </select>
                    </div>
                    <div class='col-md-8'>
                        <input type='text' id='ci_' class='form-control' autocomplete='off' value=''>
                    </div>
                </div> 
            </div>   
            `,
    buttons: {
      formSubmit: {
        text: "Buscar info",
        btnClass: "btn-blue",
        action: function () {
          var formSubmitButton = this.buttons.formSubmit;
          var ci_ = $("#ci_").val();
          var tipo_ = $("#tipo_").val();
          datos =
            "&ci_=" + ci_ + '&tipo_=' + tipo_;
          $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/verifSimatSiim.php",
            data: datos,
            beforeSend: function () {
              formSubmitButton.setText('Procesando...');
              formSubmitButton.disable();
              loadGralOn();
            },
            success: function (e) {
              console.log(e);
              loadGralOff();

              dat = JSON.parse(e);
              if (dat.error == 'false' || !dat.error) {
                if (dat.existeInmueble == '1') {
                  window.open("../php/rptSimatSiim.php?id=" + ci_ + "&tipo_=" + tipo_, "_blank");
                }
                else {
                  $.confirm({
                    title: "Error...",
                    content: "No se encontro ningun registro relacionado a " + ci_ + ", revise el dato y vuelva a intentarlo.",
                    type: "red",
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    containerFluid: true,
                    buttons: {
                      cancel: {
                        text: "Cerrar",
                        action: function () {
                          simatSiim();
                        },
                      },
                    }
                  });
                }
              } else {
                $.confirm({
                  title: "Error...",
                  content: "Excepcion generada: " + dat.message,
                  type: "red",
                  columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                  containerFluid: true,
                  buttons: {
                    cancel: {
                      text: "Cerrar",
                      action: function () {
                        simatSiim();
                      },
                    },
                  }
                });
              }
            },
            timeout: 16000,
            error: function () { },
          });

        },
      },
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
    onOpenBefore: function () {
      $('.jconfirm-title-c').css('text-align', 'center');
    }
  });
}

function verDocPopup(rutaArchivo, obs_ = '') {

  $.confirm({
    title: '',
    content: (obs_ != '' ? '<span style="padding:0.5rem 1rem  0.5rem  1rem; font-weight:bold; color:#732e2e">' + obs_ + '</span><hr>' : '') + `<iframe src="pdfjs/web/viewer.html?file=../../${rutaArchivo}"
                  width="100%"
                  height="700px"
                  style="border: none;"></iframe>`,
    type: "black",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
    buttons: {
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
  });
}

function cambioPass() {
  $.confirm({
    title: "<div style='width:98%;text-align:center;'>CAMBIO DE CONTRASEÑA</div>",
    type: "green",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-8 col-xs-offset-8",
    content: `                      
            <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                <input type='password' id='passwordAct_' class='form-control' placeholder='Clave actual' autocomplete='off'>
            </div> 
            <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                <input type='password' id='passwordNuevo_' class='form-control' placeholder='Nueva clave' autocomplete='off'>
            </div> 
            `,
    buttons: {
      formSubmit: {
        text: "Guardar",
        btnClass: "btn-blue",
        action: function () {
          var formSubmitButton = this.buttons.formSubmit;
          datos = "&passwordNuevo_=" + $("#passwordNuevo_").val() + "&passwordAct_=" + $("#passwordAct_").val();
          console.log(datos);
          $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/setPass.php",
            data: datos,
            beforeSend: function () {
              formSubmitButton.setText('Procesando...');
              formSubmitButton.disable();
              loadGralOn();
            },
            success: function (e) {
              console.log(e);
              loadGralOff();
              dat = JSON.parse(e);
              if (dat.estado == 'green') {
                $.confirm({
                  title: dat.title,
                  content: dat.message,
                  type: dat.estado,
                  typeAnimated: true,
                  columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                  buttons: {
                    aceptar: {
                      text: "Aceptar",
                      action: function () {
                        window.location.href = "login.php";
                      },
                    },
                  }
                });
              } else {
                $.confirm({
                  title: dat.title,
                  content: dat.message,
                  type: dat.estado,
                  typeAnimated: true,
                  columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                  buttons: {
                    volver: {
                      text: "Volver",
                      action: function () {
                        cambioPass()
                      },
                    },
                  }
                });
              }



            },
            timeout: 16000,
            error: function () { },
          });

        },
      },
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
    onOpenBefore: function () {
      $('.jconfirm-title-c').css('text-align', 'center');
    }
  });
}
function detalleDeuda(aux = false) {

  aux = (aux != false ? aux : '')
  $.confirm({
    title: "<div style='width:98%;text-align:center;'>Ingrese el CI/NIT/RUC ó PMC ANTIGUO:</div>",
    type: "green",
    typeAnimated: true,
    columnClass: "col-md-10 col-md-offset-10 col-xs-8 col-xs-offset-8",
    content: `                      
                    <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                        <select id='tipoIdentificador_' class='form-control' >
                          <option value='veh'>NRO PTA</option>
                          <option value='ci' selected>CI/NIT/CEX/RUC/RUN</option>
                          <option value='inm'>NRO. INMUEBLE</option>
                          <option value='act'>NRO. ACTIVIDAD ECONOMICA</option>
                        </select>
                    </div>
                    <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                        <input type='text' id='documento_' class='form-control' placeholder='Numero de documento' autocomplete='off' value='${aux}'>
                    </div>
                    <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
                        <select id='tipoReporte_' class='form-control' >
                          <option value='all' selected>TODOS LOS RUBROS</option>
                          <option value='veh' >VEHICULOS</option>
                          <option value='inm'>INMUEBLES</option>
                          <option value='act'>ACTIVIDADES ECONOMICAS</option>
                        </select>
                    </div> 
            `,
    buttons: {
      formSubmit: {
        text: "Buscar info",
        btnClass: "btn-blue",
        action: function () {
          var formSubmitButton = this.buttons.formSubmit;
          var documento_ = ($("#documento_").val()).toUpperCase();
          var tipo_ = $("#tipoIdentificador_").val();
          var tipoReporte_ = $("#tipoReporte_").val();
          datos = "&documento_=" + documento_ + "&tipoIdentificador_=" + tipo_;
          /* alert(datos); */
          $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/verifExistenciaDocumentoEnMora.php",
            data: datos,
            beforeSend: function () {
              formSubmitButton.setText('Procesando...');
              formSubmitButton.disable();
              loadGralOn();
            },
            success: function (e) {
              console.log(e);
              loadGralOff();

              dat = JSON.parse(e)
              if (dat.existe == '1') {
                window.open("../php/rptmora.php?id=" + btoa(dat.info.documento_identidad) + "&t=" + tipoReporte_, "_blank");
              }
              else {
                $.confirm({
                  title: "No encontrado...",
                  content: "No se encontró ningun registro relacionado a " + documento_ + ", revise el dato y vuelva a intentarlo.",
                  type: "red",
                  typeAnimated: true,
                  columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                  buttons: {
                    cancel: {
                      text: "Cerrar",
                      action: function () {
                        detalleDeuda(documento_);
                      },
                    },
                  }
                });
              }
            },
            timeout: 16000,
            error: function () { },
          });

        },
      },
      cancel: {
        text: "Cerrar",
        action: function () { },
      },
    },
    onOpenBefore: function () {
      $('.jconfirm-title-c').css('text-align', 'center');
    }
  });
}

function solicitudCite(aux = false) {

  $.ajax({
    async: true,
    type: "POST",
    dataType: "html",
    contentType: "application/x-www-form-urlencoded",
    url: "../php/getTipoDocCite.php",
    data: '',
    beforeSend: function () {
      loadGralOn();
    },
    success: function (html_) {
      loadGralOff();
      $.confirm({
        title: " ",
        type: "green",
        typeAnimated: true,
        columnClass: "col-md-10 col-md-offset-10 col-xs-8 col-xs-offset-8",
        content: html_,
        buttons: {
          formSubmit: {
            text: "Solicitar CITE",
            btnClass: "btn-blue",
            action: function () {
              var formSubmitButton = this.buttons.formSubmit;
              datos = "&referencia_=" + $("#referencia_").val() +
                "&tipoDocumento_=" + $("#tipoDocumento_").val() +
                "&usuario_solicitante=" + $("#usuario_solicitante").val() +
                "&hhrr_=" + $("#hhrr_").val() +
                "&destino_=" + $("#destino_").val();
              $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "../php/getCite.php",
                data: datos,
                beforeSend: function () {
                  formSubmitButton.setText('Procesando...');
                  formSubmitButton.disable();
                  loadGralOn();
                },
                success: function (e) {
                  loadGralOff();
                  dat = JSON.parse(e)

                  $.confirm({
                    title: dat.title,
                    content: dat.message,
                    type: dat.estado,
                    typeAnimated: true,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    buttons: {
                      copiar: {
                        text: "Copiar",
                        btnClass: "btn-green",
                        action: function () {
                          let citeCreado = $("#citeCreado").html();
                          console.log('previo al try');
                          console.log(citeCreado);
                          (async () => {
                            try {
                              await copyToClipboard(citeCreado);
                              // Guardar el mensaje en localStorage

                              localStorage.setItem('toastrMessage', 'Copiado al portapapeles!');
                              // Redirigir a citeList.php
                              window.location.href = "citeList.php";
                            } catch (err) {
                              console.error('Error al copiar: ', err);
                            }
                          })();
                        },
                      },
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

            },
          },
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
    timeout: 1600,
    error: function () { },
  });


}


function copyToClipboard(text) {
  return new Promise((resolve, reject) => {
    // Primero intentamos usar la API Clipboard si está disponible
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(resolve).catch(reject);
    } else {
      // Fallback para navegadores que no soportan la API Clipboard
      const textArea = document.createElement("textarea");
      textArea.value = text;
      textArea.style.position = "fixed";  // Evita scroll en la página
      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();

      try {
        const successful = document.execCommand('copy');
        if (successful) {
          resolve();
        } else {
          reject(new Error('No se pudo copiar el texto'));
        }
      } catch (err) {
        reject(err);
      } finally {
        document.body.removeChild(textArea);
      }
    }
  });
}

function displayAsTable(data) {
  const table = document.createElement('table');
  table.style.borderCollapse = 'collapse';
  table.style.width = '100%';

  // Crear encabezados
  const headerRow = table.insertRow();
  for (const key in data[0]) {
    const th = document.createElement('th');
    th.textContent = key.toUpperCase();
    th.style.border = '1px solid black';
    th.style.padding = '5px';
    th.style.textAlign = 'center';
    th.style.color = 'white';
    th.style.background = 'black';
    headerRow.appendChild(th);
  }

  // Llenar datos
  data.forEach(item => {
    const row = table.insertRow();
    for (const key in item) {
      const cell = row.insertCell();
      cell.textContent = item[key];
      cell.style.border = '1px solid black';
      cell.style.padding = '5px';
    }
  });

  return table;

}

function checkEndOfPage() {

  /* 
  con el siguiente if se mostraria la promo al final de la pagina
  if (
    $(window).scrollTop() + $(window).height() >= $(document).height() &&
    !$("#swLogin").val()
  ) { */
  showPromos();
  /* } */
}

function showPromos() {
  var contenido = `<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button> 
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">  
                <div class="bd-placeholder-img text-center">
                    <img src="../img/anuncios/20_descuento2025.jpg">
                    <div class="container text-center">
                        <div class="carousel-caption text-start"> 
                            <p><a class="btn btn-lg btn-warning" href="#"><i class="fa fa-facebook-f"></i> <span style="font-size:0.7rem;">Más info aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="carousel-item text-end">  
                <div class="bd-placeholder-img text-center">
                    <img src="../img/anuncios/20_descuento2025.jpg">
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

function showEdictos() {
  var contenido = `<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button> 
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button> 
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button> 
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button> 
  </div>
  <div class="carousel-inner">
      <div class="carousel-item active">  
          <div class="bd-placeholder-img text-center">
              <img src="../img/anuncios/edicto01122024.jpg">
              <div class="container text-center">
                  <div class="carousel-caption text-start"> 
                      <p><a class="btn btn-lg btn-warning" href="../img/anuncios/edicto01122024.pdf" target="_blank"><i class="fa fa-cloud-download"></i> <span style="font-size:0.7rem;">Descargar edicto | 04/12/24 [1Mb]</a></p>
                  </div>
              </div>
          </div>
      </div>     
      <div class="carousel-item">  
          <div class="bd-placeholder-img text-center">
              <img src="../img/anuncios/edicto12072024.jpg">
              <div class="container text-center">
                  <div class="carousel-caption text-start"> 
                      <p><a class="btn btn-lg btn-warning" href="../img/anuncios/edicto12072024.pdf" target="_blank"><i class="fa fa-cloud-download"></i> <span style="font-size:0.7rem;">Descargar edicto | 12/07/24 [14Mb]</a></p>
                  </div>
              </div>
          </div>
      </div>     
      <div class="carousel-item text-end">  
          <div class="bd-placeholder-img text-center"> 
              <img src="../img/anuncios/edicto19072024.jpg">
              <div class="container text-center">
                  <div class="carousel-caption text-start"> 
                      <p><a class="btn btn-lg btn-warning" href="../img/anuncios/edicto19072024.pdf" target="_blank"><i class="fa fa-cloud-download"></i> <span style="font-size:0.7rem;">Descargar edicto  | 19/07/24 [14Mb]</a></p>
                  </div>
              </div>
          </div>
      </div>   
      <div class="carousel-item text-end">  
          <div class="bd-placeholder-img text-center"> 
              <img src="../img/anuncios/edicto2021.jpg">
              <div class="container text-center">
                  <div class="carousel-caption text-start"> 
                      <p><a class="btn btn-lg btn-warning" href="../img/anuncios/edicto2021_1.pdf" target="_blank"><i class="fa fa-cloud-download"></i> <span style="font-size:0.7rem;">Descargar edicto [Part1]  | GESTION 2021 [620Mb]</a></p>
                  </div>
              </div>
          </div>
      </div>   
      <div class="carousel-item text-end">  
          <div class="bd-placeholder-img text-center"> 
              <img src="../img/anuncios/edicto2021.jpg">
              <div class="container text-center">
                  <div class="carousel-caption text-start"> 
                      <p><a class="btn btn-lg btn-warning" href="../img/anuncios/edicto2021_2.pdf" target="_blank"><i class="fa fa-cloud-download"></i> <span style="font-size:0.7rem;">Descargar edicto [Part2]  | GESTION 2021 [600Mb]</a></p>
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
    title: "<span style='font-size:1rem;'>Notificación por edicto, conforme a los Articulos 21, 66, y 100 de la Ley del Código Tributario Boliviano</span>",
    message: contenido,
    size: "large",
  });
}

function impvaAnotado() {

  datos = "&impvaAnotado=" + '1';

  $.ajax({
    async: true,
    type: "POST",
    dataType: "html",
    contentType: "application/x-www-form-urlencoded",
    url: "../php/getDeudasImpv.php",
    data: datos,
    beforeSend: function () {
      loadGralOn();
    },
    success: function (e) {
      loadGralOff();
      dat = JSON.parse(e);
      $.confirm({
        title: "DEUDORES DEL IMPUESTO IMPVA PARA ANOTACIÓN PREVENTIVA EN TRÁNSITO",
        content: dat.html,
        type: "red",
        typeAnimated: true,
        columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
        buttons: {
          cancel: {
            text: "Cerrar",
            action: function () {
            },
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




}
function impvaNoAnotado() {

  datos = "&impvaAnotado=" + '0';

  $.ajax({
    async: true,
    type: "POST",
    dataType: "html",
    contentType: "application/x-www-form-urlencoded",
    url: "../php/getDeudasImpv.php",
    data: datos,
    beforeSend: function () {
      loadGralOn();
    },
    success: function (e) {
      loadGralOff();
      dat = JSON.parse(e);
      $.confirm({
        title: "DEUDORES DEL IMPUESTO IMPVA PARA ANOTACIÓN PREVENTIVA EN TRÁNSITO",
        content: dat.html,
        type: "red",
        typeAnimated: true,
        columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
        buttons: {
          cancel: {
            text: "Cerrar",
            action: function () {
            },
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
}



$("#mensajeWtsp").keydown(detectarTecla);
$(".mensajeWtspBtn").click(detectarTecla);
$(".miRegistroBtn").click(formVerificaRegistros);

$(".mensajeProformaBtn").click(() => {
  proformaRuat();
});
$(".mensajeTramitepBtn").click(() => {
  window.open("./consultaTramite.php");
});

function formVerificaRegistros() {

  var sinLogin = `  
    <div>
        <div class="col-md-12">
          <label>PIN<span style="color:red;">*</span></label>
          <input type="password" id="pin_" class="form-control" placeholder="NUMERO PIN"  autocomplete="off" required />
        </div>
    </div>
    <hr>
    <div style="color:red;font-size:0.8rem;">
      * Para obtener su número PIN, por favor realice su registro
    </div>
  `;
  var ciAux = '';
  var disabled_ = '';
  if ($("#swLogin").val()) {
    sinLogin = '';
    if ($("#cinitContribuyente").val() > 0) {
      ciAux = $("#cinitContribuyente").val();
      disabled_ = 'disabled';
    }
  }

  var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <label>CI/NIT (sin extensión)</label>
                <div class="col-md-4">
                    <select id="tipodoc_" class="form-control">
                        <option selected value="CI">CI</option>
                        <option value="CEX">CEX</option>
                        <option value="NIT">NIT</option>
                        <option value="OD">OD</option>
                    </select>
                </div>  
                <div class="col-md-8">
                    <input type="text" id="ci_" placeholder="Ejemplo:6062063" class="form-control" value="${ciAux}"  ${disabled_} autocomplete="off" required />
                </div>
            </div>
            ${sinLogin} 
        </div>
        `;
  var errorContribuyente = true;

  if ($("#swLogin").val()) {
    $.confirm({
      title: "Por favor, ingrese la siguiente información:",
      type: "dark",
      content: content_,
      buttons: { 
        formSubmit: {
          text: "Consultar",
          btnClass: "btn-blue",
          action: function () {
            var formSubmitButton = this.buttons.formSubmit;
  
            if (($("#ci_").val()).length > 4 && ($("#pin_").length === 0 || $("#pin_").val().length > 3)) {
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
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
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
            } else {
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "rtl": true,
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 3000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };
              toastr["warning"]('Error...', 'El CI y/o PIN no son correctos, revise e intente nuevamente por favor.');
              return false;
            }
            datos =
              "&tipodoc_=" + $("#tipodoc_").val() +
              "&ci_=" + $("#ci_").val() +
              "&pin_=" + $("#pin_").val();
          },
        },
        cancel: function () { },
      },
      onContentReady: function () {
        var jc = this; 
        $('#pin_').on('keypress', function (ev) {
          if (ev.which === 13) {
            jc.$$formSubmit.trigger('click');
          }
        });
      },
    }); 
  }

  else{
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
  
            if (($("#ci_").val()).length > 4 && ($("#pin_").length === 0 || $("#pin_").val().length > 3)) {
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
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
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
            } else {
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "rtl": true,
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 3000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };
              toastr["warning"]('Error...', 'El CI y/o PIN no son correctos, revise e intente nuevamente por favor.');
              return false;
            }
            datos =
              "&tipodoc_=" + $("#tipodoc_").val() +
              "&ci_=" + $("#ci_").val() +
              "&pin_=" + $("#pin_").val();
          },
        },
        cancel: function () { },
      },
      onContentReady: function () {
        var jc = this; 
        $('#pin_').on('keypress', function (ev) {
          if (ev.which === 13) {
            jc.$$formSubmit.trigger('click');
          }
        });
      },
    });
  }
}



function showRetencion() {

  var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <label>CI/NIT (sin extensión)</label> 
                <div class="col-md-12">
                    <input type="text" id="ci_" placeholder="Ejemplo:6062063" autocomplete="off" class="form-control" value="" required />
                </div>
            </div> 
        </div>
        `;
  var errorContribuyente = true;

  $.confirm({
    title: "Por favor, ingrese la siguiente información:",
    type: "dark",
    content: content_,
    buttons: {
      formSubmit: {
        text: "Consultar",
        btnClass: "btn-blue",
        action: function () {
          var formSubmitButton = this.buttons.formSubmit;

          if (($("#ci_").val()).length > 4) {
            datos =
              "&ci_=" + ($("#ci_").val()).trim().toUpperCase();
            $.ajax({
              async: true,
              type: "POST",
              dataType: "html",
              contentType: "application/x-www-form-urlencoded",
              url: "../php/getRetencionPorCI.php",
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
                  columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                  buttons: {
                    cancel: {
                      text: "Cerrar",
                      action: function () { },
                    },
                  },
                  onOpenBefore: function () {
                    $('.jconfirm-title-c').css({
                      'text-align': 'center',
                      'font-size': '1rem'
                    })
                  }
                });
              },
              timeout: 16000,
              error: function () { },
            });
          } else {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "progressBar": true,
              "rtl": false,
              "preventDuplicates": true,
              "onclick": null,
              "showDuration": 450,
              "hideDuration": 1000,
              "timeOut": 3000,
              "extendedTimeOut": 1000,
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            toastr["warning"]('Ingrese un numero de CI valido e intente nuevamente por favor.', 'Error');
            return false;
          }
          datos =
            "&ci_=" + $("#ci_").val() +
            "&pin_=" + $("#pin_").val();
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
                    <input type="text" id="ci_" placeholder="No." class="form-control" autocomplete="off" value="${ci_}" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nombre(s)/Razon Soc.</label>
                    <input type="text" id="nombre_" placeholder="Nombres ó Razon Social" value="" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label>Paterno/Sigla</label>
                    <input type="text" id="paterno_" placeholder="Ap. paterno ó sigla" value="" class="form-control" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Materno</label>
                    <input type="text" id="materno_" placeholder="Ap. Materno" value="" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label>Ap. Casada</label>
                    <input type="text" id="apcasada_" placeholder="Ap. Casada" value="" class="form-control" required /> 
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Num. Celular</label>
                    <input type="text" id="cel_" placeholder="Celular" class="form-control" value=""  required /> 
                </div>
                <div class="col-md-6">    
                    <label>Correo</label>
                    <input type="email" id="correo_" placeholder="Correo electronico" class="form-control" value="" required />
                </div>
            </div>
            <hr>
            <label><span style="font-size:11px">* Se realizara una verificación interna de la información proporcionada previo a emitirle un numero PIN de acceso.</span></label>
            
            <!-- <label>Fecha nacimiento</label> <input type="text" id="fnacimiento_" placeholder="dd/mm/AAAA"  value="" class="form-control" required /> -->
            
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
    timeout: 16000,
    error: function () { },
  });
}

function getcontenido(elemt, color, subelemt, descr, documento = false) {
  var src_ = "img/requisitos/" + elemt + "/" + subelemt + ".jpg";
  var contenido = "<div style='width:100%; text-align:center;'><img src='../img/requisitos/" + elemt + "/" + subelemt + ".jpg'></div>";
  title_ = "Requisitos para " + descr;

  var datosContactos = `<hr>
            <label>Contacto</label>
            <input type="text" id="contacto_" placeholder="Numero de celular" value=""  class="form-control" required />
            <label>Correo</label>
            <input type="email" id="correo_" placeholder="Correo electrónico" value=""  class="form-control" required />`;

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
                  <input type="text" id="ci_" placeholder="No." class="form-control" autocomplete="off" value="" required />
              </div>
          </div>
          <label>Nombre completo</label>
          <input type="text" id="nombre_" placeholder="Nombres Paterno Materno" value="" class="form-control" required />
          <label>Número de inmueble</label>
          <input type="text" id="numinmueble_" placeholder="No.inmueble"  value="" class="form-control" required />
          <label>Número de lote</label>
          <input type="text" id="numlote_" placeholder="Lote" class="form-control" value=""  required />
          <label>Manzano</label>
          <input type="text" id="manzano_" placeholder="Manzano" class="form-control" value="" required />
          <label>Superficie Terreno</label>
          <input type="text" id="superficie_" placeholder="Superficie en metros cuadrados del terreno"value=""  class="form-control" required />
          <label>Ubicación</label>
          <input type="text" id="ubicacion_" placeholder="Zona, Calle, Puerta" value=""  class="form-control" required />
          
          ${datosContactos} 
      </div>
      `;
    }
    if (subelemt == "inm_20") {
      content_ = `
                <div class="form-group">
                    <label>Número de inmueble</label>
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="" required />
                    
                    <label>Nuevo nombre:</label>
                    <input type="text" id="nuevonombre_" placeholder="Nuevo nombre" class="form-control"  value="" required />
                    
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
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="" required />  

                    ${datosContactos}
                </div>
                `;
    }
    if (subelemt == "inm_15" || subelemt == "inm_21") {
      content_ = `
                <div class="form-group">
                    <label>Número de inmueble</label>
                    <input type="text" id="numinmueble_" placeholder="No.inmueble" class="form-control" value="" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="" required />  

                    <label>Gestion</label>
                    <input id="gestion_" type="text" class="form-control" value="1996">

                    ${datosContactos}

                </div>
                `;
    }

    // ---------------------------------------------- VEHICULOS -------------------------------------------
    if (subelemt == "veh_1" || subelemt == "veh_2" || subelemt == "veh_2_1" || subelemt == "veh_3") {
      content_ = `
                <div class="form-group">
                    <label>Número de placa</label>
                    <input type="text" id="num_placa_" placeholder="No. de placa" class="form-control" value="" required />
                    
                    <label>Cedula de Identidad</label>
                    <input type="text" id="ci_" placeholder="C.I." class="form-control" value="" required />
                    
                    ${datosContactos}
                </div>
                `;
    }

    if (subelemt == "veh_10" || subelemt == "veh_11" || subelemt == "veh_17") {
      content_ = `
                <div class="form-group">
                  <label>Número de placa</label>
                  <input type="text" id="num_placa_" placeholder="No. de placa" class="form-control" value="" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="" required />
                  
                  <label>De Gestión</label>
                  <input type="text" id="gestionIni_" placeholder="2023" class="form-control" value="" required />
                  
                  <label>A Gestión</label>
                  <input type="text" id="gestionFin_" placeholder="2024" class="form-control" value="" required />
                  
                  ${datosContactos}

                </div>
                `;
    }

    if (subelemt == "eco_1") {
      content_ = `
                <div class="form-group">
                  <label>Número de patente</label>
                  <input type="text" id="num_act_" placeholder="No. patente" class="form-control" value="" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="" required />
                  
                  ${datosContactos}

                </div>
                `;
    }

    if (subelemt == "eco_5" || subelemt == "eco_7") {
      content_ = `
                <div class="form-group">
                  <label>Número de patente</label>
                  <input type="text" id="num_act_" placeholder="No. patente" class="form-control" value="" required />
                  
                  <label>Cedula de Identidad/NIT</label>
                  <input type="text" id="ci_" placeholder="CI/NIT" class="form-control" value="" required />
                  
                  <label>De Gestión</label> 
                  <input id="gestion_" type="text" class="form-control" value="1996">
                  
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
            var imageUrl = '../' + src_;

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


function loadGralOn() {
  $(".loadGral").addClass("loadGralOn");
  $(".loadGral").removeClass("loadGralOff");
  $(".loadGral").html("<img src='../img/ia.gif'>");

}
function loadGralOff() {
  $(".loadGral").removeClass("loadGralOn");
  $(".loadGral").addClass("loadGralOff");
}

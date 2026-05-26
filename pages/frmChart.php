<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php
  require_once("../conexionmysql.php");
  foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
  }
  $FECHAS = date('d-m-Y');
  if (!$_SESSION['idusuario']) {
    /* echo "<script> alert('" . "select * from USUARIOS_HABILITADOS where USUARIO=$txtUsuario and ESTADO=ACTIVO and password = $txtPass" . "')</script>"; */
    //echo "<script> alert('No se encuentra habilitado. \\n Consulte con su Administrador" . "select * from  tramites_uict.USUARIOS_HABILITADOS where USUARIO=$txtUsuario and ESTADO=ACTIVO and password = md5($txtPass)" . ".')</script>";
    echo "<script> location.href='index.php';</script>";
  }

  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Tributario</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }

    .info-card {
      background: white;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .info-card i {
      font-size: 2rem;
      margin-bottom: 5px;
    }

    .chart-container {
      background: white;
      border-radius: 10px;
      padding: 15px;
      margin-top: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      height: 400px;
    }

    .chart-container canvas {
      max-height: 320px !important;
    }

    .matrix-container {
      background: white;
      border-radius: 10px;
      padding: 15px;
      margin-top: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    .matrix-table {
      font-size: 0.65rem;
      width: 100%;
    }

    .matrix-table td {
      text-align: center;
      padding: 4px 4px;
      vertical-align: middle;
    }

    .matrix-table .operator-name {
      text-align: left;
    }

    /* Responsividad mejorada */
    @media (max-width: 768px) {
      .chart-container {
        height: 350px;
      }

      .chart-container canvas {
        max-height: 270px !important;
      }
    }

    @media (max-width: 576px) {
      .chart-container {
        height: 300px;
      }

      .chart-container canvas {
        max-height: 220px !important;
      }
    }


    .show-btn3 {
      position: absolute;
      top: 5rem;
      right: -3px;
      background-color: #020e10;
      width: 2rem !important;
      color: white;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .show-btn3 a {
      color: #e0e0e0;
      text-decoration: none;
    }

    .show-btn3:hover {
      color: #ffffff;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div>
      <div class="show-btn3"><a id="contenBtn" href="./index.php"><i class="fas fa-home" aria-hidden="true"></i></a></div>
    </div>
    <input type="hidden" id="codigo_unidad" value="<?php echo $_SESSION['codigo_unidad']; ?>" />
    <?php

    if (($_SESSION['rol']  == 'JEFATURA'  or $_SESSION['rol']  == 'JEFE AREA'  or $_SESSION['codigo_unidad']  == 'SIS') and ($_SESSION['codigo_unidad']  == 'SIS' or  $_SESSION['codigo_unidad']  == 'UICT')  or $_SESSION['rol']  == 'DIRECCION') {
    ?>
      <div class="row justify-content-center g-3">
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-calendar "></i>
            <input type="text" class="form-control text-center datepicker " id="dashboardDate" value="<?php echo date("d/m/Y"); ?>" readonly style="border: none; box-shadow: none; font-weight: bold;  ">
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-clock"></i> <span style="font-size: 2rem;" id="avgWaitTime">-- MINUTOS</span><br>
            <small class="text-muted">TIEMPO DE ESPERA PROMEDIO</small>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-tachometer"></i> <span style="font-size: 2rem;" id="avgAttentionTime">-- MINUTOS</span><br>
            <small class="text-muted">TIEMPO PROMEDIO DE ATENCION</small>
          </div>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Resumen General <b>U.I.C.T.</b> (Creados vs Atendidos)</h6>
            <canvas id="pieChart"></canvas>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Cantidad de Trámites por Tipo (Creados vs Atendidos)</h6>
            <canvas id="chart1"></canvas>
          </div>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Trámites Atendidos por Usuario</h6>
            <canvas id="chart2"></canvas>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="matrix-container" style="height: 400px; overflow-y: auto;">
            <h6><i class="fas fa-table me-2"></i>Matriz: Operadores vs Tipos de Trámite</h6>
            <div id="matrixContainer">
              <table class="table table-bordered matrix-table" id="matrixTable">
                <thead>
                  <tr id="matrixHeader">
                    <th class="operator-name">Operador</th>
                  </tr>
                </thead>
                <tbody id="matrixBody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    <?php
    }
    ?>

    <?php
    if (($_SESSION['rol']  == 'JEFATURA' or $_SESSION['rol']  == 'JEFE AREA'  or $_SESSION['codigo_unidad']  == 'SIS') and ($_SESSION['codigo_unidad']  == 'SIS' or  $_SESSION['codigo_unidad']  == 'UFyR')   or $_SESSION['rol']  == 'DIRECCION') {
    ?>
      <hr>

      <div class="row justify-content-center g-3">
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-calendar "></i>
            <input type="text" class="form-control text-center datepicker " id="dashboardDateUf" value="<?php echo date("d/m/Y"); ?>" readonly style="border: none; box-shadow: none; font-weight: bold; font-size: 1.25rem;">
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-clock"></i> <span style="font-size: 2rem;" id="avgWaitTimeUf">-- MINUTOS</span><br>
            <small class="text-muted">TIEMPO DE ESPERA PROMEDIO</small>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="info-card">
            <i class="fas fa-tachometer"></i> <span style="font-size: 2rem;" id="avgAttentionTimeUf">-- MINUTOS</span><br>
            <small class="text-muted">TIEMPO PROMEDIO DE ATENCION</small>
          </div>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Resumen General <b>U.F.</b> (Creados vs Atendidos)</h6>
            <canvas id="pieChartUf"></canvas>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Cantidad de Trámites por Tipo (Creados vs Atendidos)</h6>
            <canvas id="chart1Uf"></canvas>
          </div>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-lg-6 col-md-12">
          <div class="chart-container">
            <h6>Trámites Atendidos por Usuario</h6>
            <canvas id="chart2Uf"></canvas>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="matrix-container" style="height: 400px; overflow-y: auto;">
            <h6><i class="fas fa-table me-2"></i>Matriz: Operadores vs Tipos de Trámite</h6>
            <div id="matrixContainerUf">
              <table class="table table-bordered matrix-table" id="matrixTableUf">
                <thead>
                  <tr id="matrixHeaderUf">
                    <th class="operator-name">Operador</th>
                  </tr>
                </thead>
                <tbody id="matrixBodyUf">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="../js/jquery-confirm.js"></script>
  <script>
    // Registrar el plugin de etiquetas de datos
    Chart.register(ChartDataLabels);
    let chart1Instance;
    let chart2Instance;
    let pieChartInstance;
    let updateInterval;

    let chart1InstanceUf;
    let chart2InstanceUf;
    let pieChartInstanceUf;
    let updateIntervalUf;
    // Variables para almacenar datos previos y evitar reconstrucción innecesaria
    let previousData = {
      minutos_promedio_espera: null,
      minutos_promedio_atencion: null,
      resumen_tipos_tramite: null,
      tramites_atendidos_por_usuario: null,
      matriz_operador_tipo: null,
      resumen_torta: null,

      minutos_promedio_esperaUf: null,
      minutos_promedio_atencionUf: null,
      resumen_tipos_tramiteUf: null,
      tramites_atendidos_por_usuarioUf: null,
      matriz_operador_tipoUf: null,
      resumen_tortaUf: null,
    };
    // Función para convertir a número de forma segura
    function toNumber(value) {
      var num = parseFloat(value);
      return isNaN(num) ? 0 : num;
    }
    // Función para comparar arrays de objetos
    function arraysEqual(arr1, arr2) {
      if (!arr1 || !arr2) return false;
      if (arr1.length !== arr2.length) return false;
      return JSON.stringify(arr1) === JSON.stringify(arr2);
    }
    // Función para verificar si la fecha seleccionada es hoy
    function isSelectedDateToday() {
      var selectedDate = $('#dashboardDate').val();
      var today = moment().format('DD/MM/YYYY');
      return selectedDate === today;
    }
    // Función para controlar la actualización automática
    function manageAutoUpdate() {
      if (updateInterval) {
        clearInterval(updateInterval);
        updateInterval = null;
      }
      if (isSelectedDateToday()) {
        updateInterval = setInterval(updateDashboard, 3000);
        console.log('Actualización automática activada (fecha actual seleccionada)');
      } else {
        console.log('Actualización automática desactivada (fecha histórica seleccionada)');
      }
    }

    function manageAutoUpdateUf() {
      if (updateIntervalUf) {
        clearInterval(updateIntervalUf);
        updateIntervalUf = null;
      }
      if (isSelectedDateToday()) {
        updateIntervalUf = setInterval(updateDashboardUf, 3000);
        console.log('Actualización automática activada (fecha actual seleccionada)');
      } else {
        console.log('Actualización automática desactivada (fecha histórica seleccionada)');
      }
    }

    function createMatrix(matrixData) {
      console.log('Datos de matriz recibidos:', matrixData);
      if (!matrixData || matrixData.length === 0) {
        $('#matrixContainer').html('<p class="text-muted">No hay datos disponibles para la matriz</p>');
        return;
      }

      // Obtener todos los operadores únicos y tipos de trámite
      var operators = [];
      var tramiteTypes = [];
      var operatorAvgMinutes = {}; // Nuevo: almacenar minutos promedio por operador

      matrixData.forEach(function(item) {
        if (operators.indexOf(item.NOMBRE_OPERADOR) === -1) {
          operators.push(item.NOMBRE_OPERADOR);
        }
        if (tramiteTypes.indexOf(item.tipo_tramite) === -1) {
          tramiteTypes.push(item.tipo_tramite);
        }
        // Capturar minutos promedio por operador
        if (!operatorAvgMinutes[item.NOMBRE_OPERADOR]) {
          operatorAvgMinutes[item.NOMBRE_OPERADOR] = parseFloat(item.minutos_promedio_atencion) || 0;
        }
      });

      // Ordenar arrays
      operators.sort();
      tramiteTypes.sort();

      console.log('Operadores:', operators);
      console.log('Tipos de trámite:', tramiteTypes);
      console.log('Minutos promedio por operador:', operatorAvgMinutes);

      // Crear estructura de datos para la matriz
      var matrixStructure = {};
      operators.forEach(function(op) {
        matrixStructure[op] = {};
        tramiteTypes.forEach(function(type) {
          matrixStructure[op][type] = 0;
        });
      });

      // Llenar la matriz con los datos
      matrixData.forEach(function(item) {
        if (matrixStructure[item.NOMBRE_OPERADOR] && matrixStructure[item.NOMBRE_OPERADOR].hasOwnProperty(item.tipo_tramite)) {
          matrixStructure[item.NOMBRE_OPERADOR][item.tipo_tramite] = parseInt(item.cantidad_por_tipo_de_tramite) || 0;
        }
      });

      console.log('Estructura de matriz:', matrixStructure);

      // Construir el HTML del header
      var headerHtml = '';
      headerHtml += '<td class="operator-name">Operador</td>';
      headerHtml += '<td class="avg-minutes">Promedio</td>'; // Nueva columna
      tramiteTypes.forEach(function(type) {
        headerHtml += '<td>' + type + '</td>';
      });
      headerHtml += '<td class="total-header">Total</td>';
      $('#matrixHeader').html(headerHtml);

      // Crear array de operadores con sus totales para ordenamiento
      var operatorsWithTotals = [];
      operators.forEach(function(operator) {
        var rowTotal = 0;
        tramiteTypes.forEach(function(type) {
          rowTotal += matrixStructure[operator][type];
        });
        operatorsWithTotals.push({
          name: operator,
          total: rowTotal,
          avgMinutes: operatorAvgMinutes[operator] || 0
        });
      });

      // Ordenar por total de forma DESCENDENTE (mayor a menor)
      operatorsWithTotals.sort(function(a, b) {
        return b.total - a.total; // Descendente: b - a
      });

      console.log('Operadores ordenados por total (descendente):', operatorsWithTotals);

      // Construir el HTML del body con el nuevo orden
      var bodyHtml = '';
      operatorsWithTotals.forEach(function(operatorData) {
        var operator = operatorData.name;
        var rowTotal = operatorData.total;
        var avgMinutes = operatorData.avgMinutes;

        var rowHtml = '<tr>';
        rowHtml += '<td class="operator-name" title="' + operator + '">' + operator + '</td>';
        rowHtml += '<td class="avg-minutes">' + avgMinutes.toFixed(2) + '</td>'; // Nueva celda

        tramiteTypes.forEach(function(type) {
          var value = matrixStructure[operator][type];
          var cellClass = value > 0 ? 'value-cell has-value' : 'value-cell';
          rowHtml += '<td class="' + cellClass + '">' + (value > 0 ? value : '-') + '</td>';
        });

        rowHtml += '<td class="total-cell">' + rowTotal + '</td>';
        rowHtml += '</tr>';
        bodyHtml += rowHtml;
      });

      // Agregar fila de totales
      var totalRowHtml = '<tr>';
      totalRowHtml += '<td class="operator-name"><strong>TOTAL</strong></td>';
      totalRowHtml += '<td class="avg-minutes"><strong>-</strong></td>'; // Nueva celda para totales
      var grandTotal = 0;
      tramiteTypes.forEach(function(type) {
        var columnTotal = 0;
        operators.forEach(function(operator) {
          columnTotal += matrixStructure[operator][type];
        });
        grandTotal += columnTotal;
        totalRowHtml += '<td class="value-cell has-value"><strong>' + columnTotal + '</strong></td>';
      });
      totalRowHtml += '<td class="grand-total"><strong>' + grandTotal + '</strong></td>';
      totalRowHtml += '</tr>';

      bodyHtml += totalRowHtml;

      $('#matrixBody').html(bodyHtml);
      console.log('Matriz HTML generado correctamente');
    }

    function createMatrixUf(matrixData) {
      console.log('Datos de matriz recibidos:', matrixData);
      if (!matrixData || matrixData.length === 0) {
        $('#matrixContainerUf').html('<p class="text-muted">No hay datos disponibles para la matriz</p>');
        return;
      }

      // Obtener todos los operadores únicos y tipos de trámite
      var operators = [];
      var tramiteTypes = [];
      var operatorAvgMinutes = {}; // Nuevo: almacenar minutos promedio por operador

      matrixData.forEach(function(item) {
        if (operators.indexOf(item.NOMBRE_OPERADOR) === -1) {
          operators.push(item.NOMBRE_OPERADOR);
        }
        if (tramiteTypes.indexOf(item.tipo_tramite) === -1) {
          tramiteTypes.push(item.tipo_tramite);
        }
        // Capturar minutos promedio por operador
        if (!operatorAvgMinutes[item.NOMBRE_OPERADOR]) {
          operatorAvgMinutes[item.NOMBRE_OPERADOR] = parseFloat(item.minutos_promedio_atencion) || 0;
        }
      });

      // Ordenar arrays
      operators.sort();
      tramiteTypes.sort();

      console.log('Operadores:', operators);
      console.log('Tipos de trámite:', tramiteTypes);
      console.log('Minutos promedio por operador:', operatorAvgMinutes);

      // Crear estructura de datos para la matriz
      var matrixStructure = {};
      operators.forEach(function(op) {
        matrixStructure[op] = {};
        tramiteTypes.forEach(function(type) {
          matrixStructure[op][type] = 0;
        });
      });

      // Llenar la matriz con los datos
      matrixData.forEach(function(item) {
        if (matrixStructure[item.NOMBRE_OPERADOR] && matrixStructure[item.NOMBRE_OPERADOR].hasOwnProperty(item.tipo_tramite)) {
          matrixStructure[item.NOMBRE_OPERADOR][item.tipo_tramite] = parseInt(item.cantidad_por_tipo_de_tramite) || 0;
        }
      });

      console.log('Estructura de matriz:', matrixStructure);

      // Construir el HTML del header
      var headerHtml = '';
      headerHtml += '<td class="operator-name">Operador</td>';
      headerHtml += '<td class="avg-minutes">Promedio</td>'; // Nueva columna
      tramiteTypes.forEach(function(type) {
        headerHtml += '<td>' + type + '</td>';
      });
      headerHtml += '<td class="total-header">Total</td>';
      $('#matrixHeaderUf').html(headerHtml);

      // Crear array de operadores con sus totales para ordenamiento
      var operatorsWithTotals = [];
      operators.forEach(function(operator) {
        var rowTotal = 0;
        tramiteTypes.forEach(function(type) {
          rowTotal += matrixStructure[operator][type];
        });
        operatorsWithTotals.push({
          name: operator,
          total: rowTotal,
          avgMinutes: operatorAvgMinutes[operator] || 0
        });
      });

      // Ordenar por total de forma DESCENDENTE (mayor a menor)
      operatorsWithTotals.sort(function(a, b) {
        return b.total - a.total; // Descendente: b - a
      });

      console.log('Operadores ordenados por total (descendente):', operatorsWithTotals);

      // Construir el HTML del body con el nuevo orden
      var bodyHtml = '';
      operatorsWithTotals.forEach(function(operatorData) {
        var operator = operatorData.name;
        var rowTotal = operatorData.total;
        var avgMinutes = operatorData.avgMinutes;

        var rowHtml = '<tr>';
        rowHtml += '<td class="operator-name" title="' + operator + '">' + operator + '</td>';
        rowHtml += '<td class="avg-minutes">' + avgMinutes.toFixed(2) + '</td>'; // Nueva celda

        tramiteTypes.forEach(function(type) {
          var value = matrixStructure[operator][type];
          var cellClass = value > 0 ? 'value-cell has-value' : 'value-cell';
          rowHtml += '<td class="' + cellClass + '">' + (value > 0 ? value : '-') + '</td>';
        });

        rowHtml += '<td class="total-cell">' + rowTotal + '</td>';
        rowHtml += '</tr>';
        bodyHtml += rowHtml;
      });

      // Agregar fila de totales
      var totalRowHtml = '<tr>';
      totalRowHtml += '<td class="operator-name"><strong>TOTAL</strong></td>';
      totalRowHtml += '<td class="avg-minutes"><strong>-</strong></td>'; // Nueva celda para totales
      var grandTotal = 0;
      tramiteTypes.forEach(function(type) {
        var columnTotal = 0;
        operators.forEach(function(operator) {
          columnTotal += matrixStructure[operator][type];
        });
        grandTotal += columnTotal;
        totalRowHtml += '<td class="value-cell has-value"><strong>' + columnTotal + '</strong></td>';
      });
      totalRowHtml += '<td class="grand-total"><strong>' + grandTotal + '</strong></td>';
      totalRowHtml += '</tr>';

      bodyHtml += totalRowHtml;

      $('#matrixBodyUf').html(bodyHtml);
      console.log('Matriz HTML generado correctamente');
    }

    // Función para obtener y actualizar los datos del dashboard
    function updateDashboard() {
      console.log("en updateDashboard");
      const selectedDate = $('#dashboardDate').val();
      const formattedDate = moment(selectedDate, 'DD/MM/YYYY').format('YYYY-MM-DD');
      $.ajax({
        url: 'apiCharts.php',
        method: 'GET',
        data: {
          date: formattedDate
        },
        dataType: 'json',
        success: function(data) {
          console.log('Datos recibidos:', data);
          // Actualizar tarjetas de información
          var waitTime = toNumber(data.minutos_promedio_espera);
          var attentionTime = toNumber(data.minutos_promedio_atencion);
          if (previousData.minutos_promedio_espera !== waitTime) {
            $('#avgWaitTime').text(waitTime.toFixed(2) + ' MINUTOS');
            previousData.minutos_promedio_espera = waitTime;
          }
          if (previousData.minutos_promedio_atencion !== attentionTime) {
            $('#avgAttentionTime').text(attentionTime.toFixed(2) + ' MINUTOS');
            previousData.minutos_promedio_atencion = attentionTime;
          }
          // --- Chart 1: Cantidad de Trámites por Tipo ---
          if (data.resumen_tipos_tramite && data.resumen_tipos_tramite.length > 0) {
            if (!arraysEqual(previousData.resumen_tipos_tramite, data.resumen_tipos_tramite)) {
              console.log('Actualizando Chart 1 UICT - datos han cambiado');
              const chart1Labels = data.resumen_tipos_tramite.map(function(item) {
                return item.tipo_tramite;
              });
              const chart1DataCreados = data.resumen_tipos_tramite.map(function(item) {
                return toNumber(item.cantidad_creados);
              });
              const chart1DataAtendidos = data.resumen_tipos_tramite.map(function(item) {
                return toNumber(item.cantidad_atendidos);
              });
              if (chart1Instance) {
                chart1Instance.destroy();
              }
              const ctx1 = document.getElementById('chart1').getContext('2d');
              chart1Instance = new Chart(ctx1, {
                type: 'bar',
                data: {
                  labels: chart1Labels,
                  datasets: [{
                      label: 'Creados',
                      data: chart1DataCreados,
                      backgroundColor: 'rgba(75, 192, 192, 0.6)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                    },
                    {
                      label: 'Atendidos',
                      data: chart1DataAtendidos,
                      backgroundColor: 'rgba(153, 102, 255, 0.6)',
                      borderColor: 'rgba(153, 102, 255, 1)',
                      borderWidth: 1
                    }
                  ]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      position: 'top',
                    },
                    datalabels: {
                      anchor: 'end',
                      align: 'top',
                      rotation: -90,
                      color: '#000',
                      font: {
                        size: 10,
                        weight: 'bold'
                      },
                      formatter: function(value) {
                        return value > 0 ? value : '';
                      }
                    }
                  },
                  scales: {
                    x: {
                      stacked: false,
                    },
                    y: {
                      beginAtZero: true,
                      stacked: false
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.resumen_tipos_tramite = JSON.parse(JSON.stringify(data.resumen_tipos_tramite));
            }
          }
          // --- Chart 2: Trámites Atendidos por Usuario (HORIZONTAL) ---
          if (data.tramites_atendidos_por_usuario && data.tramites_atendidos_por_usuario.length > 0) {
            if (!arraysEqual(previousData.tramites_atendidos_por_usuario, data.tramites_atendidos_por_usuario)) {
              console.log('Actualizando Chart 2 UICT - datos han cambiado');
              const chart2Labels = data.tramites_atendidos_por_usuario.map(function(item) {
                return item.NOMBRE_OPERADOR;
              });
              const chart2Data = data.tramites_atendidos_por_usuario.map(function(item) {
                return toNumber(item.cantidad_tramites_atendidos);
              });
              if (chart2Instance) {
                chart2Instance.destroy();
              }
              const ctx2 = document.getElementById('chart2').getContext('2d');
              chart2Instance = new Chart(ctx2, {
                type: 'bar',
                data: {
                  labels: chart2Labels,
                  datasets: [{
                    label: 'Trámites Atendidos',
                    data: chart2Data,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  indexAxis: 'y',
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: false,
                    },
                    datalabels: {
                      anchor: 'end',
                      align: 'right',
                      color: '#000',
                      font: {
                        size: 10,
                        weight: 'bold'
                      },
                      formatter: function(value) {
                        return value > 0 ? value : '';
                      }
                    }
                  },
                  scales: {
                    x: {
                      beginAtZero: true
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.tramites_atendidos_por_usuario = JSON.parse(JSON.stringify(data.tramites_atendidos_por_usuario));
            }
          }
          // --- Pie Chart: Resumen General ---
          if (data.resumen_torta && data.resumen_torta.length > 0) {
            if (!arraysEqual(previousData.resumen_torta, data.resumen_torta)) {
              console.log('Actualizando Pie Chart UICT - datos han cambiado');
              var totalCreados = 0;
              var totalAtendidos = 0;
              data.resumen_torta.forEach(function(item) {
                totalCreados += toNumber(item.cantidad_creados);
                totalAtendidos += toNumber(item.cantidad_atendidos);
              });
              if (pieChartInstance) {
                pieChartInstance.destroy();
              }
              const ctxPie = document.getElementById('pieChart').getContext('2d');
              pieChartInstance = new Chart(ctxPie, {
                type: 'pie',
                data: {
                  labels: ['Creados', 'Atendidos'],
                  datasets: [{
                    data: [totalCreados, totalAtendidos],
                    backgroundColor: [
                      '#98f8e5ff ',
                      '#ffd5b0ff'
                    ],
                    borderColor: [
                      '#98f8e5ff ',
                      '#ffd5b0ff'
                    ],
                    borderWidth: 2
                  }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      position: 'bottom',
                    },
                    datalabels: {
                      color: '#000',
                      font: {
                        size: 14,
                        weight: 'bold'
                      },
                      formatter: function(value, context) {
                        var total = context.dataset.data.reduce(function(a, b) {
                          return a + b;
                        }, 0);
                        var percentage = ((value / total) * 100).toFixed(1);
                        return value + '\n(' + percentage + '%)';
                      }
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.resumen_torta = JSON.parse(JSON.stringify(data.resumen_torta));
            }
          }
          // --- Matriz de Operadores vs Tipos de Trámite ---
          if (data.matriz_operador_tipo) {
            if (!arraysEqual(previousData.matriz_operador_tipo, data.matriz_operador_tipo)) {
              console.log('Actualizando Matriz UICT - datos han cambiado');
              createMatrix(data.matriz_operador_tipo);
              previousData.matriz_operador_tipo = JSON.parse(JSON.stringify(data.matriz_operador_tipo));
            } else {
              console.log('Matriz UICT - sin cambios, no se actualiza');
            }
          } else {
            console.log('No se recibieron datos de matriz');
          }
        },
        error: function(xhr, status, error) {
          console.error("Error al obtener datos del dashboard:", status, error);
          console.error("Respuesta del servidor:", xhr.responseText);
        }
      });
    }

    function updateDashboardUf() {
      console.log("en updateDashboardUf");
      const selectedDate = $('#dashboardDateUf').val();
      const formattedDate = moment(selectedDate, 'DD/MM/YYYY').format('YYYY-MM-DD');
      $.ajax({
        url: 'apiChartsUf.php',
        method: 'GET',
        data: {
          date: formattedDate
        },
        dataType: 'json',
        success: function(data) {
          console.log('Datos recibidos:', data);
          // Actualizar tarjetas de información
          var waitTime = toNumber(data.minutos_promedio_espera);
          var attentionTime = toNumber(data.minutos_promedio_atencion);
          if (previousData.minutos_promedio_esperaUf !== waitTime) {
            $('#avgWaitTimeUf').text(waitTime.toFixed(2) + ' MINUTOS');
            previousData.minutos_promedio_esperaUf = waitTime;
          }
          if (previousData.minutos_promedio_atencionUf !== attentionTime) {
            $('#avgAttentionTimeUf').text(attentionTime.toFixed(2) + ' MINUTOS');
            previousData.minutos_promedio_atencionUf = attentionTime;
          }
          // --- Chart 1: Cantidad de Trámites por Tipo ---
          if (data.resumen_tipos_tramite && data.resumen_tipos_tramite.length > 0) {
            if (!arraysEqual(previousData.resumen_tipos_tramiteUf, data.resumen_tipos_tramite)) {
              console.log('Actualizando Chart 1 uf - datos han cambiado');
              const chart1Labels = data.resumen_tipos_tramite.map(function(item) {
                return item.tipo_tramite;
              });
              const chart1DataCreados = data.resumen_tipos_tramite.map(function(item) {
                return toNumber(item.cantidad_creados);
              });
              const chart1DataAtendidos = data.resumen_tipos_tramite.map(function(item) {
                return toNumber(item.cantidad_atendidos);
              });
              if (chart1InstanceUf) {
                chart1InstanceUf.destroy();
              }
              const ctx1 = document.getElementById('chart1Uf').getContext('2d');
              chart1InstanceUf = new Chart(ctx1, {
                type: 'bar',
                data: {
                  labels: chart1Labels,
                  datasets: [{
                      label: 'Creados',
                      data: chart1DataCreados,
                      backgroundColor: 'rgba(75, 192, 192, 0.6)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                    },
                    {
                      label: 'Atendidos',
                      data: chart1DataAtendidos,
                      backgroundColor: 'rgba(153, 102, 255, 0.6)',
                      borderColor: 'rgba(153, 102, 255, 1)',
                      borderWidth: 1
                    }
                  ]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      position: 'top',
                    },
                    datalabels: {
                      anchor: 'end',
                      align: 'top',
                      rotation: -90,
                      color: '#000',
                      font: {
                        size: 10,
                        weight: 'bold'
                      },
                      formatter: function(value) {
                        return value > 0 ? value : '';
                      }
                    }
                  },
                  scales: {
                    x: {
                      stacked: false,
                    },
                    y: {
                      beginAtZero: true,
                      stacked: false
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.resumen_tipos_tramiteUf = JSON.parse(JSON.stringify(data.resumen_tipos_tramite));
            }
          }
          // --- Chart 2: Trámites Atendidos por Usuario (HORIZONTAL) ---
          if (data.tramites_atendidos_por_usuario && data.tramites_atendidos_por_usuario.length > 0) {
            console.log(previousData.tramites_atendidos_por_usuarioUf);
            console.log(data.tramites_atendidos_por_usuario);
            console.log("arraysEqual(previousData.tramites_atendidos_por_usuarioUf, data.tramites_atendidos_por_usuario):" + arraysEqual(previousData.tramites_atendidos_por_usuarioUf, data.tramites_atendidos_por_usuario));
            if (!arraysEqual(previousData.tramites_atendidos_por_usuarioUf, data.tramites_atendidos_por_usuario)) {
              console.log('Actualizando Chart 2 UF - datos han cambiado');
              const chart2Labels = data.tramites_atendidos_por_usuario.map(function(item) {
                return item.NOMBRE_OPERADOR;
              });
              const chart2Data = data.tramites_atendidos_por_usuario.map(function(item) {
                return toNumber(item.cantidad_tramites_atendidos);
              });
              if (chart2InstanceUf) {
                chart2InstanceUf.destroy();
              }
              const ctx2 = document.getElementById('chart2Uf').getContext('2d');
              chart2InstanceUf = new Chart(ctx2, {
                type: 'bar',
                data: {
                  labels: chart2Labels,
                  datasets: [{
                    label: 'Trámites Atendidos',
                    data: chart2Data,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  indexAxis: 'y',
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: false,
                    },
                    datalabels: {
                      anchor: 'end',
                      align: 'right',
                      color: '#000',
                      font: {
                        size: 10,
                        weight: 'bold'
                      },
                      formatter: function(value) {
                        return value > 0 ? value : '';
                      }
                    }
                  },
                  scales: {
                    x: {
                      beginAtZero: true
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.tramites_atendidos_por_usuarioUf = JSON.parse(JSON.stringify(data.tramites_atendidos_por_usuario));
            }
          }
          // --- Pie Chart: Resumen General ---
          if (data.resumen_torta && data.resumen_torta.length > 0) {
            if (!arraysEqual(previousData.resumen_tortaUf, data.resumen_torta)) {
              console.log('Actualizando Pie Chart Uf - datos han cambiado');
              var totalCreados = 0;
              var totalAtendidos = 0;
              data.resumen_torta.forEach(function(item) {
                totalCreados += toNumber(item.cantidad_creados);
                totalAtendidos += toNumber(item.cantidad_atendidos);
              });
              if (pieChartInstanceUf) {
                pieChartInstanceUf.destroy();
              }
              const ctxPie = document.getElementById('pieChartUf').getContext('2d');
              pieChartInstanceUf = new Chart(ctxPie, {
                type: 'pie',
                data: {
                  labels: ['Creados', 'Atendidos'],
                  datasets: [{
                    data: [totalCreados, totalAtendidos],
                    backgroundColor: [
                      '#98f8e5ff ',
                      '#ffd5b0ff'
                    ],
                    borderColor: [
                      '#98f8e5ff ',
                      '#ffd5b0ff'
                    ],
                    borderWidth: 2
                  }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      position: 'bottom',
                    },
                    datalabels: {
                      color: '#000',
                      font: {
                        size: 14,
                        weight: 'bold'
                      },
                      formatter: function(value, context) {
                        var total = context.dataset.data.reduce(function(a, b) {
                          return a + b;
                        }, 0);
                        var percentage = ((value / total) * 100).toFixed(1);
                        return value + '\n(' + percentage + '%)';
                      }
                    }
                  }
                },
                plugins: [ChartDataLabels]
              });
              previousData.resumen_tortaUf = JSON.parse(JSON.stringify(data.resumen_torta));
            }
          }
          // --- Matriz de Operadores vs Tipos de Trámite ---
          if (data.matriz_operador_tipo) {
            if (!arraysEqual(previousData.matriz_operador_tipoUf, data.matriz_operador_tipo)) {
              console.log('Actualizando Matriz - datos han cambiado');
              createMatrixUf(data.matriz_operador_tipo);
              previousData.matriz_operador_tipoUf = JSON.parse(JSON.stringify(data.matriz_operador_tipo));
            } else {
              console.log('Matriz UF - sin cambios, no se actualiza');
            }
          } else {
            console.log('No se recibieron datos de matriz');
          }
        },
        error: function(xhr, status, error) {
          console.error("Error al obtener datos del dashboard:", status, error);
          console.error("Respuesta del servidor:", xhr.responseText);
        }
      });
    }


    $(document).ready(function() {
      console.log("inicializando funciones")
      const fp = $(".datepicker").flatpickr({
        dateFormat: "d/m/Y",
        onChange: function(selectedDates, dateStr, instance) {
          if ($('#codigo_unidad').val() == 'UICT' || $('#codigo_unidad').val() == 'DIR' || $('#codigo_unidad').val() == 'SIS') {
            updateDashboard();
            manageAutoUpdate();
          }
          if ($('#codigo_unidad').val() == 'UFyR' || $('#codigo_unidad').val() == 'DIR' || $('#codigo_unidad').val() == 'SIS') {
            updateDashboardUf();
            manageAutoUpdateUf();
          }
        }
      });

      // Cargar datos iniciales
      if ($('#codigo_unidad').val() == 'UICT' || $('#codigo_unidad').val() == 'DIR'  || $('#codigo_unidad').val() == 'SIS') {
        updateDashboard();
        manageAutoUpdate();
      }
      if ($('#codigo_unidad').val() == 'UFyR' || $('#codigo_unidad').val() == 'DIR' || $('#codigo_unidad').val() == 'SIS') {
        updateDashboardUf();
        manageAutoUpdateUf();
      }
    });



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
            action: function() {
              var formSubmitButton = this.buttons.formSubmit;
              datos = "&passwordNuevo_=" + $("#passwordNuevo_").val() + "&passwordAct_=" + $("#passwordAct_").val();
              console.log(datos);
              $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "setPass.php",
                data: datos,
                beforeSend: function() {
                  formSubmitButton.setText('Procesando...');
                  formSubmitButton.disable();
                },
                success: function(e) {
                  console.log(e);
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
                          action: function() {
                            window.location.href = "index.php";
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
                          action: function() {
                            cambioPass()
                          },
                        },
                      }
                    });
                  }

                },
                timeout: 16000,
                error: function() {},
              });

            },
          },
          cancel: {
            text: "Cerrar",
            action: function() {},
          },
        },
        onOpenBefore: function() {
          $('.jconfirm-title-c').css('text-align', 'center');
        }
      });
    }

    function logout() {
      window.location.href = 'logout.php';
    }
  </script>
</body>

</html>
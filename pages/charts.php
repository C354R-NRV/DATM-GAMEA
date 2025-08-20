<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <!-- Chart.js for Pie and Bar Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Google Charts for Meter Chart -->
  <script
    type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      padding: 20px;
    }

    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .chart-section {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 1.8em;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 10px;
    }

    /* Charts Visualization Section - Exact format from graphic.html */
    .charts-visualization {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .text-counts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      margin-bottom: 20px;
    }

    .text-count-box {
      background: linear-gradient(135deg, #36a2eb 0%, #287ab1 100%);
      color: white;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .text-count-box span {
      display: block;
      font-size: 1.5em;
      margin-top: 5px;
    }

    .charts-top {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 20px;
    }

    .charts-bottom {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 20px;
    }

    .chart-item {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      text-align: center;
      flex: 1 1 45%;
      min-width: 300px;
    }

    .chart-item canvas {
      max-height: 300px;
      width: 100% !important;
    }

    /* Meter Chart Section - Exact format from imagen.html */
    .meter-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      padding: 20px;
    }

    #gauge_div {
      max-width: 600px;
      height: 400px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

      .charts-top,
      .charts-bottom {
        flex-direction: column;
        align-items: center;
      }

      .chart-item {
        flex: 1 1 100%;
        max-width: 100%;
      }

      #gauge_div {
        height: 300px;
      }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    .show-btn3 {
      top: 5rem;
    }

    .show-btn3,
    .show-btn4,
    .show-btn5 {
      position: absolute;
      right: -3px;
      background-color: #020e10;
      width: 2rem !important;
      color: white;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .show-btn3 a,
    .show-btn4 a,
    .show-btn5 a {
      color: #e0e0e0;
      text-decoration: none;
    }

    .show-btn3:hover,
    .show-btn4 a {
      color: #ffffff;
    }

    .show-btn4 {
      top: 8rem;
    }

    .show-btn5 {
      top: 11rem;
    }

    #comboOperativo {
      position: absolute;
      right: 2.5rem;
      top: 11rem;
      display: none;
      background-color: #020e10;
      color: #fff;
      border: none;
      padding: 6px 8px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      font-size: 0.9rem;
      cursor: pointer;
    }

    #comboOperativo option {
      background-color: #020e10;
      color: white;
    }
  </style>
</head>

<body>
  <div>
    <div class="show-btn3"><a id="contenBtn" href="./index.php"><i class="fa fa-home" aria-hidden="true"></i></a></div>
    <div class="show-btn4"><a id="contenBtn" href="./ufPredialList.php"><i class="fa fa-reply" aria-hidden="true"></i></a></div>
    <div class="show-btn5" id="btnCombo"><i class="fa fa-list" aria-hidden="true"></i></div>

    <select id="comboOperativo">
      <option value="Todos">Todos</option>
      <option value="Operativo 1">Operativo 1</option>
      <option value="Operativo 2">Operativo 2</option>
      <option value="Operativo 3">Operativo 3</option>
    </select>

  </div>
  <div class="dashboard-container">
    <!-- First: Charts Visualization (from graphic.html) -->
    <div class="chart-section">
      <div class="text-counts">
        <div class="text-count-box">
          Puntos Programados
          <span id="total_puntos_programados">0</span>
        </div>
        <div class="text-count-box">
          Puntos Procesados
          <span id="puntos_fiscalizados">0</span>
        </div>
        <div class="text-count-box">
          Puntos Consolidados
          <span id="puntos_procesados">0</span>
        </div>
        <div class="text-count-box">
          Puntos en Desacato
          <span id="puntos_desacato">0</span>
        </div>
      </div>

      <div class="charts-top">
        <div class="chart-item">
          <canvas id="pieChart"></canvas>
        </div>
        <div class="chart-item">
          <canvas id="verticalBarEstadoOperativo"></canvas>
        </div>
      </div>

      <div class="charts-bottom">
        <div class="chart-item">
          <canvas id="verticalBarUsuario"></canvas>
        </div>
        <div class="chart-item">
          <canvas id="horizontalBarTipologia"></canvas>
        </div>
      </div>
    </div>

    <!-- Second: Meter Chart (from imagen.html) -->
    <div class="chart-section">
      <h2 class="section-title">MEDIDOR DE AVANCE</h2>
      <div class="meter-container">
        <div id="gauge_div"></div>
      </div>
    </div>
  </div>
  <!--  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> -->
  <script>
    const btnCombo = document.getElementById('btnCombo');
    const combo = document.getElementById('comboOperativo');

    btnCombo.addEventListener('click', () => {
      const isHidden = getComputedStyle(combo).display === 'none';
      combo.style.display = isHidden ? 'block' : 'none';
    });
    document.addEventListener('click', (e) => {
      if (!btnCombo.contains(e.target) && !combo.contains(e.target)) {
        combo.style.display = 'none';
      }
    });

    /* Chart.register(ChartDataLabels); */
    // Initialize Google Charts
    google.charts.load("current", {
      packages: ["gauge"]
    });

    // Load both chart systems
    Promise.all([
      new Promise((resolve) => google.charts.setOnLoadCallback(resolve)),
      new Promise((resolve) => {
        if (document.readyState === "loading") {
          document.addEventListener("DOMContentLoaded", resolve);
        } else {
          resolve();
        }
      }),
    ]).then(() => {
      loadOperativos().then(() => {
        initCharts();
        startAutoUpdate();
      });

      document.getElementById("comboOperativo").addEventListener("change", () => {
        // Resetear datos previos al cambiar operativo
        previousChartsData = null
        previousMeterData = null
        gaugeChartInstance = null
        currentGaugeValue = 0
        initCharts()
      })
    });

    async function loadOperativos() {
      try {
        const response = await fetch("../php/getOperativos.php");
        const operativos = await response.json();

        const combo = document.getElementById("comboOperativo");
        combo.innerHTML = "";

        // Agregar "Todos"
        combo.innerHTML = `<option value="Todos">Todos</option>`;

        // Agregar desde backend
        operativos.forEach(op => {
          const option = document.createElement("option");
          option.value = op.idoperativo;
          option.textContent = op.operativo + ' [' + op.fecha_operativo + ']';
          combo.appendChild(option);
        });

        console.log("Operativos cargados:", operativos);
      } catch (error) {
        console.error("Error cargando operativos:", error);
      }
    }


    let pieChartInstance = null;
    let verticalBarEstadoOperativoInstance = null;
    let verticalBarUsuarioInstance = null;
    let horizontalBarTipologiaInstance = null;

    let gaugeChartInstance = null
    let currentGaugeValue = 0
    let gaugeDataTable = null
    let gaugeOptions = null

    // Variables para almacenar datos previos y evitar reconstrucción innecesaria
    let previousChartsData = null
    let previousMeterData = null
    let updateInterval = null

    // Función para comparar datos y detectar cambios
    function hasDataChanged(newData, oldData) {
      if (!oldData) return true
      return JSON.stringify(newData) !== JSON.stringify(oldData)
    }

    // Función para iniciar la actualización automática
    function startAutoUpdate() {
      // Limpiar intervalo anterior si existe
      if (updateInterval) {
        clearInterval(updateInterval);
      }

      // Configurar nuevo intervalo de 3 segundos
      updateInterval = setInterval(() => {
        initCharts();
      }, 3000);
    }

    // Función para detener la actualización automática
    function stopAutoUpdate() {
      if (updateInterval) {
        clearInterval(updateInterval);
        updateInterval = null;
      }
    }

    async function initCharts() {
      try {
        const operativoSeleccionado = document.getElementById("comboOperativo").value
        console.log(`ufPredialChartsDataV2.php?operativo=${encodeURIComponent(operativoSeleccionado)}`)

        const chartsResponse = await fetch(
          `ufPredialChartsDataV2.php?operativo=${encodeURIComponent(operativoSeleccionado)}`,
        )
        const chartsData = await chartsResponse.json()

        const meterResponse = await fetch(`getConsultaV2.php?operativo=${encodeURIComponent(operativoSeleccionado)}`)
        const meterData = await meterResponse.json()

        console.log(chartsData)

        // Solo actualizar si los datos han cambiado
        if (chartsData.status === "success" && hasDataChanged(chartsData.data, previousChartsData)) {
          renderPieAndBarCharts(chartsData.data)
          previousChartsData = JSON.parse(JSON.stringify(chartsData.data))
        }

        if (hasDataChanged(meterData, previousMeterData)) {
          renderMeterChart(meterData)
          previousMeterData = JSON.parse(JSON.stringify(meterData))
        }
      } catch (error) {
        console.error("Error loading chart data:", error)
      }
    }

    function destroyExistingCharts() {
      if (pieChartInstance) {
        pieChartInstance.destroy();
        pieChartInstance = null;
      }
      if (verticalBarEstadoOperativoInstance) {
        verticalBarEstadoOperativoInstance.destroy();
        verticalBarEstadoOperativoInstance = null;
      }
      if (verticalBarUsuarioInstance) {
        verticalBarUsuarioInstance.destroy();
        verticalBarUsuarioInstance = null;
      }
      if (horizontalBarTipologiaInstance) {
        horizontalBarTipologiaInstance.destroy();
        horizontalBarTipologiaInstance = null;
      }
    }

    // Pie and Bar Charts Rendering
    function renderPieAndBarCharts(data) {
      destroyExistingCharts();

      // Update text counts
      document.getElementById("total_puntos_programados").textContent =
        data.total_puntos_programados[0]?.total || 0;
      document.getElementById("puntos_fiscalizados").textContent =
        data.puntos_fiscalizados[0]?.total || 0;
      document.getElementById("puntos_procesados").textContent =
        data.puntos_procesados[0]?.total || 0;
      document.getElementById("puntos_desacato").textContent =
        data.puntos_desacato[0]?.total || 0;

      // Pie Chart  
      const data2 = {
        pie_data: [{
            label: "PUNTOS PROGRAMADOS",
            total: (data.total_puntos_programados[0]?.total || 0)
          },
          {
            label: "PUNTOS PROCESADOS",
            total: (data.puntos_fiscalizados[0]?.total || 0)
          },
          {
            label: "PUNTOS CONSOLIDADOS",
            total: (data.puntos_procesados[0]?.total || 0)
          },
          {
            label: "PUNTOS EN DESACATO",
            total: (data.puntos_desacato[0]?.total || 0)
          }
        ]
      };

      const pieLabels = data2.pie_data.map((item) => item.label);
      const pieValues = data2.pie_data.map((item) => parseInt(item.total));

      pieChartInstance = new Chart(document.getElementById("pieChart").getContext("2d"), {
        type: "pie",
        data: {
          labels: pieLabels,
          datasets: [{
            data: pieValues,
            backgroundColor: ["#ffeb3b", "#007bff", "#4caf50", "#f44336"],
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        },
      });

      // Vertical Bar: Estado Operativo
      const vLabels = data.vertical_bar_estado_operativo.map(
        (item) => item.operativo || "OUT.OPER"
      );
      const vValuesProgramado = data.vertical_bar_estado_operativo.map(
        (item) => parseInt(item.programado) || 0
      );
      const vValuesFiscalizado = data.vertical_bar_estado_operativo.map(
        (item) => parseInt(item.fiscalizados) || 0
      );

      verticalBarEstadoOperativoInstance = new Chart(
        document
        .getElementById("verticalBarEstadoOperativo")
        .getContext("2d"), {
          type: "bar",
          data: {
            labels: vLabels,
            datasets: [{
                label: "Programados",
                data: vValuesProgramado,
                backgroundColor: "#36a2eb",
              },
              {
                label: "Fiscalizados",
                data: vValuesFiscalizado,
                backgroundColor: "#ff6384",
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  precision: 0
                }
              },
            },
          },
        }
      );

      // Vertical Bar: Usuario
      const uLabels = data.vertical_bar_usuario.map((item) => item.usuario);
      const uValues = data.vertical_bar_usuario.map((item) =>
        parseInt(item.total)
      );

      verticalBarUsuarioInstance = new Chart(
        document.getElementById("verticalBarUsuario").getContext("2d"), {
          type: "bar",
          data: {
            labels: uLabels,
            datasets: [{
              label: "Registros por Usuario",
              data: uValues,
              backgroundColor: "#36a2eb",
            }, ],
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  precision: 0
                }
              },
            },
          },
        }
      );

      // Horizontal Bar: Tipologia
      const hLabels = data.horizontal_bar_tipologia.map(
        (item) => item.tipologia
      );
      const hValues = data.horizontal_bar_tipologia.map((item) =>
        parseInt(item.total)
      );

      horizontalBarTipologiaInstance = new Chart(
        document.getElementById("horizontalBarTipologia").getContext("2d"), {
          type: "bar",
          data: {
            labels: hLabels,
            datasets: [{
              label: "Registros por Tipologia",
              data: hValues,
              backgroundColor: "#ff6384",
            }, ],
          },
          options: {
            indexAxis: "y",
            responsive: true,
            scales: {
              x: {
                beginAtZero: true,
                ticks: {
                  precision: 0
                }
              },
            },
          },
        }
      );
    }


    function renderMeterChart(data) {
      const totalPuntosProgramados = data.total
      const newValue = data.parcial

      // Si es la primera vez o cambió el máximo, recrear el gauge
      if (!gaugeChartInstance || !gaugeOptions || gaugeOptions.max !== totalPuntosProgramados) {
        // Crear nueva instancia solo si es necesario
        gaugeDataTable = window.google.visualization.arrayToDataTable([
          ["Label", "Value"],
          ["", 0],
        ])

        gaugeOptions = {
          width: 600,
          height: 400,
          redFrom: 0,
          redTo: 0,
          yellowFrom: 0,
          yellowTo: 0,
          greenFrom: 0,
          greenTo: totalPuntosProgramados,
          minorTicks: 5,
          max: totalPuntosProgramados,
          greenColor: "#FFEB3B",
          yellowColor: "#36A2EB",
          animation: {
            duration: 800,
            easing: "out",
            startup: true,
          },
        }

        gaugeChartInstance = new window.google.visualization.Gauge(document.getElementById("gauge_div"))

        currentGaugeValue = 0
      }

      animateGaugeToValue(newValue)
    }


    function animateGaugeToValue(targetValue) {
      const startValue = currentGaugeValue
      const difference = targetValue - startValue
      const duration = 1000 // 1 segundo de animación
      const steps = 30 // 30 pasos para animación suave
      const stepValue = difference / steps
      const stepDuration = duration / steps

      let step = 0

      function animateStep() {
        if (step >= steps) {
          // Asegurar que termine exactamente en el valor objetivo
          currentGaugeValue = targetValue
          updateGaugeDisplay(currentGaugeValue)
          return
        }

        currentGaugeValue = startValue + stepValue * step
        updateGaugeDisplay(currentGaugeValue)

        step++
        setTimeout(animateStep, stepDuration)
      }

      animateStep()
    }

    function updateGaugeDisplay(value) {
      if (gaugeDataTable && gaugeChartInstance && gaugeOptions) {
        gaugeDataTable.setValue(0, 1, Math.round(value))
        gaugeOptions.yellowTo = Math.round(value)
        gaugeOptions.greenFrom = Math.round(value)

        gaugeChartInstance.draw(gaugeDataTable, gaugeOptions)
      }
    }

    // Opcional: Detener actualización cuando la página se oculta para ahorrar recursos
    document.addEventListener('visibilitychange', function() {
      if (document.hidden) {
        stopAutoUpdate();
      } else {
        startAutoUpdate();
      }
    });
  </script>
</body>

</html>
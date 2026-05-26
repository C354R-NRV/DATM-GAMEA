<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$query = "SELECT 
            a.idproceso,a.resolucion_determinativa,a.gestion_fiscal,a.piet,a.fecha_piet,a.acto_ejecucion_tributaria,
            a.fecha_notificacion,a.cancelacion_determinacion_tributaria,
            a.auto_conclusion,a.cierre_definitivo_proceso,a.observaciones,a.path_archivo,a.estado_, a.numero_tributario,a.idrubro, 
            c.rubro, c.idrubro, a.fregistro_::DATE as fregistro_, b.usuario , codigo_proceso
            from uaj_procesos a 
            left join datm_usuario b on a.idusuario_ = b.id  
            left join exc_rubro c on a.idrubro = c.idrubro 
            where a.estado_
            and  a.idproceso = $idproceso   
            order by a.idproceso asc";

$stmt = $cons->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$data = array();
$data['html'] = "<div class='form-group custom-form-container'> 
    <div class='row g-3'>
        <div class='col-lg-6 col-md-12'>
            <label>No. DOCUMENTO TRIBUTARIO</label>
            <div class='form-value'>".$result['numero_tributario']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>Rubro</label>
            <div class='form-value'>".$result['rubro']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>REGISTRO DE LA RESOLUCIÓN DETERMINATIVA</label>
            <div class='form-value'>".$result['resolucion_determinativa']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>REGISTRO DE LAS GESTIONES QUE FISCALIZA</label>
            <div class='form-value'>".$result['gestion_fiscal']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>REGISTRO DE LA EMISIÓN DEL PIET</label>
            <div class='form-value'>".$result['piet']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>FECHA DE NOTIFICACIÓN DEL PIET</label>
            <div class='form-value'>".$result['fecha_piet']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>ACTO ADMINISTRATIVO REALIZADO PARA LA EJECUCIÓN TRIBUTARIA</label>
            <div class='form-value'>".$result['acto_ejecucion_tributaria']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>FECHA DE NOTIFICACIÓN</label>
            <div class='form-value'>".$result['fecha_notificacion']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>CANCELACIÓN DE DETERMINACIÓN TRIBUTARIA</label>
            <div class='form-value'>".$result['cancelacion_determinacion_tributaria']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>N° DE AUTO DE CONCLUSIÓN DEL PROCESO</label>
            <div class='form-value'>".$result['auto_conclusion']."</div>
        </div>
        <div class='col-lg-6 col-md-12'>
            <label>CIERRE DEFINITIVO DEL PROCESO DE FISCALIZACIÓN</label>
            <div class='form-value'>".$result['cierre_definitivo_proceso']."</div>
        </div>
    </div>

    <div class='col-md-12 mt-3'>
        <label>Observaciones</label>
        <div class='form-value'>".$result['observaciones']."</div>
    </div>
</div>";
print_r(json_encode($data));

<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
require_once '../php/conexionpsql.php';

header('Content-Type: application/json');

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

try {

    error_log("ufPredialChartsData.php: Session check bypassed for debugging");

    $conn = new Conexion();
    $cons = $conn->conectar();
    $auxFiltro = '';
    if ($operativo != 'Todos') {
        $auxFiltro = " and o.idoperativo = $operativo ";
    }
    // Queries for charts data
    $queries = [
        // Text counts without relation between tables
        'total_puntos_programados' => "SELECT COUNT(*) AS total FROM public.uf_prepredial o WHERE estado_ = true  $auxFiltro  ",
        'puntos_fiscalizados' => "SELECT  
                COUNT(DISTINCT pr.id) AS total
            FROM public.uf_predial pr
            LEFT JOIN public.uf_grupo_operativo g 
                ON g.idusuario = pr.idusuario
            LEFT JOIN public.uf_operativo o 
                ON g.idoperativo = o.idoperativo 
                AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
            WHERE 
                pr.estado_ = true 
                AND pr.clasificacion = 'A' 
                AND idestado_fiscalizacion = 1 $auxFiltro ",
        'puntos_procesados' => "SELECT  
                COUNT(DISTINCT pr.id) AS total
            FROM public.uf_predial pr
            LEFT JOIN public.uf_grupo_operativo g 
                ON g.idusuario = pr.idusuario
            LEFT JOIN public.uf_operativo o 
                ON g.idoperativo = o.idoperativo 
                AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
            WHERE 
                pr.estado_ = true 
                AND pr.clasificacion = 'A' 
                and idestado_fiscalizacion = 2  $auxFiltro ",
        'puntos_desacato' => "SELECT  
                COUNT(DISTINCT pr.id) AS total
            FROM public.uf_predial pr
            LEFT JOIN public.uf_grupo_operativo g 
                ON g.idusuario = pr.idusuario
            LEFT JOIN public.uf_operativo o 
                ON g.idoperativo = o.idoperativo 
                AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
            WHERE 
                pr.estado_ = true 
                AND pr.clasificacion = 'A' 
                and idestado_fiscalizacion = 3  $auxFiltro",
        // Pie chart data without relation between tables
        'pie_data' => "
            SELECT 'PUNTOS PROGRAMADOS' AS label, COUNT(*) AS total FROM public.uf_prepredial WHERE estado_ = true
            UNION ALL
            SELECT 'PUNTOS PROCESADOS' AS label, COUNT(*) AS total FROM public.uf_predial WHERE estado_ = true AND clasificacion = 'A' AND idestado_fiscalizacion = 1
            UNION ALL
            SELECT 'PUNTOS CONSOLIDADOS' AS label, COUNT(*) AS total FROM public.uf_predial WHERE estado_ = true AND clasificacion = 'A' AND idestado_fiscalizacion = 2
            UNION ALL
            SELECT 'PUNTOS EN DESACATO' AS label, COUNT(*) AS total FROM public.uf_predial WHERE estado_ = true AND clasificacion = 'A' AND idestado_fiscalizacion = 3
        ",
        'vertical_bar_estado_operativo' => "
            SELECT 
                COALESCE(a.fecha, b.fecha_operativo) AS fecha,
                COALESCE(b.operativo, 'F.OPE') ||' ['|| fecha_operativo||']' AS operativo,
                COALESCE(b.total, 0) AS programado,
                COALESCE(a.parcial, 0) AS fiscalizados
            FROM (
                SELECT 
                    CAST(pr.fecha_apersonamiento AS date) AS fecha,   
                    COUNT(DISTINCT pr.id) AS parcial
                FROM public.uf_predial pr
                LEFT JOIN public.uf_grupo_operativo g 
                    ON g.idusuario = pr.idusuario
                LEFT JOIN public.uf_operativo o 
                    ON g.idoperativo = o.idoperativo 
                    AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
                WHERE 
                    pr.estado_ = true 
                    AND pr.clasificacion = 'A' 
                    AND pr.idestado_fiscalizacion IN (1,2,3)
                GROUP BY CAST(pr.fecha_apersonamiento AS date)
            ) a
            FULL JOIN (
                SELECT 
                    
                    o.fecha_operativo, 
                    o.operativo, 
                    COUNT(*) AS total
                FROM uf_prepredial a
                LEFT JOIN uf_operativo o 
                    ON a.idoperativo = o.idoperativo
                WHERE a.estado_ = true 
                GROUP BY o.operativo, o.fecha_operativo
            ) b
            ON a.fecha = b.fecha_operativo

		where b.operativo is not null 
        ", 
        'vertical_bar_usuario' => "  
            SELECT a.usuario, b.idusuario, COUNT(*) AS total
                FROM datm_usuario a
                LEFT JOIN uf_predial b ON a.id = b.idusuario 
                left join uf_operativo o on cast( o.fecha_operativo as date) = cast(  b.fecha_apersonamiento as date)
            where b.estado_ is true and b.clasificacion = 'A'  
                    $auxFiltro  
                GROUP BY a.id, a.usuario, b.idusuario
                ORDER BY a.id
        ", 
        'horizontal_bar_tipologia' => "
            SELECT  
            pr.tipologia, COUNT(*) AS total
            FROM uf_predial pr
            LEFT JOIN uf_prepredial g 
                ON g.idpredial_asociado = pr.id
            LEFT JOIN  uf_operativo o 
                ON g.idoperativo = o.idoperativo 
                AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
            WHERE 
                pr.estado_ = true 
                AND pr.clasificacion = 'A' 
                and pr.estado_  is true
                and g.estado_  is true   
                
                $auxFiltro  

                    GROUP BY tipologia
            ORDER BY tipologia     "
                ];

    $result = [];

    foreach ($queries as $key => $sql) {
        $stmt = $cons->prepare($sql);
        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Error executing query for $key: " . $errorInfo[2]);
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result[$key] = $data;
    }
    $result['sql'] = $queries;
    ob_end_clean();
    echo json_encode(['status' => 'success', 'data' => $result]);
} catch (Exception $e) {
    ob_end_clean();
    error_log("ufPredialChartsData.php error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}

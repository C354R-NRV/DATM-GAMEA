<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();
/* 
$query = "select fecha_apersonamiento,  b.usuario, a.nombre_razon, a.contacto_titular, 
a.nombre_apoderado, a.contacto_apoderado, a.tipologia, a.via, a.no_plantas, 
a.no_concluidos, a.no_brutos, a.hhrr, a.descripcion, a.no_formulario, 
TRIM(replace(replace(replace(replace(ubicacion_nivel1, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel1, 
    TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel2, 
    TRIM(replace(replace(replace(ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel3,
    a.no_puerta, a.imagen_principal, a.imagen_adicional, a.video,    (SELECT string_agg(s.servicio, ', ') 
        FROM uf_predrial_servicio ps 
        JOIN uf_servicios s ON ps.idservicio = s.idservicio 
        WHERE ps.idpredial = a.id ) servicios,   a.numero_inmueble 
        from uf_predial   a 
        left join datm_usuario b on a.idusuario = b.id  
        where  a.estado_ and  a.numero_inmueble = '$numero_inmueble' order by a.id desc "; */

$query = "select 
        a.id,
        x.detalle ,x.idprepredial, 
        b.grupo,   
        d.operativo, 
        c.usuario,
            a.nombre_razon, 
            a.nombre_apoderado, 
            a.contacto_titular, 
            a.contacto_apoderado,
            trim(a.ubicacion_nivel1||' '||a.ubicacion_nivel2 ||' '||a.ubicacion_nivel3 ||' '||a.descripcion||' #'||a.no_puerta) as direccion, 
            a.codigo_catastral,  
            a.no_formulario, 
            a.via as dato_tecnico_via, 
            CASE 
            WHEN ( 
            SELECT string_agg(s.servicio, ', ')  
            FROM uf_predrial_servicio ps 
            JOIN uf_servicios s ON ps.idservicio = s.idservicio 
            WHERE ps.idpredial = a.id 
            ) IN ( 
            'LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO', 
            'TODOS, LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO' 
            )
            THEN 'TODOS'
            ELSE (
            SELECT string_agg(s.servicio, ', ') 
            FROM uf_predrial_servicio ps
            JOIN uf_servicios s ON ps.idservicio = s.idservicio
            WHERE ps.idpredial = a.id
            )
        END AS dato_tecnico_servicio,
            a.tipologia as dato_tecnico_tipologia,
            a.no_plantas as construccion_plantas,
            a.no_concluidos as construccion_concluidas,
            a.no_brutos as construccion_construccion,
            'https://datm.elalto.gob.bo/pages/ufPredialList.php?i='||a.numero_inmueble as enlace,
            a.numero_inmueble,
            a.descripcion,
            a.cant_act,
            a.descripcion_act,
            a.hhrr,
            to_char( a.fecha_apersonamiento, 'DD/MM/YYYY') AS fecha_apersonamiento ,
            a.imagen_principal,
            a.imagen_adicional,
            a.latitud, a.longitud,
            d.idoperativo, a.clasificacion

        from uf_predial a 
        left join uf_operativo d on d.fecha_operativo::DATE = a.fecha_apersonamiento::DATE
        left join uf_grupo_operativo b on a.idusuario = b.idusuario and d.idoperativo = b.idoperativo  
        left join datm_usuario c on c.id = b.idusuario
        
        LEFT JOIN uf_prepredial x ON x.idpredial_asociado = a.id   
        
        
        where  a.estado_    
        
        and a.numero_inmueble like '$numero_inmueble' 
        
        order by id desc; ";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
print_r(json_encode($result));

<?php 


/* "AdjuntoNombre": ,
"AutoridadCargo": ,
"AutoridadSolicitante": ,
"CodigoSolicitud": "1009",
"DetalleCantidad": 2,
"Entidad":"G08",
"FechaEnvio": "20241203135125",
"Gerencia": "Direcci\u00f3n de Administraci\u00f3n Tributaria Municipal de El Alto",
"idSolicitud": 15,
"TipoProceso": "R",

"HashDatos": "aa7ac3286a2a3e55eaa28e7df98d7ee532c9015d",
"HashImagen": "a3a81a12cec56b813c89c80f851fedba60672cd8",
"Usuario": "DIRECCION", 


DIRECTOR DE ADMINISTRACION TRIBUTARIA MUNICIPAL DE EL ALTOCESAR ROJAS VALERO1011G0820241203161601Dirección de Administración Tributaria Municipal de El Alto17R

562a90d8588660eb50cf09f0dc8a59644e0ae8f9



tring texto = string.Empty; 
texto = string.Concat(
            string.IsNullOrEmpty(cabecera.AdjuntoNombre) ? string.Empty : cabecera.AdjuntoNombre,
            string.IsNullOrEmpty(cabecera.AutoridadCargo) ? string.Empty : cabecera.AutoridadCargo,                   
            string.IsNullOrEmpty(cabecera.AutoridadSolicitante) ? string.Empty : cabecera.AutoridadSolicitante,                   
            string.IsNullOrEmpty(cabecera.CodigoSolicitud) ?string.Empty : cabecera.CodigoSolicitud,                   

            cabecera.DetalleCantidad.ToString(CultureInfo.InvariantCulture),

            string.IsNullOrEmpty(cabecera.Entidad) ? string.Empty : cabecera.Entidad,
            string.IsNullOrEmpty(cabecera.FechaEnvio) ? string.Empty: cabecera.FechaEnvio, 
            string.IsNullOrEmpty(cabecera.Gerencia) ? string.Empty : cabecera.Gerencia,                   
            cabecera.IdSolicitud.ToString(CultureInfo.InvariantCulture), 
            string.IsNullOrEmpty(cabecera.TipoProceso) ? string.Empty : cabecera.TipoProceso
        ); 

*/
$cabecera = new stdClass();
$cabecera->adjunto_nombre = "srf_675092f1267e8.pdf";
$cabecera->autoridad_cargo = "DIRECTOR DE ADMINISTRACION TRIBUTARIA MUNICIPAL DE EL ALTO";
$cabecera->autoridad_solicitante = "CESAR ROJAS VALERO";
$cabecera->codigo_solicitud = "1016";
$cabecera->detalle_cantidad = "1";
$cabecera->entidad = "G08";
$cabecera->fecha_envio_ansi = "20241204133449";
$cabecera->gerencia = "Dirección de Administración Tributaria Municipal de El Alto";
$cabecera->IdSolicitud = 22;
$cabecera->tipo_proceso = "R";

$texto = '';
$texto .= !empty($cabecera->adjunto_nombre) ? $cabecera->adjunto_nombre : '';
$texto .= !empty($cabecera->autoridad_cargo) ? $cabecera->autoridad_cargo : '';
$texto .= !empty($cabecera->autoridad_solicitante) ? $cabecera->autoridad_solicitante : '';
$texto .= !empty($cabecera->codigo_solicitud) ? $cabecera->codigo_solicitud : '';
$texto .= !empty($cabecera->detalle_cantidad) ? $cabecera->detalle_cantidad : '';
$texto .= !empty($cabecera->entidad) ? $cabecera->entidad : '';
$texto .= !empty($cabecera->fecha_envio_ansi) ? $cabecera->fecha_envio_ansi : '';
$texto .= !empty($cabecera->gerencia) ? $cabecera->gerencia : ''; 
$texto .= !empty($cabecera->IdSolicitud) ? $cabecera->IdSolicitud : ''; 
$texto .= !empty($cabecera->tipo_proceso) ? $cabecera->tipo_proceso : '';
$cabecera->hash_datos = sha1($texto); 

echo "<br>".$cabecera->hash_datos."<br>====================================================<br>";

?>
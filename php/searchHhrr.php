<?php
session_start();

require_once("../conexionmysql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

// la idea a futuro es poder dividir en un array los tipos de operaciones, nombre de funcioario y area que esta atendiendo
$operaciones_ = [
    'PROCESANDO SOLICITUD ',            
    'ASIGNADO A ',                      
    'DESARCHIVADO Y PROCESANDO ',       
    'ARCHIVADO POR '                    
];

$rs = array();
try {

    $query = "select * from hoja_ruta where cod_hoja_ruta like 'DATM/$nrohhrr/$gestion'; ";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        // Salida de datos de cada fila
        while ($row = $result->fetch_assoc()) {
            $documento = ($_SESSION['idusuario'] > 0 ? "<br>Documento: " . $row["documento"] . "" : "");
            $aux_ = '';
            $auxProceso =  $row["estado"];
            $auxFuncionario = '';
            $auxArea = '';
            if ($row["rubro"] != 'S/R') {
                $aux_ = '<tr>
                        <td><img src="../img/consulta_tramite/user.svg" style="max-width:2.5rem;" ></td>
                        <td> <b>REGISTRO TRIBUTARIO:</b></td>
                        <td class="text-muted" id="destinatario">' . $row["rubro"] . ': ' . $row["registro_tributario"] . $documento . '</td>
                    </tr>';
            }
            /* if (strpos($row["estado"], 'HOJA DE RUTA ANEXADO A LA HOJA DE RUTA PRINCIPAL') !== false) {
                $auxProceso  = $row["estado"];
            } else {

                $operaciones_; 
                
                foreach ($operaciones_ as $operation) {
                    $input = str_replace($operation, '', $auxProceso);
                } 

                $row["estado"];
                $auxProceso = $row["estado"];
                $auxFuncionario = $row["rubro"];
                $auxArea = $row["rubro"];
            } */

            $rs['contenido'] = ' 
                <div style="text-align:center;" style="max-width:2rem;"><h5>RESULTADO DE BUSQUEDA</h5></div>
                <div class="table-responsive"> 
                    <table class="table table-vcenter card-table custom-table"> 
                        <tbody>
                            <tr>
                                <td><img src="../img/consulta_tramite/folder.svg" style="max-width:2.5rem;"></td>
                                <td > <b>HHRR:</b></td>
                                <td class="text-muted" id="nro_dtm">' . $row["cod_hoja_ruta"] . '</td>
                            </tr>
                            <tr>
                                <td><img src="../img/consulta_tramite/documento.svg" style="max-width:2.5rem;"></td>
                                <td > <b>FECHA DE INICIO:</b></td>
                                <td class="text-muted" id="uni_ejec">' . $row["fecha_creacion"] . ' ' . $row["hora"] . '</td>
                            </tr>
                            ' . $aux_ . '
                            <tr>
                                <td><img src="../img/consulta_tramite/documento_rojo.svg"style="max-width:2.5rem;" ></td>
                                <td > <b>REFERENCIA:</b></td>
                                <td class="text-muted" id="referencia">' . $row["referencia"] . '</td>
                            </tr>
                            <tr>
                                <td><img src="../img/consulta_tramite/proceso.svg"style="max-width:2.5rem;" > </td>
                                <td > <b>ESTADO:</b></td>
                                <td class="text-muted" id="estado">' . $row["estado"] . '</td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            ';
            $rs['color_'] = 'green';
            $rs['titulo_'] = "Hoja de ruta <b>DATM/$nrohhrr/$gestion</b>";
        }
    } else {
        $rs['titulo_'] = 'Sin resultados';
        $rs['color_'] = 'red';
        $rs['contenido'] =  "La hoja de ruta <b>DATM/$nrohhrr/$gestion</b> no se encuentra registrada.";
    }
} catch (Exception $th) {
    $rs['titulo_'] = 'Ups...';
    $rs['color_'] = 'red';
    $rs['contenido'] = "Hay mucho trafico en este momento, intentalo más tarde por favor";
}
$dat = json_encode($rs);
echo $dat;

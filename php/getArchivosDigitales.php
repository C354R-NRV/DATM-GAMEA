<?php
// getArchivosDigitales.php
// Recibe POST 'inmueble' y devuelve un fragmento HTML con la lista de archivos

$numero_inmueble = isset($_POST['inmueble']) ? trim($_POST['inmueble']) : '';
$directorio = '/mnt/scanner_datm/2_INMUEBLES';

if ($numero_inmueble === '') {
    echo "<div style='color:red'>Falta el número de inmueble.</div>";
    exit;
}

if (!is_dir($directorio) || !is_readable($directorio)) {
    echo "<div style='color:red'>No se puede acceder a la carpeta compartida.</div>";
    exit;
}

$patron = $directorio . '/' . $numero_inmueble . '*';
$archivos = glob($patron);

if ($archivos === false) {
    echo "<div style='color:red'>Error al leer los archivos.</div>";
    exit;
}

usort($archivos, function ($a, $b) {
    return filemtime($b) - filemtime($a);
});

if (count($archivos) === 0) {
    echo "<div style='color:gray'>No se encontraron documentos digitales para <b>" . htmlspecialchars($numero_inmueble) . "</b>.</div>";
    exit;
}

// Estilos inline mínimos (porque va a ir dentro de un modal)
?>
<style>
    .file-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .file-list li {
        padding: 6px 8px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .file-list li:hover {
        background: #f5f5f5;
    }

    .file-name {
        font-size: 14px;
        font-weight: 500;
    }

    .file-meta {
        font-size: 12px;
        color: #666;
    }

    .download-btn {
        padding: 4px 8px;
        background: #28a745;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 12px;
    }

    .download-btn:hover {
        background: #10451c;
        color: white;
    }
</style>

<ul class="file-list">
    <?php foreach ($archivos as $archivo_full):
        $basename = basename($archivo_full);
        if (strpos($basename, $numero_inmueble) !== 0) continue;

        $sizeKB = is_file($archivo_full) ? round(filesize($archivo_full) / 1024, 2) . ' KB' : '—';
        $mtime  = is_file($archivo_full) ? date("Y-m-d H:i", filemtime($archivo_full)) : '—';
        $link   = 'downloadArchivoInmueble.php?file=' . rawurlencode($basename) . "&i=";
    ?>
        <li>
            <div>
                <div class="file-name"><?= htmlspecialchars($basename) ?></div>
                <div class="file-meta"><?= $mtime ?> · <?= $sizeKB ?></div>
            </div>
            <div>
                <a class="download-btn" href="<?= $link ?>" target="_blank">Descargar</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
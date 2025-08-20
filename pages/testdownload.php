<?php
$filepath = '/mnt/scanner_datm/2_INMUEBLES/1510133909_20250812_00001.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="1510133909_20250812_00001.pdf"');
header('Content-Length: ' . filesize($filepath));
readfile($filepath);
exit;
<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data: chart updated at: {$time}\n\n";
flush();
?>
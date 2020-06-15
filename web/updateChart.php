<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

while ( true) {
    $time = date('r');
    echo "data: ping at: {$time}\n\n";
    flush();

    sleep(10);

}

?>
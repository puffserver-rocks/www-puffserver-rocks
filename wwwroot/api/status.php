<?php
header('Content-Type: application/json');

function checkSource($host, $port, $timeout = 1) {
    $fp = @fsockopen("udp://$host", $port, $errno, $errstr, $timeout);
    if (!$fp) return false;

    stream_set_timeout($fp, $timeout);
    fwrite($fp, "\xFF\xFF\xFF\xFFTSource Engine Query\x00");
    $response = fread($fp, 4096);
    fclose($fp);

    return !empty($response);
}

$servers = [
  "cs2" => checkSource("puffserver.rocks", 27015),
  "surf" => checkSource("csgo.surf", 27015),
  "scouts" => checkSource("scoutsknives.club", 27015)
];

echo json_encode($servers);

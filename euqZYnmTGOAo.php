<?php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL,"es_MX");
	$conn = mysqli_connect("localhost", "root", "", "gpoptima");
    //$cone = mysqli_connect("localhost", "ale005publik", "1Faby19951995.2020.", "publik");
    //$conn = mysqli_connect("db5004895068.hosting-data.io", "dbu2782311", "1Faby19951995.2021.", "dbs4101035");
    function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
}
?>
<?php
function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    $R = 6371000; // Radius bumi dalam meter
    // Konversi derajat ke radian
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);
    // Selisih latitude dan longitude
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    // Haversine formula
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    // Jarak dalam meter
    $distance = $R * $c;
    // Bulatkan ke angka genap terdekat
    $distance = round($distance / 2) * 2;
    return $distance;
}
$latitude_berangkat = '-6.9796191';
$longitude_berangkat = '107.6308668';
$latitude_tujuan = '-6.9322942';
$longitude_tujuan = '107.7758373';
$jarak = haversineDistance($latitude_berangkat, $longitude_berangkat, $latitude_tujuan, $longitude_tujuan);
echo $jarak.' meter';
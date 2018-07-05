<?php
//Calcular com a lei dos cossenos
function calc_distance($lat1, $lng1, $lat2, $lng2) {

  //Diferença entra as longitudes
  $theta = $lng1 - $lng2;

  //Pegando os radianos
  $rad_lat_1 = deg2rad($lat1);
  $rad_lat_2 = deg2rad($lat2);
  $rad_lng = deg2rad($theta);

  //Pegando os senos
  $sen_lat_1 = sin($rad_lat_1);
  $sen_lat_2 = sin($rad_lat_2);

  //Pegando os cossenos
  $cos_lat_1 = cos($rad_lat_1);
  $cos_lat_2 = cos($rad_lat_2);
  $cos_lng = cos($rad_lng);

  //alpha = sin1 * sin2 + cos1 + cos2  * cos theta (em radianos)
  $distance = $sen_lat_1 * $sen_lat_2 + $cos_lat_1 * $cos_lat_2 * $cos_lng;

  //Inverte  o valor (reverte o cos)
  $distance_rev = acos($distance);

  //converte a reversao para radianos do cosseno em graus
  $true_distance = rad2deg($distance_rev);

  //segundos
  $seg = $true_distance * 60;
  //milhas
  $miles = $seg * 1.1515;

  //Convertendo milhas em km depois metros
  return ($miles * 1.609344) * 1000;
}

//Ponto de partida
$point = ["-25.5362915","-49.2725592"];

//Coordenadas ao redor
$coords = [
  "-25.4386762" => "-49.2948674",
  "-25.4983061" => "-49.2678641",
  "-25.4371314" => "-49.3065065",
  "-25.415213"  => "-49.214332",
  "-25.4299542" => "-49.2651058",
  "-25.4665944" => "-49.2804113",
  "-25.4236728" => "-49.24240880000001",
  "-25.4345567" => "-49.3022224",
  "-25.504898"  => "-49.232986",
  "-25.4171615" => "-49.34963860000001",
  "-25.467903"  => "-49.28113399999999"
];
//Distancia máxima
$max_distance_metters = 10000;
$rs = [];

foreach ($coords as $lat => $lng) {
  $distance = calc_distance($lat, $lng, $point[0], $point[1]);
  if($distance <= $max_distance_metters){
    $rs['dentro-do-raio'][] = $distance;
  }else{
    $rs['fora-do-raio'][] = $distance;
  }
}

print_r($rs);

//https://paginas.fe.up.pt/~ee99067/docs/Distancias.pdf

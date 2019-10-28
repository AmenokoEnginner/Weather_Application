<?php
// $id = 地域id
function json($id)
{
  $url = 'http://weather.livedoor.com/forecast/webservice/json/v1?city=' . $id;
  $json = file_get_contents($url);
  $json = mb_convert_encoding($json, 'UTF-8');
  return json_decode($json, true);
}

function forecast($id)
{
  $json = json($id);
  return [
    'city'           => $json['location']['city'],
    'weather'        => $json['forecasts'][1]['telop'],
    'maxTemperature' => $json['forecasts'][1]['temperature']['max']['celsius'],
    'minTemperature' => $json['forecasts'][1]['temperature']['min']['celsius']
  ];
}

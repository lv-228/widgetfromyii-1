<?php

namespace app\components;
use Yii;

use yii\base\Widget;
use yii\helpers\Html;

class OpenWeatherWidget extends Widget
{
	public $map_json;
	public $coords = [];
	public $appid = "string";
	public $weather = [];
	public $test = "string";
	public $days = [];
	public $keys = [];
	public $weekday;
	public $pic_day1th;
	public $minmax;

	//Парсит $route['map_json'] так как json не валидный
	public function getCoordFromRouteVarInView()
	{
		if(json_decode($this->map_json,true)["v"] == 2){
			$coord['lat'] = round(json_decode($this->map_json,true)["route"][0]["ll"][0],5);
			$coord['lon'] = round(json_decode($this->map_json,true)["route"][0]["ll"][1],5);
			return $coord;
		}
		else {
			$coord['lat'] = substr($this->map_json,11,8);
			$coord['lon'] = substr($this->map_json,20,8);
			return $coord;
		}
		
	}

	public function getWeatherByCoord()
	{
		//$key = 'weather_lat_'.$this->coords['lat'].'_lng_'.$this->coords['lon'];
		$request_params = 
    		[
    			'lat' => $this->coords['lat'],
    			'lon' => $this->coords['lon'],
    			'lang' => 'ru',
    			'units' => 'metric',
    			'appid' => $this->appid
    		];
    	$result['five_days'] = json_decode(file_get_contents( 'http://api.openweathermap.org/data/2.5/forecast?' . http_build_query($request_params)),true);
    	$result['one_day'] = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?' . http_build_query($request_params)),true);
    	return $result;
	}

	public function getMonth($str)
	{
		if($str[0] == 0){
			switch ($str[1]) {
			case 9:
				return 'Сен';
			case 8:
				return 'Авг';
			case 7:
				return 'Июл';
			case 6:
				return 'Июн';
			case 5:
				return 'Май';
			case 4:
				return 'Апр';
			case 3:
				return 'Мар';
			case 2:
				return 'Фев';
			case 1:
				return 'Янв';
		}
		}
		else{
			switch ($str[1]) {
				case 0:
					# code...
					return 'Окт';
				case 1:
					return 'Ноя';
				case 2:
					return 'Дек';
			}
		}

	}

	public function convertDeg($response,$keys)
	{
                    if($response[0]['five_days']['list'][$keys]['wind']['deg'] == 0)
                        $wind_direction = "<font>↑</font>С";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] == 90)
                        $wind_direction = "<font>→</font>В";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] == 180)
                        $wind_direction = "<font>↓</font>Ю";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] == 270)
                        $wind_direction = "<font>←</font>З";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] > 0 && $response[0]['five_days']['list'][$keys]['wind']['deg'] < 90)
                        $wind_direction = "<font>↗</font> С-B";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] > 90 && $response[0]['five_days']['list'][$keys]['wind']['deg'] < 180)
                        $wind_direction = "<font>↘</font>Ю-В";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] > 180 && $response[0]['five_days']['list'][$keys]['wind']['deg'] < 270)
                        $wind_direction = "<font>↙</font>Ю-З";
                    elseif($response[0]['five_days']['list'][$keys]['wind']['deg'] > 270)
                        $wind_direction = "<font>↖</font>С-З";
        return $wind_direction;

	}

	public function getMinMax($key1,$key2,$req)
	{
		$min = 100;
		$max = 0;
		for($i = $key1; $i < $key2; $i++){
			if($min > (int)$req[$i]['main']['temp'])
				$min = (int)$req[$i]['main']['temp'];
			if($max < (int)$req[$i]['main']['temp'])
				$max = (int)$req[$i]['main']['temp'];
		}
		$res[0] = $min;
		$res[1] = $max;
		$min = 100;
		$max = 0;
		for($i = $key2; $i < $key2 + 8; $i++){
			if($min > (int)$req[$i]['main']['temp'])
				$min = (int)$req[$i]['main']['temp'];
			if($max < (int)$req[$i]['main']['temp'])
				$max = (int)$req[$i]['main']['temp'];
		}
		$res[2] = $min;
		$res[3] = $max;
		$min = 100;
		$max = 0;
		for($i = $key2 + 8; $i < $key2 + 16; $i++){
			if($min > (int)$req[$i]['main']['temp'])
				$min = (int)$req[$i]['main']['temp'];
			if($max < (int)$req[$i]['main']['temp'])
				$max = (int)$req[$i]['main']['temp'];
		}
		$res[4] = $min;
		$res[5] = $max;
		$min = 100;
		$max = 0;
		for($i = $key2 + 16; $i < $key2 + 24; $i++){
			if($min > (int)$req[$i]['main']['temp'])
				$min = (int)$req[$i]['main']['temp'];
			if($max < (int)$req[$i]['main']['temp'])
				$max = (int)$req[$i]['main']['temp'];
		}
		$res[6] = $min;
		$res[7] = $max;
		$min = 100;
		$max = 0;
		return $res;
	}

	public function getDay($getdate)
	{
			$days['Monday'] = 'Пн';
			$days['Tuesday'] = 'Вт';
			$days['Wednesday'] = 'Ср';
			$days['Thursday'] = 'Чт';
			$days['Friday'] = 'Пт';
			$days['Saturday'] = 'Сб';
			$days['Sunday'] = 'Вс';
			while (key($days) != $getdate['weekday']) {
				next($days);
			}
			$res[0] = current($days);
			$res[1] = key($days) == 'Sunday' ? reset($days) : next($days);
			$res[2] = key($days) == 'Sunday' ? reset($days) : next($days);
			$res[3] = key($days) == 'Sunday' ? reset($days) : next($days);
			return $res;
	}

    public function init()
    {
    	parent::init();
    	$this->coords = $this->getCoordFromRouteVarInView();
    	$this->weather = $this->getWeatherByCoord();
    }

    public function run()
    {
    	$response = $this->coords;
    	$response[] = $this->weather;
		$days = array_column($response[0]['five_days']['list'], 'dt_txt');
    	for($i = 0; $i < count($days); $i++){
        	$days[$i] = substr($days[$i],5,5);
    	}
    	sort($days,SORT_STRING);
    	$days = array_unique($days);
    	$keys = array_keys($days);
    	$weekday = $this->getDay(getdate());
    	$pic_day1th = $response[0]['five_days']['list'][$keys[0]+2]['weather'][0]['icon'].".png" == NULL ? $response[0]['five_days']['list'][$keys[0]+3]['weather'][0]['icon'].".png" ?? $response[0]['five_days']['list'][$keys[0]+4]['weather'][0]['icon'].".png" ?? $response[0]['five_days']['list'][$keys[0]+5]['weather'][0]['icon'].".png" : $response[0]['five_days']['list'][$keys[0]+2]['weather'][0]['icon'].".png";
    	$minmax = $this->getMinMax($keys[0],$keys[1],$response[0]['five_days']['list']);
    	return $this->render('_openWeather', 
    		[
    			"response" => $response,
    			"coords" => $coords,
    			"weather" => $weather,
    			"days" => $days,
    			"keys" => $keys,
    			"weekday" => $weekday,
    			"pic_day1th" => $pic_day1th,
    			"minmax" => $minmax
    		]
    	);
    }
}
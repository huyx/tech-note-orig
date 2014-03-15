<?php
/*
返回坐标点在那个省：

用法: ?lnglats=<lnglat>[&nocache=y]

其中：
  * lnglat: lng, lat
  * nocache: 可以是 y，表示是否使用缓存

示例：
  * http://42.121.107.99/api/province.php?lnglat=113.01,34.01
  * http://42.121.107.99/api/province.php?lnglat=113.01,34.01&nocache=y
*/
header("Content-Type: text/plain");

require '/var/www/lib/predis/autoload.php';

$lnglat = $_REQUEST['lnglat'];
$nocache = isset($_REQUEST['nocache']) && $_REQUEST['nocache'] && $_REQUEST['nocache'] == 'y';

function redis() {
    global $from, $to;

	$redis_server = array(
		'scheme' => 'tcp',
		'host'   => '127.0.0.1',
		'port'   => '16370',
	);

	$options = array(
		'prefix' => 'province:'
	);

	return new Predis\Client($redis_server, $options);
}

function province($lng, $lat) {
    global $nocache;
    $redis = redis();
	if(!$nocache) {
		$r = $redis->hget($lng, $lat);
		if($r) {
			$redis->hincrby("stat", "hit", 1);
			return $r;
		}
	}
	$redis->hincrby("stat", "miss", 1);
	$url = "http://api.map.baidu.com/geocoder?location=$lat,$lng&output=json";
	$s = file_get_contents($url);
	$r = json_decode($s, true);
	if($r['status'] == 'OK') {
		$province = $r['result']['addressComponent']['province'];
		if(strlen($province))
		    $redis->hset($lng, $lat, $province);
		return $province;
	} else {
		$redis->hincrby("stat", "error", 1);
		return "error: $r[status]";
	}
}

list($lng, $lat) = explode(',', $lnglat);
$lng = sprintf("%.2f", floatval($lng));
$lat = sprintf("%.2f", floatval($lat));

echo province($lng, $lat);
?>

<?php
/*
百度坐标转换：

用法: ?lnglats=<lnglats>[&nocache=y][&invert=y][&from=0][&to=4]

说明：
  * 好像是只支持 from=0&to=4 和 from=2和to=4

其中：
  * lnglats: lng1,lat1;lng2,lat2;lng3,lat3...
  * nocache: 可以是 y，表示是否使用缓存
  * invert: 是否反向变换（不精确）
  * from: 源坐标类型，缺省为 0
  * to: 目标坐标类型，缺省为 4

坐标类型:
  * 0   GPS坐标
  * 2   谷歌坐标
  * 4   百度坐标

示例：
  * http://42.121.107.99/api/bdmapconv.php?lnglats=113.01,23.01
  * http://42.121.107.99/api/bdmapconv.php?lnglats=113.01,23.01;113.02,23.01&nocache=y
  * http://42.121.107.99/api/bdmapconv.php?lnglats=113.01,23.01;113.02,23.01&from=2
*/
header("Content-Type: text/plain");

require '/var/www/lib/predis/autoload.php';

$lnglats = $_REQUEST['lnglats'];
$nocache = isset($_REQUEST['nocache']) && $_REQUEST['nocache'] && $_REQUEST['nocache'] == 'y';
$invert = isset($_REQUEST['invert']) && $_REQUEST['invert'] && $_REQUEST['invert'] == 'y';
$from = isset($_REQUEST['from'])? $_REQUEST['from']:'0';
$to = isset($_REQUEST['to'])? $_REQUEST['to']:'4';

function redis() {
    global $from, $to;

    $redis_server = array(
        'scheme' => 'tcp',
        'host'   => '127.0.0.1',
        'port'   => '16370',
    );

    $options = array(
        'prefix' => ($from=='0' && $to=='4')? 'bdmc:':"bdmc:$from>$to:",
    );

    return new Predis\Client($redis_server, $options);
}

function convert($lng, $lat) {
    global $nocache, $from, $to;
    $redis = redis();
    if(!$nocache) {
        $r = $redis->hget($lng, $lat);
        if($r) {
            $redis->hincrby("stat", "hit", 1);
            return $r;
        }
    }
    $redis->hincrby("stat", "miss", 1);
    $s = file_get_contents("http://api.map.baidu.com/ag/coord/convert?from=$from&to=$to&mode=1&x=$lng&y=$lat");
    foreach(json_decode($s, true) as $r) {
        if($r['error'] == 0) {
            $x = base64_decode($r['x']);
            $y = base64_decode($r['y']);
            $s = sprintf("%.6f,%.6f", floatval($x), floatval($y));
            $redis->hset($lng, $lat, $s);
            return $s;
        } else {
            $redis->hincrby("stat", "error", 1);
            return "error: $r[error]";
        }
    }
}

function invert($v1, $v2) {
    return 2 * $v1 - $v2;
}

$result = array();

foreach(explode(';', $lnglats) as $lnglat) {
    list($lng, $lat) = explode(',', $lnglat);
    list($lng, $lat) = array(floatval($lng), floatval($lat));
    list($lng2, $lat2) = array(round($lng, 2), round($lat, 2));
    list($dlng, $dlat) = array($lng-$lng2, $lat-$lat2);
    $r = convert($lng2, $lat2);
    if($r[0] >= '0' && $r[0] <= '9') {
        list($offs_lng, $offs_lat) = explode(",", $r);
        if($invert) {
            $r = sprintf("%.6f,%.6f", invert($lng, $dlng+floatval($offs_lng)), invert($lat, $dlat+floatval($offs_lat)));
        } else {
            $r = sprintf("%.6f,%.6f", $dlng+floatval($offs_lng), $dlat+floatval($offs_lat));
        }
    }
    $result[] = $r;
}

echo implode("\n", $result);
?>

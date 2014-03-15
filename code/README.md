## 概述

- WGS-84   人类坐标
- GCJ-02   火星坐标系，国家保密插件
- BD-09    百度坐标

## 网络地图 API

- GOOGLE 地理信息查询：http://api.map.baidu.com/geocoder?location=34.12121,113.12121&output=json，可以返回地址、行政区域等信息
- 百度坐标转换：http://api.map.baidu.com/ag/coord/convert?from=0&to=4&mode=1&x=113.12121&y=34.12121，支持 WGS-84 坐标到百度坐标

## 算法

- 百度坐标 <==> 火星坐标：
  - bdmap_crypt.c
- GPS ==> 火星坐标
  - wgs84_to_gcj02.py
  - wgs84_to_gcj02.cs
- 距离
  - wgs84_distance.py

## 其他

- bdmap_conv.php（废弃）: WGS-84 到百度转换，支持 Redis 缓存
- google_province.php: 判断点所在省份并缓存

# -*- coding: utf-8 -*-
"""百度 API 转换

接口：http://api.map.baidu.com/ag/coord/convert?from=0&to=4&mode=1&x=113.12121&y=34.12121
返回：[{"error":0,"x":"MTEzLjEzNDE3NTM4OTM0","y":"MzQuMTI1OTQyOTM4Mjg2"}]

from, to 是坐标类型:

  * 0   GPS坐标
  * 2   谷歌坐标
  * 4   百度坐标

说明：

  * 好像是只支持 from=0&to=4 和 from=2和to=4
"""
import json
import urllib2

def convert(lat, lng):
    url = 'http://api.map.baidu.com/ag/coord/convert?from=0&to=4&mode=1&x=%s&y=%s' % (lng, lat)
    for result in json.loads(urllib2.urlopen(url).read()):
        print result['y'].decode('base64'), result['x'].decode('base64')

convert(34.127064, 113.127771)

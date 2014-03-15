# -*- coding: utf-8 -*-
from math import pi, sin, cos, acos

EARTH_RADIUS = 6378137

PI_180 = pi / 180

def distance(la1, lo1, la2, lo2):
    """计算两点之间的距离

    :param la1, lo1: 第一个点的纬度、经度
    :param la2, lo2: 第二个点的纬度、经度

    参考:
    * http://www.geodatasource.com/developers/c
    * http://boulter.com/gps/distance/
    """
    la1 = la1 * PI_180
    la2 = la2 * PI_180

    theta = (lo1 - lo2) * PI_180
    dist = sin(la1) * sin(la2) + cos(la1) * cos(la2) * cos(theta)
    dist = acos(dist)

    return dist * EARTH_RADIUS

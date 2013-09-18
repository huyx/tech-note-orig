日期时间处理
============

### TIPS ###

#### 如何知道一个月有多少天 ####

	>>> import calendar
	>>> calendar.monthrange(2013, 9)[1]
	30

#### 如何知道某年是否闰年 ####

	>>> import calendar
	>>> calendar.isleap(2013)
	False

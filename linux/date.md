date
====

一般应用
--------

显示秒数:

	date +"%s"

配合 for 循环:

	#!/bin/bash
	for i in {1..10}
	do
	   date --date="-$i days ago"
	done

高级应用
--------

计算时间差:

	#!/bin/bash
	START=$(date +%s)
	# working ...
	END=$(date +%s)
	DIFF=$(( $END - $START ))
	echo "It took $DIFF seconds"

强悍的工具
----------

只给几个例子，详细可以查看参考文档。

未来：

	date --date='tomorrow'
	date --date='1 hour'
	date --date='1 hours'
	date --date='1 day'
	date --date='10 day'
	date --date='10 week'
	date --date='10 month'
	date --date='10 year'

过去：

	date --date='yesterday'
	date --date='1 day ago'
	date --date='10 day ago'
	date --date='10 week ago'
	date --date='10 month ago'
	date --date='10 year ago'

还有：

	date --date='fortnight'		# fortnight = 14 天
	date --date='5 fortnight'
	date --date='fortnight ago'
	date --date='5 fortnight ago'
	date --date='2 hour'
	date --date='2 hour ago'
	date --date='20 minute'
	date --date='20 minute ago'

还认识星期几？

	date --date='this Friday'
	## OR ##
	date --date='next Friday'
	## OR ##
	date --date='this Fri'
	## OR ##
	date --date='next Fri.'

还有！

	date --date='2 Fri'
	## OR ## 
	date --date='second Fri.'
	## OR ## 
	date --date='Second Friday'

参考
----

- [date invocation - GNU Coreutils](http://www.gnu.org/software/coreutils/manual/html_node/date-invocation.html#date-invocation)
- [Getting Yesterdays or Tomorrows Day With Bash Shell Date Command](http://www.cyberciti.biz/tips/linux-unix-get-yesterdays-tomorrows-date.html)

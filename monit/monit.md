# Monit

## 安装 monit

	$ sudo apt-get install monit

### 配置

/etc/default/monit

	startup=1

/etc/monit/monitrc

	set daemon  30           # check services at 2-minute intervals
	    with start delay 20  # optional: delay the first check by 4-minutes
	set logfile /var/log/monit.log
	set httpd port 2812 and
	    allow admin:monit
	include /etc/monit/conf.d/*.conf

/etc/monit/conf.d/mysvc.conf

	check process mysvc1
		with pidfile "/home/me/mysvc/var/run/mysvc1.pid"
		start program = "/home/me/mysvc/service start mysvc1"
		stop program = "/home/me/mysvc/service stop mysvc1"
		if cpu > 20% for 2 cycles then restart
		group mysvc

	check process mysvc2
		with pidfile "/home/me/mysvc/var/run/mysvc2.pid"
		start program = "/home/me/mysvc/service start mysvc2"
		stop program = "/home/me/mysvc/service stop mysvc2"
		if cpu > 20% for 2 cycles then restart
		group mysvc

### 常用操作

	$ sudo monit
	$ sudo monit –h
	$ sudo monit reload
	$ sudo monit start <name>
	$ sudo monit restart <name>

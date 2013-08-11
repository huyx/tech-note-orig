Zabbix
======

* [手册](http://www.zabbix.com/documentation/2.2/manual)
* [配置项参考](https://www.zabbix.com/documentation/1.8/manual/config/items)

安装
----

**下载解压**

	tar xzvf ....
    cd zabbix...

**添加用户和组**

    sudo useradd zabbix

**安装支持包**

    sudo apt-get install libmysqlclient-dev 
    sudo apt-get install libcurl4-openssl-dev
    sudo apt-get install libsnmp-dev
    sudo apt-get install libssh2-1-dev

**安装数据库**

    cd database/mysql
    mysql> create database zabbix
    mysql -uroot zabbix < schema.sql
    mysql -uroot zabbix < images.sql 
    mysql -uroot zabbix < data.sql 

**源代码配置、编译、安装**

    ./configure --enable-server --enable-agent --enable-proxy --with-net-snmp --with-ssh2 --with-mysql --with-libcurl

	./configure --enable-agent 

	make

    sudo make install

其中：

* `-with-libcurl`  --  Web 监控需要 libcurl

**配置 zabbix_server**

    sudo vi /usr/local/etc/zabbix_server.conf
        DBPassword=<...>
        DBSocket=/var/run/mysqld/mysqld.sock 

**运行 zabbix_server**

**安装php前端**

    sudo cp -a frontends/php/ /var/www/zabbix
    http://<...>/zabbix/
    sudo vi /etc/php5/apache2/php.ini
        ... date.timezone = Asia/Shanghai

**登录**

* 缺省用户: `Admin/zabbix`
* 中文界面: `/Profile/User/Language`

如果 Chinese(zh_CN) 是灰的

	locale -a | grep zh_CN
	    结果应该是空的
	sudo locale-gen zh_CN.UTF-8
	sudo service apache2 restart

中文本地化文件目录

    /var/www/zabbix/locale/zh_CN/LC_MESSAGES

TODO

* 修改翻译文件后如何编译？

**程序**

	zabbix_server
	zabbix_agent
	zabbix_agentd

	zabbix_get
    zabbix_get -s 192.168.0.101 -p 10050 -k mysql.status[Questions]
    zabbix_sender

配置
----

### 监控MySQL ###

**/usr/local/etc/zabbix_agentd.conf**

	# 包括配置目录
    Include=/usr/local/etc/zabbix_agentd.conf.d/

**/usr/local/etc/zabbix_agentd.conf.d/mysql.conf**

    ### Set of parameters for monitoring MySQL server (v3.23.42 and later)
	### Change -u and add -p if required
	UserParameter=mysql.ping,mysqladmin -uroot -p<xxxxx> ping | grep -c alive
	UserParameter=mysql.version,mysql -V
	UserParameter=mysql.status[*],echo "SHOW GLOBAL STATUS WHERE Variable_name='$1';" | mysql -N -uroot -p<xxxxx> | awk '{print $$2}'

**注意指定密码时 -p 后不要有空格**

    mysql -uroot -p123456
    mysql -uroot -p 123456		# 错误

**agent 上测试**

	zabbix_agentd -t mysql.ping
	zabbix_agentd -t mysql.status[Uptime]

**重启 agent 服务**

**server 上测试**

	zabbix_get zabbix_get -s 10.10.10.1 -p 10050 -k "mysql.status[Bytes_received]"

### 设置自动启动 ###

	sudo cp misc/init.d/ubuntu/zabbix-agent.conf /etc/init.d/zabbix-agent
	sudo update-rc.d zabbix-agent defaults

## 问题与解决 ##

### server 日志中出现： /usr/sbin/fping: [2] No such file or directory ###

安装 fping

    sudo apt-get install fping

修改配置文件

    /usr/local/etc/zabbix_server.conf
        FpingLocation=/usr/bin/fping

### 忘记密码怎么办？ ###

- [Reset Recover Zabbix Admin Password](http://www.sysadminwiki.net/site/doku.php/monitoring/zabbix/reset_recover_zabbix_admin_password)

登录 MySQL 后，执行：

    update zabbix.users set passwd=md5('newpass') where alias='Admin';

### 其他 ###

* 密码连续错 5 次会锁定 30 秒
* 查看日志文件: `tail -f /tmp/zabbix_server.log`

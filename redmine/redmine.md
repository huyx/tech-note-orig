Redmine
========

- [项目主页](http://redmine.org/)

安装
----

- [(荐)在 Ubuntu 上安装 Redmine 详解](http://www.redmine.org/projects/redmine/wiki/HowTo_Install_Redmine_on_Ubuntu_step_by_step)

主要步骤:

	$ sudo apt-get install apache2 libapache2-mod-passenger
	$ sudo apt-get install mysql-server mysql-client 
	$ sudo apt-get install redmine redmine-mysql
	$ sudo ln -s /usr/share/redmine/public /var/www/redmine
	
	# 编辑 /etc/apache2/mods-available/passenger.conf, 添加
	  PassengerDefaultUser www-data
	
	# 编辑 /etc/apache2/sites-available/default, 添加
	<Directory /var/www/redmine>
	    RailsBaseURI /redmine
	    PassengerResolveSymlinksInDocumentRoot on
	</Directory>
	$ sudo service apache2 restart

缺省用户名/密码: `admin/admin`

备份
----

备份数据库:

	/usr/bin/mysqldump -u root -p<password> redmine_default | gzip > /path/to/backups/redmine_db_`date +%y_%m_%d`.gz

备份附件:

	rsync -a /var/lib/redmine/default/files /path/to/backups/files

技巧
----

### 修改稿中文翻译 ###

Redmine 已经支持中文，但有时看着会对有些翻译不满意，想做些修改。 Redmine 的翻译保存在 yml 文件中，修改方法如下：

- 找到 `config/locales/zh.yml`
- 找到要修改的信息，修改并保存
- 重启 apache

安装
----

### 安装 MMS Agent

- 登录到 MMS，点击 Settings/Monitoring Agent，然后点击响应的操作系统图标
- 或登录后访问：<https://mms.mongodb.com/settings/monitoring-agent>

### 安装 munin-node

安装  munin-node 后可以在 mms 网站上看到更多服务器系统运行信息。

    sudo apt-get install munin-node

编辑配置文件：

    # /etc/munin/munin-node.conf
    allow ^10\.144\.183\.73$

配置
----

### 配置文件

    # /etc/mongodb-mms/monitoring-agent.config
    mmsApiKey=...
    # globalAuthUsername=yourAdminUser
    # globalAuthPassword=yourAdminPassword

### 权限

如果启用了认证，则需要指定 globalAuthUsername 和 globalAuthPassword，该用户需要拥有下列权限：

- clusterAdmin
- readAnyDatabase

如果启用数据库剖析（DB Profiling），则还需要下列权限：

- dbAdminAnyDatabase 或
- 在要剖析的数据库上的 dbAdmin 角色

参考
----

- [Getting Started with Monitoring](http://mms.mongodb.com/help/monitoring/install/)
- [安装带 C 扩展的 PyMongo](http://mms.mongodb.com/help/monitoring/tutorial/install-pymongo/)

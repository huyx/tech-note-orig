# Zabbix 配置 ssh 代理进行监控 #

参考：

- [SSH checks [Zabbix]](https://www.zabbix.com/documentation/2.0/manual/config/items/itemtypes/ssh_checks)

### 修改配置文件 ###

修改 `/etc/zabbix/zabbix_server.conf`:

    SSHKeyLocation=/home/zabbix/.ssh

### 修改 zabbix home 目录 ###

停止服务, 停止服务后才可以修改 home 目录

	sudo service zabbix-agent stop
	sudo service zabbix-server stop

修改 home 目录 

	usermod -m -d /home/zabbix zabbix

重新启动服务

	sudo service zabbix-agent start
	sudo service zabbix-server start

### 生成密钥 ###

    sudo -u zabbix ssh-keygen -t rsa

### 拷贝公钥到服务器 ###

    sudo -u zabbix ssh-copy-id root@10.10.10.10

如果提示: ERROR: No identities found，试试这个

    sudo -u zabbix ssh-copy-id -i /home/zabbix/.ssh/id_rsa.pub root@10.10.10.10

### 配置 ###

- Authentication method: Public Key
- Public key file: id_rsa.pub
- Private key file: id_rsa
- Executed script: 例如: ps aux | grep httpd | wc -l

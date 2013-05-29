# Redis

* [Redis](http://redis.io/)

## 安装 Redis

### 下载、编译

	$ sudo apt-get install build-essential
	$ wget http://redis.googlecode.com/files/redis-2.4.7.tar.gz
	$ tar xzf redis-2.4.7.tar.gz
	$ cd redis-2.4.7/
	$ make

### 测试（可选）

	$ sudo apt-get install tcl8.5
	$ make test

### 安装服务

	$ cd utils
	$ sudo sh install_server.sh

### 安装 redis-py 

	$ sudo pip install redis

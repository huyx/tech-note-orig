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

## 问题 ##

### BUG: slave+readonly 模式的 redis 服务器不支持 sort ###

sort 指令可以修改数据，但很多时候不修改数据，即使不修改数据服务器也会抱怨不能再只读的服务器上执行该命令，这应该是个 BUG，官方网站上也有人提出来这个，不知道什么时候能修改。

目前的版本 2.6.14 好像还有这个问题。
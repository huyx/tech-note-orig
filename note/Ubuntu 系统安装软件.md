基础准备
--------

    sudo apt-get install python-software-properties

软件包
------

### Node.js

    sudo add-apt-repository ppa:chris-lea/node.js
    sudo apt-get update
    sudo apt-get install g++ make nodejs

### MongoDB

参考: [Install MongoDB on Ubuntu](http://docs.mongodb.org/manual/tutorial/install-mongodb-on-ubuntu/)

    sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
    echo 'deb http://downloads-distro.mongodb.org/repo/ubuntu-upstart dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list
    sudo apt-get update
    # 版本 2.6.1
    sudo apt-get install mongodb-org
    # 安装特定版本
	sudo apt-get install mongodb-org=2.6.1 mongodb-org-server=2.6.1 mongodb-org-shell=2.6.1 mongodb-org-mongos=2.6.1 mongodb-org-tools=2.6.1
    # 版本 2.4.9
    sudo apt-get install mongodb-10gen


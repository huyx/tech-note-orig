Ubuntu 包管理
=============

资源
----

可以先到下面找一找有没有软件包。

- [Lanuchpad](https://launchpad.net/)
- [Ubuntu Sources List Generator](http://repogen.simplylinux.ch/)
- [Personal Package Archives for Ubuntu](https://launchpad.net/ubuntu/+ppas)

**软件包地址**

- [Redmine@Lanuchpad](https://launchpad.net/~ondrej/+archive/redmine)

工具
----

- [Package Management](https://help.ubuntu.com/12.04/serverguide/package-management.html)

### dpkg ###

	dpkg -l
	dpkg -l | grep apache2
	dpkg -L ufw
	dpkg -S /etc/host.conf 
	sudo dpkg -i zip_3.0-4_i386.deb
	sudo dpkg -r zip

### apt-get ###

	apt-get help
	sudo apt-get install nmap
	sudo apt-get remove nmap
	sudo apt-get update
	sudo apt-get upgrade

### aptitude ###

    sudo aptitude

安装方法
--------

### PPA ###

- [Installing software from a PPA](https://help.launchpad.net/Packaging/PPA)
- [PPA(中文)](http://wiki.ubuntu.org.cn/PPA)

**安装 add-apt-repository**

    sudo apt-get install python-software-properties

**安装软件包**

    sudo add-apt-repository ppa:user/ppa-name
    sudo apt-get update
    sudo apt-get install 

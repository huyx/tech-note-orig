ufw 配置
========

参考:

- <http://wiki.ubuntu.org.cn/Ufw使用指南>

初始配置
--------

### 配置文件

编辑 /etc/default/ufw:

    # /etc/default/ufw
    IPV6=no     # 禁止 IPV6 规则

### 启用

1. **重要** 先允许 ssh 服务，阿里服务器缺省已经开启了 ssh 端口

    sudo ufw allow ssh
    sudo ufw allow 22/tcp			# 或指定端口

2. 开启防火墙

    sudo ufw enable

常用操作
--------

    sudo ufw status						# 查看状态
    sudo ufw status numbered            # 查看状态并显示规则序号
    sudo ufw allow to 10.10.10.1		# 允许来自内网所有连接
    sudo ufw allow from 192.168.6.0/24	# 允许来自 192.168.6.x 的连接
    sudo ufw delete allow 80/tcp		# 删除规则
    sudo ufw [--dry-run] delete NUM     # 试运行删除第 NUM 条规则

在防火墙关闭状态查看规则
---------------------

目前，防火墙没有开启前，不能通过 ufw 查看已经设置了那些规则，不过可以通过其他方法查看：

### 用 gufw

如果有图形界面就好说了，直接在图形界面里可以看到：

    sudo apt-get install gufw
    gufw

### 查看 /lib/ufw/user*.rules

/lib/ufw 目录下有两个规则文件 user.rules 和 user6.rules，其中 `### tuple ###` 的行中记录了当前的规则：

    sudo grep '^### tuple' /lib/ufw/user*.rules

格式为：

    ### tuple ### <action> <proto> <dst port> <dst> <src port> <src> <direction>
    ### tuple ### <action> <proto> <dst port> <dst> <src port> <src> <dst app name> <src app name> <direction>

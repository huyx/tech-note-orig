MongoDB 安全
============

概述
----

### 增加安全性的方法

- 修改缺省端口
- 打开认证
- 最新权限
- 防火墙

### 常用操作

    db.auth()
    db.addUser({ user: "...", pwd: "...", roles: ["...", "..."])
    db.runCommand({ logout: 1 })

### 角色

- 操作单个数据库的角色
  - read
  - readWrite
  - dbAdmin
  - userAdmin
- 操作所有数据库的角色
  - readAnyDatabase
  - readWriteAnyDatabase
  - dbAdminAnyDatabase
  - userAdminAllDatabase
- 管理角色
  - clusterAdmin

#### 角色组合

有些操作需要多个角色权限，比如：

- sh.status()
  需要 clusterAdmin 和对 config 的读操作
- rs.conf()
  需要 clusterAdmin 和对 local 的读操作
- sh.addShard()
  需要对 config 的读/写操作

存储：

- system.users

### 添加用户管理员

**用户管理员**，就是管理用户的用户。

1. 连接到 mongod 或 mongos

use admin

user = {
    user: "<username>",
    pwd: "<password>",
    roles: ["userAdminAnyDatabase"]
}

db.addUser(user)

2. 添加数据库用户

db.addUser

副本及和集群安全
----------------

1. 产生一个密钥文件，可以用下面命令产生：

    openssl rand -base64 128        # 产生长度为 128 字符的密钥

1. 修改文件权限

    sudo chown mongodb\: mongodb.key
    sudo chmod 600 mongodb.key

1. 在集群的每个成员的配置文件里增加 keyFile 配置：

    keyFile = /srv/mongodb/keyfile
    说明：keyFile 隐含了 auth 选项，因此这个选项可以省略

1. 连接到 mongos 或 mongod 进行配置

### 常见问题

#### 如何修改用户密码？

db.changeUserPassword("<username>", "<newpassword>")


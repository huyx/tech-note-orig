MongoDB 配置
============

配置文件和脚本
--------------

### MongoDB upstart 脚本

和 Ubuntu 缺省配置文件相比，做了如下修改：

- 修改创建的目录的权限
- 指定 pidfile，以便可以运行多个实例

脚本示例：

    # mongodb-sh1a.conf
    tart on runlevel [2345]
    stop on runlevel [06]
    
    limit nofile 20000 20000
    
    kill timeout 300 # wait 300s between SIGTERM and SIGKILL.
    
    pre-start script
      mkdir -p /alidata1/mongodb/sh1a
      mkdir -p /var/log/mongodb
      chown mongodb:mongodb /alidata1/mongodb/sh1a
      chown mongodb:mongodb /var/log/mongodb
    end script
    
    script
      exec start-stop-daemon --start --quiet --chuid mongodb:mongodb \
          --exec /usr/bin/mongod --pidfile /var/run/mongodb-sh1a.pid\
          -- --config /etc/mongodb/sh1a.conf
    end script

### MongoDB 配置文件(复制组成员)

    # sh1a.conf
    
    # port = 27017
    replSet = sh1
    oplogSize = 512                 # 修改 oplog 大小，缺省为可用空间的 5%

    dbpath = /alidata1/mongodb/sh1a
    directoryperdb = true           # 每个数据库一个目录
    logpath = /var/log/mongodb/sh1a.log
    logappend = true
    smallfiles = true
    cpu = true
    #nohttpinterface = true
    #auth = true

### MongoDB 配置文件(复制组 Arbiter)

    # sh1z.conf
    # Arbiter 服务器配置
    
    port = 27001
    replSet = sh1
    nojournal = true        # Arbiter 服务器，不需要 journal

    dbpath = /alidata1/mongodb/sh1z
    logpath = /var/log/mongodb/sh1z.log
    logappend = true
    smallfiles = true
    #cpu = true
    
    nohttpinterface = true
    #auth = true

### 配置服务器配置文件

    # configsvr.conf

    configsvr = true
    #port = 27019

    dbpath = /var/lib/mongodb/configdb
    logpath = /var/log/mongodb/configsvr.log
    logappend = true
    smallfiles = true
    cpu = true

    #nohttpinterface = true
    #auth = true

### mongos.conf

    # mongos.conf
    #port = 27017

    logpath = /var/log/mongodb/mongos.log
    logappernd = true
    configdb = configsvr1

    #nohttpinterface = true

复制组配置管理
--------------

### 复制组管理

    // 初始化
    rs.initiate()
    rs.add('host:port')
    rs.addArb('host:port')
    // 状态
    rs.status()
    db.getReplicationInfo()                // 查看 oplog 信息
    // 修改配置
    cfg = rs.conf()
    cfg.members[0].host = 'host:port'      // 修改成员地址
    cfg.members[0].priority = 2            // 修改优先级
    rs.reconfig(cfg)
    // 主服务器降级一段时间，缺省为 60 秒
    rs.stepDown([seconds])

集群管理
--------

### 设置块大小(chunkSize)

    # 连接到 mongos
    use config
    db.settings.save({ _id: "chunksize", value: 32})

说明：

- chunkSize 选项只在集群初始化时有用，因此建议都用上面的方法设置，以免造成疑惑。

MMS 监控
--------

### 安装

参考：

-  <https://mms.mongodb.com/settings/monitoring-agent>

1. 下载

    axel https://mms.mongodb.com/download/agent/monitoring/mongodb-mms-monitoring-agent_2.0.1.23-1_amd64.deb

2. 安装

    udo dpkg -i mongodb-mms-monitoring-agent_2.0.1.23-1_amd64.deb

3. 编辑 `etc/mongodb-mms/monitoring-agent.config`

    mmsApiKey=...

4. 启动 agent

    sudo start mongodb-mms-monitoring-agent

pymongo
--------

### 安装

    sudo pip install pymongo

常见问题
--------

### 系统不正常，怎么办？

有时候系统一些莫名其妙的问题，比如：

- 服务无法启动
- mongo 控制台卡住了一样，半天没反应
- 出现 11002 连接错误之类的
- 性能好像严重下降

这时首先要看下日志文件，往往答案在那里。

### 为什么 local 数据库占用这么大空间？

oplogSize 缺省为磁盘可用空间的 5%，而 oplog 集合在 local 数据库里，因此会占用较多磁盘空间。

### 如何修改 oplogSize？

简化步骤（修改后完全同步）：

- 执行 rs.stepDown
- 停止服务器
- 删除原来的数据文件
- 启动服务器，等待同步完成

更详细的说明参见：<http://docs.mongodb.org/manual/tutorial/change-oplog-size/>

### 复制组成员状态显示为 REMOVED 是怎么回事？怎么办？

**不用管它**，过一会会恢复（除非你的复制组没有后续操作）。

这种情况出现在“重新添加”成员后：

    rs.remove("host1:27017")
    rs.add("host1:27017")
    rs.status()

这时可以看到会出现这个状态！


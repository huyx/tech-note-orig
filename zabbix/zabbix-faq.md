### 如何测试配置是否正确 ###

zabbix_agentd

- `-p --print`: 打印支持的监测量
- `-t --test`: 测试

zabbix_get

示例：

    zabbix_agentd -p
    zabbix_agentd -t "agent.ping"
    zabbix_get -s 127.0.0.1 -k "agent.ping"

### 为什么 system.run 返回 ZBX_NOTSUPPORTED？ ###

现象：

    $ zabbix_agentd -t "system.run[echo test]"
    ZBX_NOTSUPPORTED

检查一下 agent 的配置文件中这个参数：

    EnableRemoteCommands=1

### 如何监测进程内存 ###

使用 ps 的 -o -p 和 --no-headers:

- rss 是实际内存
- vsx 是分配的虚拟内存
- `-p` 指定进程

    system.run[ps --no-headers -o rss -p $(cat youproc.pid)]
    system.run[ps --no-headers -o vsz -p $(cat youproc.pid)]

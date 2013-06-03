## HAPROXY ##

### 通过 acl 限制客户端 ip 地址 ###

网络结构： 192.168.*.* --> haproxy:6699 --> 192.168.0.1:2699

目标，只允许下列主机访问：

* 192.168.0.*
* 192.168.1.99

配置文件：

    listen  mysvc 0.0.0.0:6699
      mode tcp
      acl src1 192.168.0.1/24
      acl src2 192.168.1.99
      tcp-request content accept if src1 || src2
      tcp-request content reject
      dispatch 192.168.0.100:2699

说明：

* 不能用 block if，因为 block 是7层上的配置（http模式）
* 可以定义多个 acl 规则
* 可以指定多条控制规则：tcp-request content ... 
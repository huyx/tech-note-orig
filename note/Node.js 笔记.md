Node.js 笔记
============

参考链接:

- [Node.js](nodejs.org)
- [Node入门 » 一本全面的Node.js教程](http://www.nodebeginner.org/index-zh-cn.html)
- Node.js 开发指南.pdf

软件包:

- fs -- File System 文件系统
- events -- 事件模块
- util -- inherits, inspect
- msgpack -- MsgPack，目前只发现这个支持能支持消息流的解码
- protobufjs -- 人气比较高
- protobuf, protobuf.js -- 人气较低
- underscore -- http://underscorejs.org/
- mongodb
- redis

入门
----

### Ubuntu 系统安装 Node.js

自带版本:

    sudo apt-get install nodejs

最新版本:

    sudo apt-get install python-software-properties
    sudo add-apt-repository ppa:chris-lea/node.js
    sudo apt-get update
    sudo apt-get install g++ make nodejs

调试
----

### 本地调试

    node debug myprog.js

### 远程调试

    # 服务器
    node --debug[=port] myprog.js
    node --debug-brk[=port] myprog.js
    # 客户端
    node debug <host>:<port>

npm
---

    sudo npm install socket.io
    sudo npm --registry http://registry.npmjs.eu/ install express

**镜像列表**

- `http://registry.npmjs.eu/` --  主页 <http://npmjs.eu/> 
- `http://registry.cnpmjs.org/`
- `http://dist.u.qiniudn.com/` -- 七牛 http://nodejs.org/dist 镜像

示例
----

### 一个简单的 http 服务器


    // server.js
    var http = require("http");

    http.createServer(function(request, response) {
      console.log("Request received.");
      response.writeHead(200, {"Content-Type": "text/plain"});
      response.write("Hello World");
      response.end();
    }).listen(8888);

    console.log("Server has started.");

其中：

- http.createServer
- request, resoponse
- console.log
- listen

TIPS
----

### npm 安装软件包时出现 gyp 访问的网址 http://nodejs.org/dist， 但停住不动了，怎么办能不能改变到其他网址？

这是个莫名其妙的问题，但为什么我们中国人就不能有个正常的网络呢？实在需要修改时可以这样：

    npm --disturl=http://xxxxxx/xxx ...

前提是你能找到一个镜像。


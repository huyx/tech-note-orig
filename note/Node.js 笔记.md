Node.js 笔记
============

参考链接:

- [Node入门 » 一本全面的Node.js教程](http://www.nodebeginner.org/index-zh-cn.html)

软件包:

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
    sudo apt-get install python-software-properties python g++ make nodejs

npm
---

    sudo npm install socket.io
    sudo npm --registry http://registry.npmjs.eu/ install express

**镜像列表**

- `http://registry.npmjs.eu/` --  主页 <http://npmjs.eu/> 

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


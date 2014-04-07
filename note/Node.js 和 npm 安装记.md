安装 Node.js 和 包管理器
npm，折腾了一上午，似乎是快要成功了，记录下折腾的过程！

先介绍下系统环境，阿里云的服务器，最低配置，512M内存，Ubuntu 12.04。

### 安装 Node.js

首先是安装 Node.js，Ubuntu 12.04 中软件库里有 Node.js，不过版本有些老了，对于日新月异的 Node.js 来说，还是安装最新版本比较好：

    sudo apt-get install python-software-properties
    sudo add-apt-repository ppa:chris-lea/node.js
    sudo apt-get update
    sudo apt-get install python-software-properties python g++ make nodejs

### 使用 npm!

好了，安装好了，npm 也安装好了，可是，查找一个软件包试试:

    $ npm search redis
    npm WARN Building the local index for the first time, please be patient
    npm http GET https://registry.npmjs.org/-/all

然后，就没有下文了，安装了 iftop 查看，发现数据传输很慢，过一会就变成了 0，看来是 GFW 或是工信部的孩子们做鬼，该死！

### http 代理

网上查了一下，npm 可以设置代理：

    npm config set proxy http://xxx.xxx.xxx.xxx:port

反正代理是挺难找的，好不容易有个能通、网络速度又快的，下载完后出现 Killed：

    $ npm search redis
    npm WARN Building the local index for the first time, please be patient
    npm http GET https://registry.npmjs.org/-/all
    npm http 200 https://registry.npmjs.org/-/all
    Killed

不知道咋回事，又试了其他代理，要么是不同，要么是慢得要死。

### npm 镜像

干脆找 registry.npmjs.org 的镜像吧，成果有了：

    npm config set registry http://registry.npmjs.eu/

速度还挺快，但最后还是 Killed，网上搜了一下，发现应该因为内存占用过大是被 kill 掉了，小心监测了一下内存占用，发现 npm 下载软件包列表完成后占用内存急剧增加，然后就 Killed 了。

### 解决 killed

由于云服务器只有 512M 内存，而且没有交换空间，解决方法就是增加交换空间。

好了！

参考：

- [安装 Node.js - Ubuntu, Mint, elementary OS](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager#ubuntu-mint-elementary-os)


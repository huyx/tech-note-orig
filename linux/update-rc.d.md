## update-rc.d ##

* [update-rc.d 命令用法详解](http://blog.csdn.net/shb_derek/article/details/8489112)
* [Ubuntu Manpage: update-rc.d](http://manpages.ubuntu.com/manpages/precise/en/man8/update-rc.d.8.html)

示例：

     update-rc.d foobar defaults
     update-rc.d foobar start 20 2 3 4 5 . stop 20 0 1 6 .
     update-rc.d top_level_app defaults 98 02

### 相关文件 ###

* /etc/init.d/skeleton
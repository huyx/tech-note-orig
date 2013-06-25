lsof
====

可以查看打开的文件和 TCP 连接。

## 常用操作 ##

- 列出所有打开的文件: `lsof`
- 列出指定进程打开的文件: `lsof -a -p 605`
- 查找打开某个文件的应用程序: `lsof /var/run/sendmail.pid`
- 找出谁在使用文件系统: `lsof /export/home`
- 查找已经删除的文件: `lsof | grep (deleted)`
- 监听端口 25 的进程: `lsof -i :25`
- 显示活动的连接: `lsof -i @192.168.1.10`

## 技巧 ##

- 恢复误删的文件，见参考文档。
- 解决问题: 删除正在打开的文件不会释放空间，因此有时候空间会莫名其妙不见了，这是用 `lsof | grep (deleted)` 可以找到这些文件，重启系统可以删除这些文件，或者重启打开这些文件的进程。

## 参考文档 ##

- [使用 lsof 查找打开的文件](http://www.ibm.com/developerworks/cn/aix/library/au-lsof.html)

    
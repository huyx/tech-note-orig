# Windows XP #

## 常用软件 ##

- [TimeSnapper](http://www.timesnapper.com/) -- 定时截取屏幕的软件，可以选择截取 **全屏** 或 **活动窗口**。
  - 看主页，TimeSnapper 是个商业软件，有 30 天试用期！ 不要紧，往下看，在页面最下端可以看到： `TimeSnapper Classic: Free Forever`， 永久免费。

## 技巧 ##

### Windows 的 uptime ###

- 参考: [http://stackoverflow.com/questions/11606774/how-to-get-the-uptime-in-windows](http://stackoverflow.com/questions/11606774/how-to-get-the-uptime-in-windows)

台式机还好，服务器运行多长时间了？linux 下可用用 uptime 获得，Windows 怎么办？

**使用 “任务管理器”** 

Windows XP 不适用，Windows 2008 适用,其他没测试

- 打开任务管理
- 选择“性能”页面
- 仔细找找，在靠右靠下的位置

**使用 systeminfo**

英文系统： `systeminfo | find "System Boot Time:"`
中文系统: `systeminfo | find "系统启动时间"`

### Windows 扩展名冲突带来的问题 ###

- 环境： Windows XP

我习惯于把 MySQL 配置文件的扩展名写成 `.cnf`，在 Windows 上问题就来了， Windows 把 `.cnf` 识别成了“快速拨号”类型的文件，文件扩展名不见了，图标也换了。

更客气的是，右键菜单也换了，常用的操作（编辑）也执行不了，碰到这种情况，一般是采用两种方法：

- 打开浏览器，选择“工具/文件夹选项/文件类型”，找到扩展名，修改
- 注册表编辑器，找到 `.cnf` 修改

今天我直接打开了注册表编辑器，找到 `.cnf`，看看好像是 Netmeeting 使用的文件，直接就给删了，删了之后要重启 `explorer` 才生效。

打开任务管理器，杀掉 `explorer`。

这是桌面和任务栏都不见了，不要慌，还是在任务管理器里，选择“文件/新建任务”，输入： `C:\Windows\explorer.exe`，一切就该恢复正常了。

可是今天，情况有些不对，桌面和任务栏还是没有出来，怎么办？请看《故障：关闭后无法打开资源管理器（explorer）》

### 故障：关闭后无法打开资源管理器（explorer） ###

- 环境： Windows XP
- 摘要： 退出 chrome 后，explorer 就回来了

由于修改了一些配置需要重启 explorer，用任务管理器杀掉 explorer 后，“文件/新建任务”，输入 `C:\Windows\explorer.exe`，任务栏和桌面却没有出来。

一番折腾后，发现其实很简单，只要杀掉某些进程就可以了，今天试了试，发现完全退出 chrome 后，桌面和任务栏马上回来了，重新试验一番，确认这个管用。

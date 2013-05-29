## 故障现象

复位后，系统可以好几分钟，然后系统不管用了，发现硬盘变成了只读，dmesg 查看，发现很多下面的消息：

	[  956.313601] sd 2:1:5:0: rejecting I/O to offline device
	[  956.313609] sd 2:1:5:0: rejecting I/O to offline device
	[  956.313618] sd 2:1:5:0: rejecting I/O to offline device
	[  956.313628] sd 2:1:5:0: rejecting I/O to offline device

执行大部分命令提示都是如此：

    root@ubuntu:~# reboot
    bash: /sbin/reboot: Input/output error

网上查找资料，说是下面的启动参数可能管用，修改 /boot/grub/grub.cfg，在 linux 启动命令行末尾加上：

    noapic apci=off

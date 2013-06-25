# TCP Keepalive #

Linux 平台支持，Windows 未知。

## 内核支持（基本不可行） ##

可以配置内核的 keepalive 参数，但是，请注意：

- **修改影响全局** 大家都用一个参数？
- **程序还需要配合** 程序还需要用 setsockopt 请求 keepalive 控制，既然做了这个了，还不如一起把参数设置了！

只记录一下查看参数的方法：

    cat /proc/sys/net/ipv4/tcp_keepalive_time
    cat /proc/sys/net/ipv4/tcp_keepalive_intvl
    cat /proc/sys/net/ipv4/tcp_keepalive_probes

要重启生效的话，需要用 sysctl(8) 修改参数

## 编程的方法 ##

### C ###

    int s;
	int optval;
	socklen_t optlen = sizeof(optval);

	s = socket(PF_INET, SOCK_STREAM, IPPROTO_TCP));
    // 查看 KEEPALIVE
	getsockopt(s, SOL_SOCKET, SO_KEEPALIVE, &optval, &optlen);
    // 设置 KEEPALIVE
	optval = 1;
	setsockopt(s, SOL_SOCKET, SO_KEEPALIVE, &optval, optlen);
	// 设置 TCP_KEEPIDLE、TCP_KEEPCNT、TCP_KEEPINTVL
	optval = 180;
	setsockopt(s, SOL_TCP, TCP_KEEPIDLE, &optval, optlen);
	optval = 3;
	setsockopt(s, SOL_TCP, TCP_KEEPCNT, &optval, optlen);
	optval = 60;
	setsockopt(s, SOL_TCP, TCP_KEEPINTVL, &optval, optlen);

### Python ###

    import platform
    import socket

    sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    sock.setsockopt(socket.SOL_SOCKET, socket.SO_KEEPALIVE, 1)
    sock.setsockopt(socket.SOL_TCP, socket.TCP_KEEPIDLE, 300)
    sock.setsockopt(socket.SOL_TCP, socket.TCP_KEEPINTVL, 60)
    sock.setsockopt(socket.SOL_TCP, socket.TCP_KEEPCNT, 3)


## 使用 libkeepalive ##

[libkeepalive](http://libkeepalive.sourceforge.net/) 的使用方法：

	$ LD_PRELOAD=libkeepalive.so test
	$ LD_PRELOAD=libkeepalive.so KEEPCNT=20 KEEPIDLE=180  KEEPINTVL=60 test

参考 [原文链接](http://www.tldp.org/HOWTO/TCP-Keepalive-HOWTO/addsupport.html#libkeepalive)。

## 参考 ##

- [TCP Keepalive HOWTO](http://www.tldp.org/HOWTO/TCP-Keepalive-HOWTO/index.html)


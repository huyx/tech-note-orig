# Redis 设计模式 #

## Lock ##

参考：

- [Locking with SETNX](http://redis.io/commands/setnx) -- 从 2.6.12 开始，可以用 SET 命令更简单地实现同样功能
- [Locking with SETNX](http://redis.io/commands/set)

锁定：

    SET resource-name anystring NX EX max-lock-time

解锁(只有在值匹配时才删除 key):

    if redis.call("get",KEYS[1]) == ARGV[1]
	then
	    return redis.call("del",KEYS[1])
	else
	    return 0
	end

## 算法 ##

### 滑动平均 ###

	def moving_average(iterable, n=3):
	    # moving_average([40, 30, 50, 46, 39, 44]) --> 40.0 42.0 45.0 43.0
	    # http://en.wikipedia.org/wiki/Moving_average
	    it = iter(iterable)
	    d = deque(itertools.islice(it, n-1))
	    d.appendleft(0)
	    s = sum(d)
	    for elem in it:
	        s += elem - d.popleft()
	        d.append(elem)
	        yield s / float(n)

## 数据结构 ##

### enum -- 枚举类型 ###

    class Status:
        open, pending, closed = range(3)

### namedtuple ###


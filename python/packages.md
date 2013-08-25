# Python 软件包 #

## Web ##

- [urllib3](https://github.com/shazow/urllib3) - Requests 基于 urllib3 开发

### Requests ###

- [Requests](https://github.com/kennethreitz/requests) - HTTP for Humans

例子：

    #!/usr/bin/env python
	# -*- coding: utf-8 -*-
	 
	import requests
	 
	r = requests.get('https://api.github.com', auth=('user', 'pass'))
	 
	print r.status_code
	print r.headers['content-type']
	 
	# ------
	# 200
	# 'application/json'

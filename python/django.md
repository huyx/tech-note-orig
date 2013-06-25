Django
======

TIPS
----

### 管理界面中显示日期的域长度不够，日期显示不全 ###

dirty 但是简单的方法，查看显示页面源代码，发现:

	<input class="vDateField" ... size="12" ...>

在 contrib/admin 下查找 vDateField，得到： 

    grep 'vDateField' -R .

	./widgets.py: final_attrs = {'class': 'vDateField', 'size': '10'}

修改 widgets.py，把 10 修改成 12。
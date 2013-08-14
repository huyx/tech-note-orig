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

### 定制多对多关系 ###

当我们定义一个 ManyToManyField 的字段时，Django 会自动为我们创建一个类（以及相应的关系表），这个创建由`django.db.models.fields.related.create_many_to_many_intermediary_model`完成，一般情况下可以满足我们的需要。

但有时我们需要定制自己的关系类（以及相应的关系表），这时可以通过 `ManyToManyField` 的 through 参数实现：

    class Person(models.Model):
	    name = models.CharField(max_length=128)
	
	    def __unicode__(self):
	        return self.name
	
	class Group(models.Model):
	    name = models.CharField(max_length=128)
	    members = models.ManyToManyField(Person, through='Membership')
	
	    def __unicode__(self):
	        return self.name
	
	class Membership(models.Model):
	    person = models.ForeignKey(Person)
	    group = models.ForeignKey(Group)
	    date_joined = models.DateField()
	    invite_reason = models.CharField(max_length=64)

	    def __unicode__(self):
	        return "%s_%s“ % (self.person, self.group)

	    class Meta:
	        db_table = u"membership"
	        verbose_name = u"Membership"
	        verbose_name_plural = u"Memberships"

上面例子中，我们做了如下定制:

- 添加了字段 `date_joined` 和 `invite_reason`
- 重新定义了 `__unicode__`
- 重新定义了 Meta，指定了数据表名(`db_table`)和显示名(`verbose_name`)

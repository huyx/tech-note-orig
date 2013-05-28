## 服务器配置

### 字符集

* 查看字符集
  * `show variables like '%char%'`
* 编辑 /etc/mysql/conf.d/mysql_charset.cnf

文件内容如下：

    [mysqld]
    character-set-server=utf8
    collation-server=utf8_general_ci

### 其他

* 重置密码
  * `mysqladmin -uroot password '123456'` -- #密码重置为 123456


MySQL
=====

## 工具 ##

### mysqladmin ###

Ubuntu 下支持**命令补全**，例如：

	$ mysqladmin -<TAB<TAB>
    -?  -#  -C  -E  -f  -h  -i  -p  -P  -r  -s  -S
    -t  -u  -v  -V  -w

又如：

    $ mysqladmin <TAB><TABl
    -?                flush-tables      reload
    ...

一次可以执行多个命令，例如：

	mysqladmin processlist status

常用操作：

	mysqladmin create <db_name>
	mysqladmin drop <db_name>
	mysqladmin processlist
	mysqladmin extended-status

## 运算符 ##

### 判断/比较 ###

- `[NOT] LIKE`: 支持通配符, `%` 匹配多个字符， `_` (下划线) 匹配单个字符。
- `[NOT] REGEXP`: **正则表达式**，例如: `"Tom" REGEXP "[Tt].*"`
- `BINARY`: **二进制比较**，缺省 LIKE 比较不区分大小写，可以使用这种语法： `BINARY a LIKE b`


### 逻辑运算 ###

- `AND OR NOT`
- `&& || !`

### 位运算 ###

- `& | ~ ^`
- `<< >>`

### TIPS ###

- `~` 和 `!`
    -  `~` 取反（位运算）
    -  `!` 非（逻辑运算）

#### 数据库改名 ####

参考:

- [RENAME TABLE Syntax](http://dev.mysql.com/doc/refman/5.5/en/rename-table.html)

说明：

- 不能直接改名： 曾经有这个命令，因为有一定风险，又去掉了
- 可以采用表改名： 表改名时可以修改到数据库

	RENAME TABLE current_db.tbl_name TO other_db.tbl_name;

## 服务器配置 ##

### 字符集 ###

* 查看字符集
  * `show variables like '%char%'`
* 编辑 /etc/mysql/conf.d/mysql_charset.cnf

文件内容如下：

    [mysqld]
    character-set-server=utf8
    collation-server=utf8_general_ci

## 其他 ##

- 重置密码
    - `mysqladmin -uroot password '123456'` -- #密码重置为 123456
- mysql 导入 sql 文件中间遇到错误时继续执行下面的语句
    - `-f`、`--force`


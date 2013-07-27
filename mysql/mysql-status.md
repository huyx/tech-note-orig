MySQL 状态
==========

通过 mysql 执行命令：

    mysql -uroot -e status
    或
    echo status | mysql -uroot
    或
    mysql -uroot <<EOL
    > status
    > EOL
    或
    echo status > status
    mysql -uroot < status

- `status`
- `show processlist`

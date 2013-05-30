### 参数

* `-X, --exclude-from FILE`    排除文件中列出的 patterns

### 示例

**备份目录，排除指定的文件**

    tar czvf backup.tar.gz -X tar-back-X-files dir1 dir2

    # tar-back-X-files
    *.pyc
    *.log*
    var/history/*


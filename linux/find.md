## find ##

### TIPS ###

#### 查找文件并按日期排序： ####

简洁，比较好的实现（利用 xargs）

    find -name '*.txt' | xargs ls -ltr       

不太好的实现（利用 sort）

    find -name '*.txt' -exec ls -l --time-style=+"%F %T" {} \; | sort -k 6

# Linux TIPS #

### dos2unix ###

	# dos2unix/unix2dos
    sed -i -e 's/\r//' file
    # unix2dos/todos
    sed -i -e 's/$/\r/' file

### sponge ###

sponge 的翻译:  n. 海绵；海绵状物

**sponge** 把所有输入读取后保存到文件里，因此可以配合管道实现对同一文件的读取和写入。

**iconv 配合 sponge 实现文件编码转换**

    for file in *.txt; do
        iconv -f gbk -t utf8 "$file" | sponge "$file"
    done


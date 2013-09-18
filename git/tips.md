# GIT 技巧 #

## 获取信息 ##

    # 提交次数
	git rev-list HEAD | wc -l
	git log --oneline			# 老版本不适用
	# 修改文件数, 添加的行数, 删除的行数
	git diff --shortstat | sed -e 's/[^0-9]*\([0-9]\+\)[^0-9]*/\1./g' -e 's/.$$//')

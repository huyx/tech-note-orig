MySQL Workbench
===============

### 显示中文、修改字体 ###

MySQL Workbench 对中文的支持还算不错，但缺省配置下中文显示有问题，有的地方是显示不出来，有的地方是显示效果比较差（字体很小）。经过一番尝试，找到了修改的方法。

第一步： 修改字体，支持中文显示

- 菜单: `Edit/Preferences...`，打开选项对话框
- 选择 `Appearance` 页
- 在 `Configure Fonts For:` 中选择 `Simplified Chinese`
- 这时 `Fonts` 列表框的内容已经调整成了可以显示中文的字体

第二部：修改字体大小

- 第一种方法
  - 用鼠标在要修改的字体上点一下，然后不动保持2秒，这时字体进入编辑状态
  - 把每种字体都改大一号
- 修改配置文件: `wb_options.xml`，不同计算机配置文件所在位置可能不一样，可以按照下面的步骤找到文件：
  - `开始-->运行` 输入 `cmd.exe` 并回车
  - 在命令窗口输入 `start .`
  - 上面两步可以合成一步：在 `运行` 对话框里输入 `cmd /c start .`
  - 从这里开始找到: `Application Data\MySQL\Workbench\wb_options.xml`
  - 修改配置文件中所有含 Font 的项目，字体大小加 1。


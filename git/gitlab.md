# gitlab #

- [gitlab](http://gitlab.org)

## 安装 ##

部署的环境是 Ubuntu 12.04。

正式的安装方法比较麻烦，为了省事可以采用 [BitNami](http://bitnami.com) 提供的安装包：

- [BitNami 提供的 Gitlab 安装包](http://bitnami.com/stack/gitlab)

### 步骤 ###

- 下载 GitLab 5.2.0 for Linux 64-bit
- 设置成可执行文件： `chmod +x bitnami-gitlab-5.2.0-0-linux-x64-installer.run`
- 执行安装文件: `sudo ./bitnami-gitlab-5.2.0-0-linux-x64-installer.run` 

## FAQ ##

### 安装后 email 通知内容中 url 地址不对 ###

问题： 安装后访问 gitlab 的地址大致是 http://192.168.0.100:8080/**gitlab**， 可是 gitlab 发送的邮件通知中给出的链接是： http://192.168.0.100:8080/...，这样就不能直接从邮件提供的链接直接打开相应地址。

解决方法：

- 进入安装目录: `cd /opt/gitlab-5.2.0`
- 修改配置文件: `sudo vi apps/gitlab/htdocs/config/gitlab.yml`
  - 修改 **relative_url_root**: `relative_url_root: /gitlab`
- 重启 apache: `sudo ./ctlscript.sh restart apache`
- (不知道是不是必须的)重启 gitlab_sidekiq: `sudo ./ctlscript.sh restart gitlab_sidekiq`

参考:

- [Running GitLab from a subdirectory on Apache](http://shanetully.com/2012/08/running-gitlab-from-a-subdirectory-on-apache/)
- [gitlab.yml.example](https://github.com/gitlabhq/gitlabhq/blob/master/config/gitlab.yml.example)


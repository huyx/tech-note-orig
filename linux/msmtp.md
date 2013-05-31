## msmtp ##

### 安装 ###

    sudo apt-get install msmtp

### 配置 ###

* 配置文件所在位置： 执行 `msmtp --version` 可以查看
  * 系统配置文件: /etc/msmtprc
  * 用户配置文件: ~/.msmtprc

#### 使用 Gmail 发信 ####

    defaults
    tls on
    tls_starttls on
    tls_trust_file /etc/ssl/certs/ca-certificates.crt
    
    account default
    host smtp.gmail.com
    port 587
    auth on
    user <usrename>@gmail.com
    password <passwordL
    from <usrename>@gmail.com
    logfile ~/msmtp.log

### 测试 ###

	echo -e "Subject: Test Mail\r\n\r\nThis is a test mail" |msmtp --debug --from=default -t username@gmail.com

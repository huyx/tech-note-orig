upstart 笔记
============

参考：

- <http://upstart.ubuntu.com/cookbook/#configuration>
- <http://upstart.ubuntu.com/cookbook/#environment-variables>
- <http://upstart.ubuntu.com/cookbook/#initctl-commands-summary>
- <http://upstart.ubuntu.com/cookbook/#cookbook-and-best-practises>

配置文件
-------

### 小节分类

#### Process Definition

- exec	 
- pre-start	 
- post-start	 
- pre-stop	 
- post-stop	 
- script	 

#### Event Definition

- manual
- start on	 
- stop on	 

#### Job Environment

- env	 
- export	 

#### Services, tasks and respawning

- normal exit	 
- respawn	 
- respawn limit	 
- task	 

#### Instances

- instance	 

#### Documentation

- author	 
- description	 
- emits	 
- version	 
- usage

#### Process environment

- apparmor load
- apparmor switch
- console none	 
- console log
- console output	 
- console owner	 
- chdir
- chroot	 
- limit	 
- nice	 
- oom score	 
- setgid	
- setuid	
- umask

#### Process Control

- expect fork	 
- expect daemon	 
- expect stop	 
- kill signal
- kill timeout	 
- reload signal


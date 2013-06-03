# redis-py #

## hiredis ##

- https://github.com/pietern/hiredis-py
- **慎用**： 使用 scripts 时不能正确更新加载。 

## 已知问题 ##

- 使用 redis-py + hiredis 时连接断开后不会自动重新加载
  - 参考： [Scripts are not automatically reloaded properly when using the HiredisParser](https://github.com/andymccurdy/redis-py/issues/318)

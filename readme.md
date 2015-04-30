##Yii 按模块连接数据库
---
###Require
* Yii 1.x
* php 5.3+

###How to use

 1. 引入类
引入`ActiveRecord`和`WebModule`类
使模型文件继承`ActiveRecord`
使模块文件继承`WebModule`
 2. 配置
 在模块配置下设置db,db配置和系统db配置相同. 参考`main.php`
 3. 额外说明
* 区别于使用configure()函数,跨模块调用模型将优先使用被调用模块的数据库配置
* 若模块没有配置db属性,模型将仍然调用系统级db参数连接数据库
* 仅测试了无嵌套的模块
* 系统级的模型仅会调用系统db

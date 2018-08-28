# 微信公众号后台程序
### 说明
    1. 这个程序没有太多功能
    2. 它是个人号的后台
    3. 采用PHP编写
    4. 模仿和借鉴了贴吧云签到的源码
    5. 娱乐学习用的
    6. 弃坑了

### 运行环境
    开发环境: Windows 10+PHP 7.1+MYSQL 5.7
    部署环境: Windows Server 2012+PHP 7.1+MYSQL 5.7

### 目录结构
```
wechat.
├─function
├─library
├─plugin
│  ├─demo
│  ├─livesrc
│  ├─myname
│  ├─replyMsg
│  └─tulingAI
├─save
├─source
│  ├─css
│  ├─image
│  └─js
│      └─theme
│          └─default
└─template
    ├─admin
    ├─error
    └─web
        └─apps
            └─test
                ├─css
                └─js
```

### 数据库结构
    phpmyadmin导出个文件放源码里了

### 使用方法
    1. 修改sw_config.php文件
    2. 上传到服务器
    3. 修改数据表sw_config中的wx_check为1
    4. 去微信公众平台进行服务器验证
    5. 验证完毕wx_check改为0
    6. 应该就可以用了

### 功能特点
    1. 可切换到公众号服务器验证模式
    2. plugin内的插件自动加载，后台有开关
    3. 关键词回复功能
    4. webapp写起来也很方便
    5. 忘了还有什么了

### 示例
    四维平面公众号(siweipingmian)
![siweipingmian](https://blog.aikamino.cn/wp-content/uploads/2018/04/640.webp_.jpg)

### 协议
    不懂这个，随意拿去玩

### 感谢
    kenvix的wcurl和mysqli类(https://kenvix.com/)

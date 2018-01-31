这是一个用symfony4开发的后台管理系统
=============

如何安装？
-------------

**1.下载项目 并且编译项目**

>     git clone https://gitlab.com/nligo/coffey-admin.git
>     cd coffey-admin
>     composer install


**2.配置数据库,邮件,站点信息,域名信息,在.env文件中进行编辑**
>     DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
>     MAILER_URL=null://localhost
>     LOG_FORM_EMAIL=from@email.com
>     LOG_TO_EMAIL=to@email.com
>     DOMAIN=domain.com
>     ADMIN_DOMAIN=admin.domain.com
>     SITE_NAME=飞羽科技
**3.创建数据库，更新数据表**

>     bin/console doctrine:database:create
>     bin/console doctrine:schema:update -f


**然后访问http://admin.domain.com/ 就可以看到后台的东西了**



![Alt text](website.png "网站图片")

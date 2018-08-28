<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/26,下午 11:04
 * Description:
 * Version:
 */

//定义程序根目录
define( "ROOT_PATH", __DIR__ . "/" );

//数据库配置Mysql
define( "DB_HOST", "" );
define( "DB_USER", "" );
define( "DB_PASSWD", "" );
define( "DB_DBNAME", "" );

//SMTP配置
define( "SMTP_HOST", "smtp.163.com" );
define( "SMTP_SEC", "ssl" );
define( "SMTP_PORT", 465 );
define( "SMTP_ACCOUNT", "" );
define( "SMTP_PASSWD", "" );
define( "SMTP_NAME", "" );

//公众号配置
define( "WX_APPID", "" );
define( "WX_SECRET", "" );
define( "WX_TOKEN", "" );
define( "WX_BIZ", "" );

//网站配置
define( "WWW_HOST", $_SERVER["HTTP_HOST"] );
define( "WWW_CLIENTIP", $_SERVER["REMOTE_ADDR"] );
define( "WWW_URL", ( ( ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on" ) || ( isset( $_SERVER["HTTP_X_FORWARDED_PROTO"] ) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https" ) ) ? "https://" : "http://" ) . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );

//webapp配置
define( "WEB_DEBUG", false );
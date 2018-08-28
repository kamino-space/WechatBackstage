<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/26,下午 10:55
 * Description: 程序入口
 * Version: 1.2.1
 */

require_once "init.php";


switch ( $_GET["f"] ) {
	case \sw\sw_config::getConfig( "wx_url" ):
		if ( \sw\sw_config::getConfig( "wx_check" ) ) {
			$wx = new \wx\wx_check();
			$wx->valid();
		} else {
			$wx = new \wx\wx_response();
			$wx->responseStart();
		}
		break;
	case "web":
		require ROOT_PATH . "template/web/index.php";
		break;
	case "admin":
		require ROOT_PATH . "template/admin/index.php";
		break;
	case "ajax":
		echo WWW_URL;
		break;
	case "":
		header( "Location: https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=" . WX_BIZ . "&scene=110#wechat_redirect" );
		break;
	default:
		require ROOT_PATH . "template/error/404.php";
		break;
}